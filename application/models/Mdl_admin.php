<?php

class Mdl_admin extends CI_Model
{

    public function getAdmin($where = "")
    {
        $this->db->select("admin.*, roles.role_class");
        $this->db->join("roles", "roles.id = admin.id_role");
        return $this->db->get_where("admin", $where)->result();
    }

    public function listadmin()
    {
        return $this->db->get("admin")->result();
    }

    public function getkebudayaan()
    {
        return $this->db->get('kebudayaan');
    }

    public function converterbudaya($kode)
    {
        if (isset($kode)) {
            if ($kode == 1) {
                return "Budaya Jawa Tengah";
            } else if ($kode == 2) {
                return "Budaya Jawa Barat";
            } else if ($kode == 3) {
                return "Budaya Jawa Timur";
            }
        } else {
            return "";
        }
    }

    public function budayawhere($where = "")
    {
        return $this->db->get_where('kebudayaan', $where)->result();
    }

    public function adminwhere($where = "")
    {
        return $this->db->get_where('admin', $where)->result();
    }

    public function updatebudaya($where = "", $id = "")
    {
        $this->db->where('id', $id);
        return $this->db->update("kebudayaan", $where);
    }

    public function updateadmin($where = "", $id = "")
    {
        $this->db->where('id', $id);
        return $this->db->update("admin", $where);
    }

    public function addadmin($data = "")
    {
        if (isset($data) && $data != "") {
            return $this->db->insert("admin", $data);
        } else {
            return false;
        }
    }

    public function deletebudaya($where, $gambar)
    {
        $this->DeleteImage($gambar);
        return $this->db->delete('kebudayaan', $where);
    }

    public function deleteadmin($where)
    {
        return $this->db->delete('admin', $where);
    }

    // fungsi upload gambar
    public function UploadFile($ext, $filename, $path, $return)
    {
        var_dump($filename);
        die;
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'jpg|png|jpeg|mp4|mkv|avi|mp3|webp';
        $config['file_name']            = date("Ymd") . $filename . $ext;
        $config['overwrite']            = true;
        $config['max_size']             = 30024; // 15MB

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('gambar')) {
            return $return . $this->upload->data("file_name");
        } elseif ($this->upload->do_upload('audio')) {
            return $return . $this->upload->data("file_name");
        }

