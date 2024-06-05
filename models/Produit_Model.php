<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produit_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('produit', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('produit', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('produit');
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('produit', array('id' => $id));
        return $query->row();
    }

    public function get_all()
    {
        $query = $this->db->get('produit');
        return $query->result();
    }

    public function product_configuration()
    {
        $query = $this->db->query("SELECT pc.product_category_label AS product_category,
                                    pc.fruit_category_label AS fruit_category,
                                    pc.product_description,
                                    s.prix AS charges_price,
                                    d.prix AS detail_price
                                FROM Product_Configuration pc
                                LEFT JOIN Stock s ON pc.product_id = s.id_1
                                LEFT JOIN Mvt_Detail d ON pc.product_id = d.id_1");

        return $query->result();
    }
}
