<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_admin extends CI_Controller
{

    public function index()
    {
        if(!$this->input->post()){
            $this->cek_login();
            $data['title'] = 'Login Direktur';
            $this->load->view('page/auth/login/view_direktur', $data);
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if($username == "direktur" AND $password == "direktur"){
                $data = [
                    'email' => 'direktur@gmail.com',
                    'role_id' => 1,
                    'login' => true
                ];
                $this->session->set_userdata($data);
                redirect(base_url('home'));
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Username atau password salah!</div>');
                redirect(base_url('login-direktur'));
            }
        }
    }
    
    public function tour(){
        if(!$this->input->post()){
            $this->cek_login();
            $data['title'] = 'Login Tour';
            $this->load->view('page/auth/login/view_tour', $data);
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($username == "tour" and $password == "tour") {
                $data = [
                    'email' => 'tour@gmail.com',
                    'role_id' => 2,
                    'login' => true
                ];
                $this->session->set_userdata($data);
                redirect(base_url('home'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Username atau password salah!</div>');
                redirect(base_url('login-tour'));
            }
        }
    }
    
    public function keuangan(){
        if(!$this->input->post()){
            $this-> cek_login();
            $data['title'] = 'Login Keuangan';
            $this->load->view('page/auth/login/view_keuangan', $data);
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($username == "keuangan" and $password == "keuangan") {
                $data = [
                    'email' => 'keuangan@gmail.com',
                    'role_id' => 3,
                    'login' => true
                ];
                $this->session->set_userdata($data);
                redirect(base_url('home'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Maaf!</strong> Username atau password salah!</div>');
                redirect(base_url('login-keuangan'));
            }
        }
    }

    public function cek_login()
    {
        if ($this->session->userdata('login') == true) {
            redirect(base_url('home'));
        }
    }

}
