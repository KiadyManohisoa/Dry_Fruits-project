<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogAdmin_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Administrator');
        $this->load->model('backoffice/view_model', 'main');
        $this->load->library('session');
    }

    public function authenticate() {
        $pseudo_name = $this->input->post('user_name');
            $this->session->unset("admin_status");
            $password = $this->input->post('user_psswd');
        $response = $this->administrator->login($pseudo_name,$password);
        if($response!='') {
            $this->session->set("admin_status",$response);
            if ($response=='A') {
                redirect('backoffice/View/page/home');
            } else {
                redirect('backoffice/View/page/delivery');
            }
        }
        else {
            $data = $this->main->page('backoffice', 'login');
            $data['error'] = "Authentication failed </br>Verify your username and password";
            $this->load->view('templates/template', $data);
        }
    }

    public function log_out (){
        $this->session->unset("admin_status");
        redirect('backoffice/View/page');
    }


}
