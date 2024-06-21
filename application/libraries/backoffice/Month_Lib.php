<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Month_Lib {
    
    public function get_number_of_days_in_month( $month,$year){
        if ($month<1|| $month> 12 || $year< 1) {
           return [];
        }
        
        // Obtenir nombre de jours dans le mois
        $daysLentgh = cal_days_in_month(CAL_GREGORIAN, $month, $year );
        return $daysLentgh;
    }
    
}