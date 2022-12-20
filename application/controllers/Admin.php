<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_admin');
        $this->load->library(array('form_validation', 'session', 'pagination', 'encryption'));
    }

    public function index() //Login
    {
        $this->output->delete_cache();
        $this->load->view('admin');
    }

    public function ajaxlogin()
    {
        $input = $this->input;
        $model = $this->Mdl_admin;
        $user = $input->post('username');
        $pass = bin2hex($input->post('password'));
        $data = array(
            "username" => $user,
            "password" => $pass
        );
        $datas = $model->getAdmin($data);
        if (isset($datas[0]->username) && isset($datas[0]->password) && $datas[0]->username == $user && $datas[0]->password == $pass) {
            $session = array(
                "id" => $datas[0]->id,
                "username" => $datas[0]->username,
                "level" => $datas[0]->level,
                "role_class" => $datas[0]->role_class
            );
            $this->session->set_userdata($session);
            $pesan = array(
                'pesan' => "Login berhasil!!",
                'jenis' => 'success'
            );
        } else {
            $pesan = array(
                'pesan' => "Login gagal!!",
                'jenis' => 'danger'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($pesan));
    }

    public function dashboard()
    {
        if ($this->session->has_userdata('username')) {
            $this->output->delete_cache();
            $this->load->view('dashboard/dashboard');
        } else {
            echo "Akses Ditolak";
        }
    }

    public function kebudayaan()
    {
        $this->output->delete_cache();
        if ($this->session->has_userdata('username')) {
            $data = array(
                "getKebudayaan" => $this->Mdl_admin->getkebudayaan()->result_array(),
                "model" => $this->Mdl_admin
            );
            $this->load->view('dashboard/listkebudayaan', $data);
        } else {
            echo "Akses ditolak";
        }
    }

    public function tentangkami()
    {
        $model = $this->Mdl_admin;
        if ($this->session->has_userdata('username')) {
            $tentangkami = $model->tentang_kami();
            $data = array(
                "tentangkami" => $tentangkami,
                "ckeditortrigger" => 1
            );
            $this->load->view('dashboard/tentangkami', $data);
        } else {
            echo "Akses Ditolak";
        }
    }

    public function logo()
    {
        if ($this->session->has_userdata('username')) {
            $model = $this->Mdl_admin;
            $tentangkami = $model->tentang_kami();
            $data = array(
                "tentangkami" => $tentangkami
            );
            $this->load->view('dashboard/logo', $data);
        } else {
            echo "Akses Ditolak";
        }
    }

    public function listadmin()
    {
        if ($this->session->has_userdata('username')) {
            $this->load->view('dashboard/listadmin');
        } else {
            echo "Akses Ditolak";
        }
    }

    public function addadmin()
    {
        if ($this->session->has_userdata('username')) {
            $this->load->view('dashboard/addadmin');
        } else {
            echo "Akses Ditolak";
        }
    }

    public function addkebudayaan()
    {
        $this->output->delete_cache();
        if ($this->session->has_userdata('username')) {
            $this->load->view('dashboard/addkebudayaan');
        } else {
            echo "Akses Ditolak";
        }
    }

    public function editbudaya($id = "")
    {
        $this->output->delete_cache();
        if ($this->session->has_userdata('username')) {
            $model = $this->Mdl_admin;
            if (isset($id) && $id !== "") {
                $budaya = $model->budayawhere(
                    array(
                        'id' => $id
                    )
                );
                $selects = array("Budaya Jawa Tengah", "Budaya Jawa Barat", "Budaya Jawa Timur");
                $data = array(
                    'id' => $id,
                    'budaya' => $budaya,
                    'selects' => $selects
                );
                $this->load->view('dashboard/editkebudayaan', $data);
            } else {
                redirect(base_url() . "admin/kebudayaan", "refresh");
            }
        } else {
            echo "Akses Ditolak";
        }
    }

    public function editadmin($id = "")
    {
        $this->output->delete_cache();
        if ($this->session->has_userdata('username')) {
            $model = $this->Mdl_admin;
            if (isset($id) && $id !== "") {
                $admin = $model->adminwhere(
                    array(
                        'id' => $id
                    )
                );
                $selects = array("Superadmin", "Admin Biasa");
                $data = array(
                    'id' => $id,
                    'admin' => $admin,
                    'selects' => $selects
                );
                $this->load->view('dashboard/editadmin', $data);
            } else {
                redirect(base_url() . "admin/listadmin", "refresh");
            }
        } else {
            echo "Akses Ditolak";
        }
    }

    public function ajaxeditadmin()
    {
        $this->output->delete_cache();
        if ($this->session->has_userdata('username')) {
            $model = $this->Mdl_admin;
            $input = $this->input;
            if ($input->post("password") !== "") {
                $data = array(
                    "username" => $input->post("username"),
                    "password" => bin2hex($input->post("password")),
                    "default_password" => $input->post("password"),
                    "level" => $input->post("level")
                );
                if ($model->updateadmin($data, $input->post("id"))) {
                    $pesan = array(
                        'pesan' => "Data berhasil diubah!!",
                        'jenis' => 'success'
                    );
                } else {
                    $pesan = array(
                        'pesan' => "Data gagal diubah!!",
                        'jenis' => 'danger'
                    );
                }
            } else {
                $data = array(
                    "username" => $input->post("username"),
                    "level" => $input->post("level")
                );
                if ($model->updateadmin($data, $input->post("id"))) {
                    $pesan = array(
                        'pesan' => "Data berhasil diubah!!",
                        'jenis' => 'success'
                    );
                } else {
                    $pesan = array(
                        'pesan' => "Data gagal diubah!!",
                        'jenis' => 'danger'
                    );
                }
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($pesan));
        } else {
            echo "Akses Ditolak";
        }
    }

    public function ajaxeditlogo()
    {
        if ($this->session->has_userdata('username')) {
            $date = date("Ymdhis");
            $model = $this->Mdl_admin;
            $gambar = $model->tentang_kami()[0]->logo;
            if (file_exists(FCPATH . $gambar)) {
                $model->DeleteImage($gambar);
            }
            // var_dump($_FILES["gambar"]);
            $data = array(
                'id_admin' => $this->session->userdata('id'),
                'logo' => $this->Mdl_admin->UploadFile2($_FILES["gambar"], 'gambar/logo/')
            );
            // echo $data["logo"];
            // die;
            if ($model->updatelogo($data)) {
                $pesan = array(
                    'pesan' => "Data berhasil diubah!!",
                    'jenis' => 'success'
                );
            } else {
                $pesan = array(
                    'pesan' => "Data gagal diubah!!",
                    'jenis' => 'danger'
                );
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($pesan));
        } else {
            echo "Akses Ditolak";
        }
    }

    public function ajaxtentangkami()
    {
        if ($this->session->has_userdata('username')) {
            $input = $this->input;
            $model = $this->Mdl_admin;
            $data = array(
                'id_admin' => $this->session->userdata('id'),
                'tentang_kami' => $input->post('detailtentang')
            );
            if ($model->updatetentang($data)) {
                $pesan = array(
                    'pesan' => 'Data berhasil diubah!!',
                    'jenis' => 'success'
                );
            } else {
                $pesan = array(
                    'pesan' => 'Data gagal diubah!!',
                    'jenis' => 'danger'
                );
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($pesan));
        } else {
            echo "Akses Ditolak";
        }
    }

    public function ajaxeditbudaya()
    {
        if ($this->session->has_userdata('username')) {
            $input = $this->input;
            $model = $this->Mdl_admin;
            $id = $input->post('id');
            $data = array(
                'id_admin' => $this->session->userdata('id'),
                'jenis_kebudayaan' => $input->post('kategori'),
                'deskripsi' => $input->post('deskripsi'),
                'judul' => $input->post('judul'),
                'video' => $input->post("video")
            );
            if ($input->post("gambar") !== "undefined") {
                $model->DeleteImage($input->post("gambarhidden"));
                $data["gambar"] = $this->Mdl_admin->UploadFile2($_FILES["gambar"], "gambar/budaya/");
            } elseif ($input->post("audio") !== "undefined") {
                $model->DeleteImage($input->post("adhidden"));
                $data["audio"] = $this->Mdl_admin->UploadFile2($_FILES["audio"], "gambar/budaya/audio/");
            }
            if ($model->updatebudaya($data, $id)) {
                $pesan = array(
                    'pesan' => 'Data berhasil diubah!!',
                    'jenis' => 'success'
                );
            } else {
                $pesan = array(
                    'pesan' => 'Data gagal diubah!!',
                    'jenis' => 'danger'
                );
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array($pesan)));
        } else {
            echo "Akses Ditolak";
        }
    }

    public function ajaxaddbudaya()
    {
        if ($this->session->has_userdata('username')) {
            $input = $this->input;
            $data = array(
                'id_admin' => $this->session->userdata('id'),
                'gambar' => $this->Mdl_admin->UploadFile2($_FILES["gambar"], "gambar/budaya/"),
                'audio' => $this->Mdl_admin->UploadFile2($_FILES["audio"], "gambar/budaya/audio/"),
                'video' => $input->post("video"),
                'jenis_kebudayaan' => $input->post('kategori'),
                'deskripsi' => $input->post('deskripsi'),
                'judul' => $input->post('judul'),
                'tanggal' => date('Y-m-d')
            );
            if ($data["gambar"] == false || $data["audio"] == false) {
                $pesan = array(
                    'pesan' => 'File Gagal diupload, Coba upload ulang!!',
                    'jenis' => 'danger'
                );
            } else {
                $this->db->trans_start();
                $this->db->insert("kebudayaan", $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() == TRUE) {
                    $this->db->trans_commit();
                    $pesan = array(
                        'pesan' => 'Data berhasil ditambahkan!!',
                        'jenis' => 'success'
                    );
                } else {
                    $this->db->trans_rollback();
                    $pesan = array(
                        'pesan' => 'Data Gagal disimpan!!',
                        'jenis' => 'danger'
                    );
                }
            }
            // }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array($pesan)));
        } else {
            echo "Akses Ditolak";
        }
    }

    public function ajaxaddadmin()
    {
        $input = $this->input;
        $model = $this->Mdl_admin;
        if ($this->session->has_userdata('username')) {
            $pass = $model->randomPassword();
            $data = array(
                "id_role" => 1,
                "username" => $input->post("username"),
                "password" => bin2hex($pass),
                "default_password" => $pass,
                "level" => $input->post("level")
            );
            if ($model->addadmin($data)) {
                $pesan = array(
                    "pesan" => "Berhasil menambah admin!!",
                    "jenis" => "success"
                );
            } else {
                $pesan = array(
                    "pesan" => "Gagal menambah admin!!",
                    "jenis" => "danger"
                );
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($pesan));
        } else {
            echo "Akses Ditolak";
        }
    }

    public function deletebudaya()
    {
        if ($this->session->has_userdata('username')) {
            $input = $this->input;
            $model = $this->Mdl_admin;
            $id = $input->post("id");
            $gambar = $input->post("gambar");
            $model->deletebudaya(array("id" => $id), $gambar);
            if ($this->db->error()['message']) {
                $pesan = array(
                    "pesan" => 'Error! [' . $this->db->error()['message'] . ']',
                    "jenis" => "danger"
                );
            } else if (!$this->db->affected_rows()) {
                $pesan = array(
                    "pesan" => 'Error! ID [' . $id . '] not found',
                    "jenis" => "danger"
                );
            } else {
                $pesan = array(
                    "pesan" => "Data berhasil dihapus",
                    "jenis" => "success"
                );
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($pesan));
        } else {
            echo "Akses Ditolak";
        }
    }


    public function deleteadmin()
    {
        if ($this->session->has_userdata('username')) {
            $input = $this->input;
            $model = $this->Mdl_admin;
            $id = $input->post("id");
            $model->deleteadmin(array("id" => $id));
            if ($this->db->error()['message']) {
                $pesan = array(
                    "pesan" => 'Error! [' . $this->db->error()['message'] . ']',
                    "jenis" => "danger"
                );
            } else if (!$this->db->affected_rows()) {
                $pesan = array(
                    "pesan" => 'Error! ID [' . $id . '] not found',
                    "jenis" => "danger"
                );
            } else {
                $pesan = array(
                    "pesan" => "Data berhasil dihapus!!",
                    "jenis" => "success"
                );
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($pesan));
        } else {
            echo "Akses Ditolak";
        }
    }




    ///Datatable

    public function budayajson()
    {
        $model = $this->Mdl_admin;
        $search = isset($_POST['search']['value']) ? $_POST['search']['value'] : ""; // Ambil data yang di ketik user

        $limit = isset($_POST['length']) ? $_POST['length'] : ""; // Ambil data limit per page    
        $start = isset($_POST['start']) ? $_POST['start'] : ""; // Ambil data start    
        $order_index = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : ""; // Untuk mengambil index yg menjadi acuan untuk sorting   
        $order_field = isset($_POST['columns'][$order_index]['data']) ? $_POST['columns'][$order_index]['data'] : ""; // Untuk mengambil nama field yg menjadi acuan untuk sorting    
        $order_ascdesc = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : ""; // Untuk menentukan order by "ASC" atau "DESC"
        $budayas = $this->Mdl_admin->filterbudaya($search, $limit, $start, $order_field, $order_ascdesc);
        $datas = array();

        foreach ($budayas as $key => $budaya) {
            $row = array();
            $row[] = (string) ($key + 1);
            $row[] =  $budaya['judul'];
            $row[] =  "<img src='" . base_url() . $budaya['gambar'] . "' width='150px' height='150px'/>";
            $row[] = $model->converterbudaya($budaya['jenis_kebudayaan']);
            $row[] = (strlen($budaya['deskripsi']) < 60) ? $budaya['deskripsi'] : substr($budaya['deskripsi'], 0, 200) . " ...";
            $row[] = '<a id="editbudaya" href="' . base_url() . 'admin/editbudaya/' . $budaya["id"] . '" class="btn btn-sm text-success">
                <span class="fa fa-pencil-alt text-success" aria-hidden="true"></span>
                </button>
                <button id="hapusbudaya" class="btn btn-sm text-danger" gambarvalue="' . $budaya["gambar"] . '" recid="' . $budaya["id"] . '">
                <span class="fa fa-trash text-danger" aria-hidden="true"></span>
                </button>';
            $datas[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $model->count_all_budaya(),
            "recordsFiltered" => $model->count_filter_budaya($search),
            "data" => $datas,
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }


    public function adminjson()
    {
        $model = $this->Mdl_admin;
        $search = isset($_POST['search']['value']) ? $_POST['search']['value'] : ""; // Ambil data yang di ketik user

        $limit = isset($_POST['length']) ? $_POST['length'] : ""; // Ambil data limit per page    
        $start = isset($_POST['start']) ? $_POST['start'] : ""; // Ambil data start    
        $order_index = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : ""; // Untuk mengambil index yg menjadi acuan untuk sorting   
        $order_field = isset($_POST['columns'][$order_index]['data']) ? $_POST['columns'][$order_index]['data'] : ""; // Untuk mengambil nama field yg menjadi acuan untuk sorting    
        $order_ascdesc = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : ""; // Untuk menentukan order by "ASC" atau "DESC"
        $admins = $this->Mdl_admin->filteradmin($search, $limit, $start, $order_field, $order_ascdesc);
        $datas = array();

        foreach ($admins as $key => $admin) {
            $row = array();
            $row[] = (string) ($key + 1);
            $row[] =  $admin['username'];
            if ($admin['level'] == 1) {
                $row[] =  "Super Admin";
            } else if ($admin['level'] == 2) {
                $row[] =  "Admin Biasa";
            }
            $row[] =  $admin['default_password'];
            $row[] = '<a id="editadmin" href="' . base_url() . 'admin/editadmin/' . $admin["id"] . '" class="btn btn-sm text-success">
                <span class="fa fa-pencil-alt text-success" aria-hidden="true"></span>
                </button>
                <button id="hapusadmin" class="btn btn-sm text-danger" recid="' . $admin["id"] . '">
                <span class="fa fa-trash text-danger" aria-hidden="true"></span>
                </button>';
            $datas[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $model->count_all_admin(),
            "recordsFiltered" => $model->count_filter_admin($search),
            "data" => $datas,
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'admin', 'refresh');
    }
}
