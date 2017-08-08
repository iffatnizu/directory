<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Events extends CI_Model {

    public function Model_Events() {
        parent::__construct();
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function getAllEvents() {
        $sql = 'SELECT ' . DBConfig::TABLE_EVENT_INFO . '.*,
                       ' . DBConfig::TABLE_EVENT_TYPE . '.*, 
                       ' . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_NAME . ',
                       ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_NAME . '
                FROM ' . DBConfig::TABLE_EVENT_INFO . '
                LEFT JOIN ' . DBConfig::TABLE_EVENT_TYPE . ' ON ' . DBConfig::TABLE_EVENT_TYPE . '.' . DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID . '
                LEFT JOIN ' . DBConfig::TABLE_STATE . ' ON ' . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID . '    
                LEFT JOIN ' . DBConfig::TABLE_CITY . ' ON ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID . '    
               ';

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function eventsDetails($id=0) {
        $sql = 'SELECT ' . DBConfig::TABLE_EVENT_INFO . '.*,
                       ' . DBConfig::TABLE_EVENT_TYPE . '.*, 
                       ' . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_NAME . ',
                       ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_NAME . '
                FROM ' . DBConfig::TABLE_EVENT_INFO . '
                LEFT JOIN ' . DBConfig::TABLE_EVENT_TYPE . ' ON ' . DBConfig::TABLE_EVENT_TYPE . '.' . DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID . '
                LEFT JOIN ' . DBConfig::TABLE_STATE . ' ON ' . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID . '    
                LEFT JOIN ' . DBConfig::TABLE_CITY . ' ON ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID . '    
                WHERE ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID . ' = "' . $id . '"
               ';

        $result = $this->db->query($sql)->row_array();

        if (!empty($result)) {

            $result['catering'] = $this->getCateringByEventInfoId($id);
            $result['receptionhall'] = $this->getReceptionHallByEventInfoId($id);
            $result['entertainers'] = $this->getEntertainmentByEventInfoId($id);
            $result['florists'] = $this->getFloristsByEventInfoId($id);
            $result['photography'] = $this->getPhotographyByEventInfoId($id);
            $result['Limos'] = $this->getLimosByEventInfoId($id);
        }

        //debugPrint($result);

        return $result;
    }

    public function getCateringByEventInfoId($id) {
        $this->db->where(DBConfig::TABLE_CATERING_ATT_EVENT_INFO_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_CATERING)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['foodType'] = getFoodTypeByTypeId($row[DBConfig::TABLE_CATERING_ATT_FOOD_TYPE_ID]);
            $equipments = explode(',', $row[DBConfig::TABLE_CATERING_ATT_EQUIPMENT]);
            $equipmentname = "";
            foreach ($equipments as $eqname) {
                $equipmentname.= getEquipmentNameById($eqname) . ', ';
            }
            $row['equipmentname'] = substr($equipmentname, 0, (strlen($equipmentname) - 2));
            $row['venue'] = getVenuementNameById($row[DBConfig::TABLE_CATERING_ATT_VENUE_TYPE_ID]);
            $row['isBookmarked'] = isServiceBookmarked('1', $id, $row[DBConfig::TABLE_CATERING_ATT_CATERING_ID], $this->session->userdata('_userId'));
            array_push($data, $row);
        }
        return $data;
    }

    public function getReceptionHallByEventInfoId($id) {
        //echo $id;
        $this->db->where(DBConfig::TABLE_RECEPTION_HALLS_ATT_EVENT_INFO_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_RECEPTION_HALLS)->result_array();
        $data = array();

        foreach ($result as $row) {
            $amenities = "";

            $am = explode(',', $row[DBConfig::TABLE_RECEPTION_HALLS_ATT_AMENITIES_TYPE]);

            foreach ($am as $a) {
                $amenities.= getAmenitiesTypeNameById($a) . ', ';
            }

            $row['amenities'] = substr($amenities, 0, (strlen($amenities) - 2));
            $row['service'] = getServiceNameById($row[DBConfig::TABLE_RECEPTION_HALLS_ATT_SERVICE_ID]);
            $row['isBookmarked'] = isServiceBookmarked('2', $id, $row[DBConfig::TABLE_RECEPTION_HALLS_ATT_RECEPTION_ID], $this->session->userdata('_userId'));
            array_push($data, $row);
        }

        return $data;
    }

    public function getEntertainmentByEventInfoId($id) {
        $this->db->where(DBConfig::TABLE_ENTERTAINMENT_ATT_EVENT_INFO_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_ENTERTAINMENT)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['agerange'] = getAgeRangeById($row[DBConfig::TABLE_ENTERTAINMENT_ATT_AGE_RANGE_ID]);

            $entertainment = "";
            $ent = explode(',', $row[DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_TYPE]);

            foreach ($ent as $e) {
                $entertainment.= getEntertainmentTypeNameById($e) . ', ';
            }

            $row['entertainment'] = substr($entertainment, 0, (strlen($entertainment) - 2));
            $row['isBookmarked'] = isServiceBookmarked('3', $id, $row[DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_ID], $this->session->userdata('_userId'));
            array_push($data, $row);
        }

        return $data;
    }

    public function getFloristsByEventInfoId($id) {
        $this->db->where(DBConfig::TABLE_FLORISTS_ATT_EVENT_INFO_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_FLORISTS)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['service'] = getServiceNameById($row[DBConfig::TABLE_FLORISTS_ATT_FLORISTS_SERVICE]);
            $flower = "";

            $f = explode(',', $row[DBConfig::TABLE_FLORISTS_ATT_FLOWER_TYPE]);

            foreach ($f as $e) {
                $flower.= getFlowerTypeNameById($e) . ', ';
            }

            $row['flower'] = substr($flower, 0, (strlen($flower) - 2));


            $arrangement = "";
            $a = explode(',', $row[DBConfig::TABLE_FLORISTS_ATT_ARRANGEMENT_TYPE]);

            foreach ($a as $e) {
                $arrangement.= getArrangementTypeNameById($e) . ', ';
            }
            $row['arrangement'] = $arrangement;
            $row['isBookmarked'] = isServiceBookmarked('4', $id, $row[DBConfig::TABLE_FLORISTS_ATT_FLORISTS_ID], $this->session->userdata('_userId'));

            array_push($data, $row);
        }

        return $data;
    }

    public function getPhotographyByEventInfoId($id) {
        $this->db->where(DBConfig::TABLE_PHOTOGRAPHY_ATT_EVENT_INFO_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_PHOTOGRAPHY)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['pstyle'] = getPhotographyStyleNameById($row[DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_STYLE_ID]);
            $row['isBookmarked'] = isServiceBookmarked('5', $id, $row[DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_ID], $this->session->userdata('_userId'));
            array_push($data, $row);
        }

        return $data;
    }

    public function getLimosByEventInfoId($id=0) {
        $this->db->where(DBConfig::TABLE_LIQUOR_ATT_EVENT_INFO_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_LIQUOR)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['service'] = getServiceNameById($row[DBConfig::TABLE_LIQUOR_ATT_SERVICE_ID]);
            $food = "";

            $ft = explode(',', $row[DBConfig::TABLE_LIQUOR_ATT_DRINK_TYPES]);

            foreach ($ft as $e) {
                $food.= getDrinkTypeNameById($e) . ', ';
            }
            $row['food'] = $food;
            $row['isBookmarked'] = isServiceBookmarked('6', $id, $row[DBConfig::TABLE_LIQUOR_ATT_LIQUOR_ID], $this->session->userdata('_userId'));
            array_push($data, $row);
        }

        return $data;
    }

    public function bookmarkservice() {
        $check = isServiceBookmarked($_GET['serviceid'], cpr_decode($_GET['eventsInfoid']), $_GET['servicelistId'], $this->session->userdata('_userId'));
        if ($check == '0') {
            $data[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID] = $_GET['serviceid'];
            $data[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_VENDOR_ID] = $this->session->userdata('_userId');
            $data[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_EVENTS_INFO_ID] = cpr_decode($_GET['eventsInfoid']);
            $data[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_LIST_ID] = $_GET['servicelistId'];
            $data[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_DATE] = time();

            $i = $this->db->insert(DBConfig::TABLE_BOOKMARK, $data);
            if ($i) {
                return '1';
            }
        }
    }

    public function removebookmarkservice() {
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID, $_GET['serviceid']);
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_EVENTS_INFO_ID, cpr_decode($_GET['eventsInfoid']));
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_LIST_ID, $_GET['servicelistId']);
        $this->db->where(DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_VENDOR_ID, $this->session->userdata('_userId'));

        $d = $this->db->delete(DBConfig::TABLE_BOOKMARK);

        if ($d) {
            return '1';
        }
    }

    public function getAllbookmark($id) {
        $sql = 'SELECT * FROM ' . DBConfig::TABLE_BOOKMARK . '                 
                WHERE ' . DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_VENDOR_ID . ' = "' . $id . '"
                GROUP BY ' . DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_EVENTS_INFO_ID . '
               ';
        $result = $this->db->query($sql)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['eventsname'] = $this->getEventsDetails($row[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_EVENTS_INFO_ID]);
            //$row['serviceDetails'] = $this->getCategoryServiceListById($row[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID]);
            array_push($data, $row);
        }

        //debugPrint($data);

        return $data;
    }

    public function getEventsDetails($id) {
        $sql = 'SELECT ' . DBConfig::TABLE_EVENT_INFO . '.*,
                       ' . DBConfig::TABLE_EVENT_TYPE . '.*, 
                       ' . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_NAME . ',
                       ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_NAME . '
                FROM ' . DBConfig::TABLE_EVENT_INFO . '
                LEFT JOIN ' . DBConfig::TABLE_EVENT_TYPE . ' ON ' . DBConfig::TABLE_EVENT_TYPE . '.' . DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_TYPE_ID . '
                LEFT JOIN ' . DBConfig::TABLE_STATE . ' ON ' . DBConfig::TABLE_STATE . '.' . DBConfig::TABLE_STATE_ATT_STATE_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID . '    
                LEFT JOIN ' . DBConfig::TABLE_CITY . ' ON ' . DBConfig::TABLE_CITY . '.' . DBConfig::TABLE_CITY_ATT_CITY_ID . ' = ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID . '    
                WHERE ' . DBConfig::TABLE_EVENT_INFO . '.' . DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID . ' = "' . $id . '"
               ';

        $result = $this->db->query($sql)->row_array();

        return $result[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME];
    }

    

}
