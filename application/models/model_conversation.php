<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Conversation extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function sendMessage($userId) {
        $eventInfoId = cpr_decode($_POST['eid']);
        $this->db->where(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID, $eventInfoId);
        $result = $this->db->get(DBConfig::TABLE_EVENT_INFO)->row_array();

        if (!empty($result)) {

            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_TITLE] = $_POST['subject'];
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_DETAILS] = trim($_POST['message']);
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID] = $userId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE] = "1";
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID] = $result[DBConfig::TABLE_EVENT_INFO_ATT_USER_ID];
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID] = $eventInfoId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_SENDING_DATE] = time();

            $i = $this->db->insert(DBConfig::TABLE_EVENT_MESSAGE, $data);

            if ($i) {
                return '1';
            } else {
                return '2';
            }
        } else {
            return "0";
        }
    }

    public function getInboxMessageByVendor($ownerId=0) {
        $sql = 'SELECT ' . DBConfig::TABLE_EVENT_MESSAGE . '.*,' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME . ',' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_NAME . ',' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME . '
                FROM ' . DBConfig::TABLE_EVENT_MESSAGE . '
                LEFT JOIN ' . DBConfig::TABLE_VENDOR . ' ON ' . DBConfig::TABLE_VENDOR . '.' . DBConfig::TABLE_VENDOR_ATT_VENDOR_ID . ' = ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID . '
                LEFT JOIN ' . DBConfig::TABLE_USER . '  ON ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_ID . ' = ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID . '
                LEFT JOIN ' . DBConfig::TABLE_EVENT_INFO . '  ON ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID . ' = ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID . '
                WHERE ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID . ' = "' . $ownerId . '"
                GROUP BY ' . DBConfig::TABLE_EVENT_MESSAGE . '.' . DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID . '
               ';

        //echo $sql;
        $message = $this->db->query($sql)->result_array();

        $data = array();
        foreach($message as $row)
        {
            $row['unread'] =  $this->checkUnreadMessage($ownerId,$row[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID]);
            array_push($data,$row);
        }

        return $data;
    }
    
    public function checkUnreadMessage($ownerId,$eid)
    {
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID, $ownerId);
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
        
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID, $ownerId);
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eid);

        $chk = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE)->num_rows();

        if ($chk > 0) {


            $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID, $eid);
            $this->db->order_by(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID, "ASC");


            $message = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE)->result_array();

            //echo $this->db->last_query();

            $data = array();

            foreach ($message as $row) {
                $cssclass = "";
                $ownername = "";

                if ($row[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE] == "1") {
                    $cssclass = "displayright";
                    $ownername = getVendorNameById($row[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
                } else {
                    $cssclass = "displayleft";
                    $ownername = getUsernameById($row[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
                }



                $row['cssclass'] = $cssclass;
                $row['username'] = $ownername;
                array_push($data, $row);
            }
            return $data;
        }
    }

    public function sendReply($userId) {
        $eventInfoId = cpr_decode($_POST['eid']);
        $this->db->where(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID, $eventInfoId);
        $result = $this->db->get(DBConfig::TABLE_EVENT_INFO)->row_array();

        if (!empty($result)) {

            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_TITLE] = "reply";
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_DETAILS] = trim($_POST['replyMsg']);
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID] = $userId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE] = "1";
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_RECEIVER_ID] = $result[DBConfig::TABLE_EVENT_INFO_ATT_USER_ID];
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID] = $eventInfoId;
            $data[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_SENDING_DATE] = time();

            $i = $this->db->insert(DBConfig::TABLE_EVENT_MESSAGE, $data);

            $lastId = $this->db->insert_id();

            $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_ID, $lastId);
            $lastresult = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE)->row_array();
            $cssclass = "";
            $ownername = "";

            if ($lastresult[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_TYPE] == "1") {
                $cssclass = "displayright";
                $ownername = getVendorNameById($lastresult[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
            } else {
                $cssclass = "displayleft";
                $ownername = getUsernameById($lastresult[DBConfig::TABLE_EVENT_MESSAGE_ATT_SENDER_ID]);
            }
            $lastresult['cssclass'] = $cssclass;
            $lastresult['username'] = $ownername;
            return $lastresult;
        } else {
            return "0";
        }
    }

}