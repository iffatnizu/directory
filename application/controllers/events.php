<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'siteConfig.php';
require_once 'dbConfig.php';
require_once APPPATH . 'directory/vendorconfig.php';

/**
 * This class does event's operations
 * @author Iffat Nizu
 * @requires siteconfig.php & dbconfig.php files
 * Functions list - index, all, details, bookmarkservice, removebookmarkservice, bookmark
 */

class Events extends CI_Controller {

    public function Events() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email', 'session'));
        $this->load->model('model_events');
        $this->load->helper('events');
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function index()
     * @param 
     * @uses Index method for event controller 
     * @return None 
     */
    public function index() {
        $this->all();
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function all()
     * @param 
     * @uses show all events
     * @return None 
     */
    public function all() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'All events';
            $data['allevents'] = $this->model_events->getAllEvents();
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, '', TRUE);
            $vendor['content'] = $this->load->view(siteConfig::COMPONENT_EVENTS_ALL, $data, TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

    /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function details()
     * @param int $id 
     * @param value 0
     * @uses show event details
     * @return  
     */
    public function details($id=0) {
        if ($this->session->userdata('_userLogin')) {
            $eid = cpr_decode($id);
            if (is_numeric($eid)) {
                $data['title'] = 'Events details';
                $data['eid'] = $id;
                $data['details'] = $this->model_events->eventsDetails($eid);
                $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
                $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, '', TRUE);
                $vendor['content'] = $this->load->view(siteConfig::COMPONENT_EVENTS_DETAILS, $data, TRUE);
                $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
                $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

     /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function bookmarkservice()
     * @param 
     * @uses for bookmark services
     * @return 
     */
    public function bookmarkservice() {
        if ($this->session->userdata('_userLogin')) {
            $eid = cpr_decode(($_GET['eventsInfoid']));
            if (is_numeric($eid)) {
                $i = $this->model_events->bookmarkservice();

                echo $i;
            }
        }
    }

     /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function removebookmarkservice()
     * @param 
     * @uses for remove bookmark
     * @return None 
     */
    public function removebookmarkservice() {
        if ($this->session->userdata('_userLogin')) {
            if (isset($_GET['submit'])) {
                $eid = cpr_decode($_GET['eventsInfoid']);
                if (is_numeric($eid)) {
                    $i = $this->model_events->removebookmarkservice();
                    echo $i;
                }
            }
        }
    }

     /**
     * @author Iffat Nizu
     * @package directory
     * @access public
     * @name function bookmark()
     * @param 
     * @uses show all bookmarks
     * @return None 
     */
    public function bookmark() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'All bookmark';
            $data['allbookmark'] = $this->model_events->getAllbookmark($this->session->userdata('_userId'));
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, '', TRUE);
            $vendor['content'] = $this->load->view(siteConfig::COMPONENT_EVENTS_BOOKMARK, $data, TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

}