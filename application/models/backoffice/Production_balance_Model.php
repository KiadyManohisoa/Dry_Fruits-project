<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Production_balance_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_balance_by_date($date_search, $id_cat_produit)
    {
        $sql = "SELECT * FROM get_Balance_By_Date(?, ?)";
        $query = $this->db->query($sql, array($date_search, $id_cat_produit));
        return $query->result_array();
    }
}
