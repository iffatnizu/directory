<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'siteConfig.php';
require_once 'dbConfig.php';

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_home');
    }

    public function index() {
        $data['title'] = 'Home Page';
        
        $data['allCity'] = getAllCity();
        $data['allEventType'] = getAllEventType();
        $data['allBudget'] = getVenueBudget();
        $data['servicesList'] = getAllServiceList();
        $data['vendor'] = getAllVendor();
        
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_HOME, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function template() {
        $data = array("title" => 'My Directory');
        $this->load->view('comp/home/compTemplate', $data);
    }
    
    public function getCity(){
        echo json_encode($this->model_home->getCityByState());
    }

}
