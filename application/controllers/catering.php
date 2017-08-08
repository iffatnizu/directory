<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'siteConfig.php';
require_once 'dbConfig.php';

class Catering extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_catering');
    }

    public function index() {
        $this->getquotes();
    }

    public function getquotes() {
        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EVENT_DATE, 'Event Date', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_CITY_ID, 'Event City', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, 'Event Type', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS, 'Number of Guests', 'required|integer');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EVENT_LOCATION, 'Event Location', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_NAME, 'Name', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_PHONE, 'Phone', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EMAIL, 'Email', 'required|valid_email');
        $this->form_validation->set_message('required', ' %s Required');

        if ($this->form_validation->run() == TRUE) {
            $this->model_catering->insertCatering();
        }

        $data['allCity'] = getAllCity();
        $data['allEventType'] = getAllEventType();
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_CATERING, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function foodpreference($eventId = '') {
        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID, 'Service', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID, 'Budget', 'required');
        $this->form_validation->set_rules('foodTypes[]', 'Types of food', 'required');
        if (isset($_POST[DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME])) {
            $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME, 'Venue Name', 'required');
        }
        $this->form_validation->set_message('required', ' %s Required');

        if ($this->form_validation->run() == TRUE) {
//            debugPrint($_POST);
            if ($eventId != '') {
                $this->model_catering->insertFoodPreference($eventId);
            }
        }

        $data['eventDetails'] = $this->model_catering->getEventDetails($eventId);
        $data['allService'] = $this->model_catering->getAllService();
        $data['allBudgetRange'] = $this->model_catering->getBudgetPerPerson();
        $data['allFoodType'] = $this->model_catering->getAllFoodType();

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_FOOD_PREFERENCE, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function fewquestions($eventId = '') {
        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID, 'Service', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID, 'Budget', 'required');
        $this->form_validation->set_rules('foodTypes[]', 'Types of food', 'required');
        $this->form_validation->set_message('required', ' %s Required');

        if ($this->form_validation->run() == TRUE) {
//            debugPrint($_POST);
            $this->model_catering->insertFoodPreference($eventId);
        }

        $data['allVenueType'] = getVenueType();
        $data['allAmenitiesType'] = getAmenitiesType();
        $data['venueBudget'] = getVenueBudget();

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_FEW_QUESTIONS, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function otherservices($eventId = '') {
        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID, 'Service', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID, 'Budget', 'required');
        $this->form_validation->set_rules('foodTypes[]', 'Types of food', 'required');
        if (isset($_POST[DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME])) {
            $this->form_validation->set_rules(DbConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME, 'Venue Name', 'required');
        }
        $this->form_validation->set_message('required', ' %s Required');

        if ($this->form_validation->run() == TRUE) {
//            debugPrint($_POST);
            $this->model_catering->insertFoodPreference($eventId);
        }
        $data['allCategory'] = getAllCategory();

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_OTHER_SERVICES, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

}
