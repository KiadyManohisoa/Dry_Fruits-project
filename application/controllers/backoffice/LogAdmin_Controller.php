<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogAdmin_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Administrator');
        $this->load->model('backoffice/view_model', 'main');
    }

    public function authenticate() {
        $pseudo_name = $this->input->post('user_name');
        $password = $this->input->post('user_psswd');
        $response = $this->administrator->login($pseudo_name,$password);
        if($response==true) {
            redirect('backoffice/View/page/home');
        }
        else {
            $data = $this->main->page('backoffice', 'login');
            $data['error'] = "Authentication failed </br>Verify your username and password";
            $this->load->view('templates/template', $data);
        }
    }


}
