<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'siteConfig.php';
require_once 'dbConfig.php';

class Affiliate extends CI_Controller {

    public function Affiliate() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_affiliate');
    }

    public function index() {
        $data['title'] = 'Affiliate and Advertisement';
        $data['content'] = $this->model_affiliate->getSiteContent('affiliate');

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_AFFILIATE_ADVERTISEMENT,$data, TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

}
