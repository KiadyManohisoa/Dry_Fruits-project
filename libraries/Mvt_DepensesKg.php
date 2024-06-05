<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mvt_DepensesKg
{
    private $CI;
    private $id;
    private $dateMvt;
    private $prix;
    private $id_1;

    public function __construct($id = null, $dateMvt = null, $prix = null, $id_1 = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Mvt_DepensesKg_model');

        $this->id = $id;
        $this->dateMvt = $dateMvt;
        $this->prix = $prix;
        $this->id_1 = $id_1;
    }

    // Getters
    public function get_Id()
    {
        return $this->id;
    }

    public function get_Date_Mvt()
    {
        return $this->dateMvt;
    }

    public function get_Prix()
    {
        return $this->prix;
    }

    public function get_Id1()
    {
        return $this->id_1;
    }

    // Setters
    public function set_Id($id)
    {
        $this->id = $id;
    }

    public function set_Date_Mvt($dateMvt)
    {
        $this->dateMvt = $dateMvt;
    }

    public function set_Prix($prix)
    {
        $this->prix = $prix;
    }

    public function set_Id1($id_1)
    {
        $this->id_1 = $id_1;
    }

    // CRUD Operations

    // Create
    public function insert()
    {
        $data = array(
            'dateMvt' => $this->dateMvt,
            'prix' => $this->prix,
            'id_1' => $this->id_1
        );
        return $this->CI->Mvt_DepensesKg_model->insert($data);
    }

    // Read by ID
    public function get_By_Id($id)
    {
        return $this->CI->Mvt_DepensesKg_model->get_by_id($id);
    }

    // Read all
    public function get_All()
    {
        return $this->CI->Mvt_DepensesKg_model->get_all();
    }

    // Update
    public function update()
    {
        $data = array(
            'dateMvt' => $this->dateMvt,
            'prix' => $this->prix,
            'id_1' => $this->id_1
        );
        return $this->CI->Mvt_DepensesKg_model->update($this->id, $data);
    }

    // Delete
    public function delete($id)
    {
        return $this->CI->Mvt_DepensesKg_model->delete($id);
    }
}
