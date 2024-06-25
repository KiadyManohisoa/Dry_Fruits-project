<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_balance_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Data_Loader', 'data_loader');
        $this->load->library('backoffice/Production_balance', 'production_balance');
        $this->load->model('backoffice/view_model', 'main');
    }

    public function check_form_exception() {
        $getDatas = $this->input->post();
        $error = '';
        if($getDatas) {
            foreach ($getDatas as $key => $value) {
                if($value=='' || str_contains($value,"Choose") || $value==null) {
                    $error.= '- The key ' . $key . ' must contain a value </br>';
                }
            }
        }
        return $error;
    }
    

    public function form_get_Production_balance() {
        $data = $this->main->page('backoffice','home');
        $extra_data = $this->data_loader->load_data('home');
        $data = array_merge($data, $extra_data);

        $error = $this->check_form_exception();
        if(!empty($error)) {
            $data['error'] = $error;
        }
        else {
            $date_rechercher = $this->input->post('search_date');
            $idcategorie = $this->input->post('product_category');
            $data['Production_balance'] = $this->production_balance->get_balance_production($date_rechercher,$idcategorie);
            $data['totals'] = $this->production_balance->get_totals_balance_production($date_rechercher,$idcategorie);
            $data['date_search'] = $date_rechercher;
        }
        $this->load->view('templates/template',$data);
    }
    

}