<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Quote extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCityByStateId($stateId='') {
        $this->db->where(DBConfig::TABLE_CITY_ATT_STATE_ID, $stateId);
        $query = $this->db->get(DBConfig::TABLE_CITY);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        }
    }

    public function insertEventInfo() {
        if ($this->session->userdata('eventInfoId')) {
            $session[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID] = FALSE;
            $session[DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE] = FALSE;
            $session[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY] = FALSE;
            $session[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] = FALSE;
            $session[DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID] = FALSE;
            $session[DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID] = FALSE;
            $session[DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE] = FALSE;

            $this->session->unset_userdata($session);
        }
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE] = $this->input->post('otherEvent', TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY] = $this->input->post('eventStatus', TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID] = $this->input->post('stateId', TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_CITY_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE] = strtotime(date("Y-m-d H:i:s"));

//        debugPrint($data);
//        exit();
//        $insert = $this->db->insert(DBConfig::TABLE_EVENT_INFO, $data);
//        $eventId = $this->db->insert_id();
//        if ($insert) {
//            $datas['eventId'] = $eventId;
        $data['step1'] = 'Done';
        $this->session->set_userdata($data);

        if ($this->session->userdata('selectCategory1')) {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_CATERER));
        } else if ($this->session->userdata('selectCategory2')) {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_DECORATION));
        } else if ($this->session->userdata('selectCategory3')) {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ENTERTAINER));
        } else if ($this->session->userdata('selectCategory4')) {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST));
        } else if ($this->session->userdata('selectCategory5')) {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY));
        } else if ($this->session->userdata('selectCategory6')) {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ADD_REMOVE_SERVICES));
        }
