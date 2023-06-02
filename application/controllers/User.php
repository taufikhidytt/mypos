<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        ga_ada_session();
        check_admin();
        $this->load->model('User_m');
    }

    public function index()
    {
        $data ['title'] = "Data Users";
        $data ['row'] = $this->User_m->get();
        $this->template->load('template', 'user/user_data', $data);
    }

    // function untuk menampilkan add user dan prosess input add user
    public function add()
    {
        // membuat validation
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[user.username]');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]',
            array(
                'matches' => '{field} tidak sesuai dengan password'
            )
        );
        $this->form_validation->set_rules('level', 'Status', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

        $this->form_validation->set_message('required', '{field} tidak boleh kosong');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah di gunakan, Silahkan cari username baru');

        // cek jika validation nilainya true atau false
        if ($this->form_validation->run() == false) {
            $data['title'] = "Add Users";
            $this->template->load('template', 'user/tambah_user', $data);
        }else{
            // mengambil semua isi yang di input
            $pos = $this->input->post(null, true);

            // melempar ke model
            $this->User_m->add($pos);

            // mengecek jika ada yang di inputkan dari model
            if($this->db->affected_rows() > 0){
                echo "<script>
                    alert('Selamatt, Anda berhasil menambahkan data baru');
                    document.location='".base_url('user')."';
                    </script>";
            }else{
                echo "<script>
                    alert('Anda gagal menambahkan data baru, Silahkan input data yang sesuai');
                    document.location='".base_url('user/add')."';
                    </script>";
            }
        }
    }

    public function delete()
    {
        // mengambil inputan
        $id = $this->input->post('user_id');

        // melempar ke model
        $this->User_m->delete($id);

        // kondisi jika berhasi di hapus
        if($this->db->affected_rows() > 0){
            echo "<script>
                alert('Selamatt, Anda Berhasil Menghapus Data');
                document.location='".base_url('user')."';
                </script>";
        }else{
            echo "<script>
                alert('Data Gagal Di Hapus');
                document.location='".base_url('user')."';
                </script>";
        }
    }

    // function untuk menampilkan update user dan prosess input update user
    public function update($id)
    {
        // membuat validation
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_username_check');
        $this->form_validation->set_rules('name', 'Name', 'required');

        // kondisi jika ada input password
        if($this->input->post('password')){
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]',
                array(
                    'matches' => '{field} tidak sesuai dengan password'
                )
            );
        }

        // kondisi jika ada input konfirmasi password
        if($this->input->post('password2')){
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]',
                array(
                    'matches' => '{field} tidak sesuai dengan password'
                )
            );
        }

        // membuat form validation
        $this->form_validation->set_rules('level', 'Status', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

        // pesan untuk form validation
        $this->form_validation->set_message('required', '{field} tidak boleh kosong');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah di gunakan, Silahkan cari username baru');

        // cek jika validation nilainya true atau false
        if ($this->form_validation->run() == false) {
            $query = $this->User_m->get($id);
            
            if($query->num_rows() > 0){
                $data['title'] = "Update Users";
                $data['row'] = $query->row();
                $this->template->load('template', 'user/edit_user', $data);
            }else{
                echo "<script>
                    alert('Data tidak di temukan');
                    document.location='".base_url('user')."';
                    </script>";
            }
        }else{
            // mengambil semua isi yang di input
            $pos = $this->input->post(null, true);

            // melempar ke model
            $this->User_m->update($pos);

            // mengecek jika ada yang di inputkan dari model
            if($this->db->affected_rows() > 0){
                echo "<script>
                    alert('Selamatt, Anda berhasil mengupdate data baru');
                    document.location='".base_url('user')."';
                    </script>";
            }else{
                echo "<script>
                    alert('Anda tidak mengupdate data');
                    document.location='".base_url('user')."';
                    </script>";
            }
        }
    }

    function username_check()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('username_check', '{field} sudah di pakai, Silahkan cari username lain.');
            return false;
        }else{
            return true;
        }
    }

}

?>