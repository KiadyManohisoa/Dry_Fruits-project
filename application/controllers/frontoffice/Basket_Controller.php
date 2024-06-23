<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basket_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('frontoffice/Data_Loader', 'data_loader');
        $this->load->model('backoffice/view_model', 'main');
        $this->load->model('backoffice/Orders_Model');
        $this->load->library('backoffice/Basket', 'Basket');
        $this->load->library('session');
    }

    public function check_form_exception() {
        $postDatas = $this->input->post();
        $error = '';
        if($postDatas) {
            foreach ($postDatas as $key => $value) {
                if(($value == '' || str_contains($value, "Choose")) && $key != 'phone_number') {
                    $error .= '- The key ' . $key . ' must contain a value </br>';
                } else if ($value < 0 && $key != 'phone_number') {
                    $error .= '- The key ' . $key . ' can\'t be negative </br>';
                }
            }
        }

        if ($this->session->get('basket') == null || $this->session->get('basket')[0] == null) {
            $error .= "<h3>Your basket is empty.</h3> </br>";
        }

        return $error;
    }

    public function create_order() {
        $data = $this->main->page('frontoffice', 'bag');
        $extra_data = $this->data_loader->load_data('bag');
        $data = array_merge($data, $extra_data);
        $error = $this->check_form_exception();
        if(!empty($error)) {
            $data['error'] = $error;
            $this->load->view('templates/template', $data);
            return;
        } 
        if($this->session->get("id_client") != null) {
            
            $data = $this->main->page('frontoffice', 'confirm');
            $basket = $this->session->get('basket');

            // Récupérer les données pour la livraison et le paiement (à adapter selon votre formulaire)
            $delivery_data = array(
                'delivery_address' => $this->input->post('address') . ", " . $this->input->post('city') . " " . $this->input->post('post_code'),
                'cost' => $this->session->get("delivery_cost"), // Calculer le coût de la livraison
            );
    
            $payment_data = array(
                'mode' => $this->input->post('payment'),
                'phone_number' => $this->input->post('phone_number')
            );
    
            // Récupérer l'id_client, la réduction et le coût
            $id_client = $this->session->get("id_client");
            $reduction = 0; // Par exemple, définir une réduction par défaut
            $cost = $this->session->get("delivery_cost");

            // Créer la commande en utilisant le modèle
            $id_order = $this->Orders_Model->create_order($delivery_data, $payment_data, $id_client, $reduction, $cost);
    
            // Insérer les produits commandés dans products_ordered
            $this->Orders_Model->insert_products_ordered($basket, $id_order);
    
            // Vider le panier après la commande
            $this->session->unset('basket');
            $this->load->view('templates/template', $data);
        } else {
            redirect(site_url('frontoffice/View/page/login'));
        }
    }

    public function generatePDF($id_order) {
        if ($this->session->get("id_client")!=null) {
            $order_details = $this->basket->get_basket_link($id_order);
    
            $this->load->library('PDF', $order_details);
            $this->pdf->GeneratePDF();
            $this->pdf->Output('I', 'Order_Details.pdf');
        }        
    
    }
}
?>
