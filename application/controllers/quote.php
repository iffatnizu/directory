<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'siteConfig.php';
require_once 'dbConfig.php';

class Quote extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_quote');
    }

    public function index() {
        $allCategory = getAllCategory();
        $data['allCategory'] = getAllCategory();
        $data['title'] = 'Quote Home';

        if (!empty($allCategory)) {
            foreach ($allCategory as $category) {
                $categoryId = $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID];
                $dataS['selectCategory' . $categoryId] = FALSE;
            }
        }
        $dataS['step1'] = FALSE;
        $dataS['eventId'] = FALSE;
        $dataS['cateringStep'] = FALSE;
        $dataS['receiptionStep'] = FALSE;
        $dataS['entertainmentStep'] = FALSE;
        $dataS['floristStep'] = FALSE;
        $dataS['photographyStep'] = FALSE;
        $dataS['liquorStep'] = FALSE;
        $dataS['vendorid'] = FALSE;
        $this->session->unset_userdata($dataS);

        $this->model_quote->deleteEventInfo();
//        echo 'Test ';
        $this->model_quote->deleteCateringService();
        $this->model_quote->deleteReceptionService();
        $this->model_quote->deleteEntertainmentService();
        $this->model_quote->deleteFloristsService();
        $this->model_quote->deletePhotographyService();
        $this->model_quote->deleteLiquorService();

        $data['vendorList'] = $this->model_quote->getVendorList();
        $data['homeContent'] = $this->model_quote->getHomeContent('quote');
        $data['homeContentStaus'] = $this->model_quote->getHomeContentStaus();
        $data['servicesList'] = getAllServiceList();

        $data['stateList'] = getAllState();

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_QUOTE, '', TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function setCategory() {
        $allCategory = getAllCategory();
        if (!empty($allCategory)) {
            foreach ($allCategory as $category) {
                $categoryId = $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID];
                $dataS['selectCategory' . $categoryId] = FALSE;
            }
            $this->session->unset_userdata($dataS);
        }
