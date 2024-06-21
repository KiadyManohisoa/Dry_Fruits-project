<?php

class Sales_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Vente journalier
    public function get_daily_sales($day,$month,$year) {
        $sql = "SELECT SUM( total-( total * reduction / 100 )) AS total 
        FROM v_sales_final 
        WHERE EXTRACT(DAY FROM ordering_date) = ? 
        AND EXTRACT(MONTH FROM ordering_date) = ? 
        AND EXTRACT(YEAR FROM ordering_date) = ?";

        $query = $this->db->query($sql, array($day,$month, $year));

        if ($query->row()->total > 0) {
            return floatval(str_replace(' ', '',$query->row()->total));
        } else {
            return 0.0; // Retourne 0 si aucune donnée n'est trouvée
        }
    }

    // Ventes mensuelles depuis database
    public function get_monthly_sales($mois, $year) {
        $sql = "SELECT SUM( total-( total * reduction / 100 )) AS total 
                FROM v_sales_final 
                WHERE EXTRACT(MONTH FROM ordering_date) = ? 
                AND EXTRACT(YEAR FROM ordering_date) = ?";
        
        $query = $this->db->query($sql, array($mois, $year));

        if ($query->row()->total > 0) {
            return floatval(str_replace(' ', '',$query->row()->total));
        } else {
            return 0.0; // Retourne 0 si aucune donnée n'est trouvée
        }
    }


    // dépense journaliers
    public function get_daily_expenses($day,$month,$year){
        $sql = "SELECT SUM(quantity_kg * price) AS depenses 
                FROM v_charges 
                WHERE EXTRACT(DAY FROM renewal_date) = ? 
                AND EXTRACT(MONTH FROM renewal_date) = ? 
                AND EXTRACT(YEAR FROM renewal_date) = ?";
        
        $query = $this->db->query($sql, array($day,$month, $year));

        if ($query->row()->depenses > 0) {
            return floatval(str_replace(' ', '',$query->row()->depenses));
        } else {
            return 0.0; // Retourne 0 si aucune donnée n'est trouvée
        }
    }
    // dépenses mensuelles
    public function get_monthly_expenses($month, $year) {
        $sql = "SELECT SUM(quantity_kg * price) AS depenses 
                FROM v_charges 
                WHERE EXTRACT(MONTH FROM renewal_date) = ? 
                AND EXTRACT(YEAR FROM renewal_date) = ?";
        
        $query = $this->db->query($sql, array($month, $year));

        if ($query->row()->depenses > 0) {
            return floatval(str_replace(' ', '',$query->row()->depenses));
        } else {
            return 0.0; // Retourne 0 si aucune donnée n'est trouvée
        }
    }
}