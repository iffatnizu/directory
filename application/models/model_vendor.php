<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Vendor extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserListByCity() {
        $cityId = $_GET[DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID];
        $sql = 'SELECT '
                . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME . ', '
                . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_ID . ', '
                . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_NAME . ', '
                . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_NAME
                . ' FROM ' . DBConfig::TABLE_VENDOR
                . ' LEFT JOIN ' . DBConfig::TABLE_CITY . ' ON ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_ID . ' = ' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID
                . ' LEFT JOIN ' . DBConfig::TABLE_STATE . ' ON ' . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_ID . ' = ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_STATE_ID
                . ' WHERE ' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID . ' = "' . $cityId . '"';
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();

            $data = array();
            foreach ($result as $row) {
                $row['rating'] = $this->getVendorRating($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
                $rating = $this->getVendorRating($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
                $row['rate'] = $rating['Rating'];
                array_push($data, $row);
            }
            usort($data, 'shortSearchResultByRate');
            return $data;
        }
    }

    public function vendorSignup() {

        $token = md5(microtime());

        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_BUSINESS_NAME] = trim($_POST['txtbusinessname']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME] = trim($_POST['txtName']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_PHONE] = trim($_POST['txtPhoneno']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL] = trim($_POST['txtEmail']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_PASSWORD] = trim(md5($_POST['txtPassword']));
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_ADDRESS] = trim($_POST['txtAddress']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID] = trim($_POST['stateId']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID] = trim($_POST['cityId']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_ZIP] = trim($_POST['txtzip']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_WEB_URL] = trim($_POST['txtURL']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_SERVICES] = json_encode($_POST['services']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_REGISTRATION_DATE] = time();
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_REGISTRATION_TOKEN] = $token;

        $insert = $this->db->insert(DBConfig::TABLE_VENDOR, $data);
        if ($insert) {
            $sess['successMsg'] = 'Vendor successfully registered.Your account is not active yet.please check your email for activition link.';
            $this->session->set_userdata($sess);
        }

        $this->email->from('admin@directory.com', 'Site administrator');
        $this->email->to($_POST['txtEmail']);
        $this->email->subject('Account activation link');
        $body = "<p>Thank you for registration in directory.com</p><br/>";
        $link = base_url() . SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_ACCOUNT . 'activation/' . $token;
        $body.= '<p>Click the following link to activate your account.<a href="' . $link . '">Link</a></p><br/>';
        $body.= '<p>if the above link does not work copy past the url on your browser.<a>' . $link . '</a></p><br/>';
        $this->email->message($body);

        $this->email->send();

        //echo $body;

        redirect(site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_LOGIN));

        //echo $this->email->print_debugger();
    }

    public function emailAddressCheck($email = "") {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL, $email);
        $query = $this->db->get(DBConfig::TABLE_VENDOR);

        if ($query->num_rows() == 1) {
            return '1';
        } else {
            return '0';
        }
    }

    public function checkActivationToken($token) {
        $this->db->select(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID);
        $this->db->select(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS);
        $this->db->select(DBConfig::TABLE_VENDOR_ATT_VENDOR_REGISTRATION_DATE);
        $this->db->select(DBConfig::TABLE_VENDOR_ATT_VENDOR_REGISTRATION_TOKEN);
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_REGISTRATION_TOKEN, $token);
        $result = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();

        if (!empty($result)) {
            $expiredate = strtotime('+1 day', $result[DBConfig::TABLE_VENDOR_ATT_VENDOR_REGISTRATION_DATE]);
            if ($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS] == '0' && time() <= $expiredate) {
                $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS] = '1';
                $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_REGISTRATION_TOKEN, $token);
                $this->db->set($data);

                $u = $this->db->update(DBConfig::TABLE_VENDOR);
                if ($u) {
                    return '1';
                }
            } else {
                return '2';
            }
        } else {

            return '0';
        }
    }

    public function makeLogin() {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL, trim($_POST['email']));
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_PASSWORD, md5($_POST['password']));
        //$this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS, '1');

        $query = $this->db->get(DBConfig::TABLE_VENDOR);

        $numrows = $query->num_rows();

        //echo $this->db->last_query();

        if ($numrows == 1) {

            $result = $query->row_array();

            if ($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS] == '1') {

                $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_LAST_LOGIN] = time();
                $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL, trim($_POST['email']));
                $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_PASSWORD, md5($_POST['password']));
                $this->db->set($data);
                $this->db->update(DBConfig::TABLE_VENDOR);

                if ($this->session->userdata('eventId')) {
                    $this->updateEventInfo($this->session->userdata('eventId'), $result[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
                }

                return $result;
            } else if ($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS] == '0') {
                return "2";
            }
        } else {
            return '0';
        }
    }

    public function updatepassword($id) {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $id);
        $this->db->where(DBConfig::TABLE_USER_ATT_PASSWORD, md5($_POST['oldpass']));

        $result = $this->db->get(DBConfig::TABLE_USER)->row_array();
        if (!empty($result)) {

            $data[DBConfig::TABLE_USER_ATT_PASSWORD] = md5($_POST['newpass']);
            $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $id);
            $this->db->set($data);
            $u = $this->db->update(DBConfig::TABLE_USER);
            if ($u)
                return '1';
        }
    }

    public function updateProfile($userId) {
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_BUSINESS_NAME] = trim($_POST['txtbusinessname']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME] = trim($_POST['txtName']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_PHONE] = trim($_POST['txtPhoneno']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_ADDRESS] = trim($_POST['txtAddress']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID] = trim($_POST['stateId']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID] = trim($_POST['cityId']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_ZIP] = trim($_POST['txtzip']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_WEB_URL] = trim($_POST['txtURL']);
        $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_SERVICES] = json_encode($_POST['services']);


