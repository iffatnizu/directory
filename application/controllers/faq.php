<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'siteConfig.php';
require_once 'dbConfig.php';

class Faq extends CI_Controller {

    public function Faq() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_faq');
    }

    public function index() {
        $data['title'] = 'Frequently asked questions';
        $data['faq'] = getFAQ();
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_FAQ,$data, TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

}
