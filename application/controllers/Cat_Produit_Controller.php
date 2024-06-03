<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_Produit_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Cat_Produit');
        $this->load->model('view_model','main');
    }

    // public function ls_Cat_Produit() {
    //     return $this->cat_produit->get_All_Cat_Produits();
    // }

    public function form_Update_Cat_Produit($id) {
        $data = $this->main->page('backoffice','CRUD');
        $data['cat_produit_update'] = $this->cat_produit->get_Cat_Produit_By_Id($id);
        $data['ls_cat_prod'] = $this->cat_produit->get_All_Cat_Produits();
        $this->load->view('templates/template',$data);
    }

    public function delete_Cat_Produit($id) {
        $this->cat_produit->delete_Cat_Produit($id);
        redirect('index.php/View/page/backoffice/CRUD');
    }

    public function insert_Cat_Produit() {
        $libelle = $this->input->get('cat_product_name');
        if($this->input->get('id_cat_product_to_update')!=null) {
            $id_Ref=$this->input->get('id_cat_product_to_update');
            $this->cat_produit->update_Cat_Produit($id_Ref,$libelle);
            redirect('index.php/View/page/backoffice/CRUD');
        }
        else {
            $this->cat_produit->add_Cat_Produit($libelle);
            redirect('index.php/View/page/backoffice/CRUD');
        }
    }

}