//        debugPrint($allCategory);
        $selectedCategories = $_POST['allVals'];
        for ($i = 0; $i < sizeof($selectedCategories); $i++) {
            $category = $selectedCategories[$i];
            $data['selectCategory' . $category] = $category;
        }
        $sc['stepIncreament'] = 1;
        $sc['sizeofStep'] = sizeof($_POST['allVals'])+1;
        $this->session->set_userdata($data);
        $this->session->set_userdata($sc);
        echo '1';
    }

    public function eventInfo($eventInfoId = '') {
        if ($eventInfoId == '' && $this->session->userdata('step1') == 'Done') {
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
            }
        } else {
            $this->form_validation->set_error_delimiters('<font color="yellow">', '</font>');
            $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, 'Event Type', 'required');
            $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_NAME, 'Event Name', 'required');
            $this->form_validation->set_rules('stateId', 'Event State', 'required');
            $this->form_validation->set_rules(DbConfig::TABLE_EVENT_ATT_CITY_ID, 'Event Suburb', 'required');
            $this->form_validation->set_message('required', ' %s Required');

            if ($this->form_validation->run() == TRUE) {
                $this->model_quote->insertEventInfo();
            }

            $data['allCategory'] = getAllCategory();
            $data['allState'] = getAllState();
            $data['allCity'] = getAllCity();
            $data['allEventType'] = getAllEventType();

            $data['title'] = 'Quote Event Information';

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_EVENT_INFO, '', TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        }
    }

    public function information() {
        $data['title'] = 'Quote Information';
        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_QUOTE_INFORMATION, $data, TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function getCityByStateId() {
        $stateId = $_POST['stateId'];
        $cityList = $this->model_quote->getCityByStateId($stateId);
        echo json_encode($cityList);
    }

    public function addRemoveServices() {
        $data['allCategory'] = getAllCategory();

        $data['title'] = 'Quote Information';

        $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
        $page['content'] = $this->load->view(siteConfig::COMPONENT_ADD_REMOVE_SERVICES, $data, TRUE);
        $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function caterer() {
        if ($this->session->userdata('step1') == 'Done') {

            if ($this->session->userdata('pagename') != "caterer") {
                $s['stepIncreament'] = $this->session->userdata('stepIncreament') + 1;
            }
            $s['pagename'] = 'caterer';
            $this->session->set_userdata($s);
            $data['st'] = $this->session->userdata('stepIncreament');

            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules('catStartDate', 'Start Date', 'required');
            $this->form_validation->set_rules('catEndDate', 'End Date', 'required');
            $this->form_validation->set_rules('catDateFlexibl', 'Dates Flexible', 'required');
            $this->form_validation->set_rules('catGuestNumber', 'Guest Number', 'required|numeric');
            $this->form_validation->set_rules('catService', 'Service Requested', 'required');
            $this->form_validation->set_rules('catCuisine', 'Cuisine', 'required');
            $this->form_validation->set_rules('catEquipment[]', 'Equipment', 'required');
            $this->form_validation->set_rules('catBudgetPerson', ' Budget per Person', 'required');
            $this->form_validation->set_message('required', ' %s Required');

            if ($this->form_validation->run() == TRUE) {
                $this->model_quote->addCatererInfo();
            }

            $data['title'] = 'Quote Information';
            $data['allCategory'] = getAllCategory();
            $data['allServices'] = getAllService();
            $data['allFoodTypes'] = getAllFoodTypes();
            $data['allEquipment'] = getAllEquipment();
            $data['allAdditionalServices'] = getAllAdditionalServices();
            $data['allVenueType'] = getVenueType();
            $data['budgetPerPerson'] = getBudgetPetPerson();

            $data['title'] = 'Quote Catering';

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_CATERER, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function decoration() {
        if ($this->session->userdata('step1') == 'Done') {


            if ($this->session->userdata('pagename') != "decoration") {
                $s['stepIncreament'] = $this->session->userdata('stepIncreament') + 1;
            }
            $s['pagename'] = 'decoration';
            $this->session->set_userdata($s);
            $data['st'] = $this->session->userdata('stepIncreament');

            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules('recepStartDate', 'Start Date', 'required');
            $this->form_validation->set_rules('recepEndDate', 'End Date', 'required');
            $this->form_validation->set_rules('recepDateFlexibl', 'Dates Flexible', 'required');
            $this->form_validation->set_rules('recepGuestNumber', 'Guest Number', 'required|numeric');
            $this->form_validation->set_rules('recepService', 'Service Requested', 'required');
            $this->form_validation->set_rules('amenitesTypes[]', 'Amenites Type', 'required');
            $this->form_validation->set_message('required', ' %s Required');

            if ($this->form_validation->run() == TRUE) {
                $this->model_quote->addDecorationInfo();
            }

            $data['title'] = 'Quote Reception Halls';
            $data['allCategory'] = getAllCategory();
            $data['allServices'] = getAllService();
            $data['allAmenitiesType'] = getAmenitiesType();

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_DECORATION, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function entertainer() {
        if ($this->session->userdata('step1') == 'Done') {

            if ($this->session->userdata('pagename') != "entertainer") {
                $s['stepIncreament'] = $this->session->userdata('stepIncreament') + 1;
            }
            $s['pagename'] = 'entertainer';
            $this->session->set_userdata($s);
            $data['st'] = $this->session->userdata('stepIncreament');

            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules('enterStartDate', 'Start Date', 'required');
            $this->form_validation->set_rules('enterEndDate', 'End Date', 'required');
            $this->form_validation->set_rules('enterDateFlexibl', 'Dates Flexible', 'required');
            $this->form_validation->set_rules('enterGuestNumber', 'Guest Number', 'required|numeric');
            $this->form_validation->set_rules('entertainmentType[]', 'Entertainment Type', 'required');
            $this->form_validation->set_rules('entertainmentBudget', 'Entertainment Budget', 'required');
            $this->form_validation->set_message('required', ' %s Required');

//            $entertainInfo = $this->model_quote->getEntertainerInfo($this->session->userdata('eventId'));
//            $data['entertainInfo'] = $entertainInfo;

            if ($this->form_validation->run() == TRUE) {
//                if (sizeof($entertainInfo) > 0) {
//                    $this->model_quote->updateEntertainerInfo();
//                } else {
                $this->model_quote->addEntertainerInfo();
//                }
            }

            $data['title'] = 'Quote Entertainer';
            $data['allCategory'] = getAllCategory();
            $data['allAgeRange'] = getAllAgeRange();
            $data['allEntertainmentType'] = getAllEntertainmentTypes();
            $data['allEntertainmentBudget'] = getAllEntertainmentBudget();

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_ENTERTAINER, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function florist() {
        if ($this->session->userdata('step1') == 'Done') {


            if ($this->session->userdata('pagename') != "florist") {
                $s['stepIncreament'] = $this->session->userdata('stepIncreament') + 1;
            }
            $s['pagename'] = 'florist';
            $this->session->set_userdata($s);
            $data['st'] = $this->session->userdata('stepIncreament');




            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules('florStartDate', 'Start Date', 'required');
            $this->form_validation->set_rules('florEndDate', 'End Date', 'required');
            $this->form_validation->set_rules('florDatesFlexibl', 'Dates Flexible', 'required');
            $this->form_validation->set_rules('florGuestNumber', 'Guest Number', 'required|numeric');
            $this->form_validation->set_rules('florService', 'Service Requested', 'required');
            $this->form_validation->set_rules('florFlowerType[]', 'Flower Type', 'required');
            $this->form_validation->set_rules('florArrangementType[]', 'Arrangement Type', 'required');
            $this->form_validation->set_rules('florDetails[]', 'Details', 'required');
            $this->form_validation->set_rules('florBudget', 'Florist Budget', 'required');
            $this->form_validation->set_message('required', ' %s Required');

//            $floristInfo = $this->model_quote->getFloristInfo($this->session->userdata('eventId'));
//            $data['floristInfo'] = $floristInfo;

            if ($this->form_validation->run() == TRUE) {
//                if (sizeof($floristInfo) > 0) {
//                    $this->model_quote->updateFloristInfo();
//                } else {
                $this->model_quote->addFloristInfo();
//                }
            }

            $data['title'] = 'Quote Florist';
            $data['allCategory'] = getAllCategory();
            $data['allEntertainmentBudget'] = getAllEntertainmentBudget();
            $data['allFlowerType'] = getAllFlowerType();
            $data['allArrangementType'] = getAllArrangementType();

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_FLORIST, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function photography() {
        if ($this->session->userdata('step1') == 'Done') {

            if ($this->session->userdata('pagename') != "photography") {
                $s['stepIncreament'] = $this->session->userdata('stepIncreament') + 1;
            }
            $s['pagename'] = 'photography';
            $this->session->set_userdata($s);
            $data['st'] = $this->session->userdata('stepIncreament');

            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules('photoStartDate', 'Start Date', 'required');
            $this->form_validation->set_rules('photoEndDate', 'End Date', 'required');
            $this->form_validation->set_rules('photoDateFlexibl', 'Dates Flexible', 'required');
            $this->form_validation->set_rules('photoGuestNumber', 'Guest Number', 'required|numeric');
            $this->form_validation->set_rules('photoStyle', 'Style of Photography', 'required');
            $this->form_validation->set_rules('photoSettingType', 'Setting Type', 'required');
            $this->form_validation->set_rules('photoBudget', 'Photography Budget', 'required');
            $this->form_validation->set_message('required', ' %s Required');

//            $photographyInfo = $this->model_quote->getPhotographyInfo($this->session->userdata('eventId'));
//            $data['photographyInfo'] = $photographyInfo;

            if ($this->form_validation->run() == TRUE) {
//                if (sizeof($photographyInfo) > 0) {
//                    $this->model_quote->updatePhotographyInfo();
//                } else {
                $this->model_quote->addPhotographyInfo();
//                }
            }

            $data['title'] = 'Quote Photography';
            $data['allCategory'] = getAllCategory();
            $data['allPhotoStyle'] = getAllPhotoService();
            $data['allServiceBudget'] = getAllServiceBudget();

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_PHOTOGRAPHY, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function liquor() {
        if ($this->session->userdata('step1') == 'Done') {

            if ($this->session->userdata('pagename') != "liquor") {
                $s['stepIncreament'] = $this->session->userdata('stepIncreament') + 1;
            }
            $s['pagename'] = 'liquor';
            $this->session->set_userdata($s);
            $data['st'] = $this->session->userdata('stepIncreament');

            $this->form_validation->set_error_delimiters('<font color="red">', '</font>');
            $this->form_validation->set_rules('liqStartDate', 'Start Date', 'required');
            $this->form_validation->set_rules('liqEndDate', 'End Date', 'required');
            $this->form_validation->set_rules('liqDateFlexibl', 'Dates Flexible', 'required');
            $this->form_validation->set_rules('liqGuestNumber', 'Guest Number', 'required|numeric');
            $this->form_validation->set_rules('liqService', 'Service Requested', 'required');
            $this->form_validation->set_rules('drinksType[]', 'Drinks Type', 'required');
            $this->form_validation->set_rules('rentGlasses', 'Rent Glasses', 'required');
            $this->form_validation->set_message('required', ' %s Required');

//            $liquorInfo = $this->model_quote->getLiquorInfo($this->session->userdata('eventId'));
//            $data['liquorInfo'] = $liquorInfo;

            if ($this->form_validation->run() == TRUE) {
//                if (sizeof($liquorInfo) > 0) {
//                    $this->model_quote->updateLiquorInfo();
//                } else {
                $this->model_quote->addLiquorInfo();
//                }
            }

            $data['title'] = 'Quote Liquor';
            $data['allCategory'] = getAllCategory();
            $data['allServices'] = getAllService();
            $data['allDrinks'] = getAllDrinksType();

            $page['header'] = $this->load->view(siteConfig::MOD_HEADER, $data, TRUE);
            $page['content'] = $this->load->view(siteConfig::COMPONENT_LIQUOR, $data, TRUE);
            $page['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(site_url());
        }
    }

    public function removeService($categoryId = 0) {
        $data['selectCategory' . $categoryId] = FALSE;
        $this->session->unset_userdata($data);
        if ($this->session->userdata('selectCategory1')) {
            $this->model_quote->deleteCateringService();
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_CATERER));
        } else if ($this->session->userdata('selectCategory2')) {
            $this->model_quote->deleteReceptionService();
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_DECORATION));
        } else if ($this->session->userdata('selectCategory3')) {
            $this->model_quote->deleteEntertainmentService();
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ENTERTAINER));
        } else if ($this->session->userdata('selectCategory4')) {
            $this->model_quote->deleteFloristsService();
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST));
        } else if ($this->session->userdata('selectCategory5')) {
            $this->model_quote->deletePhotographyService();
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY));
        } else if ($this->session->userdata('selectCategory6')) {
            $this->model_quote->deleteLiquorService();
            redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR));
        } else {
            if ($this->session->userdata('step1') == 'Done') {
                redirect(site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ADD_REMOVE_SERVICES));
            } else {
                redirect(site_url(SiteConfig::CONTROLLER_QUOTE));
            }
        }
    }

    public function insertAllEventInfo() {
        $this->model_quote->insertAllEventInfo();
    }

    public function emailTemplate() {
        $emailTemplate = '<html><head><title></title></head><body><div style="width:580px;background:#FCFCFC;padding:15px;text-align:justify;float:left;border:1px solid #AAB8C6;border-radius:5px;color:#333333">';
        $emailTemplate.= '<h4 style="float:left;margin-top:0px;color:#3B73AF">Directory Email Template</h4><span style="float:right"><img src="https://corepiler.atlassian.net/s/en_US-hgwqx6-1988229788/6132/42/_/jira-logo-scaled.png" alt="logo"/></span><br clear="all"/>';
        $emailTemplate.= '<p>Dear Testman,</p>';
        $emailTemplate.= '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>';
        $emailTemplate.= '<p style="float:right;color:#3B73AF">Sincere Directory.com support.<br/> Thank you</p>';
        $emailTemplate.= '</div></body></html>';

        echo $emailTemplate;
    }

}
