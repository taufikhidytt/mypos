<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model{

    // function untuk cek login
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', strtolower($post['username']));
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    // function untuk mengambil data
    public function get($id = null)
    {
        $this->db->from('user');
        if($id != null)
        {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // function untuk menambahdata
    public function add($pos)
    {
        $params['username'] = strtolower($pos['username']);
        $params['name']     = $pos['name'];
        $params['password'] = sha1($pos['password']);
        $params['level']    = $pos['level'];
        $params['address']  = $pos['address'];
        $this->db->insert('user', $params);
    }

    // function untuk hapus data;
    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }

    // function untuk update data
    public function update($pos)
    {
        $params['username'] = strtolower($pos['username']);
        $params['name']     = $pos['name'];
        if(!empty($pos['password'])){
            $params['password'] = sha1($pos['password']);
        }
        $params['level']    = $pos['level'];
        $params['address']  = $pos['address'];
        $this->db->where('user_id', $pos['user_id']);
        $this->db->update('user', $params);
    }
}

?>