<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('backoffice/Data_Loader','Data_Loader');
        $this->load->library('backoffice/Sales_Lib','Sales_Lib');
        $this->load->library('backoffice/Month_Lib','Month_Lib');
        $this->load->library('backoffice/Util_Lib','Util_Lib');
        $this->load->model('backoffice/view_model', 'main');
    }



    public function get_sales_stats($monthyear) {
        
        $arraymonthyear=explode("-",$monthyear);
        $month=$arraymonthyear[1];
        $year=$arraymonthyear[0];

        $results=$this->sales_lib->get_daily_results($month,$year);
        $sales=$this->sales_lib->get_daily_sales($month,$year); 
        $expenses=$this->sales_lib->get_daily_expenses($month,$year);
        $sales_figures=$this->sales_lib->get_sales_figures($month,$year);

        $tableau['results']=$results;
        $tableau['sales']=$sales;
        $tableau['charges']=$expenses;
        $tableau['sales_figures']=$sales_figures;
        $tableau['monthly_sales']=$this->sales_lib->get_monthly_sales($month,$year);

        echo json_encode($tableau);



    }

}
?>
