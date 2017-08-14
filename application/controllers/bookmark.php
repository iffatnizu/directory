<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'siteConfig.php';
require_once 'dbConfig.php';
require_once APPPATH . 'directory/vendorconfig.php';

class Bookmark extends CI_Controller {

    public function Bookmark() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email', 'session'));
        $this->load->model('model_bookmark');
        $this->load->helper('events');
    }

    public function service($eventsInfoId=0) {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'Bookmark Services';
            $data['services'] = $this->model_bookmark->getBookmarkServices(cpr_decode($eventsInfoId), $this->session->userdata('_userId'));
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, '', TRUE);
            $vendor['content'] = $this->load->view(siteConfig::COMPONENT_BOOKMARK_SERVICES, $data, TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

}