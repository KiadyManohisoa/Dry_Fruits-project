<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_services_review_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Insérer une nouvelle évaluation de service dans la table client_services_review
    public function create_review($data)
    {
        return $this->db->insert('client_services_review', $data);
    }

    // Récupérer une évaluation de service par son identifiant
    public function get_review($id_service_review)
    {
        $this->db->where('id_service_review', $id_service_review);
        $query = $this->db->get('client_services_review');
        return $query->row_array();
    }

    // Mettre à jour une évaluation de service existante par son identifiant
    public function update_review($id_service_review, $data)
    {
        $this->db->where('id_service_review', $id_service_review);
        return $this->db->update('client_services_review', $data);
    }

    // Supprimer une évaluation de service par son identifiant
    public function delete_review($id_service_review)
    {
        $this->db->where('id_service_review', $id_service_review);
        return $this->db->delete('client_services_review');
    }
}
