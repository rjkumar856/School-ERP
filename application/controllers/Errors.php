<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
        $this->load->helper('security');
	}
	
	public function index()	{
	    $data['heading'] = "Page not found";
	    $data['message'] = "<p>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>";
	    
		$this->load->view('errors/html/error_404',$data);
	}
}
