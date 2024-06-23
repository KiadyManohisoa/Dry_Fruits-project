<?php 
if(!defined('BASEPATH')) exit('Access Denied');
class View_model extends CI_Model {
    public function set_nav_bar($application, $section) {
        $nav_bar = array();
        if ($application=="backoffice") {
            $CI =& get_instance();
            $CI->load->library('session');
            if ($CI->session->get('admin_status')=='A') {
                $nav_bar['home']=array('action' => 'disable', 'wording' => 'home');
                $nav_bar['user']=array('action' => 'disable', 'wording' => 'client');
                $nav_bar['edit']=array('action' => 'disable', 'wording' => 'CRUD');
            }
            $nav_bar['truck-side']=array('action' => 'disable', 'wording' => 'delivery');
            $nav_bar['shopping-bag']=array('action' => 'disable', 'wording' => 'bag');
        } 
        else if ($application=="frontoffice") {
            $nav_bar['home']=array('action' => 'disable', 'wording' => 'home');
            $nav_bar['search']=array('action' => 'disable', 'wording' => 'search');
            $nav_bar['user']=array('action' => 'disable', 'wording' => 'user');
            $nav_bar['shopping-bag']=array('action' => 'disable', 'wording' => 'bag');
            $nav_bar['info']=array('action' => 'disable', 'wording' => 'info');
        }
        foreach ($nav_bar as $key => $value) {
            if ($value['wording']==$section) {
                $nav_bar[$key]['action']='enable';
            }
        }
        return $nav_bar;
    }

    public function page($application,$section) {
        $data['title'] = 'DryFruit';
        $data['application']=$application;
        $data['nav_bar'] = $this->set_nav_bar($application,$section);
        $data['contents'] = $application."-".$section;
        $data['css'] = array('font.css','content.css','bootstrap.css','bootstrap.min.css', 'scrollbar.css','header.css','footer.css','loader.css',$application.'-'.$section.'.css','products-defiler.css');
        $data['js'] = array('angular.min.js','jquery.min.js','bootstrap.js','bootstrap.min.js','chart.js','error.js',$application.'-'.$section.'.js',$application.'.js','products-defiler.js');
        return $data;
    }
}
?>