<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ga_ada_session();
        $this->load->model('Unit_m');
    }

    public function index()
    {
        $data['title'] = "Data Unit";
        $data['row'] = $this->Unit_m->get();
        $this->template->load('template', 'product/unit/data_unit', $data);
    }

    public function add()
    {
        $data['title'] = "Tambah Data Unit";
        $this->template->load('template', '/product/unit/tambah_unit', $data);
    }


    public function processAdd()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[p_unit.name]|min_length[2]');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('is_unique', '{field} Sudah Ada, Silahkan Cari {field} Baru');
        $this->form_validation->set_message('min_length', '{field} Minimal 2 Karakter');

        if($this->form_validation->run() == false){
            $this->add();
        }else{
            $pos = $this->input->post(null, true);
            $this->Unit_m->add($pos);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                        Data Berhasil Menambahkan Data Baru.
                    </div>'
                );
                redirect('unit');
            }
        }
    }

    
    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|callback_name_check');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('min_length', '{field} Minimal 2 Karakter');

        if($this->form_validation->run() == false){
            $query = $this->Unit_m->get($id);
            if($query->num_rows() > 0){
                $unit = $query->row();
                $data["unit"] = $unit;
                $data["title"] = "Update Unit";
                $this->template->load('template', 'product/unit/ubah_unit', $data);
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!</h4>
                        Data Tidak Di Temukan, Silakan Cari Data Yang Tersedia.
                    </div>'
                );
                redirect('unit');
            }
        }else{
            $pos = $this->input->post(null, true);
            $this->Unit_m->edit($pos);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                        Anda Berhasil Mengupdate Data.
                    </div>'
                );
                redirect('unit');
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!</h4>
                        Anda Gagal Mengupdate Data, Silahkan Update Data Kembali.
                    </div>'
                );
                redirect('unit');
            }
        }
    }

    public function delete($id)
    {
        $this->Unit_m->delete($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                    Data Berhasil Di Hapus.
                </div>'
            );
            redirect('unit');
        }
    }

    function name_check()
    {
        $pos = $this->input->post(null, true);
        $query = $this->db->query("SELECT * FROM p_unit WHERE name = '$pos[name]' AND unit_id != '$pos[unit_id]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('name_check', '{field} Sudah Ada, Silahkan Cari {field} Baru');
            return false;
        }else{
            return true;
        }
    }
}

?>