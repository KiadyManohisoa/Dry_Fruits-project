<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($section) {
        $CI =& get_instance();
        $CI->load->library('session');
        if ($CI->session->get('admin_status')==null && $section!="login") {
            redirect('backoffice/View/page');
        }

        $data = array();
        $data['admin_status'] = $CI->session->get('admin_status');
        if ($section == 'CRUD') {
            $CI->load->library('backoffice/Cat_product');
            $CI->load->library('backoffice/Cat_fruit');
            $CI->load->library('backoffice/Product');
            $CI->load->library('backoffice/Stock');
            $CI->load->library('backoffice/Detail_movement');
            $CI->load->library('backoffice/Wholesale_movement');
            $CI->load->library('backoffice/Bulk_movement');
            $CI->load->library('backoffice/Charges_kg_movement');
            
            
            $data['ls_cat_products'] = $CI->cat_product->get_all_products();
            $data['ls_cat_fruits'] = $CI->cat_fruit->get_all_fruits();
            $data['ls_product_configuration'] = $CI->product->get_product_configuration();
        }
        else if ($section == 'home'){
            $CI->load->library('backoffice/Cat_product');
            $CI->load->library('backoffice/Production_balance', 'production_balance');
            $CI->load->library('backoffice/Clients_account','clients_account');
            $CI->load->model('frontoffice/Client_services_review_Model');
            $CI->load->library('frontoffice/Client_services_review','client_services_review');
            
            $data['review_pourcentage'] = $CI->Client_services_review_Model->get_stars_pourcentage();
            $data['reviews'] = $CI->client_services_review->get_all_services_review();
            $data['ls_cat_products'] = $CI->cat_product->get_all_products();
            $data['clients'] = $CI->clients_account->get_all_clients();
            $data['Production_balance'] = $CI->production_balance->get_balance_production(date('Y-m-d'),1);
            $data['date_search'] = date('Y-m-d');
    }
        else if ($section == 'delivery'){
            $CI->load->model('backoffice/Delivery_Model');
            $data['pending_baskets'] = $CI->Delivery_Model->get_pending_baskets();
            $data['delivered_baskets'] = $CI->Delivery_Model->get_delivered_baskets();
            $data['deliveries_management'] = $CI->Delivery_Model->get_deliveries_management(date('Y-m-d'));
        }

        return $data;
    }
}
?>
