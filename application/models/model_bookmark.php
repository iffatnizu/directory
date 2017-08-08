<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Bookmark extends CI_Model {

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
    
    public function getBookmarkServices($id, $usrId) {
        $sql = 'SELECT * FROM ' . DBConfig::TABLE_BOOKMARK . '                 
                WHERE ' . DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_EVENTS_INFO_ID . ' = "' . $id . '"
                AND ' . DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_VENDOR_ID . ' = "' . $usrId . '"
                ORDER BY ' . DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID . ' ASC
               ';
        //echo $sql;
        $result = $this->db->query($sql)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['servicename'] = getCategoryNameById($row[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID]);
            $row['servicDetails'] = $this->getCategoryServiceListById($row[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID]);
            array_push($data, $row);
        }

        return $data;
    }

    public function getCategoryServiceListById($id) {
        $sql = 'SELECT * FROM ' . DBConfig::TABLE_BOOKMARK . '                 
                WHERE ' . DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_ID . ' = "' . $id . '"
               ';
        $result = $this->db->query($sql)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['ListDetails'] = $this->getCategoryServiceListDetails($id, $row[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_SERVICE_LIST_ID]);
            array_push($data, $row);
        }

        return $data;
    }

    public function getCategoryServiceListDetails($catId, $id) {
        if ($catId == '1') {
            $this->db->where(DBConfig::TABLE_CATERING_ATT_CATERING_ID, $id);
            $result = $this->db->get(DBConfig::TABLE_CATERING)->row_array();
            $result['foodType'] = getFoodTypeByTypeId($result[DBConfig::TABLE_CATERING_ATT_FOOD_TYPE_ID]);
            $equipments = explode(',', $result[DBConfig::TABLE_CATERING_ATT_EQUIPMENT]);
            $equipmentname = "";
            foreach ($equipments as $eqname) {
                $equipmentname.= getEquipmentNameById($eqname) . ', ';
            }
            $result['equipmentname'] = substr($equipmentname, 0, (strlen($equipmentname) - 2));
            $result['venue'] = getVenuementNameById($result[DBConfig::TABLE_CATERING_ATT_VENUE_TYPE_ID]);


            return $result;
        } elseif ($catId == '2') {
            $this->db->where(DBConfig::TABLE_RECEPTION_HALLS_ATT_RECEPTION_ID, $id);
            $result = $this->db->get(DBConfig::TABLE_RECEPTION_HALLS)->row_array();

            $amenities = "";

            $am = explode(',', $result[DBConfig::TABLE_RECEPTION_HALLS_ATT_AMENITIES_TYPE]);

            foreach ($am as $a) {
                $amenities.= getAmenitiesTypeNameById($a) . ', ';
            }

            $result['amenities'] = substr($amenities, 0, (strlen($amenities) - 2));
            $result['service'] = getServiceNameById($result[DBConfig::TABLE_RECEPTION_HALLS_ATT_SERVICE_ID]);


            return $result;
        } elseif ($catId == '3') {
            $this->db->where(DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_ID, $id);
            $result = $this->db->get(DBConfig::TABLE_ENTERTAINMENT)->row_array();


            $result['agerange'] = getAgeRangeById($result[DBConfig::TABLE_ENTERTAINMENT_ATT_AGE_RANGE_ID]);

            $entertainment = "";
            $ent = explode(',', $result[DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_TYPE]);

            foreach ($ent as $e) {
                $entertainment.= getEntertainmentTypeNameById($e) . ', ';
            }

            $result['entertainment'] = substr($entertainment, 0, (strlen($entertainment) - 2));


            return $result;
        } elseif ($catId == '4') {
            $this->db->where(DBConfig::TABLE_FLORISTS_ATT_FLORISTS_ID, $id);
            $result = $this->db->get(DBConfig::TABLE_FLORISTS)->row_array();

            $result['service'] = getServiceNameById($result[DBConfig::TABLE_FLORISTS_ATT_FLORISTS_SERVICE]);
            $flower = "";

            $f = explode(',', $result[DBConfig::TABLE_FLORISTS_ATT_FLOWER_TYPE]);

            foreach ($f as $e) {
                $flower.= getFlowerTypeNameById($e) . ', ';
            }

            $result['flower'] = substr($flower, 0, (strlen($flower) - 2));


            $arrangement = "";
            $a = explode(',', $result[DBConfig::TABLE_FLORISTS_ATT_ARRANGEMENT_TYPE]);

            foreach ($a as $e) {
                $arrangement.= getArrangementTypeNameById($e) . ', ';
            }
            $result['arrangement'] = $arrangement;

            return $result;
        } elseif ($catId == '5') {
            $this->db->where(DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_ID, $id);
            $result = $this->db->get(DBConfig::TABLE_PHOTOGRAPHY)->row_array();

            $result['pstyle'] = getPhotographyStyleNameById($result[DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_STYLE_ID]);


            return $result;
        } elseif ($catId == '6') {
            $this->db->where(DBConfig::TABLE_LIQUOR_ATT_LIQUOR_ID, $id);
            $result = $this->db->get(DBConfig::TABLE_LIQUOR)->row_array();

            $result['service'] = getServiceNameById($result[DBConfig::TABLE_LIQUOR_ATT_SERVICE_ID]);
            $food = "";

            $ft = explode(',', $result[DBConfig::TABLE_LIQUOR_ATT_DRINK_TYPES]);

            foreach ($ft as $e) {
                $food.= getDrinkTypeNameById($e) . ', ';
            }
            $result['food'] = $food;


            return $result;
        }
    }
}