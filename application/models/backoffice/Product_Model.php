<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('product')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('product', array('id_product' => $id))->row_array();
    }

    public function get_by_criteria($id_cat_fruit,$_id_cat_product){
        
        return $this->db->get_where('product', array('id_cat_product' => $_id_cat_product,'id_cat_fruit' => $id_cat_fruit))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('product', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function delete($id)
    {
        $data['status'] = 0;
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function reinsert($id)
    {
        $data['status'] = 1;
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function get_product_categories()
    {
        return $this->db->get('v_product_categories')->result_array();
    }

    public function get_product_configuration()
    {
        return $this->db->get('v_product_configuration')->result_array();
    }

    public function update_stock()
    {
        return $this->db->get('v_product_stock')->result_array();
    }
}
