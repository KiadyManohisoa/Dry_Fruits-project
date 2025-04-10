<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_product_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Data_Loader','data_loader');
        $this->load->library('backoffice/Cat_product','cat_product');
        $this->load->model('backoffice/view_model','main');
    }

    public function form_update_cat_product($id) {
        $data = $this->main->page('backoffice','CRUD');
        $data['cat_product_update'] = $this->cat_product->get_product_by_id($id);
        $extra_data = $this->data_loader->load_data('CRUD');
        $data = array_merge($data, $extra_data);
        $this->load->view('templates/template',$data);
    }

    public function delete_cat_product($id) {
        $this->cat_product->delete_product($id);
        redirect('backoffice/View/page/CRUD');
    }

    public function insert_cat_product() {
        $data= array();
        $name = $this->input->get('cat_product_name');
        if ($name==null || $name == "") {
            $data = $this->main->page('backoffice','CRUD');
            $data['error'] = 'You should put a name on the category product input';
            $extra_data = $this->data_loader->load_data('CRUD');
            $data = array_merge($data, $extra_data);
            $this->load->view('templates/template', $data);
        } else {
            if($this->input->get('id_cat_product_to_update')!=null) {
                $id_Ref=$this->input->get('id_cat_product_to_update');
                $data['wording'] = $name;
                $this->cat_product->update_product($id_Ref,$data);
                redirect('backoffice/View/page/CRUD');
            }
            else {
                $data['wording'] = $name;
                $this->cat_product->add_product($data);
                redirect('backoffice/View/page/CRUD');
            }
        }
    }

}