<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index()
    {
        $data['title'] = 'Pemesanan';  
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

        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();



        $id = $pelanggan['id'];

        $this->db->select("pemesanan.*,nama_paket,nama_instansi");
        $this->db->from("pemesanan");
        $this->db->join("paket_wisata", "paket_wisata_id = paket_wisata.id");
        $this->db->where("pelanggan_id = $id AND pemesanan.status_pemesanan <> 3");
        $data['pembatalan'] = $this->db->get()->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pemesanan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function detail_paket($id = FALSE)
    {
        $data['title'] = 'Detail Paket';
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

        //ambil destinasi
        $data['destinasi'] = $this->proses->getDataJoin('nama_destinasi', 'item_destinasi', 'destinasi', 'destinasi_id = destinasi.id', ['paket_wisata_id' => $id]);

        $data['detail_paket_wisata'] = $this->proses->getData('paket_wisata', ['id' => $id]);
        $data['thumbnail'] = $this->proses->getDataJoin('nama_thumbnail', 'item_thumbnail', 'thumbnail', 'thumbnail_id = thumbnail.id', ['paket_wisata_id' => $id]);
        $data['fasilitas'] = $this->proses->getDataJoin('nama_fasilitas', 'item_fasilitas', 'fasilitas', 'fasilitas_id = fasilitas.id', ['paket_wisata_id' => $id]);

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pemesanan/detail_paket', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function form_pemesanan($id = FALSE)
    {
        $data['title'] = 'Form Pemesanan';
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

        $data['paket_wisata'] = $this->proses->getData('paket_wisata', ['id' => $id]);
        
        $data['destinasi'] = $this->db->select('destinasi.id, nama_destinasi')->from('item_destinasi')->join('destinasi', 'destinasi_id = destinasi.id')->where(['paket_wisata_id' => $id])->order_by('destinasi_id', 'ASC')->limit(2)->get()->result();
        
        $data['destinasi3'] = $this->db->select('destinasi.id, nama_destinasi')->from('item_destinasi')->join('destinasi', 'destinasi_id = destinasi.id')->where(['paket_wisata_id' => $id])->order_by('destinasi_id', 'DESC')->limit(1)->get()->result();
        
        $data['custom_destinasi'] = $this->db->select('custom_destinasi.id,nama_custom_destinasi')->from('item_custom_destinasi')->join('custom_destinasi', 'custom_destinasi_id = custom_destinasi.id')->where(['paket_wisata_id' => $id])->get()->result();

        $data['pelanggan'] = $this->proses->getData('pelanggan', ['email' => $this->session->userdata('email')]);

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pemesanan/form_pemesanan', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function proses_pemesanan($paket_wisata_id)
    {
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();

        $pelanggan_id = $pelanggan['id'];
        $tgl_berangkat = $this->input->post('tgl_berangkat');
        $jumlah_peserta = $this->input->post('jumlah_peserta');
        $nama_instansi = strtoupper($this->input->post('nama_instansi'));
        $custom_destinasi = $this->input->post('custom_destinasi');

        //upload foto ktp
        if ($pelanggan['foto_ktp'] == '') {
            $image = $_FILES['fotoKtp']['name'];

            if ($image) {
                $config['upload_path']       = './assets/img/ktp/';
                $config['allowed_types']     = 'gif|jpg|png';
                $config['max_size']          = '2048';
                $config['encrypt_name']         = TRUE;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('fotoKtp')) {
                    //hapus images sebelum nya
                    $old_image = $pelanggan['foto_ktp'];
                    if ($old_image != '') {
                        unlink(FCPATH . 'assets/img/ktp/' . $old_image);
                    }
                    $newKtp = $this->upload->data('file_name');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    echo $error['error'];
                }
            } else {
                $newKtp = $pelanggan['foto_ktp'];
            }
            $sql = $this->proses->updateData('pelanggan', ['foto_ktp' => $newKtp], ['email' => $this->session->userdata('email')]);
        }

        //update alamat dan telepon
        if ($pelanggan['alamat'] == '') {
            $alamat = $this->input->post('alamat');
            $telepon = $this->input->post('telepon');

            $sql = $this->proses->updateData('pelanggan', ['alamat' => $alamat, 'telepon' => $telepon], ['email' => $this->session->userdata('email')]);
        }


        //validasi tidak boleh ada yang memesan 4 hari setelah pemesanan yang sedang di proses
        $pemesanan = $this->db->get_where('pemesanan', ['status_pemesanan' => 0])->result();

        // $status_pemesanan = true;
        
 
        foreach ($pemesanan as $getPemesanan) {
            $tgl = $getPemesanan->tanggal_keberangkatan;
            $tgl1 = date('Y-m-d', strtotime('+1 days', strtotime($tgl)));
            $tgl2 = date('Y-m-d', strtotime('+2 days', strtotime($tgl)));
            $tgl3 = date('Y-m-d', strtotime('+3 days', strtotime($tgl)));
            $tgl4 = date('Y-m-d', strtotime('+4 days', strtotime($tgl)));

            if ($tgl_berangkat == $tgl or $tgl_berangkat == $tgl1 or $tgl_berangkat == $tgl2 or $tgl_berangkat == $tgl3 or $tgl_berangkat == $tgl4) {
                // $status_pemesanan = false;
            
                 $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Tidak bisa memesan pada tanggal ' . date('d-m-Y', strtotime($tgl_berangkat)) . ' karena sudah ada yang memesan. Silahkan pilih tanggal keberangkatan lain! </div></center>');
                redirect(base_url('form-pemesanan/' . $paket_wisata_id));
                die;
                
            }
            
        }
        

        // if ($status_pemesanan == false) {
        //     $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Tidak bisa memesan pada tanggal ' . date('d-m-Y', strtotime($tgl_berangkat)) . ' karena sudah ada yang memesan. Silahkan pilih tanggal keberangkatan lain! </div></center>');
        //     redirect(base_url('form-pemesanan/' . $paket_wisata_id));
        // }
        

        //proses booking tanggal
        $booking = new DateTime($tgl_berangkat);
        $today = new DateTime();
        $selisih = $today->diff($booking)->format("%a");

        if ($selisih <= 30) {
            $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Maaf tanggal keberangkatan harus lebih dari 30 hari setelah anda memesan! </div></center>');
            redirect(base_url('form-pemesanan/') . $paket_wisata_id);
        }


        $paket_wisata = $this->db->get_where('paket_wisata', ['id' => $paket_wisata_id])->row_array();
        $total_harga = $paket_wisata['harga'] * $jumlah_peserta;
        $minimal_orang = $paket_wisata['minimal_orang'];

        $nama_paket = substr($paket_wisata['nama_paket'],0,3);

        $jumlah_data = $this->db->select('id')->from('pemesanan')->order_by('id', 'DESC')->get()->row_array();
        $getJumlah = $jumlah_data['id'];

        $kode_pemesanan = '00'.($getJumlah+1).'/ORD/'.strtoupper($nama_paket);

        if($jumlah_peserta < $minimal_orang){
            $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> Maaf jumlah peserta harus '.$minimal_orang.' atau lebih! </div></center>');
            redirect(base_url('form-pemesanan/') . $paket_wisata_id);
        }

        //memasukkan data ke database
        $data = [
            'paket_wisata_id' => $paket_wisata_id,
            'kode_pemesanan' => $kode_pemesanan,
            'pelanggan_id' => $pelanggan_id,
            'tanggal_pemesanan' => date('Y-m-d'),
            'tanggal_keberangkatan' => $tgl_berangkat,
            'jumlah_peserta' => $jumlah_peserta,
            'jumlah_harga' => $total_harga,
            'nama_instansi' => $nama_instansi,
            'custom_destinasi' => $custom_destinasi
        ];

        $sql = $this->proses->insertData('pemesanan', $data);
        if ($sql) {
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Pesanan anda berhasil dibuat. Selanjutnya sistem akan meneruskan ke Manager Tour! Mohon Tunggu.. </div></center>');
            redirect(base_url('home'));
        }
    }

    public function list_batal(){
        $data['title'] = 'Pemesanan';  
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

        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();


        $this->db->select('kode_pemesanan,jumlah_harga,nama_paket,tanggal_pemesanan,tanggal_keberangkatan,jumlah_peserta,jumlah_bayar,uang_kembali');
        $this->db->from('pemesanan');
        $this->db->join('pelanggan', 'pelanggan_id = pelanggan.id');
        $this->db->join('paket_wisata', 'paket_wisata_id = paket_wisata.id');
        $this->db->where(['pelanggan_id' => $pelanggan['id'], 'status_pemesanan' => 3]);
        $data['pembatalan'] = $this->db->get()->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pemesanan/list_batal', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }
}
