<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($app, $section) {
        $CI =& get_instance();

        $data = array();
        if ($app == 'backoffice' && $section == 'CRUD') {
            $CI->load->library('Cat_Produit');
            $CI->load->library('Cat_Fruit');
            $data['ls_cat_prod'] = $CI->cat_produit->get_All_Produits();
            $data['ls_cat_fruits'] = $CI->cat_fruit->get_All_Fruits();
        }

        return $data;
    }
}
?>
