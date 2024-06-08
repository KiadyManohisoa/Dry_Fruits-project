<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('orders')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('orders', array('id_order' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('orders', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_order', $id);
        return $this->db->update('orders', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('orders', array('id_order' => $id));
    }

    public function get_basket_link($order_id)
    {
        $sql = "
        WITH OrderDetails AS (
            SELECT 
                product_category, 
                fruit_category, 
                product_ordered_sales_type,
                product_ordered_quantity,
                CASE 
                    WHEN product_ordered_sales_type = 'D' THEN detail_price
                    WHEN product_ordered_sales_type = 'W' THEN wholesale_price
                    WHEN product_ordered_sales_type = 'B' THEN bulk_price
                    ELSE NULL
                END AS product_price,
                CASE 
                    WHEN product_ordered_sales_type = 'D' THEN detail_price * product_ordered_quantity
                    WHEN product_ordered_sales_type = 'W' THEN wholesale_price * product_ordered_quantity
                    WHEN product_ordered_sales_type = 'B' THEN bulk_price * product_ordered_quantity
                    ELSE NULL
                END AS total_price_product,
                order_reduction
            FROM v_order_delivery_link
            WHERE order_id = ?
        )
        SELECT 
            product_category, 
            fruit_category, 
            product_ordered_sales_type,
            product_ordered_quantity,
            product_price,
            order_reduction,
            total_price_product,
            total_price_product - (total_price_product * order_reduction / 100) AS total_order_price
        FROM OrderDetails;
    ";

        $query = $this->db->query($sql, array($order_id));
        return $query->result_array();
    }
}
