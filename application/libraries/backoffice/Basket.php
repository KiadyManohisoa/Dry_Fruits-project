<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Basket
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('backoffice/Basket_Model', 'Basket_Model');
    }

    public function get_basket_link($id_order)
    {
        return $this->CI->Basket_Model->get_basket_link($id_order);
    }
}
