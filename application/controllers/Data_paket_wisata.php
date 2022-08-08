<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_paket_wisata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('M_database', 'proses');
    }

    public function index()
    {
        $data['title'] = 'Data Paket Wisata';
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

        //get paket wisata
        $data['paket_wisata'] = $this->proses->getAllData('paket_wisata');

        $this->load->view('config/header', $data);
        $this->load->view('config/sidebar');
        $this->load->view('config/navbar', $data);
        $this->load->view('page/data_paket_wisata/view', $data);
        $this->load->view('config/footer');
        $this->load->view('config/footer-link');
    }

    public function tambah_paket()
    {
        $destinasi = $this->input->post('destinasi');
        $custom_destinasi = $this->input->post('custom_destinasi');
        $fasilitas = $this->input->post('fasilitas');
        $nama_paket = $this->input->post('nama_paket');
        $harga = $this->input->post('harga');
        $minimal_orang = $this->input->post('minimal_orang');
        $deskripsi = $this->input->post('deskripsi');
        
        $thumbnail = $_FILES['thumbnail']['name'];
        if ($thumbnail) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail')) {
                $new_image = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }
        }

        $this->db->insert('paket_wisata', ['nama_paket' => $nama_paket, 'harga' => $harga, 'minimal_orang' => $minimal_orang, 'deskripsi' => $deskripsi, 'thumbnail' => $new_image]);

        $new_paket = $this->db->select('id')->from('paket_wisata')->order_by('id', 'DESC')->limit(1)->get()->row_array();

        //insert data destinasi ke tabel destinasi dan item destinasi
        foreach ($destinasi as $getDestinasi) {
            $this->db->insert('destinasi', ['nama_destinasi' => ucfirst($getDestinasi)]);
            $new_destinasi = $this->db->select('id')->from('destinasi')->order_by('id', 'DESC')->limit(1)->get()->row_array();

            $this->db->insert('item_destinasi', ['paket_wisata_id' => $new_paket['id'], 'destinasi_id' => $new_destinasi['id']]);
        }
        //insert data fasilitas ke item fasilitas
        foreach ($fasilitas as $getFasilitas) {
            $this->db->insert('item_fasilitas', ['paket_wisata_id' => $new_paket['id'], 'fasilitas_id' => $getFasilitas]);
            echo $new_paket['id'].'<br>';
            echo $getFasilitas.'<br>';
        }


        //insert data custom destinasi ke table destinai dan item destinasi
        foreach ($custom_destinasi as $getCustomDestinasi) {
            $this->db->insert('custom_destinasi', ['nama_custom_destinasi' => ucfirst($getCustomDestinasi)]);

            $new_custom_destinasi = $this->db->select('id')->from('custom_destinasi')->order_by('id', 'DESC')->limit(1)->get()->row_array();

            $this->db->insert('item_custom_destinasi', ['paket_wisata_id' => $new_paket['id'], 'custom_destinasi_id' => $new_custom_destinasi['id']]);
        }


        

        //insert thumnail ke thumbnail dan item thumbnail
        $thumbnail_detail1 = $_FILES['thumbnail_detail1']['name'];
        $thumbnail_detail2 = $_FILES['thumbnail_detail2']['name'];
        $thumbnail_detail3 = $_FILES['thumbnail_detail3']['name'];

        if ($thumbnail_detail1) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail_detail1')) {
                $new_thumbnail_detail1 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }

            $this->db->insert('thumbnail', ['nama_thumbnail' => $new_thumbnail_detail1]);
            $new_thumbnail1 = $this->db->select('id')->from('thumbnail')->order_by('id', 'DESC')->limit(1)->get()->row_array();
            $this->db->insert('item_thumbnail', ['paket_wisata_id' => $new_paket['id'], 'thumbnail_id' => $new_thumbnail1['id']]);
        }

        if ($thumbnail_detail2) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail_detail2')) {
                $new_thumbnail_detail2 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }

            $this->db->insert('thumbnail', ['nama_thumbnail' => $new_thumbnail_detail2]);
            $new_thumbnail2 = $this->db->select('id')->from('thumbnail')->order_by('id', 'DESC')->limit(1)->get()->row_array();
            $this->db->insert('item_thumbnail', ['paket_wisata_id' => $new_paket['id'], 'thumbnail_id' => $new_thumbnail2['id']]);
        }

        if ($thumbnail_detail3) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail_detail3')) {
                $new_thumbnail_detail3 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }

            $this->db->insert('thumbnail', ['nama_thumbnail' => $new_thumbnail_detail3]);
            $new_thumbnail3 = $this->db->select('id')->from('thumbnail')->order_by('id', 'DESC')->limit(1)->get()->row_array();
            $this->db->insert('item_thumbnail', ['paket_wisata_id' => $new_paket['id'], 'thumbnail_id' => $new_thumbnail3['id']]);
        }


        $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Paket wisata berhasil ditambahkan. </div></center>');
        redirect(base_url('data-paket-wisata'));
    }

    public function edit_paket($id)
    {
        $destinasi = $this->input->post('destinasi');
        $destinasi_id = $this->input->post('destinasi_id');
        $custom_destinasi = $this->input->post('custom_destinasi');
        $custom_destinasi_id = $this->input->post('custom_destinasi_id');
        $fasilitas = $this->input->post('fasilitas');
        $fasilitas_id = $this->input->post('fasilitas_id');
        $nama_paket = $this->input->post('nama_paket');
        $harga = $this->input->post('harga');
        $minimal_orang = $this->input->post('minimal_orang');
        $deskripsi = $this->input->post('deskripsi');
        $thumbnail_id = $this->input->post('thumbnail_id');
        $thumbnail_nama = $this->input->post('thumbnail_nama');

        //get paket wisata
        $data['paket_wisata'] = $this->db->get_where('paket_wisata', ['id' => $id])->row_array();

        $thumbnail = $_FILES['thumbnail']['name'];
        if ($thumbnail) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail')) {
                //hapus images sebelum nya
                $old_image = $data['paket_wisata']['thumbnail'];
                unlink(FCPATH . 'assets/img/' . $old_image);

                $new_image = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }
        } else {
            $new_image = $data['paket_wisata']['thumbnail'];
        }

        $this->proses->updateData('paket_wisata', ['nama_paket' => $nama_paket, 'harga' => $harga, 'minimal_orang' => $minimal_orang, 'deskripsi' => $deskripsi, 'thumbnail' => $new_image], ['id' => $id]);


        //update data custom destinasi ke tabel custom destinasi dan item custom destinasi
        $i = 0;
        foreach ($custom_destinasi as $getCustomDestinasi) {
            $this->proses->updateData('custom_destinasi', ['nama_custom_destinasi' => ucfirst($getCustomDestinasi)], ['id' => $custom_destinasi_id[$i]]);
            $i++;
        }

        //update data destinasi ke tabel destinasi dan item destinasi
        $i = 0;
        foreach ($destinasi as $getDestinasi) {
            $this->proses->updateData('destinasi', ['nama_destinasi' => ucfirst($getDestinasi)], ['id' => $destinasi_id[$i]]);
            $i++;
        }

        //update data fasilitas ke item fasilitas
        $this->proses->deleteData('item_fasilitas', ['paket_wisata_id' => $id]);

        foreach ($fasilitas as $getFasilitas) {
            $this->db->insert('item_fasilitas', ['paket_wisata_id' => $id, 'fasilitas_id' => $getFasilitas]);
        }

        //update thumnail ke thumbnail dan item thumbnail
        $thumbnail_detail1 = $_FILES['thumbnail1']['name'];
        $thumbnail_detail2 = $_FILES['thumbnail2']['name'];
        $thumbnail_detail3 = $_FILES['thumbnail3']['name'];

        //update thumbnail 1
        if ($thumbnail_detail1) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail1')) {
                //hapus images sebelum nya
                $old_image = $thumbnail_nama[0];
                unlink(FCPATH . 'assets/img/' . $old_image);

                $new_thumbnail_detail1 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }
        } else {
            $new_thumbnail_detail1 = $thumbnail_nama[0];
        }


        $this->proses->updateData('thumbnail', ['nama_thumbnail' => $new_thumbnail_detail1], ['id' => $thumbnail_id[0]]);

        //update thumbnail 2
        if ($thumbnail_detail2) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail2')) {
                //hapus images sebelum nya
                $old_image = $thumbnail_nama[1];
                unlink(FCPATH . 'assets/img/' . $old_image);

                $new_thumbnail_detail2 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }
        } else {
            $new_thumbnail_detail2 = $thumbnail_nama[1];
        }

        $this->proses->updateData('thumbnail', ['nama_thumbnail' => $new_thumbnail_detail2], ['id' => $thumbnail_id[1]]);

        //update thumbnail 3
        if ($thumbnail_detail3) {
            $config['upload_path']       = './assets/img/';
            $config['allowed_types']     = 'jpeg|jpg|png';
            $config['max_size']          = '4096';
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('thumbnail3')) {
                //hapus images sebelum nya
                $old_image = $thumbnail_nama[2];
                unlink(FCPATH . 'assets/img/' . $old_image);

                $new_thumbnail_detail3 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message', '<center><div class="alert alert-danger" role="alert"> ' . $error['error'] . ' </div></center>');
                redirect(base_url('data-paket-wisata'));
            }
        } else {
            $new_thumbnail_detail3 = $thumbnail_nama[2];
        }

        $this->proses->updateData('thumbnail', ['nama_thumbnail' => $new_thumbnail_detail3], ['id' => $thumbnail_id[2]]);


        $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Paket wisata berhasil ditambahkan. </div></center>');
        redirect(base_url('data-paket-wisata'));
    }

    public function hapus_paket($id)
    {
        $this->proses->deleteData('item_fasilitas', ['paket_wisata_id' => $id]);
        $sql = $this->proses->deleteData('paket_wisata', ['id' => $id]);
        if ($sql) {
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Paket wisata berhasil dihapus. </div></center>');
            redirect(base_url('data-paket-wisata'));
        }
    }

    public function tambah_fasilitas()
    {
        $fasilitas = $this->input->post('fasilitas');
        $sql = $this->proses->insertData('fasilitas', ['nama_fasilitas' => $fasilitas]);
        if ($sql) {
            $this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert"> Fasilitas berhasil ditambahkan. </div></center>');
            redirect(base_url('data-paket-wisata'));
        }
    }
}
