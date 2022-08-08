<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_tour extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index() 
    {
        $data['title'] = 'Manage Tour';
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

        

        $data['manage_tour'] = $this->db->query('SELECT *, pemesanan.id as pemesanan_id FROM `pemesanan` JOIN paket_wisata ON paket_wisata_id = paket_wisata.id JOIN pelanggan ON pelanggan_id =  pelanggan.id WHERE status_pemesanan = 0 OR status_pemesanan = 1')->result();

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/manage_tour/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function proses_manage_tour($id){
        $sql = $this->proses->updateData('pemesanan', ['status_pemesanan' => 1], ['id' => $id]);
        if($sql){
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Data Berhasil Diperbaharui. </div></center>');
            redirect(base_url('manage-tour'));
        }
    }
}
