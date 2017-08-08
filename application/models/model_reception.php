<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Reception extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertReception() {
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_DATE] = strtotime($this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_DATE));
        $data[DBConfig::TABLE_EVENT_ATT_CITY_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_CITY_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NAME] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EMAIL] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EMAIL, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_CATEGORY_ID] = '2';
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_CREATED_DATE] = strtotime(date("Y-m-d H:i:s"));
        $data[DBConfig::TABLE_EVENT_ATT_STATUS] = '0';
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION] = '0';
        $data[DBConfig::TABLE_EVENT_ATT_VENUE_BUDGET_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_VENUE_BUDGET_ID, TRUE);

        $phone = $_POST['cCode'] . $_POST['pCode'] . $_POST[DBConfig::TABLE_EVENT_ATT_PHONE];
        if (isset($_POST['extension']) && $_POST['extension'] != '') {
            $phone = $phone . '-' . $_POST['extension'];
        }
        $data[DBConfig::TABLE_EVENT_ATT_PHONE] = $phone;

        $insert = $this->db->insert(DBConfig::TABLE_EVENT, $data);
        $eventId = $this->db->insert_id();
        if ($insert) {
            redirect(site_url(SiteConfig::CONTROLLER_RECEPTION . SiteConfig::METHOD_RECEPTION_HALLS_QUOTES . '/' . $eventId));
        }
    }

    public function getAllVenueType() {
        $this->db->where(DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID . ' != ', '5');
        return $this->db->get(DBConfig::TABLE_VENUE_TYPE)->result_array();
    }

    public function insertHallsQuotes($eventId = 0) {
        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_HALLS_TYPE] = $this->input->post(DBConfig::TABLE_HALLS_QUOTES_ATT_HALLS_TYPE, TRUE);
        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_NEED_CATERING] = $this->input->post(DBConfig::TABLE_HALLS_QUOTES_ATT_NEED_CATERING, TRUE);
        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_EVENT_COMMENTS] = $this->input->post(DBConfig::TABLE_HALLS_QUOTES_ATT_EVENT_COMMENTS, TRUE);

        $startTime = strtotime($_POST['sHours'] . ':' . $_POST['sMinute'] . ' ' . $_POST['sExtension']);
        $endTime = strtotime($_POST['eHours'] . ':' . $_POST['eMinute'] . ' ' . $_POST['eExtension']);


        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_START_TIME] = $startTime;
        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_END_TIME] = $endTime;

        $venueTypes = implode(',', $_POST['venueTypes']);
        $amenitiesTypes = implode(',', $_POST['amenitiesTypes']);

        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_VENUE_CHOICE] = $venueTypes;
        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_AMENITIES_TYPES] = $amenitiesTypes;
        $data[DBConfig::TABLE_HALLS_QUOTES_ATT_EVENT_ID] = $eventId;

//        debugPrint($data);
//        exit();
        $insert = $this->db->insert(DBConfig::TABLE_HALLS_QUOTES, $data);
        if ($insert) {
            redirect(site_url(SiteConfig::CONTROLLER_RECEPTION . SiteConfig::METHOD_RECEPTION_OTHER_SERVICES . '/' . $eventId));
        }
    }

}
