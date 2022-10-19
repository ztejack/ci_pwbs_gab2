<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mmahasiswa extends CI_Model
{
    function get_data()
    {
        $this->db->select("id AS id_mhs, npm AS npm_mhs, nama AS nama_mhs, telepon AS telepon_mhs, jurusan AS jurusan_mhs");
        $this->db->from("tb_mahasiswa");
        $this->db->order_by("npm", "DESC");

        $query = $this->db->get()->result();
        return $query;
    }
    function insert_data($npm, $nama, $telepon, $jurusan, $token)
    {
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");

        $query = $this->db->get()->result();

        if (count($query) == 0) {
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "telepon" => $telepon,
                "jurusan" => $jurusan,
            );
            $this->db->insert('tb_mahasiswa', $data);
            $hasil = 0;
        } else {
            $hasil = 1;
        }
        return $hasil;
    }

    function delete_data($token)
    {
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");

        $query = $this->db->get()->result();

        if (count($query) == 1) {
            $this->db->where("TO_BASE64(npm) = '$token'");
            $this->db->delete("tb_mahasiswa");
            $hasil = 1;
        } else {
            $hasil = 0;
        }
        return $hasil;
    }

    // function update_data($data, $id)
    // {

    //     // $where(
    //     //     'id'=$id
    //     // )
    //     // $this->db->from("tb_mahasiswa");
    //     // $this->db->where_in()
    // }

    // function update_data($where, $data, $table)
    // {
    //     $this->db->where($where);
    //     $this->db->update($table, $data);
    // }
}
