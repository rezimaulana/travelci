<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page404 extends CI_Controller
{

    public function index()
    {
        $data['title'] = '404';
        $this->load->view('config/header', $data);
        $this->load->view('page/404/view');
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }
}
