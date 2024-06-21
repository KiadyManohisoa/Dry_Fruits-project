<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_favorite_products
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('frontoffice/Client_favorite_products_Model', 'favoriteModel');
    }

    // Méthode pour ajouter un favori
    public function add_favorite($data)
    {
        return $this->CI->favoriteModel->create_favorite($data);
    }

    // Méthode pour obtenir un favori par son identifiant
    public function get_favorite($id_client_favorite_products)
    {
        return $this->CI->favoriteModel->get_favorite($id_client_favorite_products);
    }

    // Méthode pour obtenir tous les favoris d'un client
    public function get_all_favorites_by_client($id_client)
    {
        return $this->CI->favoriteModel->get_all_favorites_by_client($id_client);
    }

    // Méthode pour obtenir les produits favoris d'un client
    public function get_favorites_by_client($id_client)
    {
        return $this->CI->favoriteModel->get_favorites_by_client($id_client);
    }

    // Méthode pour mettre à jour un favori
    public function update_favorite($id_client_favorite_products, $data)
    {
        return $this->CI->favoriteModel->update_favorite($id_client_favorite_products, $data);
    }

    // Méthode pour supprimer un favori
    public function delete_favorite($id_client,$id_product)
    {
        return $this->CI->favoriteModel->delete_favorite($id_client,$id_product);
    }
}