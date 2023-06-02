<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('supplier');
        if($id != null){
            $this->db->where('supplier_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($pos)
    {
        $params = [
            'name' => $pos['name'],
            'phone' => $pos['phone'],
            'address' => $pos['address'],
            'description' => $pos['description']
        ];
        $this->db->insert('supplier', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        
        $params = [
            'name' => $pos['name'],
            'phone' => $pos['phone'],
            'address' => $pos['address'],
            'description' => $pos['description'],
            'updated' => $date
        ];
        $this->db->where('supplier_id', $pos['supplier_id']);
        $this->db->update('supplier', $params);
    }

    public function delete($id)
    {
        $this->db->where('supplier_id', $id);
        $this->db->delete('supplier');
    }
}

?>