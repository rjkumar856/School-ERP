<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
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
        $this->load->model('home_model');
        $this->load->helper('function');
        $this->load->library('settings');
	}
	 
	public function index(){
	    redirect(base_url()."view-students");
	}
	
	public function view_students(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->data['activepage']="home";
    	    $this->settings->load_settings();
    	    $this->data['getAllCourses'] = $this->home_model->getAllCourses();
    	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	   $this->load->view('student/view',$this->data);
	}
	
	public function view_student($id){
	    try{
	        if(empty($id)){ redirect(base_url()."view-students"); }
	        $this->data['id'] = $id;
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="home";
    	    if($this->home_model->checkStudentByID($id)){
    	        
    	        $this->data['getStudentDetails'] = $this->home_model->getStudentDetails($id);
    	        $this->data['getParentDetails'] = $this->home_model->getParentDetails($id);
    	        $this->data['getPreviousQualification'] = $this->home_model->getPreviousQualification($id);
    	        
    	        $this->data['getStudentCourses'] = $this->home_model->getStudentCourses($id);
    	        
    	        $this->load->view('student/view-details',$this->data);
    	    }else{
    	        redirect(base_url()."view-students");
    	    }
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
	}
	
	
	public function add_student(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="home";
    	    $this->data['getStudentCustomFields'] = $this->home_model->getStudentCustomFields();
    	    $this->data['getStudentCategories'] = $this->home_model->getStudentCategories();
    	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
    	    
    	    $this->data['getAllCountries'] = $this->home_model->getAllCountries();
    	    $this->data['getNewAdmisssionNumber'] = $this->home_model->getNewAdmisssionNumber();
    	    
    	    //echo "add_student";
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	$this->load->view('student/add-student',$this->data);
	}
	
	public function edit_student($id){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="home";
    	    $this->data['getStudentCustomFields'] = $this->home_model->getStudentCustomFields();
    	    $this->data['getStudentCategories'] = $this->home_model->getStudentCategories();
    	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
    	    
    	    $this->data['getAllCountries'] = $this->home_model->getAllCountries();
    	    $this->data['getNewAdmisssionNumber'] = $this->home_model->getNewAdmisssionNumber();
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	$this->load->view('student/edit-student',$this->data);
	}
	
	public function edit_student_parent($id){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $CheckStudentByID = $this->home_model->CheckStudentByID($id);
    	    if($CheckStudentByID){
    	        $this->data['student_id'] = $id;
    	        $student_edit = array(
                            'name'   => 'student_id',
                            'value'  => $id,
                            'expire' => '300000'
                        );
                $this->input->set_cookie($student_edit);
    	        $this->data['getParentDetails'] = $this->home_model->getParentDetails($id);
    	        $this->data['getAllCountries'] = $this->home_model->getAllCountries();
    	    }else{
    	        redirect(base_url()."view-students");
    	        exit();
    	    }
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	$this->load->view('student/edit_student_parent',$this->data);
	}
	
	public function edit_student_previous($id){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="home";
    	    $this->data['getStudentCustomFields'] = $this->home_model->getStudentCustomFields();
    	    $this->data['getStudentCategories'] = $this->home_model->getStudentCategories();
    	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
    	    
    	    $this->data['getAllCountries'] = $this->home_model->getAllCountries();
    	    $this->data['getNewAdmisssionNumber'] = $this->home_model->getNewAdmisssionNumber();
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	$this->load->view('student/edit_student_previous',$this->data);
	}
	
	public function edit_student_doc($id){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="home";
    	    $this->data['getStudentCustomFields'] = $this->home_model->getStudentCustomFields();
    	    $this->data['getStudentCategories'] = $this->home_model->getStudentCategories();
    	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
    	    
    	    $this->data['getAllCountries'] = $this->home_model->getAllCountries();
    	    $this->data['getNewAdmisssionNumber'] = $this->home_model->getNewAdmisssionNumber();
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	$this->load->view('student/edit_student_doc',$this->data);
	}
	
	public function add_student_submission(){
	    try{
    	    set_error_handler("errorHandlerCatchUndefinedIndex");
    	    $this->settings->load_settings();
    	    $this->data['activepage']="home";
    	    $this->data['getStudentCustomFields'] = $this->home_model->getStudentCustomFields();
    	    $this->data['getStudentCategories'] = $this->home_model->getStudentCategories();
    	    $this->data['getAllClasses'] = $this->home_model->getAllClasses();
    	    
    	    $this->data['getAllCountries'] = $this->home_model->getAllCountries();
    	    $this->data['getNewAdmisssionNumber'] = $this->home_model->getNewAdmisssionNumber();
    	    
    	}catch(Exception $ex){
                if(!isset($error_message)){ $error_message = array(); }
                $error_message[] = array("code"=>205,"status"=>"error","message"=>$e->getMessage());
    	   }
    	   
    	$this->load->view('student/add-student',$this->data);
	}

}