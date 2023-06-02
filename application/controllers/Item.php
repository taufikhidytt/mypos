<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ga_ada_session();
        $this->load->model(['Item_m', 'Category_m', 'Unit_m']);
    }

    public function index()
    {
        $data['title'] = "Data Item";
        $data['row'] = $this->Item_m->get();
        $this->template->load('template', 'product/item/data_item', $data);
    }

    public function add()
    {
        $category = $this->Category_m->get();
        $unit = $this->Unit_m->get();
        $data['title'] = "Tambah Item";
        $data['category'] = $category;
        $data['unit'] = $unit;
        $this->template->load('template', 'product/item/tambah_item', $data);
    }

    

    public function processAdd()
    {
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|min_length[3]|is_unique[p_item.barcode]');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stock', 'required|numeric');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('min_length', '{field} Minamal 3 Karakter');
        $this->form_validation->set_message('is_unique', '{field} Sudah Ada, Silahkan Cari {field} Baru');
        $this->form_validation->set_message('numeric', '{field} Tidak Berisi Karakter, Wajib Berupa Numeric');
        
        if($this->form_validation->run() == false){
            $this->add();
        }else{
            $pos = $this->input->post(null, true);
            $this->Item_m->add($pos);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                        Anda Berhasil Menambahkan Data Baru.
                    </div>'
                );
                redirect('item');
            }
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|min_length[3]|callback_name_check');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stock', 'required|numeric');

        $this->form_validation->set_message('required', '{field} Tidak Boleh Kosong');
        $this->form_validation->set_message('min_length', '{field} Minamal 3 Karakter');
        $this->form_validation->set_message('is_unique', '{field} Sudah Ada, Silahkan Cari {field} Baru');
        $this->form_validation->set_message('numeric', '{field} Tidak Berisi Karakter, Wajib Berupa Numeric');

        if($this->form_validation->run() == false){
            $query = $this->Item_m->get($id);
            $category = $this->Category_m->get();
            $unit = $this->Unit_m->get();
            if($query->num_rows() > 0){
                $item = $query->row();
                $data['item'] = $item;
                $data['category'] = $category;
                $data['unit'] = $unit;
                $data['title'] = "Update Item";
                $this->template->load('template', 'product/item/ubah_item', $data);
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!</h4>
                        Data Tidak Di Temukan, Silahkan Cari Data Yang Tersedia.
                    </div>'
                );
                redirect('item');
            }
        }else{
            $pos = $this->input->post(null, true);
            $this->Item_m->edit($pos);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                        Anda Berhasil Mengupdate Data Baru.
                    </div>'
                );
                redirect('item');
            }else{
                $this->session->set_flashdata('pesan',
                    '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Upps!</h4>
                        Anda Gagal Mengupdate Data, Silahkan Update Data Yang Tersedia.
                    </div>'
                );
                redirect('item');
            }
        }

    }

    public function delete($id)
    {
        $this->Item_m->delete($id);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('pesan',
                '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Selamaat!</h4>
                    Data Berhasil Di Hapus.
                </div>'
            );
            redirect('item');
        }
    }

    function name_check()
    {
        $pos = $this->input->post(null, true);
        $query = $this->db->query("SELECT * FROM p_item WHERE name = '$pos[name]' AND barcode != '$pos[barcode]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('name_check', '{field} Data Sudah Ada, Silahkan Cara Data Yang Baru');
            return false;
        }else{
            return true;
        }
    }
}

?>