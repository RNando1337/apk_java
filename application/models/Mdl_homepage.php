<?php

class Mdl_homepage extends CI_Model
{

    public function search($keyword)
    {
        if (!$keyword) {
            return null;
        }
        $this->db->like('judul', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $query = $this->db->get("kebudayaan");
        return $query->result();
    }

    public function lastestpost()
    {
        $this->db->order_by("tanggal", "DESC");
        $this->db->limit(5);
        return $this->db->get("kebudayaan")->result_array();
    }

    public function kategori_kebudayaan($jenis_budaya)
    {
        if ($jenis_budaya == 1) {
            return "Budaya Jawa Tengah";
        } else if ($jenis_budaya == 2) {
            return "Budaya Jawa Barat";
        } else if ($jenis_budaya == 3) {
            return "Budaya Jawa Timur";
        } else {
            return "Kategori Budaya Tidak Ada";
        }
    }

    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function data_budaya($number, $offset)
    {
        return $this->db->get('kebudayaan', $number, $offset)->result();
    }

    public function jumlah_budaya()
    {
        return $this->db->get('kebudayaan')->num_rows();
    }

    public function tentangkami()
    {
        return $this->db->get('tentang_kami')->result_array();
    }

    public function getwhere_budaya($id)
    {
        return $this->db->get_where("kebudayaan", ["jenis_kebudayaan", $id])->result();
    }

    public function getdetailwhere_budaya($id)
    {
        return $this->db->get_where("kebudayaan", ["id" => $id])->result_array();
    }

    public function counter_comment($parent_komentar = "")
    {
        if (isset($parent_komentar) && $parent_komentar != "") {
            return $this->db->get_where("komentar", ["parent_komentar" => $parent_komentar])->result();
        } else {
            return array();
        }
    }

    public function total_komentar($id)
    {
        return sizeof($this->db->get_where("komentar", ["id_kebudayaan" => $id])->result_array());
    }

    public function komentar($id)
    {
        return $this->db->get_where("komentar", ["id_kebudayaan" => $id, "parent_komentar" => 0])->result();
    }

    public function insert_komen($data = "")
    {
        if (isset($data) && $data != "") {
            return $this->db->insert("komentar", $data);
        } else {
            return false;
        }
    }

    public function logo()
    {
        $logo = $this->db->get("tentang_kami")->result_array();
        return $logo[0]['logo'];
    }
}
