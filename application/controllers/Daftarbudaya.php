<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftarbudaya extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_homepage');
        $this->load->library('pagination');
    }

    public function index()
    {
        $model = $this->Mdl_homepage;
        $jumlah_data = $model->jumlah_budaya();
        $from = $this->uri->segment(3);
        $config['base_url'] = base_url() . "daftarbudaya/";
        $config["total_rows"] = $jumlah_data;
        $config["per_page"] = 100;

        $this->pagination->initialize($config);
        $data['budayas'] = $model->data_budaya($config['per_page'], $from);
        $data['model'] = $model;
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $this->load->view('listbudaya', $data);
    }
}
