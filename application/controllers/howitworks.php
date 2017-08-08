<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'siteConfig.php';
require_once 'dbConfig.php';

class Howitworks extends CI_Controller {

    public function Howitworks() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_howitworks');
    }

    public function index() {
        $data['title'] = 'How it works';
        $data['content'] = $this->model_howitworks->getSiteContent('howitworks');
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_HOW_IT_WORKS, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

}