//        }
    }

    public function addCatererInfo() {
        $data['catStartDate'] = strtotime($this->input->post('catStartDate'));
        $data['catEndDate'] = strtotime($this->input->post('catEndDate'));

        $startTime = $_POST['startHours'] . ':' . $_POST['startMinute'] . ' ' . $_POST['startExt'];
        $endTime = $_POST['endHours'] . ':' . $_POST['endMinute'] . ' ' . $_POST['endExt'];

        $data['catStartTime'] = strtotime($startTime);
        $data['catEndTime'] = strtotime($endTime);
        $data['catDateFlexibl'] = $this->input->post('catDateFlexibl');
        $data['catGuestNumber'] = $this->input->post('catGuestNumber');
        $data['catService'] = $this->input->post('catService');
        $data['catCuisine'] = $this->input->post('catCuisine');
        $data['catBudgetPerson'] = $this->input->post('catBudgetPerson');

        if (isset($_POST['otherCatCuisine']) && !empty($_POST['otherCatCuisine'])) {
            $data['otherCatCuisine'] = $_POST['otherCatCuisine'];
        }

        if (isset($_POST['catCourses']) && !empty($_POST['catCourses'])) {
            $data['catCourses'] = implode(',', $_POST['catCourses']);
        }

        if (isset($_POST['catEquipment']) && !empty($_POST['catEquipment'])) {
            $data['catEquipment'] = implode(',', $_POST['catEquipment']);
        }

        if (isset($_POST['catAddServices']) && !empty($_POST['catAddServices'])) {
            $data['catAddServices'] = implode(',', $_POST['catAddServices']);
        }

        if (isset($_POST['otherCatServices']) && $_POST['otherCatServices'] != '') {
            $data['otherCatServices'] = $_POST['otherCatServices'];
        }

        if (isset($_POST['catHaveLocation']) && $_POST['catHaveLocation'] != '') {
            $data['catHaveLocation'] = $_POST['catHaveLocation'];
        }

        if (isset($_POST['otherEquipment']) && $_POST['otherEquipment'] != '') {
            $data['otherEquipment'] = $_POST['otherEquipment'];
        }

        if (isset($_POST['catVenue']) && $_POST['catVenue'] != '') {
            $data['catVenue'] = $_POST['catVenue'];
        }

        if (isset($_POST['catKitchen']) && $_POST['catKitchen'] != '') {
            $data['catKitchen'] = $_POST['catKitchen'];
        }

        if (isset($_POST['catComments']) && $_POST['catComments'] != '') {
            $data['catComments'] = $_POST['catComments'];
        }

        $data['cateringStep'] = 'Done';
        $this->session->set_userdata($data);

        if ($this->session->userdata('selectCategory2') && $this->session->userdata('receiptionStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_DECORATION));
        } else if ($this->session->userdata('selectCategory3') && $this->session->userdata('entertainmentStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ENTERTAINER));
        } else if ($this->session->userdata('selectCategory4') && $this->session->userdata('floristStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST));
        } else if ($this->session->userdata('selectCategory5') && $this->session->userdata('photographyStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY));
        } else if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
//            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_INSERT_ALL_EVENT_INFO));
        }
    }

    public function addDecorationInfo() {
        $data['recepStartDate'] = strtotime($this->input->post('recepStartDate'));
        $data['recepEndDate'] = strtotime($this->input->post('recepEndDate'));

        $startTime = $_POST['recepHours'] . ':' . $_POST['recepMinute'] . ' ' . $_POST['recepExt'];
        $endTime = $_POST['recepEndhours'] . ':' . $_POST['recepEndminute'] . ' ' . $_POST['recepEndext'];

        $data['recepStartTime'] = strtotime($startTime);
        $data['recepEndTime'] = strtotime($endTime);
        $data['recepDateFlexibl'] = $this->input->post('recepDateFlexibl');
        $data['recepGuestNumber'] = $this->input->post('recepGuestNumber');
        $data['recepService'] = $this->input->post('recepService');

        if (isset($_POST['amenitesTypes']) && !empty($_POST['amenitesTypes'])) {
            $data['amenitesTypes'] = implode(',', $_POST['amenitesTypes']);
        }

        if (isset($_POST['recepComments']) && $_POST['recepComments'] != '') {
            $data['recepComments'] = $_POST['recepComments'];
        }

        $data['receiptionStep'] = 'Done';
        $this->session->set_userdata($data);

        if ($this->session->userdata('selectCategory3') && $this->session->userdata('entertainmentStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ENTERTAINER));
        } else if ($this->session->userdata('selectCategory4') && $this->session->userdata('floristStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST));
        } else if ($this->session->userdata('selectCategory5') && $this->session->userdata('photographyStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY));
        } else if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
//            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_INSERT_ALL_EVENT_INFO));
        }
    }

    public function addEntertainerInfo() {
        $data['enterStartDate'] = strtotime($this->input->post('enterStartDate'));
        $data['enterEndDate'] = strtotime($this->input->post('enterEndDate'));

        $startTime = $_POST['enterhours'] . ':' . $_POST['enterminute'] . ' ' . $_POST['enterext'];
        $endTime = $_POST['enterEndhours'] . ':' . $_POST['enterEndminute'] . ' ' . $_POST['enterEndext'];

        $data['enterStartTime'] = strtotime($startTime);
        $data['enterEndTime'] = strtotime($endTime);

        $data['enterDateFlexibl'] = $this->input->post('enterDateFlexibl');
        $data['enterGuestNumber'] = $this->input->post('enterGuestNumber');
        $data['ageRange'] = $this->input->post('ageRange');
        $data['eventSetting'] = $this->input->post('eventSetting');
        $data['entertainmentBudget'] = $this->input->post('entertainmentBudget');

        if (isset($_POST['settingAdditional']) && $_POST['settingAdditional'] != '') {
            $data['settingAdditional'] = $_POST['settingAdditional'];
        }

        if (isset($_POST['entertainmentType']) && !empty($_POST['entertainmentType'])) {
            $data['entertainmentType'] = implode(',', $_POST['entertainmentType']);
        }

        if (isset($_POST['otherEntertainmentType']) && $_POST['otherEntertainmentType'] != '') {
            $data['otherEntertainmentType'] = $_POST['otherEntertainmentType'];
        }

        if (isset($_POST['entertainmentComment']) && $_POST['entertainmentComment'] != '') {
            $data['entertainmentComment'] = $_POST['entertainmentComment'];
        }

        $data['entertainmentStep'] = 'Done';
        $this->session->set_userdata($data);

        if ($this->session->userdata('selectCategory4') && $this->session->userdata('floristStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST));
        } else if ($this->session->userdata('selectCategory5') && $this->session->userdata('photographyStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY));
        } else if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
//            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_INSERT_ALL_EVENT_INFO));
        }
    }

    public function addFloristInfo() {
        $data['florStartDate'] = strtotime($this->input->post('florStartDate'));
        $data['florEndDate'] = strtotime($this->input->post('florEndDate'));

        $startTime = $_POST['florhours'] . ':' . $_POST['florminute'] . ' ' . $_POST['florext'];
        $endTime = $_POST['florEndhours'] . ':' . $_POST['florEndminute'] . ' ' . $_POST['florEndext'];

        $data['florStartTime'] = strtotime($startTime);
        $data['florEndTime'] = strtotime($endTime);

        $data['florDatesFlexibl'] = $this->input->post('florDatesFlexibl');
        $data['florGuestNumber'] = $this->input->post('florGuestNumber');
        $data['florService'] = $this->input->post('florService');
        $data['florBudget'] = $this->input->post('florBudget');


        if (isset($_POST['florFlowerType']) && !empty($_POST['florFlowerType'])) {
            $data['florFlowerType'] = implode(',', $_POST['florFlowerType']);
        }

        if (isset($_POST['florArrangementType']) && !empty($_POST['florArrangementType'])) {
            $data['florArrangementType'] = implode(',', $_POST['florArrangementType']);
        }

        if (isset($_POST['florDetails']) && !empty($_POST['florDetails'])) {
            $data['florDetails'] = implode('|', $_POST['florDetails']);
        }

        if (isset($_POST['florComments']) && $_POST['florComments'] != '') {
            $data['florComments'] = $_POST['florComments'];
        }

        $data['floristStep'] = 'Done';
        $this->session->set_userdata($data);

        if ($this->session->userdata('selectCategory5') && $this->session->userdata('photographyStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY));
        } else if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
//            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_INSERT_ALL_EVENT_INFO));
        }
    }

    public function addPhotographyInfo() {
        $data['photoStartDate'] = strtotime($this->input->post('photoStartDate'));
        $data['photoEndDate'] = strtotime($this->input->post('photoEndDate'));

        $startTime = $_POST['photohours'] . ':' . $_POST['photominute'] . ' ' . $_POST['photoext'];
        $endTime = $_POST['photoEndhours'] . ':' . $_POST['photoEndminute'] . ' ' . $_POST['photoEndext'];

        $data['photoStartTime'] = strtotime($startTime);
        $data['photoEndTime'] = strtotime($endTime);

        $data['photoDateFlexibl'] = $this->input->post('photoDateFlexibl');
        $data['photoGuestNumber'] = $this->input->post('photoGuestNumber');
        $data['photoStyle'] = $this->input->post('photoStyle');
        $data['photoSettingType'] = $this->input->post('photoSettingType');
        $data['photoBudget'] = $this->input->post('photoBudget');

        if (isset($_POST['PhotoLocation']) && $_POST['PhotoLocation'] != '') {
            $data['PhotoLocation'] = $_POST['PhotoLocation'];
        }
        if (isset($_POST['PhotoRequirements']) && $_POST['PhotoRequirements'] != '') {
            $data['PhotoRequirements'] = $_POST['PhotoRequirements'];
        }
        if (isset($_POST['photoComments']) && $_POST['photoComments'] != '') {
            $data['photoComments'] = $_POST['photoComments'];
        }

        $data['photographyStep'] = 'Done';
        $this->session->set_userdata($data);

        if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
//            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_INSERT_ALL_EVENT_INFO));
        }
    }

    public function addLiquorInfo() {
        $data['liqStartDate'] = strtotime($this->input->post('liqStartDate'));
        $data['liqEndDate'] = strtotime($this->input->post('liqEndDate'));

        $startTime = $_POST['liqhours'] . ':' . $_POST['liqminute'] . ' ' . $_POST['liqext'];
        $endTime = $_POST['liqEndhours'] . ':' . $_POST['liqEndminute'] . ' ' . $_POST['liqEndext'];

        $data['liqStartTime'] = strtotime($startTime);
        $data['liqEndTime'] = strtotime($endTime);


        $data['liqDateFlexibl'] = $this->input->post('liqDateFlexibl');
        $data['liqGuestNumber'] = $this->input->post('liqGuestNumber');
        $data['liqService'] = $this->input->post('liqService');
        $data['rentGlasses'] = $this->input->post('rentGlasses');

        if (isset($_POST['drinksType']) && !empty($_POST['drinksType'])) {
            $data['drinksType'] = implode(',', $_POST['drinksType']);
        }
        if (isset($_POST['glasseQuantity']) && $_POST['glasseQuantity'] != '') {
            $data['glasseQuantity'] = $_POST['glasseQuantity'];
        }
        if (isset($_POST['liqComments']) && $_POST['liqComments'] != '') {
            $data['liqComments'] = $_POST['liqComments'];
        }

        $data['liquorStep'] = 'Done';
//        debugPrint($data);
//        exit();
        $this->session->set_userdata($data);

        if ($this->session->userdata('selectCategory1') && $this->session->userdata('cateringStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_CATERER));
        } else if ($this->session->userdata('selectCategory2') && $this->session->userdata('receiptionStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_DECORATION));
        } else if ($this->session->userdata('selectCategory3') && $this->session->userdata('entertainmentStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ENTERTAINER));
        } else if ($this->session->userdata('selectCategory4') && $this->session->userdata('floristStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST));
        } else if ($this->session->userdata('selectCategory5') && $this->session->userdata('photographyStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY));
        } else if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') != 'Done') {
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
//            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_INSERT_ALL_EVENT_INFO));
        }
    }

    public function getCatererInfo($eventId = '') {
        $this->db->where(DBConfig::TABLE_CATERING_ATT_EVENT_INFO_ID, $eventId);
        $query = $this->db->get(DBConfig::TABLE_CATERING);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function getReceptionInfo($eventId = '') {
        $this->db->where(DBConfig::TABLE_RECEPTION_HALLS_ATT_EVENT_INFO_ID, $eventId);
        $query = $this->db->get(DBConfig::TABLE_RECEPTION_HALLS);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function getEntertainerInfo($eventId = '') {
        $this->db->where(DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_INFO_ID, $eventId);
        $query = $this->db->get(DBConfig::TABLE_ENTERTAINMENT);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function getFloristInfo($eventId = '') {
        $this->db->where(DBConfig::TABLE_FLORISTS_ATT_EVENT_INFO_ID, $eventId);
        $query = $this->db->get(DBConfig::TABLE_FLORISTS);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function getPhotographyInfo($eventId = '') {
        $this->db->where(DBConfig::TABLE_PHOTOGRAPHY_ATT_EVENT_INFO_ID, $eventId);
        $query = $this->db->get(DBConfig::TABLE_PHOTOGRAPHY);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function getLiquorInfo($eventId = '') {
        $this->db->where(DBConfig::TABLE_LIQUOR_ATT_EVENT_INFO_ID, $eventId);
        $query = $this->db->get(DBConfig::TABLE_LIQUOR);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function getVendorList() {
        $this->db->order_by(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, 'random');
        $this->db->limit(20);
        $query = $this->db->get(DBConfig::TABLE_VENDOR);
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function getHomeContent($contentName = '') {
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $contentName);
        $query = $this->db->get(DBConfig::TABLE_CONTENT);
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result[DBConfig::TABLE_CONTENT_ATT_CONTENT_DETAILS];
        }
    }

    public function deleteCateringService() {
        $data['catStartDate'] = FALSE;
        $data['catEndDate'] = FALSE;
        $data['catStartTime'] = FALSE;
        $data['catEndTime'] = FALSE;
        $data['catDateFlexibl'] = FALSE;
        $data['catGuestNumber'] = FALSE;
        $data['catService'] = FALSE;
        $data['catCuisine'] = FALSE;
        $data['catBudgetPerson'] = FALSE;
        $data['otherCatCuisine'] = FALSE;
        $data['catCourses'] = FALSE;
        $data['catEquipment'] = FALSE;
        $data['catAddServices'] = FALSE;
        $data['otherCatServices'] = FALSE;
        $data['catHaveLocation'] = FALSE;
        $data['otherEquipment'] = FALSE;
        $data['catVenue'] = FALSE;
        $data['catKitchen'] = FALSE;
        $data['catComments'] = FALSE;
        $data['cateringStep'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function deleteReceptionService() {
        $data['recepStartDate'] = FALSE;
        $data['recepEndDate'] = FALSE;
        $data['recepStartTime'] = FALSE;
        $data['recepEndTime'] = FALSE;
        $data['recepDateFlexibl'] = FALSE;
        $data['recepGuestNumber'] = FALSE;
        $data['recepService'] = FALSE;
        $data['amenitesTypes'] = FALSE;
        $data['recepComments'] = FALSE;
        $data['receiptionStep'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function deleteEntertainmentService() {
        $data['enterStartDate'] = FALSE;
        $data['enterEndDate'] = FALSE;
        $data['enterStartTime'] = FALSE;
        $data['enterEndTime'] = FALSE;
        $data['enterDateFlexibl'] = FALSE;
        $data['enterGuestNumber'] = FALSE;
        $data['ageRange'] = FALSE;
        $data['eventSetting'] = FALSE;
        $data['entertainmentBudget'] = FALSE;
        $data['settingAdditional'] = FALSE;
        $data['entertainmentType'] = FALSE;
        $data['otherEntertainmentType'] = FALSE;
        $data['entertainmentComment'] = FALSE;
        $data['entertainmentStep'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function deleteFloristsService() {
        $data['florStartDate'] = FALSE;
        $data['florEndDate'] = FALSE;
        $data['florStartTime'] = FALSE;
        $data['florEndTime'] = FALSE;
        $data['florDatesFlexibl'] = FALSE;
        $data['florGuestNumber'] = FALSE;
        $data['florService'] = FALSE;
        $data['florBudget'] = FALSE;
        $data['florFlowerType'] = FALSE;
        $data['florArrangementType'] = FALSE;
        $data['florDetails'] = FALSE;
        $data['florComments'] = FALSE;
        $data['floristStep'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function deletePhotographyService() {
        $data['photoStartDate'] = FALSE;
        $data['photoEndDate'] = FALSE;
        $data['photoStartTime'] = FALSE;
        $data['photoEndTime'] = FALSE;
        $data['photoDateFlexibl'] = FALSE;
        $data['photoGuestNumber'] = FALSE;
        $data['photoStyle'] = FALSE;
        $data['photoSettingType'] = FALSE;
        $data['photoBudget'] = FALSE;
        $data['PhotoLocation'] = FALSE;
        $data['PhotoRequirements'] = FALSE;
        $data['photoComments'] = FALSE;
        $data['photographyStep'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function deleteLiquorService() {
        $data['liqStartDate'] = FALSE;
        $data['liqEndDate'] = FALSE;
        $data['liqStartTime'] = FALSE;
        $data['liqEndTime'] = FALSE;
        $data['liqDateFlexibl'] = FALSE;
        $data['liqGuestNumber'] = FALSE;
        $data['liqService'] = FALSE;
        $data['rentGlasses'] = FALSE;
        $data['drinksType'] = FALSE;
        $data['glasseQuantity'] = FALSE;
        $data['liqComments'] = FALSE;
        $data['liquorStep'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function deleteEventInfo() {
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE] = FALSE;
        $data['eventInfoId'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function insertAllEventInfo() {
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID] = $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE] = $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY] = $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] = $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID] = $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID] = $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID);
        if ($this->session->userdata('eventInfoId')) {
            $this->db->where(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID, $this->session->userdata('eventInfoId'));
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_EVENT_INFO);

            if ($this->session->userdata('selectCategory1') && $this->session->userdata('cateringStep') == 'Done') {
                $this->insertCateringInfo($this->session->userdata('eventInfoId'));
            } else if ($this->session->userdata('selectCategory2') && $this->session->userdata('receiptionStep') == 'Done') {
                $this->insertReceptionInfo($this->session->userdata('eventInfoId'));
            } else if ($this->session->userdata('selectCategory3') && $this->session->userdata('entertainmentStep') == 'Done') {
                $this->insertEntertainmentInfo($this->session->userdata('eventInfoId'));
            } else if ($this->session->userdata('selectCategory4') && $this->session->userdata('floristStep') == 'Done') {
                $this->insertFloristInfo($this->session->userdata('eventInfoId'));
            } else if ($this->session->userdata('selectCategory5') && $this->session->userdata('photographyStep') == 'Done') {
                $this->insertPhotograperInfo($this->session->userdata('eventInfoId'));
            } else if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') == 'Done') {
                $this->insertLiquorInfo($this->session->userdata('eventInfoId'));
            }
            $datas['eventSuccess'] = TRUE;
            $this->session->set_userdata($datas);
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        } else {
            $data[DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE] = $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE);

            $insert = $this->db->insert(DBConfig::TABLE_EVENT_INFO, $data);
            $eventInfoId = $this->db->insert_id();

            $datas['eventInfoId'] = $eventInfoId;
            $datas['eventSuccess'] = TRUE;
            $this->session->set_userdata($datas);

            if ($insert) {
                $serviceArray = array();

                if ($this->session->userdata('selectCategory1') && $this->session->userdata('cateringStep') == 'Done') {
                    array_push($serviceArray, '1');
                    $this->insertCateringInfo($eventInfoId);
                } else if ($this->session->userdata('selectCategory2') && $this->session->userdata('receiptionStep') == 'Done') {
                    array_push($serviceArray, '2');
                    $this->insertReceptionInfo($eventInfoId);
                } else if ($this->session->userdata('selectCategory3') && $this->session->userdata('entertainmentStep') == 'Done') {
                    array_push($serviceArray, '3');
                    $this->insertEntertainmentInfo($eventInfoId);
                } else if ($this->session->userdata('selectCategory4') && $this->session->userdata('floristStep') == 'Done') {
                    array_push($serviceArray, '4');
                    $this->insertFloristInfo($eventInfoId);
                } else if ($this->session->userdata('selectCategory5') && $this->session->userdata('photographyStep') == 'Done') {
                    array_push($serviceArray, '5');
                    $this->insertPhotograperInfo($eventInfoId);
                } else if ($this->session->userdata('selectCategory6') && $this->session->userdata('liquorStep') == 'Done') {
                    array_push($serviceArray, '6');
                    $this->insertLiquorInfo($eventInfoId);
                }

                $this->sendQuoteMailToVendor($serviceArray);

                redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
            }
        }
    }

    public function insertCateringInfo($eventInfoId = '') {
        $data[DBConfig::TABLE_CATERING_ATT_EVENT_START_DATE] = $this->session->userdata('catStartDate');
        $data[DBConfig::TABLE_CATERING_ATT_EVENT_END_DATE] = $this->session->userdata('catEndDate');
        $data[DBConfig::TABLE_CATERING_ATT_APPROX_START_TIME] = $this->session->userdata('catStartTime');
        $data[DBConfig::TABLE_CATERING_ATT_APPROX_END_TIME] = $this->session->userdata('catEndTime');
        $data[DBConfig::TABLE_CATERING_ATT_DATES_FLEXIBLE] = $this->session->userdata('catDateFlexibl');
        $data[DBConfig::TABLE_CATERING_ATT_GUESTS_NUMBER] = $this->session->userdata('catGuestNumber');
        $data[DBConfig::TABLE_CATERING_ATT_SERVICE_ID] = $this->session->userdata('catService');
        $data[DBConfig::TABLE_CATERING_ATT_FOOD_TYPE_ID] = $this->session->userdata('catCuisine');
        $data[DBConfig::TABLE_CATERING_ATT_OTHERS_FOOD_TYPE] = $this->session->userdata('otherCatCuisine');
        $data[DBConfig::TABLE_CATERING_ATT_COURSES] = $this->session->userdata('catCourses');
        $data[DBConfig::TABLE_CATERING_ATT_EQUIPMENT] = $this->session->userdata('catEquipment');
        $data[DBConfig::TABLE_CATERING_ATT_OTHER_EQUIPMENT] = $this->session->userdata('otherEquipment');
        $data[DBConfig::TABLE_CATERING_ATT_ADDITIONAL_SERVICES] = $this->session->userdata('catAddServices');
        $data[DBConfig::TABLE_CATERING_ATT_OTHER_ADDITIONAL_SERVICES] = $this->session->userdata('otherCatServices');
        $data[DBConfig::TABLE_CATERING_ATT_SET_EVENT_LOCATION] = $this->session->userdata('catHaveLocation');
        $data[DBConfig::TABLE_CATERING_ATT_VENUE_TYPE_ID] = $this->session->userdata('catVenue');
        $data[DBConfig::TABLE_CATERING_ATT_KITCHEN_AVAILABLITY] = $this->session->userdata('catKitchen');
        $data[DBConfig::TABLE_CATERING_ATT_BUDGET_PER_PERSON_ID] = $this->session->userdata('catBudgetPerson');
        $data[DBConfig::TABLE_CATERING_ATT_ADDITIONAL_COMMENTS] = $this->session->userdata('catComments');

        $data[DBConfig::TABLE_CATERING_ATT_EVENT_INFO_ID] = $eventInfoId;

        $this->db->where(DBConfig::TABLE_CATERING_ATT_EVENT_INFO_ID, $eventInfoId);
        $query = $this->db->get(DBConfig::TABLE_CATERING);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_CATERING_ATT_EVENT_INFO_ID, $eventInfoId);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_CATERING);
        } else {
            $this->db->insert(DBConfig::TABLE_CATERING, $data);
        }
    }

    public function insertReceptionInfo($eventInfoId = '') {
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_EVENT_START_DATE] = $this->session->userdata('recepStartDate');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_EVENT_END_DATE] = $this->session->userdata('recepEndDate');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_APPROX_START_TIME] = $this->session->userdata('recepStartTime');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_APPROX_END_TIME] = $this->session->userdata('recepEndTime');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_DATE_FLEXIBLE] = $this->session->userdata('recepDateFlexibl');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_GUESTS_NUMBER] = $this->session->userdata('recepGuestNumber');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_SERVICE_ID] = $this->session->userdata('recepService');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_AMENITIES_TYPE] = $this->session->userdata('amenitesTypes');
        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_ADDITIONAL_COMMENTS] = $this->session->userdata('recepComments');

        $data[DBConfig::TABLE_RECEPTION_HALLS_ATT_EVENT_INFO_ID] = $eventInfoId;

        $this->db->where(DBConfig::TABLE_RECEPTION_HALLS_ATT_EVENT_INFO_ID, $eventInfoId);
        $query = $this->db->get(DBConfig::TABLE_RECEPTION_HALLS);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_RECEPTION_HALLS_ATT_EVENT_INFO_ID, $eventInfoId);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_RECEPTION_HALLS);
        } else {
            $this->db->insert(DBConfig::TABLE_RECEPTION_HALLS, $data);
        }
    }

    public function insertEntertainmentInfo($eventInfoId = '') {
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_START_DATE] = $this->session->userdata('enterStartDate');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_END_DATE] = $this->session->userdata('enterEndDate');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_APPROX_START_TIME] = $this->session->userdata('enterStartTime');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_APPROX_END_TIME] = $this->session->userdata('enterEndTime');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_DATE_FLEXIBLE] = $this->session->userdata('enterDateFlexibl');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_GUESTS_NUMBER] = $this->session->userdata('enterGuestNumber');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_AGE_RANGE_ID] = $this->session->userdata('ageRange');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_SETTING] = $this->session->userdata('eventSetting');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_BUDGET_ID] = $this->session->userdata('entertainmentBudget');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_SETTING_ADDITIONAL] = $this->session->userdata('settingAdditional');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_TYPE] = $this->session->userdata('entertainmentType');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_OTHER_ENTERTAINMENT] = $this->session->userdata('otherEntertainmentType');
        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_ADDITIONAL_COMMENTS] = $this->session->userdata('entertainmentComment');

        $data[DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_INFO_ID] = $eventInfoId;

        $this->db->where(DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_INFO_ID, $eventInfoId);
        $query = $this->db->get(DBConfig::TABLE_ENTERTAINMENT);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_INFO_ID, $eventInfoId);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_ENTERTAINMENT);
        } else {
            $this->db->insert(DBConfig::TABLE_ENTERTAINMENT, $data);
        }
    }

    public function insertFloristInfo($eventInfoId = '') {
        $data[DBConfig::TABLE_FLORISTS_ATT_EVENT_START_DATE] = $this->session->userdata('florStartDate');
        $data[DBConfig::TABLE_FLORISTS_ATT_EVENT_END_DATE] = $this->session->userdata('florEndDate');
        $data[DBConfig::TABLE_FLORISTS_ATT_APPROX_START_TIME] = $this->session->userdata('florStartTime');
        $data[DBConfig::TABLE_FLORISTS_ATT_APPROX_END_TIME] = $this->session->userdata('florEndTime');
        $data[DBConfig::TABLE_FLORISTS_ATT_DATE_FLEXIBLE] = $this->session->userdata('florDatesFlexibl');
        $data[DBConfig::TABLE_FLORISTS_ATT_GUESTS_NUMBER] = $this->session->userdata('florGuestNumber');
        $data[DBConfig::TABLE_FLORISTS_ATT_FLORISTS_SERVICE] = $this->session->userdata('florService');
        $data[DBConfig::TABLE_FLORISTS_ATT_FLORIST_BUDGET_ID] = $this->session->userdata('florBudget');
        $data[DBConfig::TABLE_FLORISTS_ATT_FLOWER_TYPE] = $this->session->userdata('florFlowerType');
        $data[DBConfig::TABLE_FLORISTS_ATT_ARRANGEMENT_TYPE] = $this->session->userdata('florArrangementType');
        $data[DBConfig::TABLE_FLORISTS_ATT_FLOWERS_DETAILS] = $this->session->userdata('florDetails');
        $data[DBConfig::TABLE_FLORISTS_ATT_ADDITIONAL_COMMENT] = $this->session->userdata('florComments');

        $data[DBConfig::TABLE_FLORISTS_ATT_EVENT_INFO_ID] = $eventInfoId;

        $this->db->where(DBConfig::TABLE_FLORISTS_ATT_EVENT_INFO_ID, $eventInfoId);
        $query = $this->db->get(DBConfig::TABLE_FLORISTS);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_FLORISTS_ATT_EVENT_INFO_ID, $eventInfoId);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_FLORISTS);
        } else {
            $this->db->insert(DBConfig::TABLE_FLORISTS, $data);
        }
    }

    public function insertPhotograperInfo($eventInfoId = '') {
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_EVENT_START_DATE] = $this->session->userdata('photoStartDate');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_EVENT_END_DATE] = $this->session->userdata('photoEndDate');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_APPROX_START_TIME] = $this->session->userdata('photoStartTime');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_APPROX_END_TIME] = $this->session->userdata('photoEndTime');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_DATE_FLEXIBLE] = $this->session->userdata('photoDateFlexibl');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_GUESTS_NUMBER] = $this->session->userdata('photoGuestNumber');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_STYLE_ID] = $this->session->userdata('photoStyle');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_SETTING_TYPE] = $this->session->userdata('photoSettingType');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_BUDGET_ID] = $this->session->userdata('photoBudget');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_SETTING_LOCATION] = $this->session->userdata('PhotoLocation');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_REQUIRMENTS] = $this->session->userdata('PhotoRequirements');
        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_ADDITIONAL_COMMENT] = $this->session->userdata('photoComments');

        $data[DBConfig::TABLE_PHOTOGRAPHY_ATT_EVENT_INFO_ID] = $eventInfoId;

        $this->db->where(DBConfig::TABLE_PHOTOGRAPHY_ATT_EVENT_INFO_ID, $eventInfoId);
        $query = $this->db->get(DBConfig::TABLE_PHOTOGRAPHY);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_PHOTOGRAPHY_ATT_EVENT_INFO_ID, $eventInfoId);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_PHOTOGRAPHY);
        } else {
            $this->db->insert(DBConfig::TABLE_PHOTOGRAPHY, $data);
        }
    }

    public function insertLiquorInfo($eventInfoId = '') {
        $data[DBConfig::TABLE_LIQUOR_ATT_EVENT_START_DATE] = $this->session->userdata('liqStartDate');
        $data[DBConfig::TABLE_LIQUOR_ATT_EVENT_END_DATE] = $this->session->userdata('liqEndDate');
        $data[DBConfig::TABLE_LIQUOR_ATT_APPROX_START_TIME] = $this->session->userdata('liqStartTime');
        $data[DBConfig::TABLE_LIQUOR_ATT_APPROX_END_TIME] = $this->session->userdata('liqEndTime');
        $data[DBConfig::TABLE_LIQUOR_ATT_DATE_FLEXIBLE] = $this->session->userdata('liqDateFlexibl');
        $data[DBConfig::TABLE_LIQUOR_ATT_GUESTS_NUMBER] = $this->session->userdata('liqGuestNumber');
        $data[DBConfig::TABLE_LIQUOR_ATT_SERVICE_ID] = $this->session->userdata('liqService');
        $data[DBConfig::TABLE_LIQUOR_ATT_RENT_GLASSES] = $this->session->userdata('rentGlasses');
        $data[DBConfig::TABLE_LIQUOR_ATT_DRINK_TYPES] = $this->session->userdata('drinksType');
        $data[DBConfig::TABLE_LIQUOR_ATT_GLASSES_QUANTITY] = $this->session->userdata('glasseQuantity');
        $data[DBConfig::TABLE_LIQUOR_ATT_ADDITIONAL_COMMENT] = $this->session->userdata('liqComments');

        $data[DBConfig::TABLE_LIQUOR_ATT_EVENT_INFO_ID] = $eventInfoId;

        $this->db->where(DBConfig::TABLE_LIQUOR_ATT_EVENT_INFO_ID, $eventInfoId);
        $query = $this->db->get(DBConfig::TABLE_LIQUOR);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_LIQUOR_ATT_EVENT_INFO_ID, $eventInfoId);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_LIQUOR);
        } else {
            $this->db->insert(DBConfig::TABLE_LIQUOR, $data);
        }
    }

    public function sendQuoteMailToVendor($serviceArray) {
        if ($this->session->userdata('vendorid')) {
            $vendorId = $this->session->userdata('vendorid');
            $vendorArray = array();
           
            $sql = 'SELECT * FROM ' . DBConfig::TABLE_VENDOR 
                    . ' WHERE ' . DBConfig::TABLE_VENDOR_ATT_VENDOR_ID . ' = "' . $vendorId . '"';

            $result1 = $this->db->query($sql)->row_array();
            
            if ($result1[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID] == true) {
                $vendorArray[] = $result1[DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL];
            }
        } else {
            $result = $this->db->get(DBConfig::TABLE_VENDOR)->result_array();

            $data = array();

            foreach ($result as $row) {
                $servicesList = json_decode($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_SERVICES]);

                $sresult = array_intersect($servicesList, $serviceArray);

                if (!empty($sresult)) {
                    array_push($data, $row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
                }
            }

            //debugPrint($data);

            $vendorArray = array();
            foreach ($data as $vendorId) {
                $sql = 'SELECT ' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . ', AVG(' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_RATING . ') AS Rating,' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL . '
                FROM ' . DBConfig::TABLE_VENDOR_RATING . '
                LEFT JOIN ' . DBConfig::TABLE_VENDOR . ' ON ' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_ID . ' = ' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . '
                WHERE ' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . ' = ("' . $vendorId . '")';

                $result1 = $this->db->query($sql)->row_array();

                if ($result1[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] == true && $result1['Rating'] == true) {

                    $vendorArray[] = $result1[DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL];
                }
            }
        }
        
        usort($vendorArray, 'compareArray');

        $emailList = array();

        $i = 0;

        foreach ($vendorArray as $val) {
            array_push($emailList, $val);
            $i++;

            if ($i == 10) {
                break;
            }
        }

        //debugPrint($emailList);
        $this->db->where(DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_ID, "1");
        $emailTemplate = $this->db->get(DBConfig::TABLE_EMAIL_TEMPLATE)->row_array();


        foreach ($emailList as $name => $address) {

            $body = $emailTemplate[DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_TITLE];
            $body.= 'Dear ' . strstr($address, '@', true);
            $body.= $emailTemplate[DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_DETAILS];
            $body.= $emailTemplate[DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_FOOTER_TXT];

            $this->email->clear();

            $this->email->to($address);
            $this->email->from('support@directory.com');
            $this->email->subject('New Quote Email');
            $this->email->message($body);
            $this->email->send();

            //echo $body;
        }
    }
    
    public function getHomeContentStaus(){
        $query = $this->db->get(DBConfig::TABLE_SETTINGS);
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result[DBConfig::TABLE_SETTINGS_ATT_HIDE_HOME_CONTENT];
        }
    }

}