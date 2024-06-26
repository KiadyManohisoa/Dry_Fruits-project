<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('product')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('product', array('id_product' => $id))->row_array();
    }

    public function get_product_by_id($id)
    {
        return $this->db->get_where('v_product_configuration', array('product_id' => $id))->row_array();
    }

    public function get_by_criteria($id_cat_fruit,$_id_cat_product){
        
        return $this->db->get_where('product', array('id_cat_product' => $_id_cat_product,'id_cat_fruit' => $id_cat_fruit))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('product', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function delete($id)
    {
        $data['status'] = 0;
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function reinsert($id)
    {
        $data['status'] = 1;
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function get_product_categories()
    {
        return $this->db->get('v_product_categories')->result_array();
    }

    public function get_product_configuration()
    {
        return $this->db->get('v_product_configuration')->result_array();
    }

    public function update_stock()
    {
        return $this->db->get('v_product_stock')->result_array();
    }

    public function get_product_by_category($category)
    {
        $this->db->where('product_category', $category);
        $query = $this->db->get('v_product_configuration');
        if (count($query->result_array())>0) {
            return $query->result_array();
        }
        return [];
    }

    public function get_products_by_price_range($category, $min, $max) {
        $this->db->where("product_category", $category);
        if ($min>0 || $max>0) {
            $this->db->group_start();
            $this->db->group_start();
            if ($min > 0) {
                $this->db->where("detail_price >=", $min);
            }
            if ($max > 0) {
                $this->db->where("detail_price <=", $max);
            }
            $this->db->group_end();
            $this->db->group_end();
        }

        $query = $this->db->get('v_product_configuration');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return [];
    }

    public function get_all_products_by_category()
    {
        $categories = $this->db->get('cat_product')->result_array();
        $products_categorized = array();

        foreach ($categories as $category) {
            $products_categorized[$category['wording']] = $this->get_product_by_category($category['wording']);
        }

        return $products_categorized;
    }

    public function get_all_products_by_price_range($min,$max)
    {
        $categories = $this->db->get('cat_product')->result_array();
        $products_categorized = [];

        foreach ($categories as $category) {
            $products_categorized[$category['wording']] = $this->get_products_by_price_range($category['wording'],$min,$max);
        }

        return $products_categorized;
    }

    public function get_new_products (){
        $sql = 'SELECT * from v_product_configuration order by product_creation_date DESC limit 10';
		$query = $this->db->query($sql) ; 
		return $query->result_array();
    }

    public function get_reduce_products (){
        $sql = 'SELECT * from v_product_configuration where detail_reduction > 0 order by date_detail_movement DESC limit 3';
		$query = $this->db->query($sql) ; 
		return $query->result_array();
    }

    // return id most saled product , apres manao get_by_id 
	public function get_most_saled_product(){
		$sql = 'select vpc.* from (select id_product, sum(quantity) as sum_quantity from v_sales group by id_product order by sum_quantity desc limit 10) sales join v_product_configuration vpc on sales.id_product = vpc.product_id';
		$query = $this->db->query($sql) ; 
		return $query->result_array();
	}

    public function get_basket($basket) {
        $basket_return = [];
        $total = 0;
        foreach ($basket as $product) {
            // Préparer la requête SQL en utilisant des bindings pour éviter les injections SQL
            $sql = "SELECT * FROM v_product_configuration WHERE product_id = ?";
            $query = $this->db->query($sql, array($product['id_product']));
            $new_product = $query->row_array(); // Utiliser row_array() pour obtenir un tableau associatif
    
            if ($new_product) { // Vérifier si le produit existe
                $new_product['type_sales'] = $product['type_sales'];
    
                if ($product['type'] == "B") {
                    $new_product['reduction'] = $new_product['bulk_reduction'];
                    $new_product["unit_product_price"] = $new_product["bulk_price"];
                    $new_product["reduction_product"] = $new_product["unit_product_price"] - ($new_product["unit_product_price"] * $new_product['reduction'] / 100);
                } else if ($product['type'] == "W") {
                    $new_product['reduction'] = $new_product['wholesale_reduction'];
                    $new_product["unit_product_price"] = $new_product["wholesale_price"];
                    $new_product["reduction_product"] = $new_product["unit_product_price"] - ($new_product["unit_product_price"] * $new_product['reduction'] / 100);
                } else if ($product['type'] == "D") {
                    $new_product['reduction'] = $new_product['detail_reduction'];
                    $new_product["unit_product_price"] = $new_product["detail_price"];
                    $new_product["reduction_product"] = $new_product["unit_product_price"] - ($new_product["unit_product_price"] * $new_product['reduction'] / 100);
                }

                if ($new_product["reduction_product"]>0) {
                    $new_product['price_product_with_reduction'] = $new_product["reduction_product"]*$product['quantity_product'];
                } else {
                    $new_product['price_product_with_reduction'] = $new_product["unit_product_price"]*$product['quantity_product'];
                }
                $total+= $new_product['price_product_with_reduction'];
                $new_product['quantity_product'] = $product['quantity_product'];
                $new_product['type'] = $product['type'];
                $new_product['product_name'] = $new_product['product_category'] . " " . $new_product['fruit_category'];
    
                // Ajouter le produit traité au tableau de retour
                $basket_return[] = $new_product;
            }
        }
        
        $basket_return[0]['total_price_product'] = $total;
        $basket_return[0]['reduction'] = 0;
        $basket_return[0]['result'] = $total;
        // Retourner le panier traité
        return $basket_return;
    }

    public function get_product_disponibility() {
        $sql = "SELECT product_id, CASE WHEN ((stock_quantity - order_quantity)*0.5)*0.1 <= 0 THEN 'disabled' ELSE '' END AS D, CASE WHEN ((stock_quantity - order_quantity)*0.5)*0.1 < 10 THEN 'disabled' ELSE '' END AS W, CASE WHEN (stock_quantity - order_quantity)-((stock_quantity - order_quantity)*0.5) <= 0 THEN 'disabled' ELSE '' END AS B from v_product_stock";
        $disponibility = [];
        $rows = $this->db->query($sql)->result_array();
        foreach ($rows as $data) {
            $disponibility[$data['product_id']]['D'] = $data['d'];
            $disponibility[$data['product_id']]['W'] = $data['w'];
            $disponibility[$data['product_id']]['B'] = $data['b'];
        }

        return $disponibility;
    }

    public function get_product_disponibility_quantity() {
        $sql = "SELECT product_id, ((stock_quantity - order_quantity)*0.5)*0.1 AS packs, (stock_quantity - order_quantity)-((stock_quantity - order_quantity)*0.5) AS kg from v_product_stock";
        $disponibility = [];
        $rows = $this->db->query($sql)->result_array();
        foreach ($rows as $data) {
            $disponibility[$data['product_id']]['packs'] = $data['packs'];
            $disponibility[$data['product_id']]['kg'] = $data['kg'];
        }

        return $disponibility;
    }
    
}
