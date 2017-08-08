<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'siteConfig.php';
require_once 'dbConfig.php';
require_once APPPATH . 'directory/vendorconfig.php';

class Conversation extends CI_Controller {

    public function Conversation() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email', 'session'));
        $this->load->model('model_conversation');
        $this->load->helper('user');
    }

    public function sendMessage() {
        if ($this->session->userdata('_userLogin')) {
            $send = $this->model_conversation->sendMessage($this->session->userdata('_userId'));

            echo $send;
        } else {
            echo 'Sesion time out please login again';
        }
    }
    public function sendReply() {
        if ($this->session->userdata('_userLogin')) {
            $send = $this->model_conversation->sendReply($this->session->userdata('_userId'));

            echo json_encode($send);
        } else {
            echo 'Sesion time out please login again';
        }
    }

    public function inbox() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'Welcome to Vendor Panel';
            $data['allmessage'] = $this->model_conversation->getInboxMessageByVendor($this->session->userdata('_userId'));
            $vendor['header'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_HEADER, $data, TRUE);
            $vendor['navigation'] = $this->load->view(Vendorconfig::COMPONENT_VENDOR_NAVIGATION, '', TRUE);
            $vendor['content'] = $this->load->view(Vendorconfig::COMPONENT_CONVERSATION_INBOX, '', TRUE);
            $vendor['footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(Vendorconfig::COMPONENT_VENDOR_MASTER, $vendor);
        } else {
            redirect(site_url());
        }
    }

    public function getMessages() {
        if ($this->session->userdata('_userLogin')) {
            if (isset($_GET['submit'])) {
                $msg = $this->model_conversation->getMessages($this->session->userdata('_userId'), cpr_decode($_GET['eid']));
                echo json_encode($msg);
                //echo "";
            }
            else{
                print("Nice try");
            }
        }
    }

}