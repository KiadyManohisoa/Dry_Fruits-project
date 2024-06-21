<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Data_Loader','data_loader');
        $this->load->library('backoffice/Product','product');
        $this->load->model('backoffice/view_model', 'main');
        $this->load->model('backoffice/Product_Model','product_model');
    }

    public function add_services_review($id_product){
        $stars = 0; $comment = '';
        if ($this->session->get("id_client")!=null) {
            if ($this->input->post('stars')!=null) {
                $stars = $this->input->post('stars');
            }
            if ($this->input->post('comment')!=null) {
                $comment = $this->input->post('comment');
            }

            

        } else {
            redirect(site_url('frontoffice/View/page/login'));
        }
    }
}