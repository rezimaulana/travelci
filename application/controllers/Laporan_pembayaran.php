<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index(){
        $data['title'] = 'Laporan Pembayaran';
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

        $dari_tanggal = $this->input->get('dari_tanggal');
        $sampai_tanggal = $this->input->get('sampai_tanggal');

        if($dari_tanggal == ""){
            $data['laporan_pembayaran'] = $this->db->query('SELECT nama,nama_paket,tanggal_pembayaran, tanggal_keberangkatan,cicilan,total_cicilan,pemesanan.jumlah_bayar,sisa_bayar FROM `proses_pembayaran` JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE cicilan <> 0 ORDER BY tanggal_pembayaran ASC')->result(); 
        }else{
            $data['laporan_pembayaran'] = $this->db->query('SELECT nama,nama_paket,tanggal_pembayaran, tanggal_keberangkatan,cicilan,total_cicilan,pemesanan.jumlah_bayar,sisa_bayar FROM `proses_pembayaran` JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE tanggal_pembayaran BETWEEN "'.$dari_tanggal.'" AND "'.$sampai_tanggal.'" AND cicilan <> 0 ORDER BY tanggal_pembayaran ASC')->result(); 
        }

        $data['date'] = date('Y-m-d');
        
        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/laporan_pembayaran/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function cetak_laporan($dari_tanggal,$sampai_tanggal){
        if($dari_tanggal == 0 AND $sampai_tanggal == 0){
            $data['laporan_pembayaran'] = $this->db->query('SELECT nama,nama_paket,tanggal_pembayaran, tanggal_keberangkatan,cicilan,total_cicilan,pemesanan.jumlah_bayar,sisa_bayar FROM `proses_pembayaran` JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE cicilan <> 0 ORDER BY tanggal_pembayaran ASC')->result();
            
            $data['dari_tanggal'] = "";
            $data['sampai_tanggal'] = "";

        }else{
            $data['laporan_pembayaran'] = $this->db->query('SELECT nama,nama_paket,tanggal_pembayaran, tanggal_keberangkatan,cicilan,total_cicilan,pemesanan.jumlah_bayar,sisa_bayar FROM `proses_pembayaran` JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE tanggal_pembayaran BETWEEN "'.$dari_tanggal.'" AND "'.$sampai_tanggal.'" AND cicilan <> 0 ORDER BY tanggal_pembayaran ASC')->result();

            $data['dari_tanggal'] = $dari_tanggal;
            $data['sampai_tanggal'] = $sampai_tanggal;
        }
        
        
        $this->load->view('page/laporan_pembayaran/v_pembayaran', $data);
    }
    
}
