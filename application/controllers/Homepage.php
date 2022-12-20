<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_homepage');
        $this->load->library(array('form_validation', 'session', 'pagination', 'encryption'));
    }

    public function index()
    {
        $model = $this->Mdl_homepage;
        $data = array(
            "kebudayaans" => $model->lastestpost(),
            "model" => $model
        );
        $this->load->view('homepage', $data);
    }

    public function tentangkami()
    {
        $model = $this->Mdl_homepage;
        $data = array(
            'tentangs' => $model->tentangkami(),
            "model" => $model
        );
        $this->load->view('tentangkami', $data);
    }

    public function detailbudaya($id = "")
    {
        $model = $this->Mdl_homepage;
        $datas = $model->getdetailwhere_budaya($id);
        if (sizeof($datas) < 1) {
            redirect(base_url(), 'refresh');
        }
        $komentar = $model->komentar($id);
        $data = array(
            'datas' => $datas,
            'model' => $model,
            'komentars' => $komentar
        );
        $this->load->view('detailbudaya', $data);
    }

    public function filterbudaya($id = "")
    {
        // var_dump($id);
        $model = $this->Mdl_homepage;
        $budayas = $model->getwhere_budaya($id);

        // var_dump($datas);
        // echo $datas[0]["id"];
        $data = array(
            'budayas' => $budayas,
            'model' => $model,
            'id' => $id
        );
        $this->load->view('filterbudaya', $data);
    }

    public function ajaxKomen()
    {
        $date = date("Y-m-d");
        $model = $this->Mdl_homepage;
        $input = $this->input;
        if ($input->post("name") != "" && $input->post("msg") != "" && $input->post("id_budaya") != "") {
            $simpan = array(
                "id_kebudayaan" => $input->post("id_budaya"),
                "nama" => $input->post("name"),
                "parent_komentar" => $input->post("parent_id"),
                "deskripsi" => $input->post("msg"),
                "tanggal" => $date
            );
            if ($model->insert_komen($simpan)) {
                $pesan = array(
                    "pesan" => "Komentar berhasil ditambahkan",
                    "jenis" => "success"
                );
            } else {
                $pesan = array(
                    "pesan" => "Komentar gagal ditambahkan",
                    "jenis" => "danger"
                );
            }
        } else {
            $pesan = array(
                "pesan" => "Harap isi form komentar dengan benar",
                "jenis" => "danger"
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($pesan));
    }

    public function search()
    {
        // $this->load->model('Mdl_homepage');
        $model = $this->Mdl_homepage;
        $input = $this->input;
        $keyword = $input->get("keyword");
        $result_search = $model->search($keyword);
        $data = array(
            "keyword" => $keyword,
            "budayas" => $result_search,
            "model" => $model
        );

        $this->load->view('search', $data);
    }
}
