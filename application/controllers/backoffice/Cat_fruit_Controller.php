<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_fruit_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Data_Loader','data_loader');
        $this->load->library('backoffice/Cat_fruit','cat_fruit');
        $this->load->model('backoffice/view_model', 'main');
    }

    public function form_update_cat_fruit($id) {
        $data = $this->main->page('backoffice', 'CRUD');
        $data['cat_fruit_update'] = $this->cat_fruit->get_fruit_by_id($id);
        $extra_data = $this->data_loader->load_data('CRUD');
        $data = array_merge($data, $extra_data);
        $this->load->view('templates/template', $data);
    }

    public function delete_cat_fruit($id) {
        $this->cat_fruit->delete_fruit($id);
        redirect('backoffice/View/page/CRUD');
    }

    public function insert_cat_fruit() {
        $data = array();
        $name = $this->input->get('cat_fruits_name');
        if ($name==null || $name == "") {
            $data = $this->main->page('backoffice','CRUD');
            $data['error'] = 'You should put a name on the fruit input';
            $extra_data = $this->data_loader->load_data('CRUD');
            $data = array_merge($data, $extra_data);
            $this->load->view('templates/template', $data);
        } else {
            if ($this->input->get('id_cat_fruits_to_update') != null) {
                $id_Ref=$this->input->get('id_cat_fruits_to_update');
                $data['wording'] = $name;
                $this->cat_fruit->update_fruit($id_Ref,$data);
                redirect('backoffice/View/page/CRUD');
            } else {
                $data['wording'] = $name;
                $this->cat_fruit->add_fruit($data);                
                redirect('backoffice/View/page/CRUD');

            }
        }
    }

}
?>
