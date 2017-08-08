<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_User extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function userSignup() {
        $data[DBConfig::TABLE_USER_ATT_NAME] = $this->input->post(DBConfig::TABLE_USER_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_USER_ATT_EMAIL] = $this->input->post(DBConfig::TABLE_USER_ATT_EMAIL, TRUE);
        $data[DBConfig::TABLE_USER_ATT_PASSWORD] = md5($this->input->post(DBConfig::TABLE_USER_ATT_PASSWORD, TRUE));
        $data[DBConfig::TABLE_USER_ATT_REGISTRATION_DATE] = date("Y-m-d H:i:s");
        $data[DBConfig::TABLE_USER_ATT_STATUS] = '1';

        if (isset($_POST['whichBest'])) {
            $best = implode(',', $_POST['whichBest']);
        } else {
            $best = "";
        }

        $data[DBConfig::TABLE_USER_ATT_WHICH_BEST] = $best;

//        debugPrint($data);
        $insert = $this->db->insert(DBConfig::TABLE_USER, $data);
        $userId = $this->db->insert_id();
        if ($insert) {
            if($this->session->userdata('eventInfoId')) {
                $data['userId'] = $userId;
                $data['userLogin'] = TRUE;
                $data['loginSuccess'] = 'Login Successfull';
                $this->session->set_userdata($data);

                if ($this->session->userdata('eventInfoId')) {
                    $this->updateEventInfo($this->session->userdata('eventInfoId'), $this->session->userdata('userId'));
                }
                $this->updateLoginInfo($this->session->userdata('userId'));
                redirect(site_url(SiteConfig::CONTROLLER_QUOTE));
            }
            
            $sess['successMsg'] = '<font color="#f00">User successfully registered. Please Login.</font>';
            $this->session->set_userdata($sess);
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    public function insertSubscribeData() {
        $data[DBConfig::TABLE_SUBSCRIBER_ATT_SUBSCRIBER_NAME] = trim($_POST['txtFirstName']);
        $data[DBConfig::TABLE_SUBSCRIBER_ATT_SUBSCRIBER_EMAIL] = trim($_POST['txtEmail']);
        $data[DBConfig::TABLE_SUBSCRIBER_ATT_SUBSCRIBER_ZIP_CODE] = trim($_POST['txtZipCode']);
        $data[DBConfig::TABLE_SUBSCRIBER_ATT_SUBSCRIBER_DATE_TIME] = time();
        $data[DBConfig::TABLE_SUBSCRIBER_ATT_SUBSCRIBER_DETAILS] = json_encode($_POST['bestdescribes']);

        $i = $this->db->insert(DBConfig::TABLE_SUBSCRIBER, $data);

        if ($i)
            return '1';
    }

    public function getEmailIsAlreadyInUse($email = '') {
        $this->db->where(DBConfig::TABLE_USER_ATT_EMAIL, $email);
        $query = $this->db->get(DBConfig::TABLE_USER);
        return $query->num_rows();
    }

    public function checkLogin() {
        $this->db->where(DBConfig::TABLE_USER_ATT_EMAIL, trim($_POST[DBConfig::TABLE_USER_ATT_EMAIL]));
        $this->db->where(DBConfig::TABLE_USER_ATT_PASSWORD, md5($_POST[DBConfig::TABLE_USER_ATT_PASSWORD]));
        $query = $this->db->get(DBConfig::TABLE_USER);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            if ($result[DBConfig::TABLE_USER_ATT_STATUS] == '1') {
                $data['userId'] = $result[DBConfig::TABLE_USER_ATT_USER_ID];
                $data['userLogin'] = TRUE;
                $data['loginSuccess'] = 'Login Successfull';
                $this->session->set_userdata($data);

                if ($this->session->userdata('eventInfoId')) {
                    $this->updateEventInfo($this->session->userdata('eventInfoId'), $this->session->userdata('userId'));
                }
                $this->updateLoginInfo($this->session->userdata('userId'));

                redirect(site_url(SiteConfig::CONTROLLER_QUOTE));
            } elseif ($result[DBConfig::TABLE_USER_ATT_STATUS] == '0') {
                $data['userLogin'] = FALSE;
                $data['loginBlocked'] = 'Your user was suspended.please <a href="' . site_url(SiteConfig::CONTROLLER_CONTACT) . '">contact</a> service administrator';
                $this->session->set_userdata($data);
            }
        } else {
            $data['loginError'] = 'Email address or password is wrong';
            $this->session->set_userdata($data);
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN));
        }
    }

    private function updateEventInfo($eventInfoId = '', $userId = 0) {
        $this->db->where(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID, $eventInfoId);
        $this->db->set(DBConfig::TABLE_EVENT_INFO_ATT_USER_ID, $userId);
        $this->db->update(DBConfig::TABLE_EVENT_INFO);
    }

    private function updateLoginInfo($userId = 0) {
        $data[DBConfig::TABLE_USER_ATT_LAST_LOGIN_DATE] = date('Y-m-d H:i:s');
        $data[DBConfig::TABLE_USER_ATT_IP_ADDRESS] = $_SERVER['SERVER_ADDR'];

        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userId);
        $this->db->set($data);
        $this->db->update(DBConfig::TABLE_USER);
    }

    public function getFavoriteList($userId = 0) {
        $this->db->where(DBConfig::TABLE_FAVORITE_ATT_USER_ID, $userId);
        $query = $this->db->get(DBConfig::TABLE_FAVORITE);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $data = array();
            foreach ($result as $row) {
                $row['vendorName'] = $this->getVendorName($row[DBConfig::TABLE_FAVORITE_ATT_VENDOR_ID]);

                array_push($data, $row);
            }
            return $data;
        }
    }

    private function getVendorName($vendorId = 0) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_ID, $vendorId);
        $query = $this->db->get(DBConfig::TABLE_VENDOR);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME];
        }
    }

    public function getUsernameById($userid) {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userid);
        $query = $this->db->get(DBConfig::TABLE_USER);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result[DBConfig::TABLE_USER_ATT_NAME];
        }
    }

    public function getUserInboxMessage($userid) {
        $sql = 'SELECT ' . DBConfig::TABLE_EVENT_MESSAGE . '.*,' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME . ',' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_NAME . ',' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME . '
                FROM ' . DBConfig::TABLE_EVENT_MESSAGE . '
                LEFT JOIN ' . DBConfig::TABLE_VENDOR . ' ON ' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_ID . ' = ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID . '
                LEFT JOIN ' . DBConfig::TABLE_USER . '  ON ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_ID . ' = ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID . '
                LEFT JOIN ' . DBConfig::TABLE_EVENT_INFO . '  ON ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID . ' = ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID . '
                WHERE ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID . ' = "' . $userid . '"
                GROUP BY ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID . '
               ';

        //echo $sql;
        $message = $this->db->query($sql)->result_array();

        $data = array();
        foreach ($message as $row) {
            $row['unread'] = $this->checkUnreadMessage($userid, $row[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID]);
            array_push($data, $row);
        }

        return $data;
    }

    public function checkUnreadMessage($userid, $eid) {
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID, $userid);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eid);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_IS_READ, "0");

        $result = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE)->num_rows();

        return $result;
    }

    public function getMessages($ownerId, $eid) {
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID, $ownerId);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eid);

        $updatedata[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_IS_READ] = "1";
        $this->db->set($updatedata);
        $this->db->update(DBConfig::TABLE_EVENT_MESSAGE);

        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID, $ownerId);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eid);

        $chk = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE)->num_rows();

        //echo $this->db->last_query();

        if ($chk > 0) {


            $sql = 'SELECT * FROM ' . DBConfig::TABLE_EVENT_MESSAGE . '
                    WHERE ' . DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID . ' = "' . $eid . '" AND  (' . DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID . '="' . $ownerId . '" OR ' . DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID . '="' . $ownerId . '")
                    ORDER BY "' . DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID . '" ASC    
                   ';
            //echo $sql;
            //$this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eid);
            //$this->db->order_by(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID, "ASC");


            $message = $this->db->query($sql)->result_array();



            $data = array();

            foreach ($message as $row) {
                $cssclass = "";
                $ownername = "";

                if ($row[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE] == "2") {
                    $cssclass = "displayright";
                    $ownername = getUsernameById($row[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
                } else {
                    $cssclass = "displayleft";
                    $ownername = getVendorNameById($row[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
                }



                $row['cssclass'] = $cssclass;
                $row['username'] = $ownername;
                array_push($data, $row);
            }
            return $data;
        }
    }

    public function sendUserReply($userId) {
        $eventInfoId = cpr_decode($_POST['eid']);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eventInfoId);
        $this->db->order_by(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID, "ASC");
        $result = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE)->row_array();

        if (!empty($result)) {

            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_TITLE] = "reply";
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_DETAILS] = trim($_POST['replyMsg']);
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID] = $userId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE] = "2";
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID] = $result[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID];
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID] = $eventInfoId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_SENDING_DATE] = time();

            $i = $this->db->insert(DBConfig::TABLE_EVENT_MESSAGE, $data);

            $lastId = $this->db->insert_id();

            $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID, $lastId);
            $lastresult = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE)->row_array();
            $cssclass = "";
            $ownername = "";

            if ($lastresult[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE] == "2") {
                $cssclass = "displayright";
                $ownername = getUsernameById($lastresult[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
            } else {
                $cssclass = "displayleft";
                $ownername = getVendorNameById($lastresult[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
            }
            $lastresult['cssclass'] = $cssclass;
            $lastresult['username'] = $ownername;
            return $lastresult;
        } else {
            return "0";
        }
    }

    public function getUserInfo($userid = 0) {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userid);
        $query = $this->db->get(DBConfig::TABLE_USER);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result;
        }
    }

    public function updateProfile($userid = 0) {
        $data[DBConfig::TABLE_USER_ATT_NAME] = $this->input->post(DBConfig::TABLE_USER_ATT_NAME, TRUE);
        $data[DBConfig::TABLE_USER_ATT_ZIP_CODE] = $this->input->post(DBConfig::TABLE_USER_ATT_ZIP_CODE, TRUE);
        $data[DBConfig::TABLE_USER_ATT_CITY_ID] = $this->input->post(DBConfig::TABLE_USER_ATT_CITY_ID, TRUE);
        $data[DBConfig::TABLE_USER_ATT_STATE_ID] = $this->input->post(DBConfig::TABLE_USER_ATT_STATE_ID, TRUE);

        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userid);
        $this->db->set($data);
        $update = $this->db->update(DBConfig::TABLE_USER);
        if ($update) {
            $sess['successUpdateMsg'] = '<font color="#f00">User information successfully Updated</font>';
            $this->session->set_userdata($sess);
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE));
        }
    }

    public function checkOldPassword($password = '') {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $this->session->userdata('userId'));
        $this->db->where(DBConfig::TABLE_USER_ATT_PASSWORD, md5($password));
        $query = $this->db->get(DBConfig::TABLE_USER);
        return $query->num_rows();
    }

    public function updatePassword($userid = 0) {
        $data[DBConfig::TABLE_USER_ATT_PASSWORD] = md5($this->input->post('newPassword'));

        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userid);
        $this->db->set($data);
        $update = $this->db->update(DBConfig::TABLE_USER);
        if ($update) {
            $sess['passwordUpdateMsg'] = '<font color="#f00">User password successfully updated</font>';
            $this->session->set_userdata($sess);
            redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_CHANGE_PASSWORD));
        }
    }

    public function reportViolation($usrId, $eventinfoId) {
        $this->db->order_by(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID, "ASC");
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eventinfoId);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE, "1");
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID, $usrId);



        $result = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE, '1')->row_array();

        //echo $this->db->last_query();


        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_ID, $usrId);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_EVENT_INFO_ID, $eventinfoId);

        $result1 = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION)->num_rows();

        if ($result1 == 0) {
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_ID] = $usrId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_EVENT_INFO_ID] = $eventinfoId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTING_TIME] = time();
            $data[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_TYPE] = "1";
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

    public function getUserRatingReview($userId) {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID,$userId);
        $r = $this->db->get(DBConfig::TABLE_VENDOR_RATING)->result_array();
        $data = array();
        
        foreach($r as $row)
        {
            $row['review'] = $this->getVendorReview($userId,$row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID]);
            $row['vName'] = getVendorNameById($row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID]);
            array_push($data,$row);
        }
        
       return $data;
    }
    
    public function getVendorReview($userId,$vendorId)
    {
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID,$userId);
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID,$vendorId);
        $r = $this->db->get(DBConfig::TABLE_VENDOR_REVIEW)->row_array();
        
        return $r;
    }
    
    public function updateVendorRatingReview($userId)
    {
        $data1[DBConfig::TABLE_VENDOR_RATING_ATT_RATING] = $_POST['rating'];
        
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID,$userId);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID,$_POST['vID']);
        
        $this->db->set($data1);
        $this->db->update(DBConfig::TABLE_VENDOR_RATING);
        
        $data2[DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW] = $_POST['review'];
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID,$userId);
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID,$_POST['vID']);
        
        $this->db->set($data2);
        $this->db->update(DBConfig::TABLE_VENDOR_REVIEW);
        
        return '1';
    }

}
