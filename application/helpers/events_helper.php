<?php

function getEquipmentNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getEquipmentNameById($id);
}

function getVenuementNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getVenuementNameById($id);
}

/**
 * @author <akram@corepiler.com>
 * @package directory
 * @access public
 * @name function isServiceBookmarked()
 * @param $serviceid, $eventsid, $servicelistId, $userid
 * @uses for checking the events is already bookmarked
 * @return int 
 */
function isServiceBookmarked($serviceid, $eventsid, $servicelistId, $userid) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->isServiceBookmarked($serviceid, $eventsid, $servicelistId, $userid);
}

function getFoodTypeByTypeId($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getFoodTypeByTypeId($id);
}

function getAmenitiesTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAmenitiesTypeNameById($id);
}

function getServiceNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getServiceNameById($id);
}

function getAgeRangeById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAgeRangeById($id);
}

function getEntertainmentTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getEntertainmentTypeNameById($id);
}

function getFlowerTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getFlowerTypeNameById($id);
}

function getArrangementTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getArrangementTypeNameById($id);
}

function getPhotographyStyleNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getPhotographyStyleNameById($id);
}

/**
 * @author <akram@corepiler.com>
 * @package directory
 * @access public
 * @name getDrinkTypeNameById()
 * @uses getting the name of drink type by id
 * @param type $id
 * @return type 
 */
function getDrinkTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getDrinkTypeNameById($id);
}

/**
 * @author <akram@corepiler.com>
 * @package directory
 * @access public
 * @name function getCategoryTableName()
 * @uses for getting table name by category id 
 * @ignore not in use
 * @return string 
 */
function getCategoryTableName($categoryId=0) {

    if ($categoryId == '1') {
        return DBConfig::TABLE_CATERING;
    } elseif ($categoryId == '2') {
        return DBConfig::TABLE_RECEPTION_HALLS;
    } elseif ($categoryId == '3') {
        return DBConfig::TABLE_ENTERTAINMENT;
    } elseif ($categoryId == '4') {
        return DBConfig::TABLE_FLORISTS;
    } elseif ($categoryId == '5') {
        return DBConfig::TABLE_PHOTOGRAPHY;
    } elseif ($categoryId == '6') {
        return DBConfig::TABLE_LIQUOR;
    }
}

function getEventInfoDetailsId($id=0)
{
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getEventInfoDetailsId($id);
}

?>
