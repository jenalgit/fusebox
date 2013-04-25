<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SF_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		//Setup Database
		$this->load->database();

		//Load Libraries
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('nav');
		$this->load->library('support_priorities');
		$this->load->library('support_status');
		
		//Load helpers
		$this->load->helper('url');
		$this->load->helper('language');
		$this->load->helper('bootstrap_helper');
		
		//Load classes
		$this->lang->load('base');
		$this->lang->load('auth');
		
		//Load Models
		$this->load->model('Settings');
		
		$this->loginUser();
		$this->loadNavElements();
	}

	private function loadNavElements()
	{
		$this->nav->AddToNav( "dashboard", "icon-home" );
		$this->nav->AddToNav( "support", "icon-comment" );
		$this->nav->AddToNav( "user", "icon-user" );
	}
	
	private function loginUser()
	{
		$this->data["login"] = $this->ion_auth->logged_in();
		
		if ($this->data["login"]) {
			$this->data["user"] = $this->ion_auth->user()->row();
			$this->user = $this->ion_auth->user()->row();
		}
		
		$this->data["admin"] = $this->ion_auth->is_admin();
	}
	
	public function view($name, $data = true) {
		if ($data) {
			$this->load->view($name, $this->data);
		} else {
			$this->load->view($name);
		}
	}

	public function header($title) {
		$this->data["title"] = $title . " : ".$this->Settings->get("general_display_name");
		$this->data["general_display_name"] = $this->Settings->get("general_display_name");

		$this->load->view("includes/header", $this->data);
	}
	
	public function footer() {
		
	}
}
