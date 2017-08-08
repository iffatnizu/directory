<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Catering extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertCatering() {
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_DATE] = strtotime($this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_DATE));
        $data[DBConfig::TABLE_EVENT_ATT_CITY_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_CITY_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NAME] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EMAIL] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EMAIL, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_CATEGORY_ID] = '1';
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_CREATED_DATE] = strtotime(date("Y-m-d H:i:s"));
        $data[DBConfig::TABLE_EVENT_ATT_STATUS] = '0';

        $phone = $_POST['cCode'] . $_POST['pCode'] . $_POST[DBConfig::TABLE_EVENT_ATT_PHONE];
        if (isset($_POST['extension']) && $_POST['extension'] != '') {
            $phone = $phone . '-' . $_POST['extension'];
        }
        $data[DBConfig::TABLE_EVENT_ATT_PHONE] = $phone;

        $insert = $this->db->insert(DBConfig::TABLE_EVENT, $data);
        $eventId = $this->db->insert_id();
        if ($insert) {
            redirect(site_url(SiteConfig::CONTROLLER_CATERING . SiteConfig::METHOD_CATERING_FOOD_PREFERENCE . '/' . $eventId));
        }
    }

    public function getAllService() {
        return $this->db->get(DBConfig::TABLE_SERVICE)->result_array();
    }

    public function getBudgetPerPerson() {
        return $this->db->get(DBConfig::TABLE_BUDGET_PER_PERSON)->result_array();
    }

    public function getAllFoodType() {
        return $this->db->get(DBConfig::TABLE_FOOD_TYPE)->result_array();
    }

    public function getEventDetails($eventId = '') {
        $this->db->where(DBConfig::TABLE_EVENT_ATT_EVENT_ID, $eventId);
        $query = $this->db->get(DBConfig::TABLE_EVENT);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function insertFoodPreference($eventId = 0) {
        $data[DBConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID] = $this->input->post(DBConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID);
        $data[DBConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID] = $this->input->post(DBConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID, TRUE);
        $data[DBConfig::TABLE_FOOD_PREFERENCE_ATT_ABOUT_EVENT] = $this->input->post(DBConfig::TABLE_FOOD_PREFERENCE_ATT_ABOUT_EVENT, TRUE);
        if (isset($_POST[DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME])) {
            $data[DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME] = $this->input->post(DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME, TRUE);
            $data[DBConfig::TABLE_FOOD_PREFERENCE_ATT_KITCHEN] = $this->input->post(DBConfig::TABLE_FOOD_PREFERENCE_ATT_KITCHEN, TRUE);
        }

        $foodTypes = implode(',', $_POST['foodTypes']);

        $data[DBConfig::TABLE_FOOD_PREFERENCE_ATT_FOOD_TYPE] = $foodTypes;
        $data[DBConfig::TABLE_FOOD_PREFERENCE_ATT_EVENT_ID] = $eventId;

//        debugPrint($data);
//        exit();
        $insert = $this->db->insert(DBConfig::TABLE_FOOD_PREFERENCE, $data);
        if ($insert) {
            if ($_POST['eventLocation'] == '1') {
                redirect(site_url(SiteConfig::CONTROLLER_CATERING . SiteConfig::METHOD_CATERING_FEW_QUESTIONS . '/' . $eventId));
            } else if ($_POST['eventLocation'] == '2') {
                redirect(site_url(SiteConfig::CONTROLLER_CATERING . SiteConfig::METHOD_CATERING_OTHER_SERVICES . '/' . $eventId));
            }
        }
    }

}
