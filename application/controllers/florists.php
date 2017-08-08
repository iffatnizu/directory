<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'siteConfig.php';
require_once 'dbConfig.php';

class Florists extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_florists');
    }

    public function index() {
        $this->request();
    }

    public function request() {
        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EVENT_DATE, 'Event Date', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_CITY_ID, 'Event City', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, 'Event Type', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS, 'Number of Guests', 'required|integer');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_NAME, 'Name', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_PHONE, 'Phone', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EMAIL, 'Email', 'required|valid_email');
        $this->form_validation->set_message('required', ' %s Required');

        if ($this->form_validation->run() == TRUE) {
            $this->model_florists->insertFlorist();
        }
        
        $data['allCity'] = getAllCity();
        $data['allEventType'] = getAllEventType();
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_FLORISTS, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }
    
    public function decorativeServices($eventId=''){
        $data['allFlowerType'] = $this->model_florists->getAllFlowerType();
        $data['allServiceBudget'] = $this->model_florists->getAllServiceBudget();
        $data[''] = '';
        
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_DECORATIVE_SERVICES, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

}
