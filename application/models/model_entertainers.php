<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Entertainers extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertEntertainers(){
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_DATE] = strtotime($this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_DATE));
        $data[DBConfig::TABLE_EVENT_ATT_CITY_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_CITY_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NAME] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EMAIL] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EMAIL, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_CATEGORY_ID] = '3';
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_CREATED_DATE] = strtotime(date("Y-m-d H:i:s"));
        $data[DBConfig::TABLE_EVENT_ATT_STATUS] = '0';
        
        $startTime = strtotime($_POST['hours'].':'.$_POST['minute'].' '.$_POST['extension']);
        $data[DBConfig::TABLE_EVENT_ATT_START_TIME] = $startTime;
        
        $phone = $_POST['cCode'].$_POST['pCode'].$_POST[DBConfig::TABLE_EVENT_ATT_PHONE];
        if(isset ($_POST['extension']) && $_POST['extension']!='') {
            $phone = $phone.'-'.$_POST['extension'];
        }
        $data[DBConfig::TABLE_EVENT_ATT_PHONE] = $phone;

        $insert = $this->db->insert(DBConfig::TABLE_EVENT, $data);
        $eventId = $this->db->insert_id();
        if($insert) {
            redirect(site_url(SiteConfig::CONTROLLER_ENTERTAINERS.SiteConfig::METHOD_ENTERTAINERS_DJS_REQUEST.'/'.$eventId));
        }
    }
    
    public function getAllMusicType(){
        return $this->db->get(DBConfig::TABLE_MUSIC_TYPE)->result_array();
    }
    
    public function getAllServiceBudget(){
        return $this->db->get(DBConfig::TABLE_SERVICE_BUDGET)->result_array();
    }
    
    public function insertDjQuotes($eventId= '') {
        $data[DBConfig::TABLE_DJ_QUOTES_ATT_SERVICE_BUDGET_ID] = $this->input->post(DBConfig::TABLE_DJ_QUOTES_ATT_SERVICE_BUDGET_ID, TRUE);
        $data[DBConfig::TABLE_DJ_QUOTES_ATT_DJ_TYPE] = $this->input->post(DBConfig::TABLE_DJ_QUOTES_ATT_DJ_TYPE, TRUE);
        $data[DBConfig::TABLE_DJ_QUOTES_ATT_EVENT_COMMENTS] = $this->input->post(DBConfig::TABLE_DJ_QUOTES_ATT_EVENT_COMMENTS, TRUE);

        $musicTypes = implode(',', $_POST['musicTypes']);

        $data[DBConfig::TABLE_DJ_QUOTES_ATT_MUSIC_TYPES] = $musicTypes;
        $data[DBConfig::TABLE_DJ_QUOTES_ATT_EVENT_ID] = $eventId;

//        debugPrint($data);
//        exit();
        $insert = $this->db->insert(DBConfig::TABLE_DJ_QUOTES, $data);
        if ($insert) {
            redirect(site_url(SiteConfig::CONTROLLER_ENTERTAINERS . SiteConfig::METHOD_ENTERTAINERS_OTHER_SERVICES . '/' . $eventId));
        }
    }
}
