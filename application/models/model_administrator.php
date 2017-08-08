<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Administrator extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function dologin() {
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_USERNAME, $_POST['adminUsername']);
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['adminPassword']));

        $result = $this->db->get(DBConfig::TABLE_ADMIN)->row_array();

        if (empty($result)) {
            return '0';
        } else {
            $data[DBConfig::TABLE_ADMIN_ATT_ADMIN_LAST_LOGIN_TIME] = time();
            $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_ID, $result[DBConfig::TABLE_ADMIN_ATT_ADMIN_ID]);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_ADMIN);
            return $result;
        }
    }

    public function getSiteContent($contentname="") {
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $contentname);

        return $this->db->get(DBConfig::TABLE_CONTENT)->row_array();
    }

    public function updateSiteContent() {
        $data[DBConfig::TABLE_CONTENT_ATT_CONTENT_TITLE] = $_POST['title'];
        $data[DBConfig::TABLE_CONTENT_ATT_CONTENT_DETAILS] = $_POST['editor1'];
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $_POST['contentName']);

        $this->db->set($data);

        $u = $this->db->update(DBConfig::TABLE_CONTENT);


        return $u;
    }

    public function insertFAQ() {
        $data[DBConfig::TABLE_FAQ_ATT_FAQ_QUESTION] = $_POST['Question'];
        $data[DBConfig::TABLE_FAQ_ATT_FAQ_ANSWER] = $_POST['Answer'];
        $data[DBConfig::TABLE_FAQ_ATT_ADDED_TIME] = time();


        $i = $this->db->insert(DBConfig::TABLE_FAQ, $data);
        if ($i)
            return '1';
    }

    public function deletefaq($id=0) {
        $this->db->where(DBConfig::TABLE_FAQ_ATT_FAQ_ID, $id);
        $d = $this->db->delete(DBConfig::TABLE_FAQ);

        if ($d)
            return '1';
    }

    public function updateSiteParameter() {
        if ($_FILES['userfile']['name'] == true) {
            $path = "assets/public/site/";

            $imagefilename = uniqid() . basename($_FILES['userfile']['name']);

            $target = $path . $imagefilename;

            $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $extension = $_FILES["userfile"]["type"];

            if (in_array($extension, $allowedType)) {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target)) {
                    $imagename = $imagefilename;
                    $data[DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO] = $imagename;
                }
            }
        }

        // exit();


        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE] = trim($_POST['siteTitle']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD] = trim($_POST['siteMetaKeyword']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION] = trim($_POST['siteMetaDescription']);

        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_EMAIL] = trim($_POST['siteEmail']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_PHONE] = trim($_POST['sitePhone']);
        $data[DBConfig::TABLE_SETTINGS_ATT_HIDE_HOME_CONTENT] = trim($_POST['homeContentStatus']);

        $this->db->where(DBConfig::TABLE_SETTINGS_ATT_ID, '1');
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_SETTINGS);

        if ($u) {
            return '1';
        }
    }

    public function changepassword() {
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['old_password']));
        $result = $this->db->get(DBConfig::TABLE_ADMIN)->row_array();
        if (!empty($result)) {

            $data[DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD] = md5($_POST['new_password']);
            $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['old_password']));

            $this->db->set($data);

            $u = $this->db->update(DBConfig::TABLE_ADMIN);

            if ($u) {
                return '1';
            }
        }
    }

    public function getVendorList() {

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('vendorName', 'vendorBusinessName', 'vendorEmail', 'vendorAddress', 'vendorStatus');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = DBConfig::TABLE_VENDOR_ATT_VENDOR_ID;

        /* DB table to use */
        $sTable = DBConfig::TABLE_VENDOR;

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
                    intval($_GET['iDisplayLength']);
        }


        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
                            ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }


        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
        //echo $sQuery;

        $rResult = mysql_query($sQuery);


        /* Data set length after filtering */
        $sQuery = "
		SELECT FOUND_ROWS()
	";
        $rResultFilterTotal = mysql_query($sQuery) or die(mysql_error());
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";
        $rResultTotal = mysql_query($sQuery) or die(mysql_error());
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];


        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        while ($aRow = mysql_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            //echo $row[2];

            if ($row[4] == "1") {
                $row[4] = '<a onclick="directory.blockedVendor(\'' . $row[2] . '\')" href="javascript:;" class="btn btn-small btn-danger">Block</a>';
            } else {
                $row[4] = '<a onclick="directory.unblockedVendor(\'' . $row[2] . '\')" href="javascript:;" class="btn btn-small btn-success">UnBlock</a>';
            }
            $output['aaData'][] = $row;
        }

        //debugPrint($output);

        return json_encode($output);
    }

    public function getUserList() {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('name', 'email', 'status');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = DBConfig::TABLE_USER_ATT_USER_ID;

        /* DB table to use */
        $sTable = DBConfig::TABLE_USER;

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
                    intval($_GET['iDisplayLength']);
        }


        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
                            ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }


        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
        //echo $sQuery;

        $rResult = mysql_query($sQuery);


        /* Data set length after filtering */
        $sQuery = "
		SELECT FOUND_ROWS()
	";
        $rResultFilterTotal = mysql_query($sQuery) or die(mysql_error());
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";
        $rResultTotal = mysql_query($sQuery) or die(mysql_error());
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];


        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        while ($aRow = mysql_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            //echo $row[2];

            if ($row[2] == "1") {
                $row[2] = '<a onclick="directory.blockedUser(\'' . $row[1] . '\')" href="javascript:;" class="btn btn-small btn-danger">Block</a>';
            } else {
                $row[2] = '<a onclick="directory.unblockedUser(\'' . $row[1] . '\')" href="javascript:;" class="btn btn-small btn-success">UnBlock</a>';
            }
            $output['aaData'][] = $row;
        }

        //debugPrint($output);

        return json_encode($output);
    }

    public function blockedVendor($email) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL, $email);
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS, '1');

        $r = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();

        //echo $this->db->last_query();

        if (!empty($r)) {
            $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS] = "0";
            $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL, $email);
            $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS, '1');

            $this->db->set($data);

            $u = $this->db->update(DBConfig::TABLE_VENDOR);

            if ($u) {
                return '1';
            }
        }
    }

    public function blockedUser($email) {
        $this->db->where(DBConfig::TABLE_USER_ATT_EMAIL, $email);
        $this->db->where(DBConfig::TABLE_USER_ATT_STATUS, '1');

        $r = $this->db->get(DBConfig::TABLE_USER)->row_array();

        //echo $this->db->last_query();

        if (!empty($r)) {
            $data[DBConfig::TABLE_USER_ATT_STATUS] = "0";
            $this->db->where(DBConfig::TABLE_USER_ATT_EMAIL, $email);
            $this->db->where(DBConfig::TABLE_USER_ATT_STATUS, '1');

            $this->db->set($data);

            $u = $this->db->update(DBConfig::TABLE_USER);

            if ($u) {
                return '1';
            }
        }
    }

    public function unblockedVendor($email) {
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL, $email);
        $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS, '0');

        $r = $this->db->get(DBConfig::TABLE_VENDOR)->row_array();

        //echo $this->db->last_query();

        if (!empty($r)) {
            $data[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS] = "1";
            $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL, $email);
            $this->db->where(DBConfig::TABLE_VENDOR_ATT_VENDOR_STATUS, '0');

            $this->db->set($data);

            $u = $this->db->update(DBConfig::TABLE_VENDOR);

            if ($u) {
                return '1';
            }
        }
    }

    public function unblockedUser($email) {
        $this->db->where(DBConfig::TABLE_USER_ATT_EMAIL, $email);
        $this->db->where(DBConfig::TABLE_USER_ATT_STATUS, '0');

        $r = $this->db->get(DBConfig::TABLE_USER)->row_array();

        //echo $this->db->last_query();

        if (!empty($r)) {
            $data[DBConfig::TABLE_USER_ATT_STATUS] = "1";
            $this->db->where(DBConfig::TABLE_USER_ATT_EMAIL, $email);
            $this->db->where(DBConfig::TABLE_USER_ATT_STATUS, '0');

            $this->db->set($data);

            $u = $this->db->update(DBConfig::TABLE_USER);

            if ($u) {
                return '1';
            }
        }
    }

    public function getReportedUserList() {
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_TYPE, "2");

        $result = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['usr'] = getUserDetails($row[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_VIOLATED_BY_ID]);
            $row['vendor'] = getVendorDetails($row[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_ID]);
            $row['eventDetails'] = getEventInfoDetailsId($row[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_EVENT_INFO_ID]);
            array_push($data, $row);
        }
        return $data;
    }

    public function getReportedVendorList() {
        $this->db->where(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_TYPE, "1");

        $result = $this->db->get(DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['usr'] = getUserDetails($row[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_REPORTER_ID]);
            $row['vendor'] = getVendorDetails($row[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_VIOLATED_BY_ID]);
            $row['eventDetails'] = getEventInfoDetailsId($row[DBConfig::TABLE_EVENT_MESSAGE_REPORT_VIOLATION_ATT_REPORT_VIOLATION_EVENT_INFO_ID]);
            array_push($data, $row);
        }
        return $data;
    }

    public function getReportedRatingList() {
        $sql = 'SELECT ' . DBConfig::TABLE_VENDOR_REPORT_RATING . '.*,' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID . ',' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID . ',' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_RATING . '
                FROM ' . DBConfig::TABLE_VENDOR_REPORT_RATING . '
                LEFT JOIN ' . DBConfig::TABLE_VENDOR_RATING . ' ON ' . DBConfig::TABLE_VENDOR_RATING . '.' . DBConfig::TABLE_VENDOR_RATING_ATT_RATING_ID . ' = ' . DBConfig::TABLE_VENDOR_REPORT_RATING . '.' . DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_RATING_ID . '                   
               ';

        //echo $sql;

        $result = $this->db->query($sql)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['uName'] = getUsernameById($row[DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID]);
            $row['vName'] = getVendorNameById($row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID]);
            $row['ratebar'] = getRatingBar($row[DBConfig::TABLE_VENDOR_RATING_ATT_RATING]);
            $row['review'] = $this->getVendorReview($row[DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID], $row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID]);
            array_push($data, $row);
        }

        //debugPrint($data);

        return $data;
    }

    public function getVendorReview($userId, $vendorId) {
        $this->db->select(DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW);
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID, $vendorId);
        $r = $this->db->get(DBConfig::TABLE_VENDOR_REVIEW)->row_array();

        return $r[DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW];
    }

    public function deleteRatingReview() {
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID, $_POST['uID']);
        $this->db->where(DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID, $_POST['vID']);

        $d = $this->db->delete(DBConfig::TABLE_VENDOR_RATING);

        if ($d) {
            $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_USER_ID, $_POST['uID']);
            $this->db->where(DBConfig::TABLE_VENDOR_REVIEW_ATT_VENDOR_ID, $_POST['vID']);

            $d1 = $this->db->delete(DBConfig::TABLE_VENDOR_REVIEW);

            if ($d1) {
                return '1';
            }
        }
    }

    public function reportMarkAsInvalid() {
        $data[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_REPORT_STATUS] = "2";

        $this->db->where(DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_REPORT_ID, $_POST['rId']);
        $this->db->set($data);

        $u = $this->db->update(DBConfig::TABLE_VENDOR_REPORT_RATING);

        if ($u) {
            return '1';
        }
    }

    public function setVendorLogo() {
        $path = "assets/public/vendor/";



        $imageFile = basename($_FILES['userfile']['name']);
        $tmpName = $_FILES['userfile']['tmp_name'];
        $fileName = uniqid() . $imageFile;
        $target = $path . $fileName;

        $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $extension = $_FILES["userfile"]["type"];

        if (in_array($extension, $allowedType)) {
            if (move_uploaded_file($tmpName, $target)) {

                $result = $this->db->get(DBConfig::TABLE_SETTINGS)->row_array();

                $oldImg = $result[DBConfig::TABLE_SETTINGS_ATT_SITE_VENDOR_LOGO];

                if (file_exists($path . $oldImg)) {
                    if ($oldImg) {
                        unlink($path . $oldImg);
                    }
                }

                $data[DBConfig::TABLE_SETTINGS_ATT_SITE_VENDOR_LOGO] = $fileName;
                $this->db->where(DBConfig::TABLE_SETTINGS_ATT_ID, '1');
                $this->db->set($data);

                $u = $this->db->update(DBConfig::TABLE_SETTINGS);

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

}

?>
