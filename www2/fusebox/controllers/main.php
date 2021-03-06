<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends SF_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index()
	{
		$this->header("Main");
		
		if($this->ion_auth->logged_in())
		{
			redirect( "dashboard", "refresh" );
		}
		else
		{
			redirect_raw("user/login", "refresh");
		}
		
	}
}

/* End of file default.php */
/* Location: ./application/controllers/default.php */