<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogClient_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Clients_account');
        $this->load->library('frontoffice/Data_Loader');
        $this->load->library('Session');
        $this->load->model('backoffice/view_model', 'main');
    }

    public function check_form_exception() {
        $postDatas = $this->input->post();
        $error = '';
        if($postDatas) {
            foreach ($postDatas as $key => $value) {
                if($key!='mail' && ($value=='' || str_contains($value,"Choose"))) {
                    $error.= '- The key ' . $key . ' must contain a value </br>';
                }
            }
        }
        return $error;
    }

    public function checkPassword() {
        $error = '';
        $psswd = $this->input->post('password');
        $confirm_psswd = $this->input->post('confirm_password');
        if($psswd!==$confirm_psswd) {
            $error = 'Verify your password';
        }
        return $error;
    }

    public function sign_up() {
        $data = $this->main->page('frontoffice', 'login');
        $extra_data = $this->data_loader->load_data('frontoffice', 'login');
        $data = array_merge($data, $extra_data);

        $full_name = $this->input->post('full_name');    
        $mail = $this->input->post('mail');
        $phone_number = $this->input->post('phone_number');    
        $psswd = $this->input->post('password');
        $confirm_psswd = $this->input->post('confirm_password');
        $error = $this->check_form_exception();
        $error.= $this->checkPassword();

        if(!empty($error)) {
            $data['error'] = $error;      
            $this->load->view('templates/template', $data);      
        }
        else {
            $new_client = new Clients_account(null,$full_name,$mail,$psswd,$phone_number,null,null,null);
            $new_client->add_client();
            redirect('index.php/frontoffice/View/page/login');
        }
        $this->load->view('templates/template', $data);
    }

    public function authenticate() {
        $data = $this->main->page('frontoffice', 'login');
        $extra_data = $this->data_loader->load_data('frontoffice', 'login');
        $data = array_merge($data, $extra_data);

        $user = $this->input->post('user');
        $user_password = $this->input->post('user_password');
        $response = $this->clients_account->login($user,$user_password);
        if($response!=false) {
            $this->session->set('id_client',$response);
            redirect('index.php/frontoffice/View/page/home');
        }
        else {
            $data['error'] = "Authentication failed </br>Verify your username and password";
            $this->load->view('templates/template', $data);
        }
    }

}