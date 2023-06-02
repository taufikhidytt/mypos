<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    // function untuk tampilan login
    public function login()
    {
        ada_session();
        $this->load->view('login');
    }

    // function untuk proses login
    public function process()
    {
        // membuat rules validation untuk form input login;
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        // set pesan yang akan di tampilkan
        $this->form_validation->set_message('required', '{field} tidak boleh kosong');
        $this->form_validation->set_message('min_length', '{field} minimal panjang 5 karakter');

        // kondisi jika form validation true atau false
        if($this->form_validation->run() == false){
            // jika nilainya false redirect kembali ke halaman login
            $this->login();

            // jika nilainya true proses form input login
        }else{
            // mengambil semua inputan di view login
            $post = $this->input->post(null, true);

            // jika tombol submit di tekan
            if(isset($post['submit']))
            {
                // load model
                $this->load->model('User_m');

                // load model dan melempar parameter inputan ke model
                $query = $this->User_m->login($post);

                // cek jika mendapatkan 1 pengguna yang cocok;
                if($query->num_rows() > 0)
                {
                    // mengekstrak 1 baris yang di dapat
                    $row = $query->row();

                    // mendefinisikan array untuk session
                    $param = array(
                        'user_id' => $row->user_id,
                        'level' => $row->level,
                        'username' => $row->username,
                        'address' => $row->address
                    );
                    // load session yang sudah di ambil dari $param
                    $this->session->set_userdata($param);

                    // redirect ke halaman dashboard
                    $this->session->set_flashdata('pesan',
                        '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Selamaatt!</h4>
                            Anda Berhasil Login.
                        </div>'
                    );
                    redirect('dashboard');
                }else{
                    // jika gagal redirect kembali ke halaman login
                    $this->session->set_flashdata('pesan',
                        '<div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Gagal Login!</h4>
                            Silahkan Cek Kembali Username Dan Password Anda.
                        </div>'
                    );
                    redirect('auth/login');
                }
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('level');
        $this->session->set_flashdata('pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Selamatt!</h4>
                Anda Berhasil Logout.
            </div>'
        );
        redirect('auth/login');
    }
}

?>