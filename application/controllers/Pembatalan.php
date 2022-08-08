<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembatalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index()
    {
        $data['title'] = 'Pembatalan';  
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

        $this->db->select('status_pemesanan, pemesanan.id, nama_paket ,tanggal_keberangkatan ,pemesanan.jumlah_bayar,tanggal_pemesanan ,jumlah_peserta ,proses_pembayaran.status_pembayaran ,total_cicilan');
        $this->db->from('proses_pembayaran');
        $this->db->join('pemesanan', 'pemesanan_id = pemesanan.id');
        $this->db->join('paket_wisata', 'paket_wisata_id = paket_wisata.id');
        $this->db->where(['pelanggan_id' => $pelanggan['id']]);
        $this->db->order_by('proses_pembayaran.id', 'DESC');
        $this->db->limit(1);
        $data['pembatalan'] = $this->db->get()->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/pembatalan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function proses_pembatalan($id_pemesanan){
        

        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('total_cicilan, tanggal_keberangkatan');
        $this->db->from('proses_pembayaran');
        $this->db->join('pemesanan', 'pemesanan_id = pemesanan.id');
        $this->db->join('paket_wisata', 'paket_wisata_id = paket_wisata.id');
        $this->db->where(['pelanggan_id' => $pelanggan['id']]);
        $pembatalan = $this->db->get()->row_array();

        
        $tgl = $pembatalan->tanggal_keberangkatan;
        $tgl1 = date('Y-m-d', strtotime('-1 days', strtotime($tgl)));
        $tgl2 = date('Y-m-d', strtotime('-2 days', strtotime($tgl)));
        $tgl3 = date('Y-m-d', strtotime('-3 days', strtotime($tgl)));
        $tgl4 = date('Y-m-d', strtotime('-4 days', strtotime($tgl)));
        $tgl5 = date('Y-m-d', strtotime('-5 days', strtotime($tgl)));

        $today = date('Y-m-d');

        if ($today == $tgl or $today == $tgl1 or $today == $tgl2 or $today == $tgl3 or $today == $tgl4 or $today == $tgl5) {
            $uang_kembali = $pembatalan['total_cicilan'] * 0.35;
        } else {
            $uang_kembali = 0;
        }

        $sql = $this->proses->insertData('proses_pembatalan', ['pemesanan_id' => $id_pemesanan, 'tanggal_pembatalan' => $today]);

        $this->proses->updateData('pemesanan', ['status_pemesanan' => 2, 'tanggal_pembatalan' => $today, 'uang_kembali' => $uang_kembali], ['id' => $id_pemesanan]);

        if($sql){
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Permintaan pembatalan berhasil di ajukan. Mohon untuk menunggu persetujuan pembatalan. </div></center>');
            redirect(base_url('pemesanan'));
        }
    }
}
?>