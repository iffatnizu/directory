<?php

/**
 * @author Iffat Nizu
 * @package directory
 * @name function debugPrint()
 * @param string $object
 * @param string $title
 * @param boolean $isMarkup
 * @uses for debug print
 * @return  
 */
function debugPrint($object, $title = "", $isMarkup = false) {
    echo '<font color="red">Debug <<< START';
    if (!empty($title)) {
        echo "$title: ";
    }
    if ($isMarkup == false) {
        echo "<pre>";
        print_r($object);
        echo "</pre>";
    } else {
        echo htmlspecialchars($object);
    }
    echo 'END >>></font>';
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getEventInfoDetailsId()
 * @param int $id
 * @uses for getting event info detail id by id
 * @return int 
 */
function getStateByCountryId($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getStateByCountryId($id);
}

function getAllCity() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllCity();
}

function getAllCategory() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllCategory();
}

function getAllEventType() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllEventType();
}

function getVenueBudget() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getVenueBudget();
}

function getVenueType() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getVenueType();
}

function getAmenitiesType() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAmenitiesType();
}

function getUserDetails($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getUserDetails($id);
}

/**
 * @package directory
 * @access public
 * @name function c()
 * @uses for en coding string helper 
 * @return string 
 */
function c() {
    $base = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return $base[rand(0, strlen($base))];
}

/**
 * @package directory
 * @access public
 * @name function toBase()
 * @uses for encoding number to string helper function
 * @return string 
 */
function toBase($num) {

    $base = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    ;

    $b = strlen($base);
    $r = $num % $b;
    $res = $base[$r];
    $q = floor($num / $b);
    while ($q) {
        $r = $q % $b;
        $q = floor($q / $b);
        $res = $base[$r] . $res;
    }
    switch (strlen($res)) {
        case 1: $res = "~" . c() . c() . $res;
            break;
        case 2: $res = "!" . c() . $res;
            break;
        case 3: $res = "_" . $res;
            break;
    }
    return $res;
}

/**
 * @author Iffat Nizu
 * @package directory
 * @access public
 * @name function to10()
 * @uses for encoding string to number helper function
 * @return int 
 */
function to10($num) {
    $base = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    $b = strlen($base);
    switch ($num[0]) {
        case "~": $num = substr($num, 3);
            break;
        case "!": $num = substr($num, 2);
            break;
        case "_": $num = substr($num, 1);
            break;
    }
    $limit = strlen($num);
    $res = strpos($base, $num[0]);
    for ($i = 1; $i < $limit; $i++)
        $res = $b * $res + strpos($base, $num[$i]);
    return $res;
}

/**
 * @author Iffat Nizu
 * @package directory
 * @access public
 * @name function getFAQ()
 * @uses for getting faq page details from database
 * @return array 
 */
function getFAQ() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getFAQ();
}

function getAllState() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllState();
}

function getCityNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getCityNameById($id);
}

function getAllServiceList() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllServiceList();
}

function gerServiceListNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->gerServiceListNameById($id);
}

function getAllService() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllService();
}

function getAllAgeRange() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllAgeRange();
}

function getAllEntertainmentTypes() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllEntertainmentTypes();
}

function getAllEntertainmentBudget() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllEntertainmentBudget();
}

function getAllFoodTypes() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllFoodTypes();
}

function getAllEquipment() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllEquipment();
}

function getAllAdditionalServices() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllAdditionalServices();
}

function getBudgetPetPerson() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getBudgetPetPerson();
}

function getAllFlowerType() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllFlowerType();
}

function getAllArrangementType() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllArrangementType();
}

function getStateNameById($id=0) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getStateNameById($id);
}

function getCategoryNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getCategoryNameById($id);
}

function getSitParameter() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getSitParameter();
}

function getAllVendor() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllVendor();
}

function getVendorDetails($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getVendorDetails($id);
}

function getAllPhotoService() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllPhotoService();
}

function getAllServiceBudget() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllServiceBudget();
}

