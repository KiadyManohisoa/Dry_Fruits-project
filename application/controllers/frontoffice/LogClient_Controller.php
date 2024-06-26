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

    public function check_password() {
        $error = '';
        $psswd = $this->input->post('password');
        $confirm_psswd = $this->input->post('confirm_password');
        if($psswd!==$confirm_psswd) {
            $error = 'Please, make sure your passwords are correct';
        }
        return $error;
    }

    public function is_two_password_empty() {
        $answer = false;
        if(empty($this->input->post('password')) && empty($this->input->post('confirm_password'))) {
            $answer = true;
        }
        return $answer;
    }

    public function check_new_form_exception($key_not_to_check) {
        $postDatas = $this->input->post();
        $error = '';
        if($postDatas) {
            foreach ($postDatas as $key => $value) {
                if(!in_array($key,$key_not_to_check)) {
                    if($value=='') {
                        $error.= '- The key ' . $key . ' must contain a value </br>';
                    }
                }
            }
        }
        return $error;
    }

    public function upload_client_profile_pic(&$data_client) {
        $error = '';
        $id_client = $this->session->get('id_client'); 
        $upload_path = 'uploads/';
        $user_upload_path = 'uploads/user_profile/';
        $user_path = $user_upload_path . $id_client . '/';
    
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true); 
        }
        if (!is_dir($user_upload_path)) {
            mkdir($user_upload_path, 0777, true); 
        }
        if (!is_dir($user_path)) {
            mkdir($user_path, 0777, true); 
        }
    
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 5048;
        $config['max_width'] = 1920;
        $config['max_height'] = 1080;
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('user_profile_pic')) {
            
            $files = glob($user_path . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); 
                }
            }
            $upload_data = $this->upload->data();
            
            $file_ext = $upload_data['file_ext'];
            $new_file_name = 'profile_picture' . $file_ext;
            $new_file_path = $user_path . $new_file_name;
    
            if (rename($upload_data['full_path'], $new_file_path)) {
                $data_client['user_image'] = $new_file_path;
            } else {
                $error = 'Server error : Failed in renaming file';
            }
        } else {
            //$error = $this->upload->display_errors();
        }
    
        return $error;
    }
    

    public function update_client_info() {
        $data = $this->main->page('frontoffice', 'user');
        $extra_data = $this->data_loader->load_data('frontoffice', 'user');
        $data = array_merge($data, $extra_data);
        $key_not_to_check = array ('new_mail','user_profile_pic','password','confirm_password');
        $error = "";
        $error = $this->check_new_form_exception($key_not_to_check);
        $error.= $this->check_password();

        if(!empty($error)) {
            $data['error'] = $error;      
        }
        else {
            $id_client = $this->session->get('id_client');
            $data_client = array();
            $data_client['mail'] = $this->input->post('new_mail');
            $data_client['phone_number'] = $this->input->post('new_phone_number');
            $data_client['full_name'] = $this->input->post('new_full_name');
            if(!$this->is_two_password_empty()) {
                $data_client['password'] = $this->input->post('password');
            }
            $this->upload_client_profile_pic($data_client);
            $this->clients_account->update_client($id_client,$data_client);
        }

        $this->load->view('templates/template', $data);      
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
        $error.= $this->check_password();

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

    public function log_out (){
        $this->session->unset("id_client");
        $this->session->unset("basket");
        redirect('frontoffice/View/page');
    }


}