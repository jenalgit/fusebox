<?php 

	if (!defined('BASEPATH')) die();

	class Conf_usergroups extends SF_Controller {
	
		public function __construct() {
			parent::__construct();
		}
		
		public function index(){
			$this->header( "Configure Usergroups" );
			$this->navbar();
			
			
			
			$this->view( "admin/configure/usergroups" );
			$this->footer();
		}
		
	}
	
?>