function getAllDrinksType() {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAllDrinksType();
}

/**
 * @author Iffat Nizu
 * @uses  decode the hex string to its orginal formate
 * @access public 
 * @param type $x
 * @return string
 */
function cpr_decode($x) {
    $s = '';
    foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
        $s.=chr(hexdec($h));
    return($s);
}

/**
 * @author Iffat Nizu
 * @uses  encode the string to hex formate
 * @access public 
 * @param type $x
 * @return string
 */
function cpr_encode($x) {
    $s = '';
    foreach (str_split($x) as $c)
        $s.=sprintf("%02X", ord($c));
    return($s);
}

function makeSeoFriendlyUrl($data) {
    $filter1 = strtolower(str_replace(" ", "-", $data));
    $filter2 = str_replace("&", "", $filter1);
    $filter3 = str_replace("--", "-", $filter2);
    $filter4 = str_replace("'", "", $filter3);
    $filter5 = str_replace(".", "", $filter4);
    $filter6 = str_replace("%", "-", $filter5);

    return $filter6;
}

function getVendorNameById($id=0) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getVendorNameById($id);
}

function getVendorRating($id=0) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getVendorRating($id);
}

function allmonth() {
    $month = array(
        "01" => "Jan",
        "02" => "Feb",
        "03" => "Mar",
        "04" => "Apr",
        "05" => "May",
        "06" => "Jun",
        "07" => "July",
        "08" => "Aug",
        "09" => "Sep",
        "10" => "Oct",
        "11" => "Nov",
        "12" => "Dec"
    );

    return $month;
}

/**
 * @author Iffat Nizu
 * @uses  generate rating star using rating point 
 * @access public 
 * @param type $totalvalue
 * @param type $totalvotes
 * @return str
 */
function getRatingBar($totalvalue = 0) {
    $units = 5;
    $rating_unitwidth = 30;
    $current_rating = $totalvalue;


    $rating_width = @number_format($current_rating, 2) * $rating_unitwidth;
    //$rating1 = @number_format($current_rating / $count, 1);
    $rating2 = @number_format($current_rating, 2);

    $rater = '';
    $rater.='<div id="unit_long">';
    $rater.='  <ul id="unit_ul" class="unit-rating" style="width:' . $rating_unitwidth * $units . 'px;">';
    $rater.='     <li class="current-rating" style="width:' . $rating_width . 'px;">Currently ' . $rating2 . '/' . $units . '</li>';

    $rater.='  </ul>';
    $rater.='  <p';

    $rater.='>Rating: <strong> ' . $current_rating . '</strong>/' . $units;
    $rater.='  </p>';
    $rater.='</div>';
    return $rater;
}

function encode($str='') {

    $str1 = base64_encode($str);
    $str2 = base64_encode($str1);
    $str3 = base64_encode($str2);
    $str4 = base64_encode($str3);
    $str5 = strrev($str4);
    $encrypt = bin2hex($str5);

    return $encrypt;
}

function decode($encrypt='') {
    $str = '';
    for ($i = 0; $i < strlen($encrypt) - 1; $i+=2) {
        $str .= chr(hexdec($encrypt[$i] . $encrypt[$i + 1]));
    }
    $str5 = strrev($str);
    $str4 = base64_decode($str5);
    $str3 = base64_decode($str4);
    $str2 = base64_decode($str3);
    $decode = base64_decode($str2);

    return $decode;
}


function compareArray($a, $b) {
    return $b['Rating'] - $a['Rating'];
}
function shortSearchResultByRate($a, $b) {
    return $b['rate'] - $a['rate'];
}

function getDefaultVendorLogo()
{
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getDefaultVendorLogo();
}
function getVendorLogo($vendorId)
{
    $CI = &get_instance();
    $CI->load->model('model_vendor');
    return $CI->model_vendor->getVendorLogo($vendorId);
}

function getFormatedServices($servicesArray)
{
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getFormatedServices($servicesArray);
}