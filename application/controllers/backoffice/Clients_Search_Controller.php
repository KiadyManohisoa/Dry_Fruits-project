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

        $data['clients'] = $this->clients_account->search_client_by_name($client_name);
        $extra_data = $this->data_loader->load_data('backoffice','home');
        $data = array_merge($data,$extra_data);
        $this->load->view('templates/template',$data);
    }

    // // Méthode pour afficher tous les clients
    // public function all_clients() {
    //     $data['clients'] = $this->clients_account->get_all_clients();
    //     $this->load->view('backoffice_all_clients', $data);
    // }

    // Méthode pour afficher les informations personnelles d'un client
    // public function client_info($id) {
    //     $data['client'] = $this->clients_account->get_client_by_id($id);
    //     $data['last_orders'] = $this->Orders_Model->last_client_orders($id, 3);
    //     $this->load->view('backoffice_client_info', $data);
    // }
}
?>
