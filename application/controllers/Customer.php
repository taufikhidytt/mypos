<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ga_ada_session();
        $this->load->model('Customer_m');
    }

    public function index()
    {
        $data['title'] = "Data Customer";
        $data['row'] = $this->Customer_m->get();
        $this->template->load('template', 'customer/data_customer', $data);
    }

    public function add()
    {
        $data['title'] = "Tambah Data Customer";
        $this->template->load('template', 'customer/tambah_customer', $data);
    }

    public function processAdd()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('phone', 'Telpon', 'required|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[10]');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('numeric', '{field} Wajib Berupa Angka Tidak Boleh Karakter');
        $this->form_validation->set_message('min_length', '{field} Minimal 10 Karakter');
        $this->form_validation->set_message('max_length', '{field} Maksimal 13 Karakter');
        if($this->form_validation->run() == false){
            $this->add();
        }else{
            $pos = $this->input->post(null, true);
            $this->Customer_m->add($pos);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamatt!</h4>
                        Anda Berhasil Menambahkan Data Baru.
                    </div>'
                );
                redirect('customer');
            }
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('phone', 'Telpon', 'required|numeric|min_length[10]|max_length[13]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[10]');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('numeric', '{field} Wajib Berupa Angka Tidak Boleh Karakter');
        $this->form_validation->set_message('min_length', '{field} Minimal 10 Karakter');
        $this->form_validation->set_message('max_length', '{field} Maksimal 13 Karakter');

        if($this->form_validation->run() == false)
        {
            $query = $this->Customer_m->get($id);
            if ($query->num_rows() > 0) {
                $customer = $query->row();
                $data['customer'] = $customer;
                $data['title'] = "Update Data Customer";
                $this->template->load('template', 'customer/ubah_customer', $data);
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!!</h4>
                        Data Tidak Ditemukan, Silahkan Cari Data Yang Tersedia.
                    </div>'
                );
                redirect('customer');
            }
        }else{
            $pos = $this->input->post(null, true);
            $this->Customer_m->edit($pos);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamatt!</h4>
                        Anda Berhasil Mengupdate Data.
                    </div>'
                );
                redirect('customer');
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!</h4>
                        Anda Gagal Mengupdate Data.
                    </div>'
                );
                redirect('customer');
            }
        }
    }

    public function delete($id)
    {
        $this->Customer_m->delete($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Selamatt!</h4>
                    Anda Berhasil Menghapus Data.
                </div>'
            );
            redirect('customer');
        }
    }
}

?>