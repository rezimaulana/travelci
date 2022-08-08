<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index(){
        $data['title'] = 'Laporan Pemesanan';
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

        $dari_tanggal = $this->input->get('dari_tanggal');
        $sampai_tanggal = $this->input->get('sampai_tanggal');
        
        if($dari_tanggal == ""){
            $data['laporan_pemesanan'] = $this->db->query('SELECT pemesanan.*,nama_paket,nama FROM `pemesanan` JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE pemesanan.status_pemesanan = 0 OR pemesanan.status_pemesanan = 1')->result();

        }else{
            $data['laporan_pemesanan'] = $this->db->query('SELECT pemesanan.*,nama_paket,nama FROM `pemesanan` JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE pemesanan.status_pemesanan = 0 OR pemesanan.status_pemesanan = 1 AND tanggal_pemesanan BETWEEN "'.$dari_tanggal.'" AND "'.$sampai_tanggal.'"')->result();

        }
        
        
        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/laporan_pemesanan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function cetak_laporan($dari_tanggal,$sampai_tanggal){
        if($dari_tanggal == 0 AND $sampai_tanggal == 0){
            $data['laporan_pemesanan'] = $this->db->query('SELECT pemesanan.*,nama_paket,nama FROM `pemesanan` JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE pemesanan.status_pemesanan = 0 OR pemesanan.status_pemesanan = 1')->result();
            
            $data['dari_tanggal'] = "";
            $data['sampai_tanggal'] = "";

        }else{
            $data['laporan_pemesanan'] = $this->db->query('SELECT pemesanan.*,nama_paket,nama FROM `pemesanan` JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id = pelanggan.id WHERE pemesanan.status_pemesanan = 0 OR pemesanan.status_pemesanan = 1 AND tanggal_pemesanan BETWEEN "'.$dari_tanggal.'" AND "'.$sampai_tanggal.'"')->result();

            $data['dari_tanggal'] = $dari_tanggal;
            $data['sampai_tanggal'] = $sampai_tanggal;
        }
        
        
        $this->load->view('page/laporan_pemesanan/v_pemesanan', $data);
    }
    
}
