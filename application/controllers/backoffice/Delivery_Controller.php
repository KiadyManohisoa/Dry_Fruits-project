<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backoffice/Data_Loader');
        $this->load->library('backoffice/Delivery');
        $this->load->library('backoffice/Basket', 'Basket');
        $this->load->model('backoffice/Delivery_Model', 'Delivery_Model');
        $this->load->model('backoffice/view_model', 'main');
    }

    public function validate_delivery($idDelivery)
    {
        $newData['status'] = 1;
        $this->delivery->update_delivery($idDelivery, $newData);
    }

    public function unvalidate_delivery($idDelivery)
    {
        $newData['status'] = 0;
        $this->delivery->update_delivery($idDelivery, $newData);
    }

    public function get_delivery()
    {
        $data = $this->main->page('backoffice', 'delivery');

        $date_rechercher = $this->input->post('date_rechercher');
        $extra_data = $this->data_loader->load_data('delivery');
        $data = array_merge($data, $extra_data);

        if ($date_rechercher != null && $date_rechercher != "") {
            $data['deliveries_management'] = $this->Delivery_Model->get_deliveries_management($date_rechercher);
        }
        else {
            $data['error'] = 'The date for delivery search cannot be empty';
        }

        $this->load->view('templates/template', $data);
    }

    public function basket_link($order_id)
    {
        $data = $this->main->page('backoffice', 'bag');
        $order_details = $this->basket->get_basket_link($order_id);

        if (!empty($order_details)) {
            $data2 = array_merge($data, ['order_details' => $order_details]);
        } else {
            $data2 = $data;
        }

        $this->load->view('templates/template', $data2);
    }
}
