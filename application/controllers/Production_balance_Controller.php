<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_balance_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Data_Loader');
        $this->load->library('Production_balance');
        $this->load->model('view_model','main');
    }

    public function form_get_Production_balance() {
        $data = $this->main->page('backoffice','home');
        $date_rechercher = $this->input->get('date_rechercher');
        $idcategorie = $this->input->get('categorie');
        if($date_rechercher != "" && $idcategorie!= ""){
            $data['Production_balance'] = $this->production_balance->get_balance_production($date_rechercher,$idcategorie);
            $data['date_search'] = $date_rechercher;
        }
        $extra_data = $this->data_loader->load_data('backoffice', 'home');
        $data = array_merge($data, $extra_data);
        $this->load->view('templates/template',$data);
    }

}