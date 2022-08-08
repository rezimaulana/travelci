<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pembatalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database' , 'proses');
    }

    public function index()
    { 
        $data['title'] = 'Data Pembatalan';
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

        $query = 'SELECT proses_pembatalan.id, pemesanan.id as pemesanan_id, nama,telepon,nama_paket,tanggal_pemesanan,tanggal_keberangkatan,jumlah_peserta,jumlah_bayar FROM `proses_pembatalan` JOIN pemesanan ON pemesanan_id = pemesanan.id JOIN proses_pembayaran ON proses_pembatalan.pemesanan_id = proses_pembayaran.pemesanan_id JOIN pelanggan ON pelanggan_id = pelanggan.id JOIN paket_wisata ON paket_wisata_id = paket_wisata.id WHERE status_pemesanan = 3';
        

        $data['data_pembatalan'] = $this->db->query($query)->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/data_pembatalan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function proses_pembatalan($id_proses,$id_pemesanan){
        if($this->session->userdata('role_id') == 2){
            $sql = $this->proses->updateData('proses_pembatalan', ['status_proses_pembatalan' => 1], ['id' => $id_proses]);

            if ($sql) {
                $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data berhasil diperbaharui. </div></center>');
                redirect(base_url('data-pembatalan'));
            }
        }else{
            $sql = $this->proses->updateData('pemesanan', ['status_pemesanan' => 3], ['id' => $id_pemesanan]);
            $this->proses->deleteData('proses_pembatalan', ['id' => $id_proses]);
            
            if ($sql) {
                $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data berhasil diperbaharui. </div></center>');
                redirect(base_url('data-pembatalan'));
            }
        }
    }
}
