<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Limos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertLimousine(){
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_DATE] = strtotime($this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_DATE));
        $data[DBConfig::TABLE_EVENT_ATT_CITY_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_CITY_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_NAME] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_EMAIL] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EMAIL, TRUE);
        $data[DBConfig::TABLE_EVENT_ATT_CATEGORY_ID] = '6';
        $data[DBConfig::TABLE_EVENT_ATT_EVENT_CREATED_DATE] = strtotime(date("Y-m-d H:i:s"));
        $data[DBConfig::TABLE_EVENT_ATT_STATUS] = '0';
        
        $phone = $_POST['cCode'].$_POST['pCode'].$_POST[DBConfig::TABLE_EVENT_ATT_PHONE];
        if(isset ($_POST['extension']) && $_POST['extension']!='') {
            $phone = $phone.'-'.$_POST['extension'];
        }
        $data[DBConfig::TABLE_EVENT_ATT_PHONE] = $phone;

        $insert = $this->db->insert(DBConfig::TABLE_EVENT, $data);
        $eventId = $this->db->insert_id();
        if($insert) {
            redirect(site_url(SiteConfig::CONTROLLER_LIMOS.SiteConfig::METHOD_LIMOS_LIMOUSINE.'/'.$eventId));
        }
    }
    
}
