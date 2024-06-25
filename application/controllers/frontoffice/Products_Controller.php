<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('frontoffice/Data_Loader','data_loader');
        $this->load->library('backoffice/Product','product');
        $this->load->model('backoffice/view_model', 'main');
        $this->load->model('backoffice/Product_Model','product_model');
        $this->load->library('frontoffice/Client_products_review','client_products_review');
        $this->load->library('frontoffice/Client_services_review','client_services_review');
        $this->load->model('frontoffice/Client_products_review_model','client_products_review_model');
        $this->load->library('frontoffice/Client_favorite_products','client_favorite_products');
        $this->load->model('frontoffice/Client_favorite_products_model','client_favorite_products_model');
        $this->load->library('Session','session');
    }

    public function check_form_exception() {
        $postDatas = $this->input->post();
        $error = '';
        if($postDatas) {
            foreach ($postDatas as $key => $value) {
                if($value=='' || str_contains($value,"Choose")) {
                    $error.= '- The key ' . $key . ' must contain a value </br>';
                }
                else if ($value < 0) {
                    $error.= '- The key ' . $key . ' can`\'t be negative </br>';
                }
            }
        }
        return $error;
    }

    public function check_interval () {
        $error = '';
        if($this->input->post('minimum_price')>$this->input->post('maximum_price')) {
            $error.= 'Verify your search interval';
        }
        return $error;
    }

    public function products_search() {
        $data = $this->main->page('frontoffice','search');
        if ($this->session->get("id_client")!=null) {
            $data['client_favoris'] = array();
            $clients_favorites_prod=$this->client_favorite_products_model->get_favorites_with_latest_movement($this->session->get("id_client"));
            if(!empty($clients_favorites_prod)) {
                $data['favoris_products'] = $clients_favorites_prod;
                for($i=0;$i<count($clients_favorites_prod);$i++) {
                    $data['client_favoris'][] = $clients_favorites_prod[$i]['product_id'];
                }
            }
        }
        $extra_data = $this->data_loader->load_data('search');
        $data = array_merge($data,$extra_data);
        $error = $this->check_form_exception();
        $error.= $this->check_interval();
        if(!empty($error)) {
            $data['products'] = $this->product_model->get_all_products_by_price_range(0, 0);
            $data['error'] = $error;
        } else {
            $minimum_price=$this->input->post('minimum_price');
            $maximum_price=$this->input->post('maximum_price');
            $data['products'] = $this->product_model->get_all_products_by_price_range($minimum_price, $maximum_price);
        }
        $this->load->view('templates/template', $data);
    }

    public function delete_products_favoris($id_product) {
        $data = array();
        if ($this->session->get("id_client")!=null) {
            $id_client = $this->session->get("id_client");
            $this->client_favorite_products->delete_favorite($id_client,$id_product);
        } else {
            $data['error'] = 'No client, you should log in';
            echo json_encode($data);
        }
    }

    public function add_products_favoris($id_product) {
        $data = array();
        if ($this->session->get("id_client")!=null) {
            $data_fav['id_client'] = $this->session->get("id_client");
            $data_fav['id_product'] = $id_product;
            $this->client_favorite_products->add_favorite($data_fav);
        } else {
            $data['error'] = 'No client, you should log in';
            echo json_encode($data);
        }
    }

    public function get_product_by_id($id_product,$err_data=null) {
        $data = $this->main->page('frontoffice','home');
        $extra_data = $this->data_loader->load_data('home');
        $data['product'] = $this->product_model->get_product_by_id($id_product);
        $data['reviews'] = $this->client_products_review->get_review_by_id_product($id_product);
        $data['review_pourcentage'] = $this->client_products_review_model->get_stars_pourcentage($id_product);
        $data = array_merge($data,$extra_data);
        if(!empty($err_data) || $err_data!=null) {
            $data['error'] = $err_data;
        }
        $this->load->view('templates/template', $data);
    }

    public function add_services_review() {
        if ($this->session->get("id_client")!=null) {
            $data_insert = array();
            $data_insert['id_client'] = $this->session->get("id_client");
            $data_insert['stars'] = $this->input->post('stars')!=null ? $this->input->post('stars') : 0;
            $data_insert['comment'] = $this->input->post('comment');
            
            $data = $this->main->page('frontoffice','user');

            if(!$this->client_services_review->add_services_review($data_insert)){
                $data['error'] = 'You should have at least already ordered before giving your review';
            }

            $extra_data = $this->data_loader->load_data('user');
            $data = array_merge($data,$extra_data);
            $this->load->view('templates/template', $data);
        } else {
            redirect(site_url('frontoffice/View/page/login'));
        }
    }

    public function add_products_review($id_product) {
        if ($this->session->get("id_client")!=null) {
            $id_client = $this->session->get("id_client");
            $stars = $this->input->post('stars')!=null ? $this->input->post('stars') : 0;
            $comment = $this->input->post('comment');
            $answer = $this->client_products_review->add_client_product_review($id_client, $stars, $comment, $id_product);
            $error = null;
            if(!$answer) {
                $error = 'You should have at least already ordered before giving your review';
            }
            $this->get_product_by_id($id_product,$error);
        } else {
            redirect(site_url('frontoffice/View/page/login'));
        }
    }

    public function add_products_to_basket($id_product, $type, $quantity_product = 1) {
        // $this->session->destroy();
        $basket = $this->session->get('basket');
        if ($basket == null) {
            $basket = [];
        }
    
        for ($i = 0; $i < count($basket); $i++) {
            if ($basket[$i]['id_product'] == $id_product && $basket[$i]['type'] == $type) {
                $new_quantity = $basket[$i]['quantity_product'] + $quantity_product;
                if ($quantity_product == 0 || $new_quantity <= 0) {
                    array_splice($basket, $i, 1); // Remove the product from the basket
                    return;
                } if ($basket[$i]['type'] == "B" && $new_quantity < 10) {
                    $data['error'] = "Something went wrong, the type of sale Bulk should contain more than 10 kg";
                    echo json_encode($data);
                    return;
                } else if ($basket[$i]['type'] == "W" && $new_quantity < 10) {
                    $data['error'] = "Something went wrong, the type of sale Wholesale should contain more than 10 packs";
                    echo json_encode($data);
                    return;
                } else {
                    $basket[$i]['quantity_product'] = $new_quantity;
                }
                $this->session->set('basket', $basket);
                return;
            }
        }
    
        if ($quantity_product > 0) {
            $type_sales = '';
            if ($type == "B") {
                $type_sales = 'Bulk';
                $quantity_product = 10;
            } else if ($type == "W") {
                $type_sales = 'Wholesale';
                $quantity_product = 10;
            } else if ($type == "D") {
                $type_sales = 'Detail';
            } else {
                $data['error'] = "Something went wrong, the type of sales should have been B, W, or D";
                echo json_encode($data);
                return;
            }
    
            $basket[] = array(
                'id_product' => $id_product,
                'type' => $type,
                'quantity_product' => $quantity_product,
                'type_sales' => $type_sales
            );
            $this->session->set('basket', $basket);
        }
    }
    
    
}

?>
