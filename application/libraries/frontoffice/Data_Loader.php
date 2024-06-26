<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($section) {
        $CI =& get_instance();
        $CI->load->library("session");
        $CI->load->library("backoffice/Clients_account");
        $CI->load->model('backoffice/Product_Model','product_model');
        $data = array();
        $data['disponibility'] = $CI->product_model->get_product_disponibility();
        
        if ($CI->session->get("id_client")) {
            $CI->load->model("frontoffice/Client_favorite_products_Model","client_favorite_products_model");
            $CI->load->library("backoffice/orders");
            $id_client = $CI->session->get("id_client");
            $data['user'] = $CI->clients_account->get_client_by_id($id_client);
            $data['last_orders'] = $CI->orders->get_all_client_orders($id_client);

            $data['favoris_products'] = array();
            $data['client_favoris'] = array();
            $clients_favorites_prod=$CI->client_favorite_products_model->get_favorites_with_latest_movement($id_client);
            if(!empty($clients_favorites_prod)) {
                $data['favoris_products'] = $clients_favorites_prod;
                for($i=0;$i<count($clients_favorites_prod);$i++) {
                    $data['client_favoris'][] = $clients_favorites_prod[$i]['product_id'];
                }
            }

        }
        if ($section == 'home') {
            $data['reduce_products'] = $CI->product_model->get_reduce_products ();
            $data['new_products'] = $CI->product_model->get_new_products ();
            $data['most_saled_products'] = $CI->product_model->get_most_saled_product();
        }
        else if ($section == 'search'){
            $data['products'] = $CI->product_model->get_all_products_by_price_range(0, 0);
        }

        else if ($section == 'bag') {
            if ($CI->session->get("delivery_cost")==null) {
                $CI->session->set("delivery_cost",5000);
            }
            $data['delivery_cost'] = $CI->session->get("delivery_cost");
            $CI->load->model('backoffice/Product_Model','product_model');
            if ($CI->session->get('basket')!=null) {
                $data['basket'] = $CI->product_model->get_basket($CI->session->get('basket'));
            }

            if ($CI->session->get('client_reduction')!=null) {
                $data['basket'][0]['reduction'] = $CI->session->get('client_reduction');
                $data['basket'][0]['result'] = $data['basket'][0]['result'] - ($data['basket'][0]['result'] * $CI->session->get('client_reduction')/100);
            }
        }
        else if ($section=='info') {
            include(APPPATH . 'config/config_file.php');

            $data['investissors'] = $inverstissor;
            $data['team'] = $team;
            $data['about_us'] = $aboutus;
            $data['legal_notices'] = $legalnotices;
            $data['public_authorities'] = $publicAuthorities;
            $data['confidentiality'] = $confidentiality;
            $data['cookies']=$cookies;
            $data['type_of_products'] = $typeOfProducts;
            $data['partners'] = $partners;
        }
        return $data;
    }
}
?>
