<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('frontoffice/Data_Loader');
        $this->load->library('backoffice/Delivery');
        $this->load->library('backoffice/Basket', 'Basket');
        $this->load->model('backoffice/Delivery_Model', 'Delivery_Model');
        $this->load->model('backoffice/view_model', 'main');
        $this->load->library('session');
    }

    public function add_delivery() {
        
    }

    public function basket_link($order_id)
    {
        if ($this->session->get("id_client")) {
            $data = $this->main->page('frontoffice', 'bag');
            $order_details = $this->basket->get_basket_link($order_id);
    
            if (!empty($order_details)) {
                $data = array_merge($data, ['order_details' => $order_details]);
            }
    
            $this->load->view('templates/template', $data);
        }
        else {
            redirect(site_url('frontoffice/View/page/home'));
        }
    }
}
