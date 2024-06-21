<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_Search_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Data_Loader','data_loader');
        $this->load->library('backoffice/Clients_account','clients_account');
        $this->load->library('backoffice/Orders','orders');
        $this->load->model('backoffice/view_model','main');
    }

    public function search() {
        $data = $this->main->page('backoffice','home');
        $client_name = $this->input->post('client_name');

        if(empty($client_name)) {
            $extra_data = $this->data_loader->load_data('home');
            $data = array_merge($data,$extra_data);
            $data['error'] = 'The client name cannot be empty';
            $this->load->view('templates/template',$data);
            return;
        }

        $extra_data = $this->data_loader->load_data('home');
        $extra_data['clients'] = $this->clients_account->search_client_by_name($client_name);
        $data = array_merge($data,$extra_data);
        $this->load->view('templates/template',$data);
    }

    // Méthode pour afficher les informations personnelles d'un client
    public function client_info($idClient) {
        $data = $this->main->page('backoffice','client');
        $data['client'] = $this->clients_account->get_client_by_id($idClient);
        $data['last_orders'] = $this->orders->last_client_orders($idClient, 3);
        $this->load->view('templates/template', $data);
    }
}
?>
