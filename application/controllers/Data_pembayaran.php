<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    } 

    public function index()
    {
        $data['title'] = 'Manage Pembayaran';
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

        $this->db->select('proses_pembayaran.*,pemesanan.id as id_pemesanan, paket_wisata_id,pelanggan_id,nama,nama_paket,telepon,jumlah_harga,kode_pemesanan, pemesanan.status_pembayaran as status_bayar_pemesanan');
        $this->db->from('proses_pembayaran');
        $this->db->join('pemesanan', 'pemesanan_id = pemesanan.id');
        $this->db->join('paket_wisata', 'paket_wisata_id = paket_wisata.id');
        $this->db->join('pelanggan', 'pelanggan_id = pelanggan.id');
        $this->db->order_by('cicilan', 'ASC');
        $data['data_pembayaran'] = $this->db->get()->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/data_pembayaran/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }
        
    public function proses_data_pembayaran($id_proses,$id_pemesanan){
        //Ngambil data dari tabel proses pembayaran
        $pembayaran = $this->proses->getData('proses_pembayaran', ['pemesanan_id' => $id_pemesanan]);

        //ambil email pelanggan
        $pelanggan = $this->db->select('email, tanggal_pemesanan')->from('pemesanan')->join('pelanggan','pelanggan_id = pelanggan.id')->where(['pemesanan.id' => $id_pemesanan])->get()->row_array();

        //count data
        $query = $this->db->get_where('proses_pembayaran', ['pemesanan_id' => $id_pemesanan]) ->num_rows();

        $jumlah_harga = $this->input->post('jumlah_harga');
        $jumlah_bayar = str_replace(",", "", $this->input->post('jumlah_bayar')); ;
        $status = $this->input->post('status');

        $total_cicilan = 0;
        foreach ($pembayaran as $getPembayaran) {
            $total_cicilan += $getPembayaran->cicilan;
            // $total_cicilan =  $total_cicilan + $getPembayaran->cicilan;

        }

        $total_cicilan += $jumlah_bayar;
        $sisa_bayar = $jumlah_harga - $total_cicilan;
 

        $data = [
            'cicilan' => $jumlah_bayar,
            'status_pembayaran' => $status,
            'total_cicilan' => $total_cicilan,
            'status' => 1
        ];
        //insert data di proses pembayaran 
        
        $data2 =[
            'jumlah_bayar' => $total_cicilan, 
            'sisa_bayar' => $sisa_bayar,
            'status_pembayaran' => $status
        ];
        //update data di tbl pemesanan

        $tgl = $pelanggan['tanggal_pemesanan'];
        $tgl_otw = $pelanggan['tanggal_keberangkatan'];
        $tgl3 = date('d-m-Y', strtotime('+30 days', strtotime($tgl)));
        
        if($status == 1){
            $pesan_status = 'DP';
            $tanggal_bayar = date('d-m-Y', strtotime('+20 days', strtotime($tgl)));
        } elseif ($status == 2) {
            $pesan_status = 'Cicilan 2';
            $tanggal_bayar = date('d-m-Y', strtotime('-7 days', strtotime($tgl_otw)));
        } elseif ($status == 3) {
            $pesan_status = 'Lunas';
        }


        if($status != 3){
            $pesan = '
            <p>Pembayaran anda berhasil kami verifikasi.</p> 
            <p>Jumlah pembayaran: Rp.'. number_format($total_cicilan) .' </p>
            <p>Status pembayaran: '. $pesan_status.'</p>
            <p>Silahkan Lakukkan Pembayaran Selanjutnya Sebelum Tanggal '. $tanggal_bayar .'</p>
            <p style="color: red;"><strong>Peringatan!</strong> Jika anda melalukkan pembayaran melebihi batas waktu yang telah ditentukan makan pesanan akan hangus.</p>';
        }else{
            $pesan = '
            <p>Pembayaran anda berhasil kami verifikasi.</p> 
            <p>Jumlah pembayaran: Rp.'. number_format($total_cicilan) .' </p>
            <p>Status pembayaran: '. $pesan_status.'</p>';
        }

        $this->_sendEmail($pelanggan['email'], $pesan);
        $this->proses->updateData('pemesanan', $data2 , ['id' => $id_pemesanan]);
        
        $sql = $this->proses->updateData('proses_pembayaran', $data, ['id' => $id_proses]);
        if($sql){
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data berhasil diperbaharui. </div></center>');
            redirect(base_url('data-pembayaran'));
        }
    }

    public function batal_pembayaran($id)
    {
        $pelanggan = $this->db->get_where('pelanggan', ['id' => $id])->row_array();
        $jumlah_bayar = $this->input->post('jumlah_bayar');
        $jumlah_transfer = $this->input->post('jumlah_transfer');
        $sisa = $jumlah_bayar - $jumlah_transfer;
        $pesan = $this->input->post('pesan');
        $email = $pelanggan['email'];

        $message = '
        <b>Maaf jumlah yang harus di bayar tidak sesuai dengan jumlah yang harus ditransfer</b>
        <p>Jumlah yang harus dibayar: Rp. '.number_format($jumlah_bayar).' </p>
        <p>Jumlah yang anda transfer: Rp. '.number_format($jumlah_transfer).'</p>
        <p>Jumlah sisa pembayaran   : Rp. '.number_format($sisa).'</p>
        <h4>Silahkan untuk melakukkan pembayaran ulang sebesar Rp. '.number_format($sisa).'</h4>
        ';
        $this->_sendEmail($email,$message);

        $sql = $this->proses->updateData('proses_pembayaran', ['status' => 1], ['id' => $id]);

        redirect(base_url('data-pembayaran'));
    }

    public function _sendEmail($email, $pesan)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'touradeeva@gmail.com',
            'smtp_pass' => 'adeevatour123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('touradeeva@gmail.com', 'Adeeva Tour');
        $this->email->to($email);

        $this->email->subject('Notifikasi Adeeva Tour');

        $this->email->message('' . $pesan . ' <a href="' . base_url() . 'login-pelanggan" style="display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #fff;
            background-color: rgba(63,146,157);
            text-decoration: none;
            border-color: #2e6da4;">Login</a>');

        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }
    

}
