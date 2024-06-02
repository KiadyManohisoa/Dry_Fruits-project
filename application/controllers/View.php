<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {
    
// GENERAL 
    public function __construct() {
        parent::__construct();
        $this->load->model('view_model','main');
    }
    public function page($application = 'frontoffice',$section = 'home') {
        $data = $this->main->page($application,$section);
        $this->load->view('templates/template', $data);
    }
}
?>
