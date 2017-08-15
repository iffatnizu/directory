<?php
/**
 * @author Iffat Nizu
 * @package directory
 * @name function getEmailIsAlreadyInUse()
 * @param string $email
 * @uses for checking email address exist or not by email
 * @return string 
 */
function getEmailIsAlreadyInUse($email = '') {
    $CI = &get_instance();
    $CI->load->model('model_user');
    return $CI->model_user->getEmailIsAlreadyInUse($email);
}
/**
 * @author Iffat Nizu
 * @package directory
 * @name function getEventInfoDetailsId()
 * @param int $id
 * @uses for getting event info detail id by id
 * @return int 
 */
function getUsernameById($id = 0) {
    $CI = &get_instance();
    $CI->load->model('model_user');
    return $CI->model_user->getUsernameById($id);
}