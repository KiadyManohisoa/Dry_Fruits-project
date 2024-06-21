<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Default_controller extends CI_Controller {

    public function index() {
        redirect('frontoffice/View/page');
    }
}
