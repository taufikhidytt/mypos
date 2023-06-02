<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ga_ada_session();
        $this->load->model('Category_m');
    }

    public function index()
    {
        $data['title'] = "Data Category";
        $data['row'] = $this->Category_m->get();
        $this->template->load('template', 'product/category/data_category', $data);
    }

    public function add()
    {
        $data['title'] = "Tambah Data Category";
        $this->template->load('template', 'product/category/tambah_category', $data);
    }

    public function processAdd()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[p_category.name]');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('is_unique', '{field} Sudah Ada Silahkan Cari {field} Lain');

        if($this->form_validation->run() == false)
        {
            $this->add();
        }else{
            $pos = $this->input->post(null, true);
            $this->Category_m->add($pos);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                        Anda Berhasil Menambahkan Data Baru.
                    </div>'
                );
                redirect('category');
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!</h4>
                        Anda Gagal Menambahkan Data Baru.
                    </div>'
                );
                redirect('category');
            }
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required|callback_name_check');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');

        if($this->form_validation->run() == false){
            $query = $this->Category_m->get($id);
            if($query->num_rows() > 0){
                $category = $query->row();
                $data['category'] = $category;
                $data['title'] = "Update Category";
                $this->template->load('template', 'product/category/ubah_category', $data);
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!</h4>
                        Data Tidak Di Temukan, Silahkan Cari Data Yang Tersedia.
                    </div>'
                );
                redirect('category');
            }
        }else{
            $pos = $this->input->post(null, true);
            $this->Category_m->edit($pos);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamatt!</h4>
                        Anda Berhasil Mengupdate Data.
                    </div>'
                );
                redirect('category');
            }
        }
    }

    public function delete($id)
    {
        $this->Category_m->delete($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                    Data Berhasil Di Hapus.
                </div>'
            );
            redirect('category');
        }
    }

    function name_check()
    {
        $post = $this->input->post(null, true);
        $query = $this->db->query("SELECT * FROM p_category WHERE name = '$post[name]' AND category_id != '$post[category_id]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('name_check', '{field} sudah di pakai, Silahkan cari {field} lain.');
            return false;
        }else{
            return true;
        }
    }
}

?>