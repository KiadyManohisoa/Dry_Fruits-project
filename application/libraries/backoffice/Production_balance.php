<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Production_balance
{
    private $product;
    private $stock;
    private $out;
    private $sales;
    private $charges;
    private $sales_amount;
    private $results;

    private $CI;

    public function __construct($product = null, $stock = 0, $out = 0, $sales = 0, $charges = 0, $sales_amount = 0, $results = 0)
    {
        $this->product = $product;
        $this->stock = $stock;
        $this->out = $out;
        $this->sales = $sales;
        $this->charges = $charges;
        $this->sales_amount = $sales_amount;
        $this->results = $results;
        $this->CI = &get_instance();
    }


    public function get_product()
    {
        return $this->product;
    }

    public function set_product($product)
    {
        if (empty($product)) {
            throw new InvalidArgumentException("Product cannot be empty.");
        }
        $this->product = $product;
    }

    public function get_stock()
    {
        return $this->stock;
    }

    public function set_stock($stock)
    {
        if (!is_numeric($stock) || $stock < 0) {
            throw new InvalidArgumentException("Stock must be a non-negative number.");
        }
        $this->stock = $stock;
    }

    public function get_out()
    {
        return $this->out;
    }

    public function set_out($out)
    {
        if (!is_numeric($out) || $out < 0) {
            throw new InvalidArgumentException("Out must be a non-negative number.");
        }
        $this->out = $out;
    }

    public function get_sales()
    {
        return $this->sales;
    }

    public function set_sales($sales)
    {
        if (!is_numeric($sales) || $sales < 0) {
            throw new InvalidArgumentException("Sales must be a non-negative number.");
        }
        $this->sales = $sales;
    }

    public function get_charges()
    {
        return $this->charges;
    }

    public function set_charges($charges)
    {
        if (!is_numeric($charges) || $charges < 0) {
            throw new InvalidArgumentException("Charges must be a non-negative number.");
        }
        $this->charges = $charges;
    }

    public function get_sales_amount()
    {
        return $this->sales_amount;
    }

    public function set_sales_amount($sales_amount)
    {
        if (!is_numeric($sales_amount) || $sales_amount < 0) {
            throw new InvalidArgumentException("Sales amount must be a non-negative number.");
        }
        $this->sales_amount = $sales_amount;
    }

    public function get_results()
    {
        return $this->results;
    }

    public function set_results($results)
    {
        if (!is_numeric($results)) {
            throw new InvalidArgumentException("Results must be a number.");
        }
        $this->results = $results;
    }
    
    public static function get_totals_balance_production($date_search, $id_cat_produit) {
        $CI = &get_instance();
        $CI->load->model('backoffice/Production_balance_Model','Production_balance_Model');
        $CI->load->library('backoffice/util_lib','util_lib');

        $balance_total = $CI->Production_balance_Model->get_totals_balance_by_date($date_search,$id_cat_produit);

        $totals = array();
        $totals['stock'] = $CI->util_lib->format_number($balance_total[0]['stock'] ?? 0,2);
        $totals['out'] = $CI->util_lib->format_number($balance_total[0]['out'] ?? 0, 2);
        $totals['sales'] = $CI->util_lib->format_number($balance_total[0]['sales'] ?? 0, 2);
        $totals['charges'] = $CI->util_lib->format_number($balance_total[0]['charges'] ?? 0, 2);
        $totals['sales_amount'] = $CI->util_lib->format_number($balance_total[0]['sales_amount'] ?? 0, 2);
        $totals['results'] = $CI->util_lib->format_number($balance_total[0]['results'] ?? 0, 2);
        return $totals;
    }

    public static function get_balance_production($date_search, $id_cat_produit)
    {
        $CI = &get_instance();
        $CI->load->model('backoffice/Production_balance_Model','Production_balance_Model');
        $CI->load->library('backoffice/util_lib','util_lib');

        $balances_data = $CI->Production_balance_Model->get_balance_by_date($date_search, $id_cat_produit);

        $balances = array();
        foreach ($balances_data as $data) {
            $balance = new self(
                $data['product_name'],
                $data['stock'] > 0 ? $CI->util_lib->format_number($data['stock'],2) : 0,
                $data['out_production'] > 0 ? $CI->util_lib->format_number($data['out_production'],2) : 0,
                $CI->util_lib->format_number($data['sales'],2),
                $data['charges'] > 0 ? $CI->util_lib->format_number($data['charges'],2) : 0,
                $CI->util_lib->format_number($data['sales_amount'],2),
                $data['results'] > 0 ? $CI->util_lib->format_number($data['results'],2) : 0
            );
            $balances[] = $balance;
        }

        return $balances;
    }
}
