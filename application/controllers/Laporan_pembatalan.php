<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_pembatalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index(){
        $data['title'] = 'Laporan Pembatalan';
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

        $dari_tanggal = $this->input->get('dari_tanggal');
        $sampai_tanggal = $this->input->get('sampai_tanggal');


        if($dari_tanggal == ""){
            $data['laporan_pembatalan'] = $this->db->query("SELECT kode_pemesanan,nama,jumlah_harga,nama_paket,tanggal_pemesanan,tanggal_keberangkatan,tanggal_pembatalan,jumlah_peserta,jumlah_bayar,uang_kembali FROM `pemesanan` JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id WHERE status_pemesanan = 3")->result();
        }else{
            $data['laporan_pembatalan'] = $this->db->query("SELECT kode_pemesanan,nama,jumlah_harga,nama_paket,tanggal_pemesanan,tanggal_keberangkatan,tanggal_pembatalan,jumlah_peserta,jumlah_bayar,uang_kembali FROM `pemesanan` JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id WHERE status_pemesanan = 3 AND tanggal_pembatalan BETWEEN '".$dari_tanggal."' AND '".$sampai_tanggal."'")->result();

        }
        
        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/laporan_pembatalan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function cetak_laporan($dari_tanggal,$sampai_tanggal){
        if($dari_tanggal == 0 AND $sampai_tanggal == 0){
            $data['laporan_pembatalan'] = $this->db->query("SELECT kode_pemesanan,nama,jumlah_harga,nama_paket,tanggal_pemesanan,tanggal_keberangkatan,tanggal_pembatalan,jumlah_peserta,jumlah_bayar,uang_kembali FROM `pemesanan` JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id WHERE status_pemesanan = 3")->result();
            
            $data['dari_tanggal'] = "";
            $data['sampai_tanggal'] = "";

        }else{
            $data['laporan_pembatalan'] = $this->db->query("SELECT kode_pemesanan,nama,jumlah_harga,nama_paket,tanggal_pemesanan,tanggal_keberangkatan,tanggal_pembatalan,jumlah_peserta,jumlah_bayar,uang_kembali FROM `pemesanan` JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id WHERE status_pemesanan = 3 AND tanggal_pembatalan BETWEEN '".$dari_tanggal."' AND '".$sampai_tanggal."'")->result();

            $data['dari_tanggal'] = $dari_tanggal;
            $data['sampai_tanggal'] = $sampai_tanggal;
        }
        
        
        $this->load->view('page/laporan_pembatalan/v_pembatalan', $data);
    }
    
}
