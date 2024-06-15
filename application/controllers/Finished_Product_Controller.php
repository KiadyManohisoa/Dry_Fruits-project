<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finished_Product_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Data_Loader');
        $this->load->library('Product');
        $this->load->library('Stock');
        $this->load->library('Detail_movement');
        $this->load->library('Wholesale_movement');
        $this->load->library('Bulk_movement');
        $this->load->library('Charges_kg_movement');

        $this->load->model('view_model', 'main');
        $this->load->model('Product_Model','product_model');
    }

    public function form_update_finished_product($id_product,$id_detail,
    $id_wholesale,$id_bulk,$id_charges_kg) {
        
        $data = $this->main->page('backoffice', 'CRUD');
        $data['id_product_to_update'] = $id_product;
        // $data["stock_update"]=$this->stock->get_stock_by_id($id_stock);
        $data["wholesale_update"]=$this->wholesale_movement->get_wholesale_movement_by_id($id_wholesale);
        $data["detail_update"]=$this->detail_movement->get_detail_movement_by_id($id_detail);
        $data["bulk_update"]=$this->bulk_movement->get_bulk_movement_by_id($id_bulk);
        $data["charges_update"]=$this->charges_kg_movement->get_charges_movement_by_id($id_charges_kg);
        $data['update_finished_product']=1;
        $extra_data = $this->data_loader->load_data('backoffice', 'CRUD');
        $data = array_merge($data, $extra_data);

        $this->load->view('templates/template', $data);
    }

    public function delete_finished_product($id_product) {
       $this->product->delete_product($id_product); 
        redirect('index.php/View/page/backoffice/CRUD');
    }

    // public function delete_finished_product($id_detail,
    // $id_wholesale,$id_bulk,$id_charges_kg) {
    //     // echo $id_stock;
    //     // $this->stock->delete_stock($id_stock);
    //     $this->detail_movement->delete_detail_movement($id_detail);
    //     $this->wholesale_movement->delete_wholesale_movement($id_wholesale);
    //     $this->bulk_movement->delete_bulk_movement($id_bulk);
    //     $this->charges_kg_movement->delete_charges_movement($id_charges_kg);

    //     redirect('index.php/View/page/backoffice/CRUD');
    // }

    public function insert_finished_product() {
        $data_product = array();

        $stock = $this->input->post('stock');
        $charges_by_kg = $this->input->post('charges_by_kg');
        $detail_price = $this->input->post('detail_price');
        $detail_reduction = $this->input->post('detail_reduction');
        $wholesale_price = $this->input->post('wholesale_price');
        $wholesale_reduction = $this->input->post('wholesale_reduction');
        $bulk_price = $this->input->post('bulk_price');
        $bulk_reduction = $this->input->post('bulk_reduction');
       

        if ($this->input->post('update_mode') == 1) {
        echo "mandeha update";
        
        $id_product_to_update=$this->input->post('id_product_to_update');
        echo 'id product to update : '.$id_product_to_update;
    
        if ($stock>0) {
            $data_stock['id_product']= $id_product_to_update;
            $data_stock['quantity_kg']= $stock;
            $this->stock->add_stock($data_stock);
            $this->product_model->update_stock();
        }

        
        $data_charges['price']=$charges_by_kg;
        $data_charges['id_product']=$id_product_to_update;
        $this->charges_kg_movement->add_charges_movement($data_charges);
        
        $data_detail['price']=$detail_price;
        $data_detail['reduction']=$detail_reduction;
        $data_detail['id_product']=$id_product_to_update;
        $this->detail_movement->add_detail_movement($data_detail);
        
        
        $data_wholesale['price']=$wholesale_price;
        $data_wholesale['reduction']=$wholesale_reduction;
        $data_wholesale['id_product']=$id_product_to_update;
        $this->wholesale_movement->add_wholesale_movement($data_wholesale);
        

        
        $data_bulk['price']=$bulk_price;
        $data_bulk['reduction']=$bulk_reduction;
        $data_bulk['id_product']=$id_product_to_update;
        $this->bulk_movement->add_bulk_movement($data_bulk);
        

          redirect('index.php/View/page/backoffice/CRUD');
        
        } else {

        echo "mandeha insert";
        $id_cat_fruits = $this->input->post('id_cat_fruits');
        $id_cat_produits = $this->input->post('id_cat_produits');
        $description = $this->input->post('description');
        
            $now=date("Y-m-d H:i:s");


            $data_product['id_cat_fruit'] = $id_cat_fruits;
            $data_product['id_cat_product'] = $id_cat_produits;
            $data_product['description'] = $description;

            var_dump($data_product);

            $exist = $this->product->get_by_criteria($id_cat_fruits, $id_cat_produits);

            if ($exist == null) {

                $upload_path = './uploads/';
                 if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true); // Crée le répertoire avec les permissions appropriées
                }

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 5048;
                 $config['max_width'] = 1921;
                $config['max_height'] = 1081;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('pictures_details')) {

                        $uploadData = $this->upload->data();
                    
                        $timestamp = round(microtime(true) * 1000);
                        $file_ext = $uploadData['file_ext'];
                        $new_file_name = $timestamp . $file_ext;
                    
                        $new_path = './uploads_pictures/';
                    
                        if (!is_dir($new_path)) {
                            mkdir($new_path, 0777, true); // Crée le répertoire avec les permissions appropriées
                        }
                    
                        $new_file_path = $new_path . $new_file_name;

                        rename($uploadData['full_path'], $new_file_path);
                    
                        $data_product['image_link'] = $new_file_path;
                    
                    } else {
                        $error = $this->upload->display_errors();
                        echo $error;
                        return;
                    }

                $this->product->add_product($data_product);
                $exist = $this->product->get_by_criteria($id_cat_fruits, $id_cat_produits);
            }

            $id_product = $exist['id_product'];

            $this->product->reinsert_product($id_product);
            $data_charges_by_kg = [
                "id_product" => $id_product,
                "price" => $charges_by_kg
            ];

            $this->charges_kg_movement->add_charges_movement($data_charges_by_kg);

            $data_detail = [
                'id_product' => $id_product,
                'price' => $detail_price,
                'reduction' => $detail_reduction
            ];

            $this->detail_movement->add_detail_movement($data_detail);

            $data_wholesale = [
                'id_product' => $id_product,
                'price' => $wholesale_price,
                'reduction' => $wholesale_reduction
            ];

            $this->wholesale_movement->add_wholesale_movement($data_wholesale);

            $data_bulk = [
                'id_product' => $id_product,
                'price' => $bulk_price,
                'reduction' => $bulk_reduction
            ];

            $this->bulk_movement->add_bulk_movement($data_bulk);

            $data_stock = [
                'id_product' => $id_product,
                'quantity_kg' => $stock
            ];

            $this->stock->add_stock($data_stock);
            $this->product_model->update_stock();

             redirect('index.php/View/page/backoffice/CRUD');
        }
    }
}
?>
