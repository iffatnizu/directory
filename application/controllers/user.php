<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'siteConfig.php';
require_once 'dbConfig.php';

/**
 * This class does all user's operation
 * @author Iffat Nizu
 * @requires siteconfig.php & dbconfig.php files
 * Functions list - index, signup, checkEmail, subscribe, login, logout, favorite, index, getMessages, sendUserReply, editProfile, 
 * changePassword, checkOldPassword, reportViolation, manageRating, updateVendorRatingReview
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        /**
         * Load CI library function
         */
        $this->load->library(array('form_validation', 'email', 'session'));

        /**
         * Load model files
         */
        $this->load->model('model_user');

        /**
         * Load helper functions
         */
        $this->load->helper('user');
    }

    /**
     * @method type Index method
     * @param none 
     * Description  Index function call signup function
     * @return None 
     */
    public function index() {
        $this->signup();
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function signup()
     * @param 
     * @uses for signup user 
     * @return  
     */
    public function signup() {
        if (!$this->session->userdata('userLogin')) {
            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules(DbConfig::TABLE_USER_ATT_NAME, 'Name', 'required|min_length[6]');
            $this->form_validation->set_rules(DbConfig::TABLE_USER_ATT_EMAIL, 'Email', 'required|valid_email|callback_checkEmail');
            $this->form_validation->set_rules(DbConfig::TABLE_USER_ATT_PASSWORD, 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]|min_length[6]');
            $this->form_validation->set_message('required', ' %s Required');
            $this->form_validation->set_rules('whichBest[]', 'Which Best', 'required');

            if ($this->form_validation->run() == TRUE) {
                $this->model_user->userSignup();
            }

            $data['title'] = 'User Registration';
            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_SIGNUP, '', TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function checkEmail()
     * @param string $str
     * @param value empty
     * @uses for check email
     * @return boolean 
     */
    public function checkEmail($str = '') {
        $emailStatus = getEmailIsAlreadyInUse($str);
        if ($emailStatus == '1') {
            $this->form_validation->set_message('checkEmail', 'This %s is already in use');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function subscribe()
     * @param 
     * @uses for subscribe 
     * @return None 
     */
    public function subscribe() {
        if (isset($_POST['subscriber'])) {
            $i = $this->model_user->insertSubscribeData();
            if ($i == '1') {
                echo '1';
            }
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function login()
     * @param 
     * @uses for user login 
     * @return  
     */
    public function login() {

        $sc['stepIncreament'] = FALSE;
        $sc['sizeofStep'] = FALSE;
        $sc['pagename'] = FALSE;

        $this->session->unset_userdata($sc);

        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        $this->form_validation->set_rules(DbConfig::TABLE_USER_ATT_EMAIL, 'Email', 'required|valid_email');
        $this->form_validation->set_rules(DbConfig::TABLE_USER_ATT_PASSWORD, 'Password', 'required|min_length[6]');
        $this->form_validation->set_message('required', ' %s Required');

        if ($this->form_validation->run() == TRUE) {
            $this->model_user->checkLogin();
        }

        $data['title'] = 'User Login';

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_LOGIN, $data, TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function logout()
     * @param 
     * @uses for user logout 
     * @return  
     */
    public function logout() {
        if ($this->session->userdata('userId')) {
            $data['userId'] = FALSE;
            $data['userLogin'] = FALSE;

            $this->session->unset_userdata($data);

            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_INDEX));
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function favorite()
     * @param 
     * @uses show favorite list 
     * @return 
     */
    public function favorite() {
        if ($this->session->userdata('userLogin')) {
            $data['favoriteList'] = $this->model_user->getFavoriteList($this->session->userdata('userId'));

            $data['title'] = 'User Favorite List';

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_FAVORITE, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function inbox()
     * @param 
     * @uses for show user message inbox 
     * @return  
     */
    public function inbox() {
        if ($this->session->userdata('userLogin')) {
            $data['title'] = 'User Conversation Inbox';
            $data['allmessage'] = $this->model_user->getUserInboxMessage($this->session->userdata('userId'));
            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_USER_INBOX, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function getMessages()
     * @param 
     * @uses for get Messages
     * @return 
     */
    public function getMessages() {
        if ($this->session->userdata('userLogin')) {
            if (isset($_GET['submit'])) {
                $msg = $this->model_user->getMessages($this->session->userdata('userId'), cpr_decode($_GET['eid']));
                echo json_encode($msg);
            } else {
                print("Nice try");
            }
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function index()
     * @param 
     * @uses Index method for catering controller 
     * @return None 
     */
    public function sendUserReply() {
        if ($this->session->userdata('userLogin')) {
            $send = $this->model_user->sendUserReply($this->session->userdata('userId'));

            echo json_encode($send);
        } else {
            echo 'Sesion time out please login again';
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function editProfile()
     * @param 
     * @uses for user's profile edit 
     * @return  
     */
    public function editProfile() {
        if ($this->session->userdata('userLogin')) {
            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules(DbConfig::TABLE_USER_ATT_NAME, 'Name', 'required|min_length[6]');
            $this->form_validation->set_message('required', ' %s Required');

            if ($this->form_validation->run() == TRUE) {
                $this->model_user->updateProfile($this->session->userdata('userId'));
            }
            $data['userInfo'] = $this->model_user->getUserInfo($this->session->userdata('userId'));
            $data['allState'] = getAllState();

            $data['title'] = 'Edit User Profile';

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_EDIT_PROFILE, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function changePassword()
     * @param 
     * @uses for user's change password 
     * @return 
     */
    public function changePassword() {
        if ($this->session->userdata('userLogin')) {
            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules('oldPassword', 'Old Password', 'required|min_length[6]|callback_checkOldPassword');
            $this->form_validation->set_rules('newPassword', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirmNewPassword', 'Confirm Password', 'required|matches[newPassword]|min_length[6]');
            $this->form_validation->set_message('required', ' %s Required');

            if ($this->form_validation->run() == TRUE) {
                $this->model_user->updatePassword($this->session->userdata('userId'));
            }

            $data['title'] = 'Change User Password';

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_CHANGE_PASSWORD, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function checkOldPassword()
     * @param string $str
     * @uses for checking old password 
     * @return boolean 
     */
    public function checkOldPassword($str = '') {
        $status = $this->model_user->checkOldPassword($str);
        if ($status == 0) {
            $this->form_validation->set_message('checkOldPassword', 'The %s password can not match');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function reportViolation()
     * @param 
     * @uses for report violation for event message 
     * @return  
     */
    public function reportViolation() {
        if ($this->session->userdata('userLogin')) {
            if (isset($_POST['submit'])) {
                $report = $this->model_user->reportViolation($this->session->userdata('userId'), cpr_decode($_POST['eid']));
                echo $report;
            }
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function manageRating()
     * @param 
     * @uses for manage ratings 
     * @return None 
     */
    public function manageRating() {
        if ($this->session->userdata('userLogin')) {
            $data['title'] = 'Manage Rating';
            $data['ratingReview'] = $this->model_user->getUserRatingReview($this->session->userdata('userId'));
            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_USER_MANAGE_RATING, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function updateVendorRatingReview()
     * @param 
     * @uses for updating vendor rating review 
     * @return  
     */
    public function updateVendorRatingReview() {
        if ($this->session->userdata('userLogin')) {
            if (isset($_POST['submit'])) {
                echo $this->model_user->updateVendorRatingReview($this->session->userdata('userId'));
            }
        } else {
            echo "Login First";
        }
    }

}
