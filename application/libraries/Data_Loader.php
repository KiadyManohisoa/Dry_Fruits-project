<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($app, $section) {
        $CI =& get_instance();

        $data = array();
        if ($app == 'backoffice' && $section == 'CRUD') {
            $CI->load->library('Cat_product');
            $CI->load->library('Cat_fruit');
            $data['ls_cat_products'] = $CI->cat_product->get_all_products();
            $data['ls_cat_fruits'] = $CI->cat_fruit->get_all_fruits();
        }

        return $data;
    }
}
?>
