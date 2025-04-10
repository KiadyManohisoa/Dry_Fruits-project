<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {
    
// GENERAL 
    public function __construct() {
        parent::__construct();
        $this->load->model('backoffice/view_model','main');
        $this->load->library('backoffice/Data_Loader','data_loader');
        $this->load->library('Session','session');
    }

    public function page($section = 'login') {
        if($this->session->get('admin_status')==null) {
            $section='login';
        }
        $application = 'backoffice';
        $data = $this->main->page($application,$section);
        $extra_data = $this->data_loader->load_data($section);
        $data = array_merge($data,$extra_data);
        $this->load->view('templates/template', $data);
    }
}
?>
