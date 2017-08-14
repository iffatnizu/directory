<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'siteConfig.php';
require_once 'dbConfig.php';
require_once APPPATH . 'directory/vendorconfig.php';

class Events extends CI_Controller {

    public function Events() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email', 'session'));
        $this->load->model('model_events');
        $this->load->helper('events');
    }

    public function index() {
        $this->all();
    }

    public function all() {
        //echo to10($vendorid);
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

    public function bookmarkservice() {
        if ($this->session->userdata('_userLogin')) {
            $eid = cpr_decode(($_GET['eventsInfoid']));
            if (is_numeric($eid)) {
                $i = $this->model_events->bookmarkservice();

                echo $i;
            }
        }
    }

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