<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($section) {
        $CI =& get_instance();
        $CI->load->library("session");
        $CI->load->library("backoffice/Clients_account");
        $data = array();
        
        if ($CI->session->get("id_client")) {
            $CI->load->model("frontoffice/Client_favorite_products_Model","client_favorite_products_model");
            $id_client = $CI->session->get("id_client");
            $data['user'] = $CI->clients_account->get_client_by_id($id_client);
            
            $data['favoris_products'] = array();
            $data['client_favoris'] = array();
            $clients_favorites_prod=$CI->client_favorite_products_model->get_favorites_with_latest_movement($id_client);
            if(!empty($clients_favorites_prod)) {
                $data['favoris_products'] = $clients_favorites_prod;
                for($i=0;$i<count($clients_favorites_prod);$i++) {
                    $data['client_favoris'][] = $clients_favorites_prod[$i]['id_product'];
                }
            }

        }
        if ($section == 'home') {
            $CI->load->model('backoffice/Product_Model','product_model');
            $data['reduce_products'] = $CI->product_model->get_reduce_products ();
            $data['new_products'] = $CI->product_model->get_new_products ();
            $data['most_saled_products'] = $CI->product_model->get_most_saled_product();
        }
        else if ($section == 'search'){
            $CI->load->model('backoffice/Product_Model','product_model');
            $data['products'] = $CI->product_model->get_all_products_by_price_range(0, 0);
        }

        else if ($section = 'bag') {
            $CI->load->model('backoffice/Product_Model','product_model');
            if ($CI->session->get('basket')!=null) {
                $data['basket'] = $CI->product_model->get_basket($CI->session->get('basket'));
            }

            if ($CI->session->get('client_reduction')!=null) {
                $data['basket'][0]['reduction'] = $CI->session->get('client_reduction');
                $data['basket'][0]['result'] = $data['basket'][0]['result'] - ($data['basket'][0]['result'] * $CI->session->get('client_reduction')/100);
            }
        }

        return $data;
    }
}
?>
