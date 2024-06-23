<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Client_products_review_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('client_products_review')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('client_products_review', array('id_product_review' => $id))->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id_product_review', $id);
        return $this->db->update('client_products_review', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('client_products_review', array('id_product_review' => $id));
    }

    public function insert($id_client, $stars, $comment, $id_product)
{
    // Ensure the date format is correct
    $currentDate = date('Y-m-d');

    // Prepare the SQL query to check if the product was ordered by the client and delivered before today
    $sql = "SELECT * 
            FROM products_ordered 
            WHERE id_product = ? 
              AND id_order IN (
                  SELECT id_order 
                  FROM orders 
                  WHERE id_client = ? 
                    AND id_delivery IN (
                        SELECT id_delivery 
                        FROM delivery 
                        WHERE DATE(delivery_date) < ? 
                          AND status = 1
                    )
              )";

    // Execute the query with the provided parameters
    $query = $this->db->query($sql, array($id_product, $id_client, $currentDate));

    // Check if any rows are returned
    if ($query->num_rows() > 0) {
        // Prepare the insert query for client_products_review table
        $insert_sql = 'INSERT INTO client_products_review (stars, comment, id_client, id_product) VALUES (?, ?, ?, ?)';
        
        // Execute the insert query with the provided parameters
        $this->db->query($insert_sql, array($stars, $comment, $id_client, $id_product));

        return true;
    }

    return false;
}


    public function get_review_by_id_product ($id_product){
        return $this->db->get_where('v_product_comment', array('id_product' => $id_product))->result_array();
    }

    public function get_stars_pourcentage($id_product) {
        $review_pourcentage['stars_pourcentages'] = [0,0,0,0,0,0];
        $review_pourcentage['final_review']=0;
        $review_pourcentage['count_review']=0;

        $sql = "select stars, (count(stars)*100)/(select count(stars) from client_products_review where id_product = '$id_product' ) as stars_pourcentage from client_products_review where id_product = '$id_product'  group by stars";

        $tab1 = $this->db->query($sql)->result_array();

        if ($tab1!=null) {
            foreach ($tab1 as $data) {
                $review_pourcentage['stars_pourcentages'][$data['stars']] = $data['stars_pourcentage'];
            }
        }

        $sql = "select coalesce(avg(stars),0) as pourcentage from client_products_review where id_product = '$id_product'";
        if ($this->db->query($sql)->row()!=null ) {
            $review_pourcentage['final_review']=(double) number_format($this->db->query($sql)->row_array()['pourcentage'],1,"."," ");
        }
        $sql = "select count(stars) as pourcentage from client_products_review where id_product = '$id_product'";
        if ($this->db->query($sql)->row()!=null) {
            $review_pourcentage['count']=(double) number_format($this->db->query($sql)->row_array()['pourcentage'],0,""," ");
        }
        return $review_pourcentage;
    }
}

?>