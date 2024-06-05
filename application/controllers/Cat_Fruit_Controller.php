<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_Fruit_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Data_Loader');
        $this->load->library('Cat_Fruit');
        $this->load->model('view_model', 'main');
    }


    public function form_Update_Cat_Fruit($id) {
        $data = $this->main->page('backoffice', 'CRUD');
        $data['cat_fruit_update'] = $this->cat_fruit->get_Fruit_By_Id($id);
        $extra_data = $this->data_loader->load_data('backoffice', 'CRUD');
        $data['ls_cat_prod'] = $extra_data['ls_cat_prod'];
        $data['ls_cat_fruits'] = $extra_data['ls_cat_fruits'];
        $this->load->view('templates/template', $data);
    }

    public function delete_Cat_Fruit($id) {
        $catFruitObject = new Cat_Fruit();
        $catFruitObject->set_Id($id);

        $catFruitObject->delete();
        redirect('index.php/View/page/backoffice/CRUD');
    }

    public function insert_Cat_Fruit() {
        $libelle = $this->input->get('cat_fruits_name');
        $catFruitObject = new Cat_Fruit();
        $catFruitObject->set_Libelle($libelle);
        if ($this->input->get('id_cat_fruits_to_update') != null) {
            $id_Ref = $this->input->get('id_cat_fruits_to_update');
            $catFruitObject->set_Id($id_Ref);
            $catFruitObject->add_Cat_Fruit();
            redirect('index.php/View/page/backoffice/CRUD');
        } else {
            $catFruitObject->add_Cat_Fruit();
            redirect('index.php/View/page/backoffice/CRUD');
        }
    }

}
?>
