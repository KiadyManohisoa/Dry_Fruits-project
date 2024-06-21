<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_services_review
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('frontoffice/Client_services_review_Model', 'reviewModel');
    }

    public function add_services_review($data)
    {
        return $this->CI->reviewModel->create_review($data);
    }

    public function get_services_review($id_service_review)
    {
        return $this->CI->reviewModel->get_review($id_service_review);
    }

    public function update_services_review($id_service_review, $data)
    {
        return $this->CI->reviewModel->update_services_review($id_service_review, $data);
    }

    public function delete_services_review($id_service_review)
    {
        return $this->CI->reviewModel->delete_review($id_service_review);
    }
}