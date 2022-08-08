<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database',  'proses');
    }

    public function index()
    {
        $data['title'] = 'Pembayaran';
        $role_id = $this->session->userdata('role_id');
        $email = $this->session->userdata('email');
        $role = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        if ($role_id == 4) {
            $user = $this->db->get_where('pelanggan', ['email' => $email])->row_array();
            $data['home'] = 'page/home/home-pelanggan';
            $data['role'] = $user['nama'];
        } else {
            $data['role'] = $role['role'];
            $data['home'] = 'page/home/home-admin';
        } 
        
        $data['pemesanan'] = $this->proses->getDataJoin('pemesanan.*,nama_paket,harga', 'pemesanan', 'paket_wisata ', 'paket_wisata_id = paket_wisata.id', ['pelanggan_id' => $user['id'], 'pemesanan.status' => 1, 'status_pemesanan' => 0]);

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pembayaran/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function proses_pembayaran($id_pemesanan){
        $pemesanan = $this->db->get_where('pemesanan', ['id' => $id_pemesanan])->row_array();
        //$bank_pengirim = $this->input->post('bank_pengirim');
        //$bank_penerima = $this->input->post('bank_penerima');
        $nomor_rekening = $this->input->post('nomor_rekening');
        $jumlah_transfer = str_replace(",", "",$this->input->post('jumlah_transfer'));
        
        $tanggal_pembayaran = $this->input->post('tanggal_bayar'); 
        $status_pembayaran = $this->input->post('status_pembayaran');

         
        if($this->input->post('jumlah_bayar')){
             $jumlah_bayar = str_replace(",", "",$this->input->post('jumlah_bayar'));
        }else{
             $jumlah_bayar = $pemesanan['jumlah_harga'] * 0.25;
        }

        //validasi jumlah transfer tidak boleh kurang dari jumlah yang harus dibayar
        if($jumlah_transfer < $jumlah_bayar){
            $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Jumlah transfer tidak boleh kurang dari jumlah bayar. Silahkan isi form pembayaran kembali! </div></center>');
            redirect(base_url('pembayaran'));
        }

        //validasi jika sudah melewati batas pembayaran
        $tgl = $pemesanan['tanggal_pemesanan'];
        $tgl_otw = $pemesanan['tanggal_keberangkatan'];
        $tgl1 = date('Y-m-d', strtotime('+10 days', strtotime($tgl)));
        $tgl2 = date('Y-m-d', strtotime('+20 days', strtotime($tgl)));
        $tgl3 = date('Y-m-d', strtotime('-7 days', strtotime($tgl_otw)));

        if($pemesanan['status_pembayaran'] == 0){
            if($tanggal_pembayaran > $tgl1){
                $this->proses->updateData('pemesanan', ['status_pemesanan' => 3], ['id' => $id_pemesanan]);

                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Maaf anda melebihi jangka waktu pembayaran. Pesanan anda telah dibatalkan dan uang yang telah dibayarkan telah hangus. </div></center>');

                redirect(base_url('pembayaran'));
            }
        }elseif($pemesanan['status_pembayaran'] == 1){
            if($tanggal_pembayaran > $tgl2){
                $this->proses->updateData('pemesanan', ['status_pemesanan' => 3], ['id' => $id_pemesanan]);

                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Maaf anda melebihi jangka waktu pembayaran. Pesanan anda telah dibatalkan dan uang yang telah dibayarkan telah hangus. </div></center>');

                redirect(base_url('pembayaran'));
            }
        }elseif($pemesanan['status_pembayaran'] == 2){
            if($tanggal_pembayaran > $tgl3){
                $this->proses->updateData('pemesanan', ['status_pemesanan' => 3], ['id' => $id_pemesanan]);

                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Maaf anda melebihi jangka waktu pembayaran. Pesanan anda telah dibatalkan dan uang yang telah dibayarkan telah hangus. </div></center>');

                redirect(base_url('pembayaran'));
            }
        }

        $bukti_pembayaran = $_FILES['bukti_pembayaran']['name'];

        if ($bukti_pembayaran) {
            $config['upload_path']       = './assets/img/bukti_pembayaran/';
            $config['allowed_types']     = 'gif|jpg|png';
            $config['max_size']          = '2048';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('bukti_pembayaran')) {
                $bukti_bayar = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center>'.$error['error'].'</center>');
                redirect(base_url('pembayaran'));
            }
        } 
        
        $data = [
            'pemesanan_id' => $id_pemesanan,
            // 'bank_pengirim' => $bank_penerima,
            // 'bank_penerima' => $bank_penerima,
            'nomor_rekening' => $nomor_rekening,
            'jumlah_transfer' => $jumlah_transfer,
            'tanggal_pembayaran' => $tanggal_pembayaran,
            'bukti_pembayaran' => $bukti_bayar,
            'status_pembayaran' => $status_pembayaran,
            'jumlah_bayar' => $jumlah_bayar
        ];

        $sql = $this->proses->insertData('proses_pembayaran', $data);

        if($sql){
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Pembayaran sedang diproses. Selanjutnya sistem akan meneruskan ke Manager Keuangan! Mohon Tunggu.. </div></center>');
            redirect(base_url('pembayaran'));
        }

    }

    public function form_pembayaran(){
        $data['title'] = 'Form Pembayaran';
        $role_id = $this->session->userdata('role_id');
        $email = $this->session->userdata('email');
        $role = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        if ($role_id == 4) {
            $user = $this->db->get_where('pelanggan', ['email' => $email])->row_array();
            $data['home'] = 'page/home/home-pelanggan';
            $data['role'] = $user['nama'];
        } else {
            $data['role'] = $role['role'];
            $data['home'] = 'page/home/home-admin';
        }

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pembayaran/form_pembayaran', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function cetak_kwitansi(){
        $data['title'] = 'Cetak Kwitansi';
        $role_id = $this->session->userdata('role_id');
        $email = $this->session->userdata('email');
        $id = $this->session->userdata('id');
        $role = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        if ($role_id == 4) {
            $user = $this->db->get_where('pelanggan', ['email' => $email])->row_array();
            $data['home'] = 'page/home/home-pelanggan';
            $data['role'] = $user['nama'];
        } else {
            $data['role'] = $role['role'];
            $data['home'] = 'page/home/home-admin'; 
        }
 

        $data['pemesanan'] = $this->db->query("SELECT nama,status_pemesanan, proses_pembayaran.id,jumlah_harga,tanggal_pembayaran, nama_paket ,tanggal_keberangkatan ,pemesanan.jumlah_bayar,tanggal_pemesanan ,proses_pembayaran.status_pembayaran ,total_cicilan FROM `proses_pembayaran` JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE pelanggan_id = $id ORDER BY tanggal_pembayaran ASC")->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pembayaran/v_cetak_kwitansi', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }
    
    public function tab_pembayaran($id_proses){
        $data['title'] = "Cetak Kwitansi";

        $id = $this->session->userdata('id'); 

        $data['cetak_kwitansi'] = $this->db->query("SELECT nama,kode_pemesanan,custom_destinasi,nama_instansi,status_pemesanan, proses_pembayaran.id,paket_wisata.id as paket_wisata_id,pelanggan.id as pelanggan_id,jumlah_harga,tanggal_pembayaran, nama_paket ,tanggal_keberangkatan ,pemesanan.jumlah_bayar,tanggal_pemesanan ,proses_pembayaran.status_pembayaran ,total_cicilan FROM `proses_pembayaran` JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE pelanggan_id = $id AND proses_pembayaran.id = $id_proses ORDER BY tanggal_pembayaran ASC")->result();

        $this->load->view('config/header', $data);
        $this->load->view('page/pembayaran/v_kwitansi', $data);
        $this->load->view('config/footer-link');
    }
}
