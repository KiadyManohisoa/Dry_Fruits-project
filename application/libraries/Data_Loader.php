<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($app, $section) {
        $CI =& get_instance();

        $data = array();
        if ($app == 'backoffice' && $section == 'CRUD') {
            $CI->load->library('Cat_product');
            $CI->load->library('Cat_fruit');

            $CI->load->library('Product');
            $CI->load->library('Stock');
            $CI->load->library('Detail_movement');
            $CI->load->library('Wholesale_movement');
            $CI->load->library('Bulk_movement');
            $CI->load->library('Charges_kg_movement');


            $data['ls_cat_products'] = $CI->cat_product->get_all_products();
            $data['ls_cat_fruits'] = $CI->cat_fruit->get_all_fruits();
            $data['ls_product_configuration'] = $CI->product->get_product_configuration();
        }
        else if ($app == 'backoffice' && $section == 'home'){
            $CI->load->library('Cat_product');
            $data['ls_cat_products'] = $CI->cat_product->get_all_products();
        }

        return $data;
    }
}
?>
