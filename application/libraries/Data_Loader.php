<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Loader {

    public function load_data($app, $section) {
        $CI =& get_instance();
        $CI->load->library('Cat_Produit');

        $data = array();

        if ($app == 'backoffice' && $section == 'CRUD') {
            $data['ls_cat_prod'] = $CI->cat_produit->get_All_Cat_Produits();
        }

        return $data;
    }
}
?>
