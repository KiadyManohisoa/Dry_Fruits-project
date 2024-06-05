<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produit
{
    private $CI;
    public $id;
    public $image_link;
    public $description;
    public $creation_date;
    public $id_1;
    public $id_2;

    public function __construct($id = null, $image_link = null, $description = null, $creation_date = null, $id_1 = null, $id_2 = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Produit_Model');

        $this->id = $id;
        $this->image_link = $image_link;
        $this->description = $description;
        $this->creation_date = $creation_date;
        $this->id_1 = $id_1;
        $this->id_2 = $id_2;
    }

    // Getter and Setter for id
    public function get_Id()
    {
        return $this->id;
    }

    public function set_Id($id)
    {
        $this->id = $id;
    }

    // Getter and Setter for image_link
    public function get_Image_Link()
    {
        return $this->image_link;
    }

    public function set_Image_Link($image_link)
    {
        $this->image_link = $image_link;
    }

    // Getter and Setter for description
    public function get_Description()
    {
        return $this->description;
    }

    public function set_Description($description)
    {
        $this->description = $description;
    }

    // Getter and Setter for creation_date
    public function get_Creation_Date()
    {
        return $this->creation_date;
    }

    public function set_Creation_Date($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    // Getter and Setter for id_1
    public function get_Id1()
    {
        return $this->id_1;
    }

    public function set_Id1($id_1)
    {
        $this->id_1 = $id_1;
    }

    // Getter and Setter for id_2
    public function get_Id2()
    {
        return $this->id_2;
    }

    public function set_Id2($id_2)
    {
        $this->id_2 = $id_2;
    }

    // Method to insert a new product
    public function insert()
    {
        //$this->creation_date = date('Y-m-d H:i:s');

        $data = array(
            'lienimage' => $this->image_link,
            'description' => $this->description,
            'datecreation' => $this->creation_date,
            'id_1' => $this->id_1,
            'id_2' => $this->id_2
        );

        return $this->CI->Produit_Model->insert($data);
    }

    // Method to update an existing product
    public function update()
    {
        $data = array(
            'lienimage' => $this->image_link,
            'description' => $this->description,
            'datecreation' => $this->creation_date,
            'id_1' => $this->id_1,
            'id_2' => $this->id_2
        );

        return $this->CI->Produit_Model->update($this->id, $data);
    }

    // Method to delete a product
    public function delete()
    {
        return $this->CI->Produit_Model->delete($this->id);
    }

    // Method to get a product by ID
    public function get_By_Id($id)
    {
        $product = $this->CI->Produit_Model->get_by_id($id);
        if ($product) {
            $this->id = $product->id;
            $this->image_link = $product->lienimage;
            $this->description = $product->description;
            $this->creation_date = $product->datecreation;
            $this->id_1 = $product->id_1;
            $this->id_2 = $product->id_2;
        }
        return $product;
    }

    // Method to get all products
    public function get_All()
    {
        return $this->CI->Produit_Model->get_all();
    }

    //Configuration Product
    public function product_configuration()
    {
        return $this->CI->Produit_Model->product_configuration();
    }
}
