<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Server.php";

class Mahasiswa extends Server
{
    // fungsi get()
    function service_get()
    {
        // call model "Mmahasiswa"
        $this->load->model("Mmahasiswa", "mdl", TRUE);
        // call fungsi "get_data"
        $hasil = $this->mdl->get_data();

        $this->response(array("mahasiswa" => $hasil), 200);
    }
    // fungsi post()
    function service_post()
    {
        $this->load->model("Mmahasiswa", "mdl", TRUE);

        $data = array(
            // 'id' => $this->input->post('in_id'),
            'in_npm' => $this->input->post('npm'),
            'in_nama' => $this->input->post('nama'),
            'in_telepon' => $this->input->post('telepon'),
            'in_jurusan' => $this->input->post('jurusan'),
            "token" => base64_encode($this->post("npm")),
        );

        // Show submitted data on view page again.
        // $this->response(array("mahasiswa" => $data), 200);
        $hasil =  $this->mdl->insert_data($data["in_npm"], $data["in_nama"], $data["in_telepon"], $data["in_jurusan"], $data["token"]);
        if ($hasil == 0) {
            $this->response(array("status" => "Data Mahasiswa Berhasil Disimpan"), 200);
        } else {
            $this->response(array("status" => "Data Mahasiswa Gagal Disimpan !!"), 200);
        }
    }
    // fungsi get()
    function service_put()
    {
        // panggil model mahasiswa
        $this->load->model("Mmahasiswa", "mdl", TRUE);


        // ambil parameter data yang akan di isi
        $data = array(
            "npm" => $this->put("npm"),
            "nama" => $this->put("nama"),
            "telepon" => $this->put("telepon"),
            "jurusan" => $this->put("jurusan"),
            "token" => base64_encode($this->put("token"))
        );

        // panggil method update_data
        $hasil = $this->mdl->update_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);

        // jika hasil = 0
        if ($hasil == 0) {
            $this->response(array("status" => "Data Mahasiswa Berhasil di Update"), 200);
        }
        // jika hasil !=0
        else {
            $this->response(array("status" => "Data Mahasiswa Gagal di Update"), 200);
        }
    }
    // fungsi get()
    function service_delete()
    {
        $this->load->model("Mmahasiswa", "mdl", TRUE);
        //get token NPM
        $token = $this->delete("npm");
        // call delete_data
        $hasil = $this->mdl->delete_data(base64_encode($token));

        if ($hasil == 1) {
            $this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"), 200);
        } else {
            $this->response(array("status" => "Data Mahasiswa Gagal Dihapus !!"), 200);
        }
    }
}
