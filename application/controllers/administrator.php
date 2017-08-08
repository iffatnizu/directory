<?php

require_once 'siteConfig.php';
require_once 'dbConfig.php';
require_once APPPATH . 'directory/adminconfig.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'site', 'user', 'cookie', 'form', 'url','events'));
        $this->load->library(array('session', 'imageresizer'));
        $this->load->model('model_administrator');
    }

    public function index() {
        $this->login();
    }

    public function login() {
        if (!$this->session->userdata('_directoryAdminLogin')) {

            if (isset($_POST['submit'])) {
                $login = $this->model_administrator->dologin();

                if ($login != '0') {
                    $session['_directoryAdminLogin'] = true;
                    $session['_directoryAdminID'] = $login[DBConfig::TABLE_ADMIN_ATT_ADMIN_ID];

                    $this->session->set_userdata($session);

                    redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DASHBOARD));
                } else {
                    $session['_errorlAdminLogin'] = true;
                    $this->session->set_userdata($session);
                }
            }

            $data['title'] = 'Welcome to Administrator Panel';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_LOGIN, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DASHBOARD));
        }
    }

    public function dashboard() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            $data['title'] = 'Dashboard || Directory Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_DASBOARD, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function logout() {
        $session['_directoryAdminLogin'] = FALSE;
        $session['_directoryAdminID'] = FALSE;
        $this->session->unset_userdata($session);

        redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
    }

    public function sitecontent($contentname, $contentTitle) {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if ($contentname && $contentTitle) {
                if (isset($_POST['updateInformation'])) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('title', 'Title', 'required');
                    $this->form_validation->set_rules('editor1', 'Description', 'required');
                    if (!$this->form_validation->run() == FALSE) {
                        $update = $this->model_administrator->updateSiteContent();

                        if ($update) {
                            $session['_success'] = true;
                            $this->session->set_userdata($session);
                            redirect($_POST['currentUrl']);
                        }
                    }
                }
                $data['title'] = urldecode($contentTitle) . '|| Directory Admin';
                $data['contentTitle'] = urldecode($contentTitle);
                $data['contentName'] = $contentname;
                $data['content'] = $this->model_administrator->getSiteContent($contentname);
                $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
                $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
                $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_CONTENT, $data, TRUE);
                $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
            } else {
                redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
            }
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function faq() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['insertFaq'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Question', 'Question', 'required');
                $this->form_validation->set_rules('Answer', 'Answer', 'required');
                if (!$this->form_validation->run() == FALSE) {
                    $i = $this->model_administrator->insertFAQ();

                    if ($i == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_FAQ);
                    }
                }
            }
            $data['title'] = 'Dashboard || Directory Admin';
            $data['faq'] = getFAQ();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_FAQ, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function deletefaq($id=0) {
        if ($this->session->userdata('_directoryAdminLogin')) {
            $d = $this->model_administrator->deletefaq($id);
            redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_FAQ);
        }
    }

    public function siteparameter() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['submit'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('siteTitle', 'Site Title', 'required');
                $this->form_validation->set_rules('siteMetaKeyword', 'Site Meta Keyword', 'required');
                $this->form_validation->set_rules('siteMetaDescription', 'Site Meta Description', 'required');
                $this->form_validation->set_rules('siteEmail', 'Site Email Address', 'required');
                $this->form_validation->set_rules('sitePhone', 'Site Phone', 'required');
                $this->form_validation->set_rules('homeContentStatus', 'Home Content Status', 'required');

                if (!$this->form_validation->run() == FALSE) {
                    $u = $this->model_administrator->updateSiteParameter();

                    if ($u == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_PARAMETER);
                    }
                }
            }
            $data['title'] = 'Site Parameter || Directory Admin';
            $data['details'] = getSitParameter();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_PARAMETER, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function changepassword() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['updatePassword'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('old_password', 'Old Password', 'required');
                $this->form_validation->set_rules('new_password', 'New Password', 'required|matches[con_new_password]');
                $this->form_validation->set_rules('con_new_password', 'Password Confirmation', 'required');

                if (!$this->form_validation->run() == FALSE) {
                    $update = $this->model_administrator->changepassword();
                    if ($update == '1') {
                        $data['_success'] = true;
                        $this->session->set_userdata($data);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PASSWORD);
                    } else {
                        $data['_notmached'] = true;
                        $this->session->set_userdata($data);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PASSWORD);
                    }
                }
            }

            $data['title'] = 'Change Administrator Password || Directory Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_CHANGE_PASSWORD, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function lists($name="") {
        if ($this->session->userdata('_directoryAdminLogin')) {


            if ($name == true) {
                if ($name == "vendor") {
                    $data['title'] = 'Vendor List || Directory Admin';
                    $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VENDOR_LIST, $data, TRUE);
                } else if ($name == "user") {
                    $data['title'] = 'User List || Directory Admin';
                    $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_USER_LIST, $data, TRUE);
                }
            }
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);

            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function vendorList() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            $vlist = $this->model_administrator->getVendorList();
            echo $vlist;
        } else {
            echo "Session Expired";
        }
    }

    public function userList() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            $ulist = $this->model_administrator->getUserList();
            echo $ulist;
        } else {
            echo "Session Expired";
        }
    }

    public function blockedVendor() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['submit'])) {
                $b = $this->model_administrator->blockedVendor($_POST['vendorEmail']);
                echo $b;
            }
        } else {
            echo "Session Expired";
        }
    }

    public function blockedUser() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['submit'])) {
                $b = $this->model_administrator->blockedUser($_POST['userEmail']);
                echo $b;
            }
        } else {
            echo "Session Expired";
        }
    }

    public function unblockedVendor() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['submit'])) {
                $ub = $this->model_administrator->unblockedVendor($_POST['vendorEmail']);
                echo $ub;
            }
        } else {
            echo "Session Expired";
        }
    }

    public function unblockedUser() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['submit'])) {
                $ub = $this->model_administrator->unblockedUser($_POST['userEmail']);
                echo $ub;
            }
        } else {
            echo "Session Expired";
        }
    }
    
    public function deleteRatingReview() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['submit'])) {
               echo $this->model_administrator->deleteRatingReview();                
            }
        } else {
            echo "Session Expired";
        }
    }
    public function reportMarkAsInvalid() {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if (isset($_POST['submit'])) {
               echo $this->model_administrator->reportMarkAsInvalid();                
            }
        } else {
            echo "Session Expired";
        }
    }

    public function reportViolationList($name="") {
        if ($this->session->userdata('_directoryAdminLogin')) {

            $data['title'] = "";
            if ($name == true) {
                if ($name == "vendor") {
                    $data['title'] = 'Reported Vendor List || Directory Admin';
                    $data['vendorList'] = $this->model_administrator->getReportedVendorList();
                    $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_REPORTED_VENDOR_LIST, $data, TRUE);
                } else if ($name == "user") {
                    $data['title'] = 'Reported User List || Directory Admin';
                    $data['userList'] = $this->model_administrator->getReportedUserList();
                    $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_REPORTED_USER_LIST, $data, TRUE);
                }
                
                else if($name=="ratingReview")
                {
                    $data['title'] = 'Reported Rating List || Directory Admin';
                    $data['reportedRatings'] = $this->model_administrator->getReportedRatingList();
                    $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_REPORTED_RATING_LIST, $data, TRUE);
                }
            }
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);

            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }
    
    public function setVendorLogo()
    {
        if ($this->session->userdata('_directoryAdminLogin')) {
            if(isset($_POST['Change-Image']))
            {
                if($_FILES['userfile']['name']==true)
                {
                    $this->model_administrator->setVendorLogo();
                }
                else
                {
                    $s['uploaderror'] = true;
                    $this->session->set_userdata($s);
                }
            }
            $data['title'] = 'Set Default Logo || Directory Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_DEFAULT_LOGO, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

}
