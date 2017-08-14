<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'siteConfig.php';
require_once 'dbConfig.php';
require_once APPPATH . 'directory/vendorconfig.php';

class Vendor extends CI_Controller {

    public function Vendor() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email', 'session'));
        $this->load->helper('user','events');
        $this->load->model('model_home');
        $this->load->model('model_vendor');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
    }

    public function index() {
        $this->login();
    }

    public function details($vendorid, $vendorname) {
        //echo to10($vendorid);
        $allCategory = getAllCategory();
        if (!empty($allCategory)) {
            foreach ($allCategory as $category) {
                $categoryId = $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID];
                $dataS['selectCategory' . $categoryId] = FALSE;
            }
            $this->session->unset_userdata($dataS);
        }

        $this->model_vendor->deleteEventInfo();

        $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, 'Event Type', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_NAME, 'Event Name', 'required|min_length[6]');
        $this->form_validation->set_rules('stateId', 'Event State', 'required');
        $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_CITY_ID, 'Event Suburb', 'required');
        $this->form_validation->set_message('required', ' %s Required');

        if ($this->form_validation->run() == TRUE) {
            $this->model_vendor->insertEventInfo(cpr_decode($vendorid));
        }

        $data['title'] = 'Vendor details of ' . urldecode($vendorname);
        $data['vendorname'] = ucfirst(str_replace("-", " ", $vendorname));

        $data['vendor'] = getAllEventType();
        $data['vendorDetails'] = getVendorDetails(cpr_decode($vendorid));

        $data['vendorRating'] = getVendorRating(cpr_decode($vendorid));

        $data['vendorReview'] = $this->model_vendor->getVendorAllReview(cpr_decode($vendorid));

        $data['allCategory'] = getAllCategory();
        $data['allState'] = getAllState();

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_VENDOR_DETAILS, $data, TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function registration() {
        if (!$this->session->userdata('_userLogin')) {
            if (isset($_POST['vendorsubmit'])) {

                $this->form_validation->set_rules('txtbusinessname', 'Business Name', 'required');
                $this->form_validation->set_rules('txtName', 'Name', 'required');
                $this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|callback_emailAddressCheck');
                $this->form_validation->set_rules('txtPassword', 'Password', 'required');
                $this->form_validation->set_rules('txtAddress', 'Address', 'required');
                $this->form_validation->set_rules('stateId', 'State', 'required');
                $this->form_validation->set_rules('txtzip', 'Zip Code', 'required|integer|min_length[4]');
                $this->form_validation->set_rules('services[]', 'Services', 'required');
//                $this->form_validation->set_rules('txtCardName', 'Card Holder Name', 'required');
//                $this->form_validation->set_rules('txtCardNumber', 'Card Number', 'required|callback_MasterCardValidityCheck');
//                $this->form_validation->set_rules('txtCardCVV', 'Card CVV', 'required');
//                $this->form_validation->set_rules('txtCardExpMonth', 'Card Exp.Month', 'required');
//                $this->form_validation->set_rules('txtCardExpYear', 'Card Exp.Year', 'required');


                if ($this->form_validation->run() == TRUE) {
//            debugPrint($_POST);
                    $this->model_vendor->vendorSignup();
                }
            }
            $data['title'] = 'Vendor registration';
            $data['state'] = getStateByCountryId('13');
            $data['category'] = getAllCategory();
            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_VENDOR_REGISTRATION, '', TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function emailAddressCheck($email = "") {

        $check = $this->model_vendor->emailAddressCheck($email);

        if ($check == '1') {
            $this->form_validation->set_message('emailAddressCheck', 'Email Address Already Exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function MasterCardValidityCheck($num) {
        $check = $this->model_vendor->MasterCardValidityCheck($num);
        if ($check == '1') {
            $this->form_validation->set_message('MasterCardValidityCheck', 'Invalid Card Number');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function account($param="", $token="") {
        $data['msg'] = "";
        if ($token == true) {
            if ($param == 'activation') {
                $check = $this->model_vendor->checkActivationToken($token);
                if ($check == '1') {
                    $data['msg'] = "Your account successfully activated.Please login now";
                } else if ($check == '2') {
                    $data['msg'] = "The link is expired";
                } else if ($check == '3') {
                    $data['msg'] = "Invalid activation link";
                }
            }
            $data['title'] = 'Vendor activation';
            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_VENDOR_ACTIVATION, '', TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function directory() {
        if (isset($_POST['submit'])) {
            if (isset($_POST['selectSearch'])) {
                $searchSelect = $_POST['selectSearch'];

                if (is_numeric($searchSelect)) {
                    if ($searchSelect == 1) {
                        redirect(base_url() . SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_SEARCH);
                    } elseif ($searchSelect == 2) {
                        redirect(base_url() . SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_ADVANCE_SEARCH);
                    }
                }
            }
        }
        $data['title'] = 'Directory';
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_VENDOR_CHOOSING_SEARCH, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function advancesearch() {
        $data['title'] = 'Vendor Advance Search';
        if (!empty($_GET)) {
            if (isset($_GET['stateID'])) {
                if (isset($_GET['serviceID'])) {
                    $stateId = $_GET['stateID'];
                    $services = explode(",", $_GET['serviceID']);
                    $data['servicesarray'] = $services;
                    $data['stateName'] = getStateNameById($stateId);
                    $data['services']  = getFormatedServices($services);
                    $data['advSrcResult'] = $this->model_vendor->getAdvanceSearch($stateId, $services);
                }
            }
        }
        $data['category'] = getAllCategory();
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_VENDOR_DIRECTORY, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function search() {
        if (isset($_GET['searchVendor'])) {
            $data['userList'] = $this->model_vendor->getUserListByCity();
            $data['stateName'] = getStateNameById($_GET['vendorStateId']);
            $data['cityName'] = getCityNameById($_GET['vendorCityId']);
        }
        $data['title'] = 'Vendor Search';


        $data['allState'] = getAllState();

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_VENDOR_SEARCH, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    /*
     * @uses not in use since 6-26-2013
     * @author <akram@corepiler.com>
     * 
     */

    public function old_login() {
        if (!$this->session->userdata('_userLogin')) {
            $data['title'] = 'Login';
            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_USER_LOGIN, '', TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function doLogin() {
        //debugPrint($_REQUEST);
        if (isset($_POST['signin'])) {
            $login = $this->model_vendor->makeLogin();
            if ($login != '0' && $login != '2') {

                $session['_userEmail'] = $login[DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL];
                $session['_userId'] = $login[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID];
                $session['_userName'] = $login[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME];
                $session['_userLogin'] = TRUE;

                $this->session->set_userdata($session);

                echo '1';
            } else {
                echo $login;
            }
        }
    }

    public function logout() {
        $session['_userEmail'] = FALSE;
        $session['_userId'] = FALSE;
        $session['_userName'] = FALSE;
        $session['_userLogin'] = FALSE;

        $this->session->unset_userdata($session);

        echo '1';
    }

    public function updatepassword() {
        if ($this->session->userdata('_userLogin')) {
            $up = $this->model_vendor->updatepassword($this->session->userdata('_userId'));
            if ($up == '1') {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    public function login() {
        if (!$this->session->userdata('_userLogin')) {
            $data['title'] = 'Welcome to Vendor Panel';
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, '', TRUE);
            $vendor['content'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_LOGIN, '', TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DASHBOARD));
        }
    }

    public function dashboard() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'Welcome to Vendor Panel';

            $serviceArray = array('3', '4');

            $test = $this->model_vendor->sendQuoteMailToVendor($serviceArray);

            //debugPrint($test);

            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, '', TRUE);
            $vendor['content'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_DASHBOARD, '', TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_LOGIN));
        }
    }

    public function profile() {
        if ($this->session->userdata('_userLogin')) {
            $data['userdata'] = $this->model_vendor->getUserdata($this->session->userdata('_userId'));
            $data['title'] = 'Profile of ' . $this->session->userdata('_userName');
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, "", TRUE);
            $vendor['content'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_PROFILE, '', TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

    public function editprofile() {
        if ($this->session->userdata('_userLogin')) {
            if (isset($_POST['vendorsubmit'])) {
                $this->form_validation->set_rules('txtbusinessname', 'Business Name', 'required');
                $this->form_validation->set_rules('txtName', 'Name', 'required');
                $this->form_validation->set_rules('txtAddress', 'Address', 'required');
                $this->form_validation->set_rules('stateId', 'State', 'required');
                $this->form_validation->set_rules('txtzip', 'Zip Code', 'required|integer|min_length[4]');

                if ($this->form_validation->run() == TRUE) {
//            debugPrint($_POST);
                    $this->model_vendor->updateProfile($this->session->userdata('_userId'));
                }
            }

            $data['userdata'] = $this->model_vendor->getUserdata($this->session->userdata('_userId'));
            $data['category'] = getAllCategory();
            $data['state'] = getStateByCountryId('13');
            $data['title'] = 'Profile of ' . $this->session->userdata('_userName');
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, "", TRUE);
            $vendor['content'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_EDIT_PROFILE, '', TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

    public function changepassword() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'Profile of ' . $this->session->userdata('_userName');
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, "", TRUE);
            $vendor['content'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_CHANGE_PASSWORD, '', TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

    public function submitReview() {
        if ($this->session->userdata('userLogin')) {
            $up = $this->model_vendor->submitReview($this->session->userdata('userId'));
            if ($up == '1') {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    public function addToFavorite() {
        if ($this->session->userdata('userLogin')) {
            if ($_POST['status'] == '1') {
                $up = $this->model_vendor->addToFavorite($this->session->userdata('userId'));
                if ($up == '1') {
                    echo '1';
                } else {
                    echo '0';
                }
            } else if ($_POST['status'] == '0') {
                $up = $this->model_vendor->removeFavorite($this->session->userdata('userId'));
                if ($up == '1') {
                    echo '1';
                } else {
                    echo '0';
                }
            }
        }
    }

    public function submitRating() {
        if ($this->session->userdata('userLogin')) {
            $up = $this->model_vendor->submitRating($this->session->userdata('userId'));
            if ($up == '1') {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    public function stateVendors($stateId=0) {
        if (is_numeric($stateId) && $stateId == true) {
            $data['title'] = 'State Vendor List ';
            $data['stateName'] = getStateNameById($stateId);
            $data['vendorList'] = $this->model_vendor->getVendorByState($stateId);
            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_VENDORS_OF_STATE, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function reportViolation() {
        if ($this->session->userdata('_userLogin')) {
            $report = $this->model_vendor->reportViolation($this->session->userdata('_userId'), cpr_decode($_POST['eid']));

            echo $report;
        }
    }

    public function ratingReview() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'View Rating Review';
            $data['rating'] = $this->model_vendor->getVendorRatingByID($this->session->userdata('_userId'));
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, "", TRUE);
            $vendor['content'] = $this->load->view(siteConfig::COMPONENT_VENDORS_RATING_REVIEW, $data, TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

    public function sendReportForRating() {
        if ($this->session->userdata('_userLogin')) {
            if (isset($_POST['submit'])) {
                echo $this->model_vendor->sendReportForRating($this->session->userdata('_userId'));
            }
        } else {
            echo 'Please login first';
        }
    }

    public function changeLogo() {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['Change-Image'])) {
                if ($_FILES['userfile']['name'] == true) {
                    $this->model_vendor->changeVendorLogo($this->session->userdata('_userId'));
                } else {
                    $s['uploaderror'] = true;
                    $this->session->set_userdata($s);
                }
            }

            $data['title'] = 'Change Vendor Logo';

            $vlogo = getVendorLogo($this->session->userdata('_userId'));

            if ($vlogo) {
                $data['defaultLogo'] = $vlogo;
            } else {
                $data['defaultLogo'] = getDefaultVendorLogo();
            }

            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, "", TRUE);
            $vendor['content'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_CHANGE_LOGO, $data, TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }
    
    public function submitRatingAjax() {
        if ($this->session->userdata('userLogin')) {
            $up = $this->model_vendor->submitRatingAjax($this->session->userdata('userId'));
            
            echo $up;
        }
    }

}
