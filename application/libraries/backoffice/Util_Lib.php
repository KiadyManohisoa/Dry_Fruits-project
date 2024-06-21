<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util_Lib{
    // formater un nombre en $precision apres virgule et avec un espace comme séparateur de milliers
    public function format_number($number, $precision ){
        return number_format($number, $precision,'.',' ');
    }
}