        return $return . $this->upload->data("file_name");
    }

    public function DeleteImage($gambar)
    {
        return array_map('unlink', glob(FCPATH . $gambar));
    }


    //Upload File Pakai ini
    public function UploadFile2($datas = array(), $dirupload)
    {
        // var_dump($datas);
        $date = date("Ymd_his");
        if (sizeof($datas) > 0) {
            $newfilename = $date;
            $ext = (string) explode(".", $datas["name"])[1];
            $newfilename .= "." . $ext;
            $upload = move_uploaded_file($datas["tmp_name"], $dirupload . $newfilename);
            if ($upload) {
                return $dirupload . $newfilename;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // $newfilename = (string) $date;
    //         foreach ($datas as $key => $data) {
    //             $ext = (string) explode(".", $data["name"])[1];
    //             $newfilename .= "." . $ext;
    //             $upload = move_uploaded_file($data["tmp_name"], $dirupload . $newfilename);
    //             if ($upload) {
    //                 return $dirupload . $newfilename;
    //             } else {
    //             }
    //         }
    //         // return $newfilename;


    //JSON Datatable
    public function count_all_budaya()
    {
        return $this->db->count_all('kebudayaan');
    }
    public function count_filter_budaya($search)
    {
        if (
            strcmp(strtolower($search), "budaya jawa tengah") == 0
            || strcmp(strtolower($search), "budaya jawa te") == 0
            || (strcmp(strtolower($search), "budaya jawa tengah") <= 4
                && strcmp(strtolower($search), "budaya jawa tengah") > 0)
        ) {
            $search = 1;
        } else if (
            strcmp(strtolower($search), "budaya jawa barat") == 0
            || (strcmp(strtolower($search), "budaya jawa barat") <= 4
                && strcmp(strtolower($search), "budaya jawa barat") > 0)
        ) {
            $search = 2;
        } else if (
            strcmp(strtolower($search), "budaya jawa timur") == 0
            || strcmp(strtolower($search), "budaya jawa ti") == 0
            || (strcmp(strtolower($search), "budaya jawa timur") <= 3
                && strcmp(strtolower($search), "budaya jawa timur") > 0)
        ) {
            $search = 3;
        } else if ((strcmp(strtolower($search), "budaya jawa ") <= 1
            && strcmp(strtolower($search), "budaya jawa ") >= 0)) {
            $search = "1 || 2 || 3";
        } else if (strcmp(strtolower($search), "budaya jawa t") == 0) {
            $search = "1 || 3";
        }

        $this->db->like('judul', $search);
        $this->db->or_like('deskripsi', $search);
        $this->db->or_like('jenis_kebudayaan', $search);
        return $this->db->get('kebudayaan')->num_rows();
    }

    public function filterbudaya($search, $limit = "", $start = "", $order_field = "", $order_ascdesc = "")
    {
        if (
            strcmp(strtolower($search), "budaya jawa tengah") == 0
            || strcmp(strtolower($search), "budaya jawa te") == 0
            || (strcmp(strtolower($search), "budaya jawa tengah") <= 4
                && strcmp(strtolower($search), "budaya jawa tengah") > 0)
        ) {
            $search = 1;
        } else if (
            strcmp(strtolower($search), "budaya jawa barat") == 0
            || (strcmp(strtolower($search), "budaya jawa barat") <= 4
                && strcmp(strtolower($search), "budaya jawa barat") > 0)
        ) {
            $search = 2;
        } else if (
            strcmp(strtolower($search), "budaya jawa timur") == 0
            || strcmp(strtolower($search), "budaya jawa ti") == 0
            || (strcmp(strtolower($search), "budaya jawa timur") <= 3
                && strcmp(strtolower($search), "budaya jawa timur") > 0)
        ) {
            $search = 3;
        } else if ((strcmp(strtolower($search), "budaya jawa ") <= 1
            && strcmp(strtolower($search), "budaya jawa ") >= 0)) {
            $search = "1 || 2 || 3";
        } else if (strcmp(strtolower($search), "budaya jawa t") == 0) {
            $search = "1 || 3";
        }

        $this->db->like('judul', $search);
        $this->db->or_like('deskripsi', $search);
        $this->db->or_like('jenis_kebudayaan', $search);

        $this->db->order_by($order_field, $order_ascdesc);
        $this->db->limit($limit, $start);
        // return $search;
        return $this->db->get('kebudayaan')->result_array();
        // return $this->db->last_query();
    }

    public function filteradmin($search, $limit = "", $start = "", $order_field = "", $order_ascdesc = "")
    {

        $this->db->like('username', $search);
        $this->db->order_by($order_field, $order_ascdesc);
        $this->db->limit($limit, $start);
        $this->db->where("id !=", $this->session->userdata('id'));
        return $this->db->get('admin')->result_array();
    }

    public function count_all_admin()
    {
        $this->db->where("id !=", $this->session->userdata('id'));
        return $this->db->count_all('admin');
    }
    public function count_filter_admin($search)
    {
        $this->db->where("id !=", $this->session->userdata('id'));
        $this->db->like('username', $search);
        return $this->db->get('admin')->num_rows();
    }

    public function updatetentang($data)
    {
        $this->db->where('id', 1);
        return $this->db->update('tentang_kami', $data);
    }

    public function updatelogo($data)
    {
        $this->db->where('id', 1);
        return $this->db->update('tentang_kami', $data);
    }

    public function tentang_kami()
    {
        return $this->db->get_where('tentang_kami', ['id' => 1])->result();
    }


    //Helpers
    public function randomPassword()
    {
        $pass = "";
        $alphabet = "1234567890abcdefghijklmnopqrstuvwxyz";
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, strlen($alphabet) - 1);
            $pass .= $alphabet[$n];
        }
        return $pass;
    }

    public function nonlibraryupload()
    {
    }
}
