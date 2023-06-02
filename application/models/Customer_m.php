<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class customer_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('customer');
        if($id != null){
            $this->db->where('customer_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($pos)
    {
        $params = [
            'name' => $pos['name'],
            'gender' => $pos['gender'],
            'phone' => $pos['phone'],
            'address' => $pos['address'],
        ];
        $this->db->insert('customer', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        
        $params = [
            'customer_id' => $pos['customer_id'],
            'name' => $pos['name'],
            'gender' => $pos['gender'],
            'phone' => $pos['phone'],
            'address' => $pos['address'],
            'updated' => $date
        ];
        $this->db->where('customer_id', $pos['customer_id']);
        $this->db->update('customer', $params);
    }

    public function delete($id)
    {
        $this->db->where('customer_id', $id);
        $this->db->delete('customer');
    }
}

?>