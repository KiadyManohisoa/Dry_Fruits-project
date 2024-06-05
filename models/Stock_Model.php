<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Create
    public function insert_stock($data)
    {
        return $this->db->insert('stock', $data);
    }

    // Read all
    public function get_all_stock()
    {
        $query = $this->db->get('stock');
        return $query->result();
    }

    // Read by ID
    public function get_stock_by_id($id)
    {
        $query = $this->db->get_where('stock', array('id' => $id));
        return $query->row();
    }

    // Update
    public function update_stock($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('stock', $data);
    }

    // Delete
    public function delete_stock($id)
    {
        return $this->db->delete('stock', array('id' => $id));
    }
}
