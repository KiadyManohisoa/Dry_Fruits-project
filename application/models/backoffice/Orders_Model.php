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

    public function get_total_quantity_ordered($date, $product_id)
    {
        $sql = "
            SELECT
                SUM(quantity) AS total_quantity
            FROM
                orders o
            JOIN
                products_ordered po ON o.id_order = po.id_order
            WHERE
                DATE(o.ordering_date) = ?
                AND po.id_product = ?
        ";

        $query = $this->db->query($sql, array($date, $product_id));
        return $query->row_array();
    }

    public function get_number_package_ordered($date, $product_id)
    {
        $sql = "
            SELECT
                SUM(quantity) / 0.1 AS number_package
            FROM
                orders o
            JOIN
                products_ordered po ON o.id_order = po.id_order
            WHERE
                DATE(o.ordering_date) = ?
                AND po.id_product = ?
                AND (sales_type = 'B' OR sales_type = 'D')
        ";

        $query = $this->db->query($sql, array($date, $product_id));
        return $query->row_array();
    }

    public function get_charge_price($product_id, $movement_date)
    {
        $sql = "
            SELECT DISTINCT
                ckm.price
            FROM
                charges_kg_movement ckm
            JOIN
                products_ordered po ON ckm.id_product = po.id_product
            WHERE
                ckm.id_product = ?
                AND ckm.movement_date = ?
        ";

        $query = $this->db->query($sql, array($product_id, $movement_date));
        return $query->result_array();
    }

    public function get_sales_amount($ordering_date, $product_id)
    {
        $sql = "
            SELECT
                SUM(
                    CASE 
                        WHEN po.sales_type = 'D' THEN dm.price * po.quantity
                        WHEN po.sales_type = 'W' THEN wm.price * po.quantity
                        WHEN po.sales_type = 'B' THEN bm.price * po.quantity
                        ELSE 0
                    END
                ) AS total_price
            FROM
                orders o
            JOIN
                products_ordered po ON o.id_order = po.id_order
            LEFT JOIN
                detail_movement dm ON po.id_product = dm.id_product AND po.sales_type = 'D' AND DATE(o.ordering_date) = dm.movement_date
            LEFT JOIN
                wholesale_movement wm ON po.id_product = wm.id_product AND po.sales_type = 'W' AND DATE(o.ordering_date) = wm.movement_date
            LEFT JOIN
                bulk_movement bm ON po.id_product = bm.id_product AND po.sales_type = 'B' AND DATE(o.ordering_date) = bm.movement_date
            WHERE
                DATE(o.ordering_date) = ?
                AND po.id_product = ?
        ";

        $query = $this->db->query($sql, array($ordering_date, $product_id));
        return $query->row_array();
    }

    public function get_all_client_orders($id_client)
    {
        $query = $this->db->get_where('v_client_orders', array('id_client' => $id_client));
        return $query->result_array();
    }

    public function get_client_purchase($id_client) {
        $sql = 'SELECT count(id_client) as purchases FROM orders where id_client =\'' . $id_client . '\'';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    // return an array 
    public function last_client_orders($id_client, $row)
    {
        $sql = 'SELECT * FROM v_client_orders where id_client =\'' . $id_client . '\'order by ordering_date DESC limit ' . $row;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
     // maka my id_produit ao anatina commande ray 
    public function get_product_by_order  ($id_order){
        $sql = 'SELECT id_product FROM  products_ordered  where id_order = '.$id_order ; 
        $query = $this ->db->query($sql);
        return $query->result_array();
    }

    public function insert_products_ordered($basket, $id_order) {
        foreach ($basket as $item) {
            $data = array(
                'id_product_ordered' => $this->generate_product_ordered_id(), // Générer l'ID pour products_ordered
                'sales_type' => $item['type'],
                'quantity' => $item['quantity_product'],
                'id_order' => $id_order,
                'id_product' => $item['id_product']
            );

            $this->db->insert('products_ordered', $data);
        }
    }

    public function create_order($delivery_data, $payment_data,$id_client,$reduction,$cost) {
        // Générer l'ID pour la livraison et le paiement en utilisant les séquences de PostgreSQL
        $id_delivery = $this->generate_delivery_id();
        $id_payment = $this->generate_payment_id();
        $id_order = $this->generate_order_id();

        // Insérer les données de livraison
        $delivery_data['id_delivery'] = $id_delivery;
        $delivery_data['status'] = 0; // Status par défaut, à adapter selon votre logique
        $delivery_data['cost'] = $cost; // Status par défaut, à adapter selon votre logique
        $delivery_data['delivery_date'] = $this->calculate_delivery_date(); // Calculer la date de livraison

        $this->db->insert('delivery', $delivery_data);

        // Insérer les données de paiement
        $payment_data['id_payement'] = $id_payment;

        $this->db->insert('payement', $payment_data);

        // Insérer les données de commande
        $order_data = array(
            'reduction' => $reduction, // Vous pouvez définir une réduction si nécessaire
            'ordering_date' => date('Y-m-d H:i:s'), // Date actuelle
            'id_payement' => $id_payment,
            'id_delivery' => $id_delivery,
            'id_client' => $id_client // Récupérer l'ID client depuis la session
        );

        $order_data['id_order'] = $id_order;

        $this->db->insert('orders', $order_data);

        // Retourner l'ID de la commande créée
        return $id_order;
    }

    private function generate_delivery_id() {
        // Générer l'ID de livraison en utilisant la séquence de PostgreSQL
        $query = $this->db->query("SELECT 'DLV' || LPAD(nextval('delivery_sequence')::TEXT, 4, '0') AS id");
        $row = $query->row();
        return $row->id;
    }

    private function generate_payment_id() {
        // Générer l'ID de paiement en utilisant la séquence de PostgreSQL
        $query = $this->db->query("SELECT 'PMT' || LPAD(nextval('payement_sequence')::TEXT, 4, '0') AS id");
        $row = $query->row();
        return $row->id;
    }

    private function generate_order_id() {
        // Générer l'ID de commande en utilisant la séquence de PostgreSQL
        $query = $this->db->query("SELECT 'ORD' || LPAD(nextval('ordered_product_sequence')::TEXT, 4, '0') AS id");
        $row = $query->row();
        return $row->id;
    }

    private function calculate_delivery_date() {
        // Calculer la date de livraison (par exemple, 2 semaines après la date de commande)
        return date('Y-m-d H:i:s', strtotime('+2 weeks'));
    }

    private function generate_product_ordered_id() {
        // Générer l'ID pour products_ordered (à adapter selon votre séquence dans PostgreSQL)
        $query = $this->db->query("SELECT 'PRO' || LPAD(nextval('products_ordered_sequence')::TEXT, 4, '0') AS id");
        $row = $query->row();
        return $row->id;
    }
}