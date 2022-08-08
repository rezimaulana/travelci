<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing_page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_database', 'proses');
    }

    public function index(){
        $data['paket_wisata'] = $this->proses->getAllData('paket_wisata');

        $this->load->view('page/landing_page/view', $data);
    }

    public function about(){
        $this->load->view('page/landing_page/about');
    }
}

?>