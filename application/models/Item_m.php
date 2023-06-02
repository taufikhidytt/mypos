<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('p_item.*, p_category.name as name_category, p_unit.name as name_unit');
        $this->db->from('p_item');
        $this->db->join('p_category', 'p_category.category_id = p_item.category_id');
        $this->db->join('p_unit', 'p_item.unit_id = p_unit.unit_id');
        if($id != null){
            $this->db->where('item_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($pos)
    {
        $params = [
            'name'        => $pos['name'],
            'price'       => $pos['price'],
            'stock'       => $pos['stock'],
            'category_id' => $pos['category'],
            'unit_id'     => $pos['unit'],
            'barcode'     => $pos['barcode']
        ];
        $this->db->insert('p_item', $params);
    }

    public function edit($pos)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        
        $params = [
            'name'        => $pos['name'],
            'price'       => $pos['price'],
            'stock'       => $pos['stock'],
            'category_id' => $pos['category'],
            'unit_id'     => $pos['unit'],
            'barcode'     => $pos['barcode'],
            'updated'     => $date
        ];
        $this->db->where('item_id', $pos['item_id']);
        $this->db->update('p_item', $params);
    }

    public function delete($id)
    {
        $this->db->where('item_id', $id);
        $this->db->delete('p_item');
    }
}

?>