<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('p_unit');
        if($id != null){
            $this->db->where('unit_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($pos)
    {
        $params = [
            'name' => $pos['name']
        ];
        $this->db->insert('p_unit', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        
        $params = [
            'name' => $pos['name'],
            'updated' => $date
        ];
        $this->db->where('unit_id', $pos['unit_id']);
        $this->db->update('p_unit', $params);
    }

    public function delete($id)
    {
        $this->db->where('unit_id', $id);
        $this->db->delete('p_unit');
    }
}

?>