//        debugPrint($data);
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $userId);
        $insert = $this->db->update(DBConfig::TABLE_VENDOR, $data);
        if ($insert) {
            $sess['successMsg'] = '<font color="#f00">Profile successfully updated</font>';
            $this->session->set_userdata($sess);
            redirect(site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_EDIT_PROFILE));
        }
    }

    public function getUserdata($id) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();
        unset($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_PASSWORD]);
        $result['cityname'] = getCityNameById($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID]);
        $result['statename'] = getStateNameById($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID]);

        $services = json_decode($result[DBConfig::TABLE_VENDOR_ATT_VENDOR_SERVICES]);

        $result['list'] = array();
        $result['wb'] = array();

        foreach ($services as $value) {
            $result['list'][] = getCategoryNameById($value);
            $result['wb'][] = $value;
        }

        //debugPrint($services);
        //echo $this->db->last_query();

        return $result;
    }

    public function submitReview($userId = '') {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, $_POST['vendorId']);
        $query = $this->db->get(DBConfig::TABLE_VENDOR_RATING);

        if ($query->num_rows() == 0) {

            return "0";
        } else {
            $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID, $userId);
            $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID, $_POST['vendorId']);
            $query = $this->db->get(DBConfig::TABLE_VENDOR_REVIEW);
            if ($query->num_rows() == 0) {
                $data[DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID] = $userId;
                $data[DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID] = $_POST['vendorId'];

                $reviewTxt = $_POST['reviewTxt'];
                if ($reviewTxt == "") {
                    $reviewTxt = "no comments";
                }

                $data[DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW] = $reviewTxt;
                $data[DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW_DATE] = strtotime(date("Y-m-d H:i:s"));
                $data[DBConfig::TABLE_VENDOR_REVIEW_ATT_IS_ACTIVE] = '1';

                $this->db->insert(DBConfig::TABLE_VENDOR_REVIEW, $data);
                return '1';
            }
        }
    }

    public function getVendorAllReview($vendorId = '') {
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID, $vendorId);
        $query = $this->db->get(DBConfig::TABLE_VENDOR_REVIEW);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $data = array();
            foreach ($result as $row) {
                $row['userName'] = $this->getReviewerName($row[DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID]);
                $row['totalRating'] = $this->getUserTotalRating($vendorId, $row[DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID]);
                array_push($data, $row);
            }
            return $data;
        }
    }

    public function getUserTotalRating($vendorId, $userId) {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, $vendorId);
        $result = $this->db->get(DBConfig::TABLE_VENDOR_RATING)->row_array();

        if (!empty($result)) {
            return $result[DBConfig::TABLE_VENDOR_RATING_ATT_RATING];
        }
        else
        {
            return "0";
        }
    }

    private function getReviewerName($userId = '') {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userId);
        $query = $this->db->get(DBConfig::TABLE_USER);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result[DBConfig::TABLE_USER_ATT_NAME];
        }
    }

    public function addToFavorite($userId = '') {
        $this->db->where(DBConfig::TABLE_FAVORITE_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_FAVORITE_ATT_VENDOR_ID, $_POST['vendorId']);
        $query = $this->db->get(DBConfig::TABLE_FAVORITE);
        if ($query->num_rows() == 0) {
            $data[DBConfig::TABLE_FAVORITE_ATT_USER_ID] = $userId;
            $data[DBConfig::TABLE_FAVORITE_ATT_VENDOR_ID] = $_POST['vendorId'];
            $data[DBConfig::TABLE_FAVORITE_ATT_FAVORITE_DATE] = strtotime(date("Y-m-d H:i:s"));

            $this->db->insert(DBConfig::TABLE_FAVORITE, $data);
            return '1';
        } else {
            return '0';
        }
    }

    public function removeFavorite($userId = '') {
        $this->db->where(DBConfig::TABLE_FAVORITE_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_FAVORITE_ATT_VENDOR_ID, $_POST['vendorId']);
        $query = $this->db->get(DBConfig::TABLE_FAVORITE);
        if ($query->num_rows() > 0) {
            $this->db->where(DBConfig::TABLE_FAVORITE_ATT_USER_ID, $userId);
            $this->db->where(DBConfig::TABLE_FAVORITE_ATT_VENDOR_ID, $_POST['vendorId']);
            $this->db->delete(DBConfig::TABLE_FAVORITE);
            return '1';
        }
    }

    public function submitRating($userId = '') {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, $_POST['vendorId']);
        $query = $this->db->get(DBConfig::TABLE_VENDOR_RATING);
        if ($query->num_rows() == 0) {
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID] = $userId;
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] = $_POST['vendorId'];
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_RATING] = $_POST['rating'];
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_RATED_DATE] = strtotime(date("Y-m-d H:i:s"));

            $this->db->insert(DBConfig::TABLE_VENDOR_RATING, $data);
            return '1';
        } else {
            return '0';
        }
    }

    public function MasterCardValidityCheck($num) {
        $checkMasterCardPattern = $this->get_cc_type($num);

        if ($checkMasterCardPattern == "0") {
            return '1';
        } else if ($checkMasterCardPattern == "2") {
            return '1';
        } else {
            $checkMasterCardCheckSum = $this->cc_validate_checksum($num);

            if ($checkMasterCardCheckSum == true) {
                return "0";
            } else {
                return "1";
            }
        }
    }

    public function get_cc_type($cardNumber) {
        // Strip non-digits from the number
        $cardNumber = preg_replace('/\D/', '', $cardNumber);

        // First we make sure that the credit
        // card number is under 15 characters
        // in length, otherwise it is invalid;
        $len = strlen($cardNumber);
        if ($len < 15 || $len > 16) {
            return "2";
        } else {
            switch ($cardNumber) {
                case(preg_match('/^4/', $cardNumber) >= 1):
                    return 'Visa';
                case(preg_match('/^5[1-5]/', $cardNumber) >= 1):
                    return 'Mastercard';
                case(preg_match('/^3[47]/', $cardNumber) >= 1):
                    return 'Amex';
                case(preg_match('/^3(?:0[0-5]|[68])/', $cardNumber) >= 1):
                    return 'Diners Club';
                case(preg_match('/^6(?:011|5)/', $cardNumber) >= 1):
                    return 'Discover';
                case(preg_match('/^(?:2131|1800|35\d{3})/', $cardNumber) >= 1):
                    return 'JCB';
                default:
                    return "0";
                    break;
            }
        }
    }

    public function cc_validate_checksum($cardNumber) {

        $cardNumber = preg_replace('/\D/', '', $cardNumber);

        // Determine the string length
        $cardLength = strlen($cardNumber);

        // Determine the string's remainder
        $cardCheck = $cardLength % 2;

        // Break up the card number into individual
        // digits and combine total.
        $combineTotal = 0;
        $cur = 0;
        $breakCard = str_split($cardNumber);
        foreach ($breakCard as $digit) {

            // Multiply alternate digits by two
            if ($cur % 2 == $cardCheck) {
                // If the multiplied digits is greater
                // than 9, subtract 9.
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            // Total up the digits
            $combineTotal += $digit;
            $cur++;
        }

        // If the combined total's modulus 10 is equal to 0,
        // we know that the the number could be valid,
        // pending confirmation from a payment gateway
        // that the number exists.
        return ($combineTotal % 10 == 0) ? true : false;
    }

    public function getAdvanceSearch($stateId, $services) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID, $stateId);
        $result = $this->db->get(DBConfig::TABLE_VENDOR)->result_array();

        //echo $this->db->last_query();

        $ratingarray = array();

        if (!empty($result)) {
            $data = array();

            foreach ($result as $row) {
                $jsonservicedata = json_decode($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_SERVICES]);

                $sresult = array_intersect($jsonservicedata, $services);

                if (!empty($sresult)) {

                    $row['cityName'] = getCityNameById($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID]);
                    $row['stateName'] = getStateNameById($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID]);
                    $row['rating'] = $this->getVendorRating($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
                    $rating = $this->getVendorRating($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
                    $row['rate'] = $rating['Rating'];

                    array_push($data, $row);
                }
            }

            //debugPrint($ratingarray);

            usort($data, 'shortSearchResultByRate');
            return $data;
        }
    }

    public function getVendorByState($stateId) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID, $stateId);

        $result = $this->db->get(DBConfig::TABLE_VENDOR)->result_array();

        $data = array();
        foreach ($result as $row) {
            $row['rating'] = $this->getVendorRating($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
            $row['cityName'] = getCityNameById($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID]);
            $row['stateName'] = getStateNameById($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID]);
            $rating = $this->getVendorRating($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
            $row['rate'] = $rating['Rating'];
            array_push($data, $row);
        }
        usort($data, 'shortSearchResultByRate');
        return $data;
    }

    public function getVendorRating($vendorId=0) {
        $sql = 'SELECT COUNT( * ) AS vote, AVG(' . DBConfig::TABLE_VENDOR_RATING_ATT_RATING . ') AS Rating
                FROM ' . DBConfig::TABLE_VENDOR_RATING . '
                WHERE ' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . ' ="' . $vendorId . '" ';

        $result = $this->db->query($sql)->row_array();
        $result['ratebar'] = getRatingBar($result['Rating']);

        return $result;
    }

    public function reportViolation($usrId, $eventinfoId) {
        $this->db->order_by(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID, "ASC");
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eventinfoId);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE, "2");
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID, $usrId);



        $result = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE, '1')->row_array();

        //echo $this->db->last_query();
        //debugPrint($result);


        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_ID, $usrId);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_EVENT_INFO_ID, $eventinfoId);

        $result1 = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION)->num_rows();

        //echo $this->db->last_query();

        if ($result1 == 0) {
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_ID] = $usrId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_EVENT_INFO_ID] = $eventinfoId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTING_TIME] = time();
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_TYPE] = "2";
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_VIOLATED_BY_ID] = $result[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID];

            $i = $this->db->insert(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION, $data);

            if ($i) {
                return '1';
            } else {
                return '2';
            }
        } else {
            return '0';
        }
    }

    public function sendQuoteMailToVendor($serviceArray) {
        $result = $this->db->get(DBConfig::TABLE_VENDOR)->result_array();

        $data = array();

        foreach ($result as $row) {
            $servicesList = json_decode($row[DBConfig::TABLE_VENDOR_ATT_VENDOR_SERVICES]);

            $sresult = array_intersect($servicesList, $serviceArray);

            if (!empty($sresult)) {
                array_push($data, $row[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]);
            }
        }

        //debugPrint($data);

        $vendorArray = array();
        foreach ($data as $vendorId) {
            $sql = 'SELECT ' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . ', AVG(' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_RATING . ') AS Rating,' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL . '
                FROM ' . DBConfig::TABLE_VENDOR_RATING . '
                LEFT JOIN ' . DBConfig::TABLE_VENDOR . ' ON ' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_ID . ' = ' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . '
                WHERE ' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . ' = ("' . $vendorId . '")';

            $result1 = $this->db->query($sql)->row_array();

            if ($result1[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] == true && $result1['Rating'] == true) {

                $vendorArray[] = $result1[DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL];
            }
        }

        usort($vendorArray, 'compareArray');

        $emailList = array();

        $i = 0;

        foreach ($vendorArray as $val) {
            array_push($emailList, $val);
            $i++;

            if ($i == 10) {
                break;
            }
        }

        //debugPrint($emailList);
        $this->db->where(DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_ID, "1");
        $emailTemplate = $this->db->get(DBConfig::TABLE_EMAIL_TEMPLATE)->row_array();


        foreach ($emailList as $name => $address) {

            $body = $emailTemplate[DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_TITLE];
            $body.= 'Dear ' . strstr($address, '@', true);
            $body.= $emailTemplate[DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_DETAILS];
            $body.= $emailTemplate[DBConfig::TABLE_EMAIL_TEMPLATE_ATT_EMAIL_TEMPLATE_FOOTER_TXT];

            $this->email->clear();

            $this->email->to($address);
            $this->email->from('support@directory.com');
            $this->email->subject('New Quote Email');
            $this->email->message($body);
            $this->email->send();

            //echo $body;
        }

        return '1';
    }

    public function deleteEventInfo() {
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID] = FALSE;
        $data[DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE] = FALSE;
        $data['eventInfoId'] = FALSE;

        $this->session->unset_userdata($data);
    }

    public function insertEventInfo($vendorid = '') {
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE] = $this->input->post('otherEvent', TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY] = $this->input->post('eventStatus', TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] = $this->input->post(DBConfig::TABLE_EVENT_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID] = $this->input->post('stateId', TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID] = $this->input->post(DBConfig::TABLE_EVENT_ATT_CITY_ID, TRUE);
        $data[DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE] = strtotime(date("Y-m-d H:i:s"));
        $data['vendorid'] = $vendorid;

        $selectedCategories = explode(',', $_POST['allVals']);
        for ($i = 0; $i < sizeof($selectedCategories); $i++) {
            $category = $selectedCategories[$i];
            $data['selectCategory' . $category] = $category;
        }
