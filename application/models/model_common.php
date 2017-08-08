<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Common extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllCity() {
        return $this->db->get(DBConfig::TABLE_CITY)->result_array();
    }

    public function getAllCategory() {
        return $this->db->get(DBConfig::TABLE_CATEGORY)->result_array();
    }

    public function getAllEventType() {
        return $this->db->get(DBConfig::TABLE_EVENT_TYPE)->result_array();
    }

    public function getVenueBudget() {
        return $this->db->get(DBConfig::TABLE_VENUE_BUDGET)->result_array();
    }

    public function getVenueType() {
        return $this->db->get(DBConfig::TABLE_VENUE_TYPE)->result_array();
    }

    public function getAmenitiesType() {
        return $this->db->get(DBConfig::TABLE_AMENITIES_TYPE)->result_array();
    }

    public function getUserDetails($id=0) {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $id);
        return $this->db->get(DBConfig::TABLE_USER)->row_array();
    }

    public function getFAQ() {
        return $this->db->get(DBConfig::TABLE_FAQ)->result_array();
    }

    public function getAllState() {
        return $this->db->get(DBConfig::TABLE_STATE)->result_array();
    }

    public function getCityNameById($id) {
        $this->db->where(DBConfig::TABLE_CITY_ATT_CITY_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_CITY)->row_array();
        return $result[DBConfig::TABLE_CITY_ATT_CITY_NAME];
    }

    public function getAllServiceList() {
        return $this->db->get(DBConfig::TABLE_SERVICE_LIST)->result_array();
    }

    public function gerServiceListNameById($id) {
        $this->db->where(DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_SERVICE_LIST)->row_array();
        return $result[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_NAME];
    }

    public function getAllService() {
        return $this->db->get(DBConfig::TABLE_SERVICE)->result_array();
    }

    public function getAllAgeRange() {
        return $this->db->get(DBConfig::TABLE_AGE_RANGE)->result_array();
    }

    public function getAllEntertainmentTypes() {
        return $this->db->get(DBConfig::TABLE_ENTERTAINMENT_TYPE)->result_array();
    }

    public function getAllEntertainmentBudget() {
        return $this->db->get(DBConfig::TABLE_ENTERTAINMENT_BUDGET)->result_array();
    }

    public function getStateByCountryId($countryId) {
        $this->db->where(DBConfig::TABLE_STATE_ATT_COUNTRY_ID, $countryId);
        return $this->db->get(DBConfig::TABLE_STATE)->result_array();
    }

    public function getAllFoodTypes() {
        return $this->db->get(DBConfig::TABLE_FOOD_TYPE)->result_array();
    }

    public function getAllEquipment() {
        return $this->db->get(DBConfig::TABLE_EQUIPMENT)->result_array();
    }

    public function getAllAdditionalServices() {
        return $this->db->get(DBConfig::TABLE_ADDITIONAL_SERVICE)->result_array();
    }

    public function getBudgetPetPerson() {
        return $this->db->get(DBConfig::TABLE_BUDGET_PER_PERSON)->result_array();
    }

    public function getAllFlowerType() {
        return $this->db->get(DBConfig::TABLE_FLOWERS_TYPE)->result_array();
    }

    public function getAllArrangementType() {
        return $this->db->get(DBConfig::TABLE_ARRANGMENT_TYPE)->result_array();
    }

    public function getStateNameById($stateId=0) {
        $this->db->where(DBConfig::TABLE_STATE_ATT_STATE_ID, $stateId);
        $result = $this->db->get(DBConfig::TABLE_STATE)->row_array();
        return $result[DBConfig::TABLE_STATE_ATT_STATE_NAME];
    }

    public function getCategoryNameById($catId) {
        $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $catId);
        $result = $this->db->get(DBConfig::TABLE_CATEGORY)->row_array();
        return $result[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME];
    }

    public function getSitParameter() {
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_EMAIL);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_PHONE);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_HIDE_HOME_CONTENT);

        return $this->db->get(DBConfig::TABLE_SETTINGS)->row_array();
    }

    public function getAllVendor() {
        return $this->db->get(DBConfig::TABLE_VENDOR)->result_array();
    }

    public function getVendorDetails($id=0) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $id);

        $result = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();
        $result['servicename'] = $this->vendorServiceList($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_SERVICES]);
        if ($this->session->userdata('userId'))
            $result['favoriteStatus'] = $this->getFavouriteStatus($this->session->userdata('userId'));
        $result['allreadyrated'] = $this->getUserAllReadyRated($id, $this->session->userdata('userId'));
        return $result;
    }

    public function getUserAllReadyRated($vendorId, $userId) {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, $vendorId);
        $result = $this->db->get(DBConfig::TABLE_VENDOR_RATING)->row_array();

        if (!empty($result)) {
            return '1';
        } else {
            return '0';
        }
    }

    public function getAllPhotoService() {
        return $this->db->get(DBConfig::TABLE_PHOTOGRAPHY_STYLE)->result_array();
    }

    public function getAllServiceBudget() {
        return $this->db->get(DBConfig::TABLE_SERVICE_BUDGET)->result_array();
    }

    public function getAllDrinksType() {
        return $this->db->get(DBConfig::TABLE_DRINKS_TYPE)->result_array();
    }

    public function getFoodTypeByTypeId($id=0) {
        $this->db->where(DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_FOOD_TYPE)->row_array();

        return $result[DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE];
    }

    public function getEquipmentNameById($id=0) {
        $this->db->where(DBConfig::TABLE_EQUIPMENT_ATT_EQUIPMENT_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_EQUIPMENT)->row_array();

        return $result[DBConfig::TABLE_EQUIPMENT_ATT_EQUIPMENT_NAME];
    }

    public function getVenuementNameById($id=0) {
        $this->db->where(DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_VENUE_TYPE)->row_array();

        return $result[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE];
    }

    public function getAmenitiesTypeNameById($id=0) {
        $this->db->where(DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_AMENITIES_TYPE)->row_array();

        return $result[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE];
    }

    public function getServiceNameById($id=0) {
        $this->db->where(DBConfig::TABLE_SERVICE_ATT_SERVICE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_SERVICE)->row_array();

        return $result[DBConfig::TABLE_SERVICE_ATT_SERVICE];
    }

    public function getAgeRangeById($id) {
        $this->db->where(DBConfig::TABLE_AGE_RANGE_ATT_AGE_RANGE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_AGE_RANGE)->row_array();

        return $result[DBConfig::TABLE_AGE_RANGE_ATT_AGE_RANGE];
    }

    public function getEntertainmentTypeNameById($id) {
        $this->db->where(DBConfig::TABLE_ENTERTAINMENT_TYPE_ATT_ENTERTAINMENT_TYPE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_ENTERTAINMENT_TYPE)->row_array();

        return $result[DBConfig::TABLE_ENTERTAINMENT_TYPE_ATT_ENTERTAINMENT_TYPE];
    }

    public function getFlowerTypeNameById($id) {
        $this->db->where(DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_FLOWERS_TYPE)->row_array();
        //debugPrint($result);
        return $result[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE];
    }

    public function getArrangementTypeNameById($id) {
        $this->db->where(DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_ARRANGMENT_TYPE)->row_array();
        //debugPrint($result);
        return $result[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE];
    }

    public function getPhotographyStyleNameById($id) {
        $this->db->where(DBConfig::TABLE_PHOTOGRAPHY_STYLE_ATT_STYLE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_PHOTOGRAPHY_STYLE)->row_array();
        //debugPrint($result);
        return $result[DBConfig::TABLE_PHOTOGRAPHY_STYLE_ATT_STYLE];
    }

    public function getDrinkTypeNameById($id) {
        $this->db->where(DBConfig::TABLE_DRINKS_TYPE_ATT_DRINKS_TYPE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_DRINKS_TYPE)->row_array();
        //debugPrint($result);
        return $result[DBConfig::TABLE_DRINKS_TYPE_ATT_DRINKS_TYPE];
    }

    public function isServiceBookmarked($serviceid, $eventsid, $servicelistId, $userid) {
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID, $serviceid);
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_EVENTS_INFO_ID, $eventsid);
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_LIST_ID, $servicelistId);
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_VENDOR_ID, $userid);

        $result = $this->db->get(DBConfig::TABLE_BOOKMARK)->row_array();

        //echo $this->db->last_query();

        if (!empty($result)) {
            return '1';
        } else {
            return '0';
        }
    }

    private function getFavouriteStatus($userId = 0) {
        $this->db->where(DBConfig::TABLE_FAVORITE_ATT_USER_ID, $userId);
        $query = $this->db->get(DBConfig::TABLE_FAVORITE);
        return $query->num_rows();
    }

    public function getVendorNameById($vendorId = 0) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $vendorId);
        $result = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();
        return $result[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME];
    }

    public function getEventInfoDetailsId($id = 0) {
        $this->db->where(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_EVENT_INFO)->row_array();
        return $result;
    }

    public function getVendorRating($vendorId = 0) {
        $this->db->select_avg(DBConfig::TABLE_VENDOR_RATING_ATT_RATING);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, $vendorId);
        $query = $this->db->get(DBConfig::TABLE_VENDOR_RATING);
        $result = $query->row_array();
        if ($result[DBConfig::TABLE_VENDOR_RATING_ATT_RATING] != '') {
            return $result[DBConfig::TABLE_VENDOR_RATING_ATT_RATING];
        } else {
            return '0.00';
        }
    }

    public function vendorServiceList($jsonObject) {
        $data = array();

        foreach (json_decode($jsonObject) as $value) {
            array_push($data, getCategoryNameById($value));
        }

        return $data;
    }

    public function getDefaultVendorLogo() {
        $result = $this->db->get(DBConfig::TABLE_SETTINGS)->row_array();

        return $result[DBConfig::TABLE_SETTINGS_ATT_SITE_VENDOR_LOGO];
    }

    public function getFormatedServices($array) {
        $cat = array();

        foreach ($array as $key => $v) {
            $cat[] = getCategoryNameById($v);
        }

        $string = "";
        $fstring = "";
        $lstring = "";

        echo sizeof($cat);

        foreach ($cat as $key => $val) {
            if (sizeof($cat) > 2) {
                if ($key == (sizeof($cat) - 1)) {
                    $lstring.= " and " . $val;
                }
                else{
                    $fstring.= $val.",";
                }
                
                $result = substr($fstring, 0, (strlen($fstring) - 1)).$lstring;
                
            }
            else{
                $string.=$val . ' and ';
                $result = substr($string, 0, (strlen($string) - 4));
            }
        }

        $string = $result;

        return $string;
    }

}
