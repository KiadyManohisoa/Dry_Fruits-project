<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_Produit_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Data_Loader');
        $this->load->library('Cat_Produit');
        $this->load->model('view_model','main');
    }

    public function form_Update_Cat_Produit($id) {
        $data = $this->main->page('backoffice','CRUD');
        $data['cat_produit_update'] = $this->cat_produit->get_Produit_By_Id($id);
        $extra_data = $this->data_loader->load_data('backoffice', 'CRUD');
        $data['ls_cat_prod'] = $extra_data['ls_cat_prod'];
        $data['ls_cat_fruits'] = $extra_data['ls_cat_fruits'];
        $this->load->view('templates/template',$data);
    }

    public function delete_Cat_Produit($id) {
        $this->cat_produit->delete_Produit($id);
        redirect('index.php/View/page/backoffice/CRUD');
    }

    public function insert_Cat_Produit() {
        $libelle = $this->input->get('cat_product_name');
        $cat_produit_object = new Cat_Produit();
        $cat_produit_object->set_Libelle($libelle);
        if($this->input->get('id_cat_product_to_update')!=null) {
            $id_Ref=$this->input->get('id_cat_product_to_update');
            $cat_produit_object->set_Id($id_Ref);
            $cat_produit_object->update_Produit();
            redirect('index.php/View/page/backoffice/CRUD');
        }
        else {
            $cat_produit_object->add_Produit();
            redirect('index.php/View/page/backoffice/CRUD');
        }
    }

}