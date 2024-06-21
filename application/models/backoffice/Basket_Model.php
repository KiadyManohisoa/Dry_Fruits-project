<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Basket_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_basket_link($id_order)
    {
        $sql = "SELECT * FROM get_basket_link(?)";
        $query = $this->db->query($sql, array($id_order));
        return $query->result_array();
    }
}
