<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($app, $section) {
        $CI =& get_instance();

        $data = array();
        if ($app == 'backoffice' && $section == 'CRUD') {
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
        else if ($app == 'backoffice' && $section == 'home'){
            $CI->load->library('backoffice/Cat_product');
            $data['ls_cat_products'] = $CI->cat_product->get_all_products();
        }

        return $data;
    }
}
?>
