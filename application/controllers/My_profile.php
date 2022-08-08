<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My_profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
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

        $data['pelanggan'] = $user;

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/my_profile/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function edit_profile(){
        $user = $this->db->get_where('pelanggan', ['email' => $this->session->userdata['email']])->row_array();

        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telepon = $this->input->post('telepon');

        $image = $_FILES['picture']['name'];
        if ($image) {
            $config['upload_path']       = './assets/img/ktp/';
            $config['allowed_types']     = 'gif|jpg|png';
            $config['max_size']          = '2048';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('picture')) {
                //hapus images sebelum nya
                $old_image = $user['foto_ktp'];
                unlink(FCPATH . 'assets/img/ktp/' . $old_image);

                $foto_ktp = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                echo $error['error'];
            }
        } else {
            $foto_ktp = $user['foto_ktp'];
        }

        $data = [
            'nama' => $nama,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'foto_ktp' => $foto_ktp
        ];

        $sql = $this->proses->updateData('pelanggan', $data, ['email' => $this->session->userdata['email']]);
        if($sql){
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Profile berhasil diperbaharui. </div></center>');
            redirect(base_url('my-profile'));
        }
    }
}
