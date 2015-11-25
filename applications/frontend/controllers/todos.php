<?php
class Todos extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                if (!ENABLED_MEMBERSHIP) {
                        redirect();
                        exit;
                }
                $this->load->library('session');
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->database();
                $this->load->library('form_validation');
                //load the employee model
                $this->load->helper('email');
$this->load->library('pagination');
        }

        // Account Dashboard / Home
        public function index()
        {

                $this->mTitle = "Account";
                $this->mViewFile = 'account/adduser';

        }
        public function add()
        {

                $this->mTitle = "Account";
                $this->mViewFile = 'account/park';

        }
	
	
}
