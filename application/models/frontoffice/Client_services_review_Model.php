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
    // Ensure the date format is correct
    $currentDate = date('Y-m-d');
    
    // Prepare the SQL query with parameterized values
    $sql = "SELECT id_order 
            FROM orders 
            WHERE id_client = ? 
              AND id_delivery IN (
                  SELECT id_delivery 
                  FROM delivery 
                  WHERE DATE(delivery_date) < ? 
                    AND status = 1
              )";

    // Execute the query with the provided parameters
    $query = $this->db->query($sql, array($data['id_client'], $currentDate));

    // Check if any rows are returned
    if ($query->num_rows() > 0) {
        // Insert the data into the client_services_review table
        $this->db->insert('client_services_review', $data);
        return true;
    }
    return false;
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

    public function get_stars_pourcentage() {
        $review_pourcentage['stars_pourcentages'] = [0,0,0,0,0,0];
        $review_pourcentage['final_review']=0;
        $review_pourcentage['count_review']=0;

        $sql = "select stars, (count(stars)*100)/(select count(stars) from client_services_review) as stars_pourcentage from client_services_review  group by stars";

        $tab1 = $this->db->query($sql)->result_array();

        if ($tab1!=null) {
            foreach ($tab1 as $data) {
                $review_pourcentage['stars_pourcentages'][$data['stars']] = $data['stars_pourcentage'];
            }
        }

        $sql = "select coalesce(avg(stars),0) as pourcentage from client_services_review";
        if ($this->db->query($sql)->row()!=null ) {
            $review_pourcentage['final_review']=(double) number_format($this->db->query($sql)->row_array()['pourcentage'],1,"."," ");
        }
        $sql = "select count(stars) as pourcentage from client_services_review";
        if ($this->db->query($sql)->row()!=null) {
            $review_pourcentage['count']=(double) number_format($this->db->query($sql)->row_array()['pourcentage'],0,""," ");
        }
        return $review_pourcentage;
    }

    public function get_all_services_review()
    {
        return $this->db->get('v_services_comment')->result_array();
    }
}