//        debugPrint($data);
//        exit();
        $data['step1'] = 'Done';
        $this->session->set_userdata($data);

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
    }

    public function getVendorRatingByID($id) {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, $id);
        $r = $this->db->get(DBConfig::TABLE_VENDOR_RATING)->result_array();
        $data = array();

        foreach ($r as $row) {
            $row['review'] = $this->getVendorReview($id, $row[DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID]);
            $row['uName'] = getUsernameById($row[DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID]);
            $row['ratebar'] = getRatingBar($row[DBConfig::TABLE_VENDOR_RATING_ATT_RATING]);
            array_push($data, $row);
        }

        //debugPrint($data);

        return $data;
    }

    public function getVendorReview($vendorId, $userID) {
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID, $vendorId);
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID, $userID);
        $r = $this->db->get(DBConfig::TABLE_VENDOR_REVIEW)->row_array();

        return $r;
    }

    public function sendReportForRating($vid) {
        $this->db->where(DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_VENDOR_ID, $vid);
        $this->db->where(DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_RATING_ID, $_POST['rID']);

        $r = $this->db->get(DBConfig::TABLE_VENDOR_REPORT_RATING)->row_array();

        if (empty($r)) {
            $data[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_VENDOR_ID] = $vid;
            $data[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_RATING_ID] = $_POST['rID'];
            $data[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_REPORT_REASON] = $_POST['reason'];
            $data[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_REPORT_TIME] = time();

            $i = $this->db->insert(DBConfig::TABLE_VENDOR_REPORT_RATING, $data);

            if ($i) {
                return '1';
            }
        } else {
            return '0';
        }
    }

    public function changeVendorLogo($vendorId) {

        $path = "assets/public/vendor/";



        $imageFile = basename($_FILES['userfile']['name']);
        $tmpName = $_FILES['userfile']['tmp_name'];
        $fileName = uniqid() . $imageFile;
        $target = $path . $fileName;

        $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $extension = $_FILES["userfile"]["type"];

        if (in_array($extension, $allowedType)) {
            if (move_uploaded_file($tmpName, $target)) {

                $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $vendorId);
                $result = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();

                $oldImg = $result[DBConfig::TABLE_VENDOR_ATT_VENDOR_PROFILE_IMAGE];

                if (file_exists($path . $oldImg)) {
                    if ($oldImg) {
                        unlink($path . $oldImg);
                    }
                }

                $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_PROFILE_IMAGE] = $fileName;
                $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $vendorId);
                $this->db->set($data);

                $u = $this->db->update(DBConfig::TABLE_VENDOR);

                if ($u) {
                    $s['uploadsuccess'] = true;
                    $this->session->set_userdata($s);
                }
            }
        } else {
            $s['invalidImage'] = true;
            $this->session->set_userdata($s);
        }
    }

    public function getVendorLogo($vendorId) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $vendorId);
        $r = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();

        if (!empty($r)) {
            return $r[DBConfig::TABLE_VENDOR_ATT_VENDOR_PROFILE_IMAGE];
        }
    }

    public function submitRatingAjax($userId) {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, cpr_decode($_POST['vId']));
        $query = $this->db->get(DBConfig::TABLE_VENDOR_RATING);
        if ($query->num_rows() == 0) {
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID] = $userId;
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] = cpr_decode($_POST['vId']);
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_RATING] = $_POST['rate'];
            $data[DBConfig::TABLE_VENDOR_RATING_ATT_RATED_DATE] = strtotime(date("Y-m-d H:i:s"));

            $this->db->insert(DBConfig::TABLE_VENDOR_RATING, $data);

            $sql = 'SELECT AVG(' . DBConfig::TABLE_VENDOR_RATING_ATT_RATING . ') AS Rating
                FROM ' . DBConfig::TABLE_VENDOR_RATING . '
                WHERE ' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . ' ="' . cpr_decode($_POST['vId']) . '" ';

            $result = $this->db->query($sql)->row_array();

            return $result['Rating'];
        } else {
            return '0';
        }
    }

}