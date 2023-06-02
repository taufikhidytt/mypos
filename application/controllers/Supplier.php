<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ga_ada_session();
        $this->load->model('Supplier_m');
    }

    public function index()
    {
        $data['title'] = "Data Supplier";
        $data['row'] = $this->Supplier_m->get();
        $this->template->load('template', 'supplier/data_supplier', $data);
    }

    public function add()
    {
        $data['title'] = "Tambah Data Supplier";
        $this->template->load('template', 'supplier/tambah_supplier', $data);
    }

    public function processAdd()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[10]');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[10]');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('numeric', '{field} Wajib Berupa Angka Tidak Boleh Karakter');
        $this->form_validation->set_message('min_length', '{field} Minimal 10 Karakter');
        $this->form_validation->set_message('max_length', '{field} Maksimal 13 Karakter');
        if($this->form_validation->run() == false){
            $this->add();
        }else{
            $pos = $this->input->post(null, true);
            $this->Supplier_m->add($pos);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamatt!</h4>
                        Anda Berhasil Menambahkan Data Baru.
                    </div>'
                );
                redirect('supplier');
            }
        }
    }

    public function process()
    {
        $pos = $this->input->post(null, true);

        if(isset($_POST['add'])){
            $this->Supplier_m->add($pos);

        }elseif(isset($_POST['edit'])){

            $this->Supplier_m->edit($pos);
        }

        if($this->db->affected_rows() > 0){
            echo "<script>
                alert('Selamat, Data Berhasil Di Simpan');
                document.location='".base_url('supplier')."';
                </script>";
        }else{
            echo "<script>
                alert('Anda Tidak Mengupdate Data');
                document.location='".base_url('supplier')."';
            </script>";
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[10]');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[10]');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('numeric', '{field} Wajib Berupa Angka Tidak Boleh Karakter');
        $this->form_validation->set_message('min_length', '{field} Minimal 10 Karakter');
        $this->form_validation->set_message('max_length', '{field} Maksimal 13 Karakter');

        if($this->form_validation->run() == false){
            $query = $this->Supplier_m->get($id);
            if($query->num_rows() > 0){
                $supplier = $query->row();
                $data['supplier'] = $supplier;
                $data['title'] = "Update Data Supplier";
                $this->template->load('template', 'supplier/ubah_supplier', $data);
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Upss!!</h4>
                        Data Tidak Ditemukan, Silahkan Cari Data Yang Tersedia.
                    </div>'
                );
                redirect('supplier');
            }
        }else{
            $pos = $this->input->post(null, true);
            $this->Supplier_m->edit($pos);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamatt!</h4>
                        Anda Berhasil Mengupdate Data.
                    </div>'
                );
                redirect('supplier');
            }
        }
    }

    public function delete($id)
    {
        $this->Supplier_m->delete($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Selamatt!</h4>
                    Anda Berhasil Menghapus Data.
                </div>'
            );
            redirect('supplier');
        }
    }
}

?>