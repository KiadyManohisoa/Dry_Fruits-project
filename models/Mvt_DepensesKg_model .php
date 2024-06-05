<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mvt_depenseskg_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('mvt_depenseskg', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('mvt_depenseskg', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('mvt_depenseskg');
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('mvt_depenseskg', array('id' => $id));
        return $query->row_array();
    }

    public function get_all()
    {
        $query = $this->db->get('mvt_depenseskg');
        return $query->result_array();
    }
}