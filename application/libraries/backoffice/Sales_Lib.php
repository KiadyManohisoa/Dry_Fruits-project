<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_Lib {
    protected $CI;

    public function __construct() {
        // Obtenir l'instance de CodeIgniter
        $this->CI =& get_instance();

        // Charger le modèle Sales_Model via l'instance CI
        $this->CI->load->model('backoffice/Sales_Model','Sales_Model');
        $this->CI->load->library('backoffice/month_lib','month_lib');
        $this->CI->load->library('backoffice/util_lib','util_lib');
    }

    // ventes journaliers pour un mois
    public function get_daily_sales($month,$year){
        $sales=[];
        $days = $this->CI->month_lib->get_number_of_days_in_month($month,$year);
        for ($i=1; $i <= $days; $i++) { 
            $val = $this->CI->Sales_Model->get_daily_sales($i,$month,$year);
            $sales[$i] = $this->CI->util_lib->format_number($val,2);
        }
        return $sales;
    }

    // ventes mensuel
    public function get_monthly_sales($month,$year) {
        $val = $this->CI->Sales_Model->get_monthly_sales($month, $year);
        return $this->CI->util_lib->format_number($val,2);
    }

    // dépenses journaliers pour un mois
    public function get_daily_expenses($month,$year) {
        $expenses =[];
        $days = $this->CI->month_lib->get_number_of_days_in_month($month,$year);
        for ($i= 1; $i <= $days; $i++) {    
            $val=$this->CI->Sales_Model->get_daily_expenses($i,$month,$year);
            $expenses[$i] = $this->CI->util_lib->format_number($val,2);
        }
        return $expenses;

    }
    // dépense mensuel
    public function get_monthly_expenses($month,$year) {
        $val= $this->CI->Sales_Model->get_monthly_expenses($month, $year);
        return $this->CI->util_lib->format_number($val,2);
    }
    

    // résultat journalier
    public function get_daily_results($month,$year) {
        $results =[];
        $days = $this->CI->month_lib->get_number_of_days_in_month($month,$year);
        for ($i= 1; $i <= $days; $i++){
            $val= $this->CI->Sales_Model->get_daily_sales($i,$month,$year) - $this->CI->Sales_Model->get_daily_expenses($i,$month,$year);
            $results[$i] = $this->CI->util_lib->format_number($val,2);
        }
        return $results;
    }
    // résultat mensuel
    public function get_monthly_results($month,$year) {
        $val=$this->get_monthly_sales($month, $year) - $this->get_monthly_expenses($month, $year);
        return $this->CI->util_lib->format_number($val,2);
    }

    //chiffres d'affaires
    // ventes journaliers pour un mois
    public function get_sales_figures($month, $year) {
        $sales_figures_before_month = 0;
    
        for ($i = 1; $i < $month; $i++) { 
            $monthly_sales = $this->get_monthly_sales($i, $year);
            $sales_figures_before_month += floatval(str_replace(' ', '', $monthly_sales));
        }
    
        $sales_figures = [];
        $days = $this->CI->month_lib->get_number_of_days_in_month($month, $year);
    
        $val = (double) $this->CI->Sales_Model->get_daily_sales(1, $month, $year);
        $sales_figures[1] = (string) ($sales_figures_before_month + $val);
    
        for ($i = 2; $i <= $days; $i++) { 
            $val = (double) $this->CI->Sales_Model->get_daily_sales($i, $month, $year);
            $sales_figures[$i] = (string) ((double) $sales_figures[$i - 1] + $val);
        }
    
        return $sales_figures;
    }
    


}