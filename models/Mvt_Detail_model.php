<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mvt_Detail_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('Mvt_Detail', $data);
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('Mvt_Detail', array('id' => $id));
        return $query->row_array();
    }

    public function get_all()
    {
        $query = $this->db->get('Mvt_Detail');
        return $query->result_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('Mvt_Detail', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('Mvt_Detail');
    }
}
