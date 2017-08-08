<?php

function getEmailIsAlreadyInUse($email = '') {
    $CI = &get_instance();
    $CI->load->model('model_user');
    return $CI->model_user->getEmailIsAlreadyInUse($email);
}
function getUsernameById($id = 0) {
    $CI = &get_instance();
    $CI->load->model('model_user');
    return $CI->model_user->getUsernameById($id);
}