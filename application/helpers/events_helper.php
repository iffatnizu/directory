<?php

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getEquipmentNameById()
 * @param int $id
 * @uses for get Equipment Name By Id
 * @return string 
 */
function getEquipmentNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getEquipmentNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getVenuementNameById()
 * @param int $id
 * @uses for get get Venue Name By Id
 * @return string 
 */
function getVenuementNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getVenuementNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
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

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getFoodTypeByTypeId()
 * @param int $id
 * @uses for getting food type bye id
 * @return string 
 */
function getFoodTypeByTypeId($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getFoodTypeByTypeId($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getAmenitiesTypeNameById()
 * @param int $id
 * @uses for getting Amenities Type By Id
 * @return string 
 */
function getAmenitiesTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAmenitiesTypeNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getServiceNameById()
 * @param int $id
 * @uses for getting service name by id
 * @return string 
 */
function getServiceNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getServiceNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getAgeRangeById()
 * @param int $id
 * @uses for getting age range by id
 * @return string 
 */
function getAgeRangeById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getAgeRangeById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getEntertainmentTypeNameById()
 * @param int $id
 * @uses for getting entertainment type name by id
 * @return string 
 */
function getEntertainmentTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getEntertainmentTypeNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getFlowerTypeNameById()
 * @param int $id
 * @uses for getting flower type name by id
 * @return string 
 */
function getFlowerTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getFlowerTypeNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getArrangementTypeNameById()
 * @param int $id
 * @uses for getting arrangement type name by id
 * @return string 
 */
function getArrangementTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getArrangementTypeNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getPhotographyStyleNameById()
 * @param int $id
 * @uses for getting photograph style name by id
 * @return string 
 */
function getPhotographyStyleNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getPhotographyStyleNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @access public
 * @name getDrinkTypeNameById()
 * @uses getting the name of drink type by id
 * @param type $id
 * @return string 
 */
function getDrinkTypeNameById($id) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getDrinkTypeNameById($id);
}

/**
 * @author Iffat Nizu
 * @package directory
 * @access public
 * @name function getCategoryTableName()
 * @uses for getting table name by category id 
 * @ignore not in use
 * @return string 
 */
function getCategoryTableName($categoryId = 0) {

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

/**
 * @author Iffat Nizu
 * @package directory
 * @name function getEventInfoDetailsId()
 * @param int $id
 * @uses for getting event info detail id by id
 * @return int 
 */
function getEventInfoDetailsId($id = 0) {
    $CI = &get_instance();
    $CI->load->model('model_common');
    return $CI->model_common->getEventInfoDetailsId($id);
}


