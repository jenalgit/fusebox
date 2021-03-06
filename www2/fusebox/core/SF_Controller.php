<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SF_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		//Setup Database
		$this->load->database();
		
		//Load Libraries
		$this->load->library('better_bitwise');
		$this->load->library('ion_auth');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('nav');
		$this->load->library('support_priorities'); // Turn into model?
		$this->load->library('support_status'); // Turn into model? 
		$this->load->library('support_categories'); // Turn into model?
		$this->load->library('states');
		
		//Load Helpers
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->helper('language');
		$this->load->helper('bootstrap');
		$this->load->helper('bbcode');
		
		//Load Language Files
		$this->lang->load('base');
		$this->lang->load('auth');
		$this->lang->load('settings');
		$this->lang->load('permissions');
		
		//Load Models
		$this->load->model('settings_model');
		$this->load->model('usergroup_model');
		$this->load->model("support_model");
		
		$this->loginUser();
		$this->SecurityCheck();
		$this->loadNavElements();
	}
	
	private function SecurityCheck()
	{
		$PageType = $this->uri->segment( 1 );
	
		if( $PageType == "admin" && $this->ion_auth->is_staff() == false ) {
			redirect_raw("users/dashboard", "refresh");
		}elseif( $PageType == "users" && $this->ion_auth->is_staff() ) {
			redirect_raw("admin/dashboard", "refresh");
		}elseif( $PageType != "user" && $this->ion_auth->logged_in() == false ){
			redirect_raw("user/login", "refresh");
		}
	}
	
	private function loadNavElements()
	{
		$this->nav->AddToNav( "dashboard", "icon-home" );
		$this->nav->AddToNav( "support", "icon-comment" );
		$this->nav->AddToNav( "settings", "icon-edit" );
		
		$this->nav->AddToNav( "configure", "icon-wrench", false, "", array(
			array( "support", "conf_support" ),
			array( "billing", "conf_support" ),
			array( "usergroups", "conf_usergroups" ),
		) );
		
		$this->nav->AddToNav( "user", "icon-user", true );
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
	
	public function view($name, $pass = true) {
		if ($pass) {
			$this->load->view($name, $this->data);
		} else {
			$this->load->view($name);
		}
	}

	public function navbar() {
		$this->load->view("navbar");
	}
	
	public function header($title) {
		$this->data["title"] = $title . " : ".$this->settings_model->Get("general_display_name")->Value;
		$this->data["general_display_name"] = $this->settings_model->Get("general_display_name")->Value;

		$this->load->view("includes/header", $this->data);
	}
	
	public function footer() {
		
	}
}
