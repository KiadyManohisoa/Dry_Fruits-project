<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock
{
    public $id;
    public $dateRenouvellement;
    public $qttKg;
    public $id_1;
    protected $CI;

    public function __construct($id = null, $dateRenouvellement = null, $qttKg = null, $id_1 = null)
    {
        // Récupérer l'instance de l'objet CodeIgniter
        $this->CI = &get_instance();
        $this->CI->load->model('Stock_model');

        $this->id = $id;
        $this->dateRenouvellement = $dateRenouvellement;
        $this->qttKg = $qttKg;
        $this->id_1 = $id_1;
    }

    // Getters
    public function get_id()
    {
        return $this->id;
    }

    public function get_dateRenouvellement()
    {
        return $this->dateRenouvellement;
    }

    public function get_qttKg()
    {
        return $this->qttKg;
    }

    public function get_id_1()
    {
        return $this->id_1;
    }

    // Setters
    public function set_id($id)
    {
        $this->id = $id;
    }

    public function set_dateRenouvellement($dateRenouvellement)
    {
        $this->dateRenouvellement = $dateRenouvellement;
    }

    public function set_qttKg($qttKg)
    {
        $this->qttKg = $qttKg;
    }

    public function set_id_1($id_1)
    {
        $this->id_1 = $id_1;
    }

    // CRUD Operations

    // Create
    public function add_Stock()
    {
        //$this->dateRenouvellement = date('Y-m-d H:i:s');
        $data = array(
            'daterenouvellement' => $this->dateRenouvellement,
            'qttkg' => $this->qttKg,
            'id_1' => $this->id_1
        );
        return $this->CI->Stock_model->insert_stock($data);
    }

    // Read all
    public function get_All_Stock()
    {
        return $this->CI->Stock_model->get_all_stock();
    }

    // Read by ID
    public function get_Stock_By_Id($id)
    {
        return $this->CI->Stock_model->get_stock_by_id($id);
    }

    // Update
    public function update_Stock()
    {
        $data = array(
            'dateRenouvellement' => $this->dateRenouvellement,
            'qttKg' => $this->qttKg,
            'id_1' => $this->id_1
        );
        return $this->CI->Stock_model->update_stock($this->id, $data);
    }

    // Delete
    public function delete_Stock($id)
    {
        return $this->CI->Stock_model->delete_stock($id);
    }
}
