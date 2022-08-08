<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pelanggan extends CI_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index()
    {
        $data['title'] = 'Data Pelanggan';
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

        $data['pelanggan'] = $this->proses->getAllData('pelanggan');

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/data_pelanggan/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }
}
