<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_favorite_products_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Créer un favori
    public function create_favorite($data)
    {
        return $this->db->insert('client_favorite_products', $data);
    }

    // Lire un favori par son identifiant
    public function get_favorite($id_client_favorite_products)
    {
        $this->db->where('id_client_favorite_products', $id_client_favorite_products);
        $query = $this->db->get('client_favorite_products');
        return $query->row_array();
    }

    public function get_favorites_with_latest_movement($id_client)
    {
        $sql = "SELECT * FROM v_product_configuration WHERE product_id in (SELECT id_product FROM client_favorite_products WHERE id_client = ?)";

        $query = $this->db->query(
            $sql,
            array($id_client)
        );
        return $query->result_array();
    }

    // Lire tous les favoris d'un client
    public function get_all_favorites_by_client($id_client)
    {
        $this->db->where('id_client', $id_client);
        $query = $this->db->get('client_favorite_products');
        return $query->result_array();
    }

    // Lire les produits favoris d'un client
    public function get_favorites_by_client($id_client)
    {
        $this->db->select('cfp.id_client_favorite_products, cfp.id_product, vpd.product_name');
        $this->db->from('client_favorite_products cfp');
        $this->db->join('v_product_detail vpd', 'cfp.id_product = vpd.id_product', 'left');
        $this->db->where('cfp.id_client', $id_client);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mettre à jour un favori
    public function update_favorite($id_client_favorite_products, $data)
    {
        $this->db->where('id_client_favorite_products', $id_client_favorite_products);
        return $this->db->update('client_favorite_products', $data);
    }

    public function delete_favorite($id_client, $id_product)
    {
        $this->db->where('id_client', $id_client);
        $this->db->where('id_product', $id_product);
        return $this->db->delete('client_favorite_products');
    }

}