<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Client_products_review 
{
    protected $CI ; 

    private $id_product_review ; 
    private $stars ; 
    private $comment ; 
    private $client ; 
    private $id_product ; 
    private $review_date ; 

    public function get_id_product_review (){
        return $this->id_product_review ; 
    }

    public function get_stars (){
        return $this->stars ; 
    }

    public function get_comment (){
        return $this->comment ; 
    }

    public function get_client (){
        return $this->client ; 
    }

    public function get_id_product(){
        return $this->id_product; 
    }

    public function get_review_date(){
        return $this->review_date; 
    }

    public function set_id_product_review ($id_product_review){
        $this->id_product_review = $id_product_review ; 
    }

    public function set_stars ($stars){
        $this->stars = $stars ; 
    }

    public function set_comment ($comment){
        $this->comment = $comment ; 
    }

    public function set_client ($client){
        $this->client = $client ; 
    }

    public function set_id_product ($id_product){
        $this->id_product = $id_product ; 
    }

    public function set_review_date ($review_date){
        $this->review_date = $review_date ; 
    }

    public function __construct($id_product_review = null , $stars = null , $comment = null , $client = null , $id_product = null, $review_date = null )
    {
        $this->CI = &get_instance();
        $this->CI->load->model('frontoffice/Client_products_review_model','Client_products_review_model');
        $this->set_id_product_review($id_product_review);
        $this->set_stars($stars) ; 
        $this->set_comment($comment);
        $this->set_client($client) ; 
        $this->set_id_product($id_product);
        $this->set_review_date($review_date);
    }

    public function get_all_client_product_review (){
        $data = $this->Client_products_review_model->get_all();
        $client_reviews = array();
        foreach ($data as $client_review) {
            $client_reviews[] = new Client_products_review(
               $client_review['id_product_review'],
               $client_review['stars'],
               $client_review['comment'],
               $client_review['client'],
               $client_review['id_product'],
               $client_review['id_product'] 
            ); 
        }
        return $client_reviews ; 
    }

    public function add_client_product_review ($client , $stars,$comment, $id_product){
        return $this->CI->Client_products_review_model->insert($client , $stars , $comment , $id_product);
    }

    // return an object 
    public function get_client_product_review_by_id($client_review){
        $client_review = $this->CI->Client_products_review_model->get_by_id($client_review);
       return new Client_products_review(
            $client_review['id_product_review'],
            $client_review['stars'],
            $client_review['comment'],
            $client_review['client'],
            $client_review['id_product'],
            $client_review['id_product'] 
         ); 
    }

    public function update_client_product_review ($client_review , $data){
        return $this->CI->Client_products_review_model->update($client_review , $data); 
    }

    public function delete_client_product_review ($client_review){
        return $this->CI->Client_products_review_model->delete($client_review);
    }

    public function get_review_by_id_product($id_product){
        $reviews = $this->CI->Client_products_review_model->get_review_by_id_product($id_product);
        if ($reviews==null) {
            $reviews=[];
        }
        return $reviews;
    }
}
?>