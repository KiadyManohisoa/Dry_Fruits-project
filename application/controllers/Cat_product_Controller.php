<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_product_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Data_Loader');
        $this->load->library('Cat_product');
        $this->load->model('view_model','main');
    }

    public function form_update_cat_product($id) {
        $data = $this->main->page('backoffice','CRUD');
        $data['cat_product_update'] = $this->cat_product->get_product_by_id($id);
        $extra_data = $this->data_loader->load_data('backoffice', 'CRUD');
        $data = array_merge($data, $extra_data);
        $this->load->view('templates/template',$data);
    }

    public function delete_cat_product($id) {
        $this->cat_product->delete_product($id);
        redirect('index.php/View/page/backoffice/CRUD');
    }

    public function insert_cat_product() {
        $data= array();
        $name = $this->input->get('cat_product_name');
        if($this->input->get('id_cat_product_to_update')!=null) {
            $id_Ref=$this->input->get('id_cat_product_to_update');
            $data['wording'] = $name;
            $this->cat_product->update_product($id_Ref,$data);
            redirect('index.php/View/page/backoffice/CRUD');
        }
        else {
            $data['wording'] = $name;
            $this->cat_product->add_product($data);
            redirect('index.php/View/page/backoffice/CRUD');
        }
    }

}