<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
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
        $this->load->model('mailsend');
        $this->load->helper('string');
	}
	
	public function get_all_student(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	        if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
            $getUserList = $this->home_model->getAllStudentList($request);
            if(is_array($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function get_student(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=> []));
                return true;
            }
            
            $getUserList = $this->home_model->getStudentList($request);
            if(is_array($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Student Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_student_pagination(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
            $getUserList = $this->home_model->getStudentPagination($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Your pagination has been gets Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_parents_list(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->page) || !isset($request->limit)){
                $request->page = 1;
                $request->limit = 50;
            }
            
            $getUserList = $this->home_model->getParentList($request);
            if(is_array($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Parents Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_states_by_country(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->country_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Country ID!",'items'=> []));
                return true;
            }
            
            $getUserList = $this->home_model->getStatesByCountry($request);
            if(is_object($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'States Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>$getUserList));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_cities_by_state(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->state_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the State ID!",'items'=> []));
                return true;
            }
            
            $getUserList = $this->home_model->getCitiesByState($request);
            if(is_object($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'States Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>$getUserList));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function add_student(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->admission_number) || !isset($request->admission_date) || !isset($request->first_name) || !isset($request->last_name) || !isset($request->middle_name)
    	    || !isset($request->roll_number) || !isset($request->class) || !isset($request->dob) || !isset($request->gender) || !isset($request->address) 
    	    || !isset($request->city) || !isset($request->country) || !isset($request->email) || !isset($request->mobile) || !isset($request->is_handicapped)
    	    || !isset($request->password) || !isset($request->pincode) || !isset($request->state) || !isset($request->student_category)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>$request));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            
            $this->form_validation->set_rules("roll_number", "Roll Number", "trim|required|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("admission_number", "Admission Number", "trim|required|xss_clean|numeric|max_length[255]");
            $this->form_validation->set_rules("admission_date", "Admission Date", "trim|required|xss_clean");
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            
            $this->form_validation->set_rules("city", "City", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid City"));
            $this->form_validation->set_rules("state", "State", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid State"));
            $this->form_validation->set_rules("country", "Country", "trim|required|xss_clean|numeric|max_length[11]",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            
            $this->form_validation->set_rules("middle_name", "Middle Name", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("birth_place", "Birth Place", "trim|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("blood_group", "Blood Group", "trim|xss_clean|in_list[A+,A-,B+,B-,O+,O-,AB+,AB-]");
            $this->form_validation->set_rules("is_handicapped", "Is handicapped", "trim|xss_clean|in_list[No,Yes]");
            $this->form_validation->set_rules("language", "Language", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("religion", "Religion", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("class", "Class/Batch", "trim|xss_clean|numeric|max_length[11]",array("Select valid Class/Batch"));
            $this->form_validation->set_rules("student_category", "Student Category", "trim|xss_clean|max_length[255]");
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>$this->form_validation->error_array(),'items'=>$request));
                return true;
             }
            
            $CheckUser = $this->home_model->CheckStudentWithDetails($request);
            if(!$CheckUser){
                $request_data = array(
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "roll_number" => $this->security->xss_clean($request->roll_number),
                    "admission_number" => $this->security->xss_clean($request->admission_number),
                    "doj" => $this->security->xss_clean($request->admission_date),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "middle_name" => $this->security->xss_clean($request->middle_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "access_key"=> strtolower(uniqid('key_').random_string('alnum',9)),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city),
                    "state_id" => $this->security->xss_clean($request->state),
                    "dob" => $this->security->xss_clean($request->dob),
                    "country_id" => $this->security->xss_clean($request->country),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    "birth_place" => $this->security->xss_clean($request->birth_place),
                    "blood_group" => $this->security->xss_clean($request->blood_group),
                    "is_handicapped" => $this->security->xss_clean($request->is_handicapped),
                    "handicap_details" => (isset($request->handicap_details))?$this->security->xss_clean($request->handicap_details):'',
                    "nationality" => (isset($request->nationality))?$this->security->xss_clean($request->nationality):'',
                    "language" => $this->security->xss_clean($request->language),
                    "religion" => $this->security->xss_clean($request->is_handicapped),
                    "student_category" => $this->security->xss_clean($request->student_category),
                    "class_id" => $this->security->xss_clean($request->class),
                    "created_by"=>'',
                    "status" => "Active",
                );
                
                $url_title = url_title($request->roll_number, "dash", TRUE);
                $file_url = 'default.png';
                
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/student/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg|psd';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                    if(!$this->upload->do_upload('file')){
            	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors(),'items'=>$request));
            	         return true;
            	         exit();
        	         }else{
        	             $upload_data = $this->upload->data();
        	             $file_url = $upload_data['file_name'];
        	       }
                }
                
                $request_data['photo'] = $file_url;
                
                $AddNewStudent = $this->home_model->AddNewStudent($request_data);
                if($AddNewStudent){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New Student Added successfully!','items'=>$AddNewStudent));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                if(isset($CheckUser->roll_number) and $CheckUser->roll_number == $request->roll_number){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Roll number is already used in other user!','items'=>$CheckUser));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'217',"status"=>"error","message"=>'This Admission Number is already used in other user!','items'=>$CheckUser));
                    return true;
                    exit();
                }
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function add_parent(){
	    //header('Content-type: application/json');
	    //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr,"details"=>$errstr.": file ".$errfile." at ".$errline,'items'=>[]));
            exit();
            }
        function exceptionHandlerCatchUndefinedIndex($exception) {
            echo json_encode(array("code"=>'250',"status"=>"error","message"=>$exception->getMessage(),"details"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine(),'items'=>[]));
            exit();
            }
            
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     set_exception_handler("exceptionHandlerCatchUndefinedIndex");
	     
	     if($_SERVER['REQUEST_METHOD'] != 'POST'){
            echo json_encode(array("code"=>'201',"status"=>"error","message"=>"Wrong Method",'items'=>[]));
            return true;
        }
	     
	     $postdata = (file_get_contents("php://input")) ? file_get_contents("php://input") : (object) $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            if(is_object($postdata)){
                $request = $postdata;
            }else{
                $request = json_decode($postdata);
            }
            
    	    if(!isset($request->first_name) || !isset($request->last_name) || !isset($request->relationship)
    	    || !isset($request->education) || !isset($request->occupation) || !isset($request->dob) || !isset($request->gender) || !isset($request->address) 
    	    || !isset($request->city) || !isset($request->country) || !isset($request->email) || !isset($request->mobile) || !isset($request->income)
    	    || !isset($request->password) || !isset($request->pincode) || !isset($request->state) || !isset($request->office_phone)){
                echo json_encode(array("code"=>'231',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            $this->form_validation->set_data((array)$request);
            $this->form_validation->set_rules("email", "Email", "trim|required|xss_clean|valid_email|max_length[255]");
            $this->form_validation->set_rules("mobile", "Mobile No", "trim|required|xss_clean|exact_length[10]|max_length[255]");
            $this->form_validation->set_rules("relationship", "Relation", "trim|required|xss_clean|in_list[Father,Mother,Others]");
            
            $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("last_name", "Last Name", "trim|required|xss_clean|alpha_numeric_spaces|max_length[255]");
            $this->form_validation->set_rules("dob", "DOB", "trim|required|xss_clean");
            $this->form_validation->set_rules("password", "Password", "trim|required|xss_clean|min_length[8]|max_length[255]");
            $this->form_validation->set_rules("gender", "Gender", "trim|required|xss_clean|alpha|max_length[255]|in_list[Male,Female,Others]");
            $this->form_validation->set_rules("address", "Address", "trim|required|xss_clean|min_length[10]|max_length[255]");
            $this->form_validation->set_rules("city", "City", "trim|required|xss_clean|numeric",array("Select valid City"));
            $this->form_validation->set_rules("state", "State", "trim|required|xss_clean|numeric",array("Select valid State"));
            $this->form_validation->set_rules("country", "Country", "trim|required|xss_clean|numeric",array("Select valid Country"));
            $this->form_validation->set_rules("pincode", "Pincode/Postal Code", "trim|required|xss_clean|min_length[5]|max_length[6]|numeric");
            
            $this->form_validation->set_rules("education", "Education", "trim|xss_clean|alpha_dash|max_length[255]");
            $this->form_validation->set_rules("occupation", "Occupation", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("income", "Income", "trim|xss_clean|max_length[255]");
            $this->form_validation->set_rules("office_phone", "Office phone", "trim|xss_clean|alpha_dash|max_length[20]");
            
            $this->form_validation->set_rules("student_id", "Student", "trim|required|xss_clean|numeric",array("Selected Student Does not Exist"));
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("code"=>'210',"status"=>"error","message"=>implode("<br>",$this->form_validation->error_array()),'items'=>$request));
                return true;
             }
            
            $CheckUser = $this->home_model->CheckParentWithDetails($request);
            if(!$CheckUser){
                $request_data = array(
                    "email" => $this->security->xss_clean($request->email),
                    "mobile" => $this->security->xss_clean($request->mobile),
                    "student_id" => $this->security->xss_clean($request->student_id),
                    "office_phone" => $this->security->xss_clean($request->office_phone),
                    "first_name" => $this->security->xss_clean($request->first_name),
                    "last_name" => $this->security->xss_clean($request->last_name),
                    "password" => $this->encrypt->encode($request->password),
                    "access_key"=> strtolower(uniqid('key_').random_string('alnum',9)),
                    "gender" => $this->security->xss_clean($request->gender),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city),
                    "state_id" => $this->security->xss_clean($request->state),
                    "dob" => $this->security->xss_clean($request->dob),
                    "country_id" => $this->security->xss_clean($request->country),
                    "pincode" => $this->security->xss_clean($request->pincode),
                    
                    "relationship" => $this->security->xss_clean($request->relationship),
                    "education" => $this->security->xss_clean($request->education),
                    "occupation" => $this->security->xss_clean($request->occupation),
                    "income" => $this->security->xss_clean($request->income),
                    "role" => "All",
                    "created_by"=>"1",
                    "status" => "Active",
                );
                
                $AddNewStudent = $this->home_model->AddNewParent($request_data);
                if($AddNewStudent){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New Parent Added successfully!','items'=>$AddNewStudent));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                if(isset($CheckUser->mobile) and $CheckUser->mobile == $request->mobile){
                    echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This Mobile number is already used in other parent!','items'=>$CheckUser));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'217',"status"=>"error","message"=>'This Email is already used in other parent!','items'=>$CheckUser));
                    return true;
                    exit();
                }
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_user_details(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id) || !isset($request->userid) || !isset($request->email) || !isset($request->full_name) || !isset($request->phone) || !isset($request->address)
    	    || !isset($request->city) || !isset($request->country)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            if(empty($request->id) || empty($request->email) || empty($request->full_name) || empty($request->phone) || empty($request->address)
    	    || empty($request->city) || empty($request->country)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }
            
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                echo json_encode(array("code"=>'205',"status"=>"error","message"=>"Invalid Email Address",'items'=>$request));
                return true;
            }
            
            if(filter_var($request->phone, FILTER_VALIDATE_INT, array("options" => array("min_range"=>4000000000, "max_range"=>9999999999))) === false){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Invalid Phone Number",'items'=>$request));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckUser($request->id);
            if($CheckUser && !empty($CheckUser)){
                $CheckDetailsNotExist = $this->apiModel->CheckDetailsNotExist($request);
                if($CheckDetailsNotExist && !empty($CheckDetailsNotExist)){
                    echo json_encode(array("code"=>'210',"status"=>"success","message"=>'This User ID or Email or Mobile number is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else{
                    $UpdateUserDetails = $this->apiModel->UpdateUserDetails($request);
                    if($UpdateUserDetails){
                        echo json_encode(array("code"=>'200',"status"=>"success","message"=>'User Details updated successfully!'));
                        return true;
                        exit();
                    }else{
                        echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:'));
                        return true;
                        exit();
                    }
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_user(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckUser($request->id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->DeleteUserDetails($request->id);
                if($GetUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Professional Deleted successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'User not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	//PROFESSIONAL
	public function get_professional(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->getProfessionalList($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Professional Listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_pagination_professional(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
            $getUserList = $this->apiModel->getPaginationProfessional($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Pagition Successfully added!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_professional_status(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!"));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->user_id) || !isset($request->status)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID Number and Status!"));
                return true;
            }else if($request->status !== 'Y' && $request->status !== 'N'){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Wrong Status selected"));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckProfessional($request->user_id);
            if($CheckUser && !empty($CheckUser)){
                $UpdateUser = $this->apiModel->UpdateProfessional($request->user_id,$request->status);
                if($UpdateUser){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Your Status updated successfully!'));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:'));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!',"items"=>$CheckUser));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage()));
            return true;
            exit();
	   }
	}
	
	public function get_professional_details(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->user_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckProfessional($request->user_id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->GetProfessionalDetails($request->user_id);
                if($GetUserDetails and is_object($GetUserDetails)){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'User Data gets successfully!','items'=>$GetUserDetails));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function add_new_professional(){
	   header('Content-type: application/json');
	   header("Access-Control-Allow-Origin: *");
       header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata =  $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>$postdata,'fullname'=>[]));
            return true;
        }else{
            $request = (object) $postdata;
    	    if(!isset($request->userid) || !isset($request->email) || !isset($request->full_name) || !isset($request->phone) || !isset($request->address)
    	    || !isset($request->city) || !isset($request->country) || !isset($request->new_password) || !isset($request->category) || !isset($request->area) || !isset($request->youtube_url) || !isset($request->role)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            if(empty($request->email) || empty($request->full_name) || empty($request->phone) || empty($request->address)
    	    || empty($request->city) || empty($request->country) || empty($request->category) || empty($request->area) || empty($request->role)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }
            
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                echo json_encode(array("code"=>'205',"status"=>"error","message"=>"Invalid Email Address",'items'=>[]));
                return true;
            }
            
            if(filter_var($request->phone, FILTER_VALIDATE_INT, array("options" => array("min_range"=>4000000000, "max_range"=>9999999999))) === false){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Invalid Phone Number",'items'=>$request));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckProfessionalWithDetails($request);
            if(!$CheckUser){
                $url_title = url_title($request->full_name, "dash", TRUE);
                $CheckProfessionalURL = $this->apiModel->CheckProfessionalURL($url_title);
                if($CheckProfessionalURL){
                    $GetProfessionalURL = $this->apiModel->GetProfessionalURL($url_title);
                    
                    if($GetProfessionalURL and $GetProfessionalURL->total > 0){
                        $url_title = $url_title."_". ($GetProfessionalURL->total + 1);
                    }else{
                        $url_title = $url_title."_".time();
                    }
                }
                
                $file_url = 'default-user.png';
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/professional/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                    if(!$this->upload->do_upload('file')){
            	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors()));
            	         return true;
            	         exit();
        	         }else{
        	             $upload_data = $this->upload->data();
        	             $file_url = $upload_data['file_name'];
        	       }
                }
                
                
                $request_data = array(
                    "userid" => $this->security->xss_clean($request->userid),
                    "full_name" => $this->security->xss_clean($request->full_name),
                    "email" => $this->security->xss_clean($request->email),
                    "phone" => $this->security->xss_clean($request->phone),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city),
                    "country" => $this->security->xss_clean($request->country),
                    "password" => md5($this->security->xss_clean($request->new_password)),
                    "profile_image" => $file_url,
                    "slug" => $url_title,
                    "about" => $this->security->xss_clean($request->about),
                    "cat_id" => $this->security->xss_clean($request->category),
                    "area_id" => $this->security->xss_clean($request->area),
                    "youtube_url" => $this->security->xss_clean($request->youtube_url),
                    "role" => $this->security->xss_clean($request->role),
                    "ip"=> $this->details->getClientIP(),
                    "status" => "Y",
                    "type" => "signup"
                );
                $UpdateUserDetails = $this->apiModel->AddProfessionalDetails($request_data);
                if($UpdateUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New User Added successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This User ID or Email or Mobile number is already used in other user!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_professional_details(){
	   header('Content-type: application/json');
	   header("Access-Control-Allow-Origin: *");
       header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
       
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata =  $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>$postdata,'fullname'=>[]));
            return true;
        }else{
            $request = (object) $postdata;
    	    if(!isset($request->id) || !isset($request->userid) || !isset($request->email) || !isset($request->full_name) || !isset($request->phone) || !isset($request->address)
    	    || !isset($request->city_id) || !isset($request->country) || !isset($request->cat_id) || !isset($request->area_id) || !isset($request->youtube_url) || !isset($request->role)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>$request));
                return true;
            }
            
            if(empty($request->id) || empty($request->email) || empty($request->full_name) || empty($request->phone) || empty($request->address)
    	    || empty($request->city_id) || empty($request->country) || empty($request->cat_id) || empty($request->area_id) || empty($request->role)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }
            
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                echo json_encode(array("code"=>'205',"status"=>"error","message"=>"Invalid Email Address",'items'=>[]));
                return true;
            }
            
            if(filter_var($request->phone, FILTER_VALIDATE_INT, array("options" => array("min_range"=>4000000000, "max_range"=>9999999999))) === false){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Invalid Phone Number",'items'=>$request));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckProfessional($request->id);
            if($CheckUser && !empty($CheckUser)){
                $CheckDetailsNotExist = $this->apiModel->CheckProfessionalDetailsNotExist($request);
                if($CheckDetailsNotExist && !empty($CheckDetailsNotExist)){
                    echo json_encode(array("code"=>'210',"status"=>"success","message"=>'This User ID or Email or Mobile number is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else{
                    if(!isset($request->slug) || empty($request->slug)){
                        $request->slug = url_title($request->full_name, "dash", TRUE)."_".time();
                    }
                
                if(!isset($request->profile_image) || empty($request->profile_image)){
                        $request->profile_image = 'default-user.png';
                    }
                    
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $request->slug;
            	     $config['upload_path']          = './assets/files/professional/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                        if(!$this->upload->do_upload('file')){
                	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors()));
                	         return true;
                	         exit();
            	         }else{
            	             $upload_data = $this->upload->data();
            	             $request->profile_image = $upload_data['file_name'];
            	       }
                    }
                    
                    $UpdateUserDetails = $this->apiModel->UpdateProfessionalDetails($request);
                    if($UpdateUserDetails){
                        echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Professional Details updated successfully!'));
                        return true;
                        exit();
                    }else{
                        echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:'));
                        return true;
                        exit();
                    }
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_professional(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Professional ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckProfessional($request->id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->DeleteProfessionalDetails($request->id);
                if($GetUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Professional Deleted successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'Professional details not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Professional Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	
	public function get_areas(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Please Enter City!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->city) || empty($request->city)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Please Enter City",'items'=>[]));
                return true;
            }
            $GetUserDetails = $this->apiModel->GetAreas($request->city);
            if($GetUserDetails and is_array($GetUserDetails)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'User Data gets successfully!','items'=>$GetUserDetails));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'200',"status"=>"error","message"=>'No data available','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	//ADMIN
	public function get_admin(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->getAdminList($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Admin user listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_pagination_admin(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
            $getUserList = $this->apiModel->getPaginationAdmin($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Pagination added Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_admin_status(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!"));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->user_id) || !isset($request->status)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID Number and Status!"));
                return true;
            }else if($request->status !== 'Y' && $request->status !== 'N'){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Wrong Status selected"));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckAdmin($request->user_id);
            if($CheckUser && !empty($CheckUser)){
                $UpdateUser = $this->apiModel->UpdateAdmin($request->user_id,$request->status);
                if($UpdateUser){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Your Status updated successfully!'));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:'));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!',"items"=>$CheckUser));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage()));
            return true;
            exit();
	   }
	}
	
	public function get_admin_details(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->user_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckAdmin($request->user_id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->GetAdminDetails($request->user_id);
                if($GetUserDetails and is_object($GetUserDetails)){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'User Data gets successfully!','items'=>$GetUserDetails));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function add_new_admin(){
	   //header('Content-type: multipart/form-data');
	   header("Access-Control-Allow-Origin: *");
       header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata =  $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>$postdata));
            return true;
        }else{
            $request = (object) $postdata;
    	    if(!isset($request->userid) || !isset($request->email) || !isset($request->full_name) || !isset($request->phone) || !isset($request->address)
    	    || !isset($request->city_id) || !isset($request->country) || !isset($request->new_password) || !isset($request->roles)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>$request));
                return true;
            }
            
            if(empty($request->email) || empty($request->full_name) || empty($request->phone) || empty($request->address)
    	    || empty($request->city_id) || empty($request->country) || empty($request->new_password) || empty($request->roles) || empty($request->userid)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>$request));
                return true;
            }
            
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                echo json_encode(array("code"=>'205',"status"=>"error","message"=>"Invalid Email Address",'items'=>[]));
                return true;
            }
            
            if(filter_var($request->phone, FILTER_VALIDATE_INT, array("options" => array("min_range"=>4000000000, "max_range"=>9999999999))) === false){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Invalid Phone Number",'items'=>$request));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckAdminWithDetails($request);
            if(!$CheckUser){
                $url_title = url_title($request->full_name, "dash", TRUE);
                $url_title = $url_title."_".time();
                
                $file_url = 'default-user.png';
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $url_title;
            	     $config['upload_path']          = './assets/files/admin/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                    if(!$this->upload->do_upload('file')){
            	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors()));
            	         return true;
            	         exit();
        	         }else{
        	             $upload_data = $this->upload->data();
        	             $file_url = $upload_data['file_name'];
        	       }
                }
                
                $request_data = array(
                    "userid" => $this->security->xss_clean($request->userid),
                    "full_name" => $this->security->xss_clean($request->full_name),
                    "email" => $this->security->xss_clean($request->email),
                    "phone" => $this->security->xss_clean($request->phone),
                    "address" => $this->security->xss_clean($request->address),
                    "city_id" => $this->security->xss_clean($request->city_id),
                    "country" => $this->security->xss_clean($request->country),
                    "password" => md5($this->security->xss_clean($request->new_password)),
                    "profile_image" => $file_url,
                    "role" => $this->security->xss_clean($request->roles),
                    "ip"=> $this->details->getClientIP(),
                    "status" => "Y"
                );
                $UpdateUserDetails = $this->apiModel->AddAdminDetails($request_data);
                if($UpdateUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New User Added successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'This User ID or Email or Mobile number is already used in other user!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_admin_details(){
	   //header('Content-type: application/json');
	   header("Access-Control-Allow-Origin: *");
       header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
       
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata =  $_POST;
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>$postdata,'fullname'=>[]));
            return true;
        }else{
            $request = (object) $postdata;
    	    if(!isset($request->id) || !isset($request->userid) || !isset($request->email) || !isset($request->full_name) || !isset($request->phone) || !isset($request->address)
    	    || !isset($request->city_id) || !isset($request->country) || !isset($request->roles)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>$request));
                return true;
            }
            
            if(empty($request->id) || empty($request->email) || empty($request->full_name) || empty($request->phone) || empty($request->address)
    	    || empty($request->city_id) || empty($request->country) || empty($request->roles)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }
            
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                echo json_encode(array("code"=>'205',"status"=>"error","message"=>"Invalid Email Address",'items'=>[]));
                return true;
            }
            
            if(filter_var($request->phone, FILTER_VALIDATE_INT, array("options" => array("min_range"=>4000000000, "max_range"=>9999999999))) === false){
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>"Invalid Phone Number",'items'=>$request));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckAdmin($request->id);
            if($CheckUser && !empty($CheckUser)){
                $CheckDetailsNotExist = $this->apiModel->CheckAdminDetailsNotExist($request);
                if($CheckDetailsNotExist && !empty($CheckDetailsNotExist)){
                    echo json_encode(array("code"=>'210',"status"=>"success","message"=>'This User ID or Email or Mobile number is already used in other user!','items'=>[]));
                    return true;
                    exit();
                }else{
                    if(!isset($request->slug) || empty($request->slug)){
                        $request->slug = url_title($request->full_name, "dash", TRUE)."_".time();
                    }
                
                if(!isset($request->profile_image) || empty($request->profile_image)){
                        $request->profile_image = 'default-user.png';
                    }
                    
                if(isset($_FILES['file']) and $_FILES['file']['size'] > 0){
                     $config['file_name'] = $request->slug;
            	     $config['upload_path']          = './assets/files/admin/';
            	     $config['allowed_types']        = 'gif|jpg|png|jpeg';
            	     $config['max_size']             = 999999;
            	     $config['remove_spaces']        = TRUE;
            	     $this->load->library('upload',$config);
                    
                        if(!$this->upload->do_upload('file')){
                	         echo json_encode(array("code"=>"230","status"=>"error","message"=>$this->upload->display_errors()));
                	         return true;
                	         exit();
            	         }else{
            	             $upload_data = $this->upload->data();
            	             $request->profile_image = $upload_data['file_name'];
            	       }
                    }
                    
                    $UpdateUserDetails = $this->apiModel->UpdateAdminDetails($request);
                    if($UpdateUserDetails){
                        echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Admin Details updated successfully!'));
                        return true;
                        exit();
                    }else{
                        echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:'));
                        return true;
                        exit();
                    }
                }
            }else{
                echo json_encode(array("code"=>'216',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_admin(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckAdmin($request->id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->DeleteAdminDetails($request->id);
                if($GetUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Admin Deleted successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	//ORDERS
	public function get_orders(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->getOrdersList($request);
            if($getUserList && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Orders listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Items Not Found','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_pagination_orders(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
	     
            $getUserList = $this->apiModel->getPaginationOrder($request);
            if($getUserList && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Pagination added Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'Items Not Found','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_order_details(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->order_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the ORDER ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckOrder($request->order_id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->GetOrderDetails($request->order_id);
                if($GetUserDetails and is_object($GetUserDetails)){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Order Data gets successfully!','items'=>$GetUserDetails));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function assign_order_allocation(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>$postdata));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->order_id) && !isset($request->prof_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Select the ORDER ID And Prof ID",'items'=>$request));
                return true;
            }
            
            if(!isset($request->schedule_date) && !isset($request->schedule_time)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Select the Schedule Time And Schedule Time",'items'=>$request));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckOrder($request->order_id);
            if($CheckUser && !empty($CheckUser)){
                
                $CheckUser = $this->apiModel->CheckProfessional($request->prof_id);
                if($CheckUser && !empty($CheckUser)){
                    
                    $GetUserDetails = $this->apiModel->AssingOrderAllocation($request->order_id,$request->prof_id,$request->schedule_date,$request->schedule_time);
                    if($GetUserDetails){
                        echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Order Assigned successfully','items'=>$request));
                        return true;
                        exit();
                    }else{
                        echo json_encode(array("code"=>'205',"status"=>"error","message"=>'This Time we cant Remove. Try again later!','items'=>$request));
                        return true;
                        exit();
                    }
                }else{
                    echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Selected Professional Doesnot exist!','items'=>$request));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Selected Order Doesnot exist!','items'=>$request));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>$request));
            return true;
            exit();
	   }
	}
	
	public function remove_order_allocation(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->order_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the ORDER ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckOrder($request->order_id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->RemoveOrderAllocation($request->order_id);
                if($GetUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Order Allocation Removed successfully','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'This Time we cant Remove. Try again later!','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Order Doesnot exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function search_professionals(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->professional)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Name",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->searchProfessionalList($request->professional);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Professional user listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	//ORDERS
	public function get_timings(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
            $getUserList = $this->apiModel->getOfficeTimings();
            if($getUserList && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Timings listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'Items Not Found','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	//CITY
	public function get_city_list(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->getCityList($request->page,$request->limit);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'City listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_pagination_city(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
            $getUserList = $this->apiModel->getPaginationCity();
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Pagination added Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_city_status(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!"));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->user_id) || !isset($request->status)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID Number and Status!"));
                return true;
            }else if($request->status !== 'Y' && $request->status !== 'N'){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Wrong Status selected"));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckAdmin($request->user_id);
            if($CheckUser && !empty($CheckUser)){
                $UpdateUser = $this->apiModel->UpdateAdmin($request->user_id,$request->status);
                if($UpdateUser){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Your Status updated successfully!'));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:'));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!',"items"=>$CheckUser));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage()));
            return true;
            exit();
	   }
	}
	
	public function get_city_details(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->city_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the city id",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckCity($request->city_id);
            if($CheckUser && $CheckUser->total > 0){
                $GetCityDetails = $this->apiModel->GetCityDetails($request->city_id);
                if($GetCityDetails and is_object($GetCityDetails)){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'User Data gets successfully!','items'=>$GetCityDetails));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'City not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'City Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function add_new_city(){
	   //header('Content-type: application/json');
	    header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->name) || !isset($request->country_id) || !isset($request->status)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            if(empty($request->name) || empty($request->country_id) || empty($request->status)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }
            
            $url_title = url_title($request->name, "dash", TRUE);
                $CheckCityURL = $this->apiModel->CheckCityURL($url_title);
                if($CheckCityURL and $CheckCityURL->total > 0){
                    $url_title = $url_title."_".time();
                }

                $request_data = array(
                    "name" => $this->security->xss_clean($request->name),
                    "slug" => $url_title,
                    "country_id" => $this->security->xss_clean($request->country_id),
                    "status" => $this->security->xss_clean($request->status)
                );
                
                $UpdateUserDetails = $this->apiModel->AddCityDetails($request_data);
                if($UpdateUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New City Added successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_city_details(){
	   //header('Content-type: application/json');
	    header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)  || !isset($request->name) || !isset($request->country_id) || !isset($request->status)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            if(empty($request->id) || empty($request->name) || empty($request->country_id) || empty($request->status)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }

                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "name" => $this->security->xss_clean($request->name),
                    "country_id" => $this->security->xss_clean($request->country_id),
                    "status" => $this->security->xss_clean($request->status)
                );
                
            $CheckUser = $this->apiModel->CheckCity($request->id);
            if($CheckUser && $CheckUser->total > 0){
                
                $UpdateUserDetails = $this->apiModel->UpdateCityDetails((object)$request_data);
                if($UpdateUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'City Details Upddated successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured and Try again later','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'City Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_city(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckCity($request->id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->DeleteCityDetails($request->id);
                if($GetUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'City Deleted successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'City Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	//AREA
	public function get_area_list(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->getAreaList($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Area listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_pagination_area(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
	     
            $getUserList = $this->apiModel->getPaginationArea($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Pagination added Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_area_status(){
	   header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!"));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->user_id) || !isset($request->status)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID Number and Status!"));
                return true;
            }else if($request->status !== 'Y' && $request->status !== 'N'){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Wrong Status selected"));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckAdmin($request->user_id);
            if($CheckUser && !empty($CheckUser)){
                $UpdateUser = $this->apiModel->UpdateAdmin($request->user_id,$request->status);
                if($UpdateUser){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Your Status updated successfully!'));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:'));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'User Doesnot exist!',"items"=>$CheckUser));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage()));
            return true;
            exit();
	   }
	}
	
	public function get_area_details(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->area_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Area id",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckArea($request->area_id);
            if($CheckUser && $CheckUser->total > 0){
                $GetCityDetails = $this->apiModel->GetAreaDetails($request->area_id);
                if($GetCityDetails and is_object($GetCityDetails)){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Area Data gets successfully!','items'=>$GetCityDetails));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'Area not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Area Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function add_new_area(){
	   //header('Content-type: application/json');
	    header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->name) || !isset($request->city_id) || !isset($request->status)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            if(empty($request->name) || empty($request->city_id) || empty($request->status)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }
            
            $url_title = url_title($request->name, "dash", TRUE);
                $CheckCityURL = $this->apiModel->CheckAreaURL($url_title);
                if($CheckCityURL and $CheckCityURL->total > 0){
                    $url_title = $url_title."_".time();
                }

                $request_data = array(
                    "areasName" => $this->security->xss_clean($request->name),
                    "area_url" => $url_title,
                    "cityId" => $this->security->xss_clean($request->city_id),
                    "status" => $this->security->xss_clean($request->status)
                );
                
                $UpdateUserDetails = $this->apiModel->AddAreaDetails($request_data);
                if($UpdateUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'New Area Added successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_area_details(){
	   //header('Content-type: application/json');
	    header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)  || !isset($request->areasName) || !isset($request->cityId) || !isset($request->status)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            if(empty($request->id) || empty($request->areasName) || empty($request->cityId) || empty($request->status)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }

                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "areasName" => $this->security->xss_clean($request->areasName),
                    "cityId" => $this->security->xss_clean($request->cityId),
                    "status" => $this->security->xss_clean($request->status)
                );
                
            $CheckUser = $this->apiModel->CheckArea($request->id);
            if($CheckUser && $CheckUser->total > 0){
                
                $UpdateUserDetails = $this->apiModel->UpdateAreaDetails((object)$request_data);
                if($UpdateUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Area Details Upddated successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'DB Error Occured and Try again later','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Area Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function delete_area(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Area ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckArea($request->id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->DeleteAreaDetails($request->id);
                if($GetUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Area Deleted successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'DB Error Occured:','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Area Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	//REVIEWS
	public function get_review_list(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->getReviewsList($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Reviews listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_pagination_review(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
            $getUserList = $this->apiModel->getPaginationReviews($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Pagination added Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_review_status(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!"));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->review_id) || !isset($request->status)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the User ID Number and Status!"));
                return true;
            }else if($request->status !== 'Y' && $request->status !== 'N'){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Wrong Status selected"));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckReview($request->review_id);
            if($CheckUser && !empty($CheckUser)){
                $UpdateUser = $this->apiModel->UpdateReviewStatus($request->review_id,$request->status);
                if($UpdateUser){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Your Status updated successfully!'));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'Review not found'));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Review Doesnot exist!',"items"=>$CheckUser));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage()));
            return true;
            exit();
	   }
	}
	
	public function delete_review(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Review ID",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckReview($request->id);
            if($CheckUser && !empty($CheckUser)){
                $GetUserDetails = $this->apiModel->DeleteReviewDetails($request->id);
                if($GetUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Review Deleted successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'Review not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Review Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function get_review_details(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->review_id)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Review id",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckReview($request->review_id);
            if($CheckUser && $CheckUser->total > 0){
                $GetCityDetails = $this->apiModel->GetReviewDetails($request->review_id);
                if($GetCityDetails and is_object($GetCityDetails)){
                    $GetCityDetails->reviews = html_entity_decode($GetCityDetails->reviews,ENT_QUOTES|ENT_HTML5|ENT_SUBSTITUTE);
                    
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Review Data gets successfully!','items'=>$GetCityDetails));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'Review not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Review Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	public function update_review_details(){
	   //header('Content-type: application/json');
	    header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->id)  || !isset($request->category_id) || !isset($request->reviews) || !isset($request->rating) || !isset($request->status)){
                echo json_encode(array("code"=>'2031',"status"=>"error","message"=>"Enter all the Fields!",'items'=>[]));
                return true;
            }
            
            if(empty($request->id) || empty($request->category_id) || empty($request->reviews) || empty($request->rating) || empty($request->status)){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Fill all the Mandatory Fields!",'items'=>[]));
                return true;
            }

                $request_data = array(
                    "id" => $this->security->xss_clean($request->id),
                    "category_id" => $this->security->xss_clean(htmlentities($request->category_id,ENT_QUOTES|ENT_HTML5|ENT_SUBSTITUTE)),
                    "reviews" => $this->security->xss_clean(htmlentities($request->reviews,ENT_QUOTES|ENT_HTML5|ENT_SUBSTITUTE)),
                    "rating" => $this->security->xss_clean(htmlentities($request->rating,ENT_QUOTES|ENT_HTML5|ENT_SUBSTITUTE)),
                    "status" => $this->security->xss_clean(htmlentities($request->status,ENT_QUOTES|ENT_HTML5|ENT_SUBSTITUTE)),
                );
                
            $CheckUser = $this->apiModel->CheckReview($request->id);
            if($CheckUser && $CheckUser->total > 0){
                
                $UpdateUserDetails = $this->apiModel->UpdateReviewDetails((object)$request_data);
                if($UpdateUserDetails){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Review Details Upddated successfully!','items'=>[]));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'215',"status"=>"error","message"=>'Review not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Review Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'217',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
	
	//CATEGORY LIST
	public function get_category_list(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->page) || !isset($request->limit)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Page Number and Limit!",'items'=>[]));
                return true;
            }
            
            $getUserList = $this->apiModel->getCategoryList($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Category listed Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>'No data found','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'205',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function get_pagination_category(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     $request = json_decode($postdata);
            $getUserList = $this->apiModel->getPaginationCategory($request);
            if(isset($getUserList) && !empty($getUserList)){
                echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Pagination added Successfully!','items'=>$getUserList));
                return true;
                exit();
            }else{
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>'No data found:','items'=>[]));
                return true;
                exit();
            }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'203',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   } 
	}
	
	public function update_category_status(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!"));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->category_id) || !isset($request->status)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the category ID Number and Status!"));
                return true;
            }else if($request->status !== 'Y' && $request->status !== 'N'){
                echo json_encode(array("code"=>'204',"status"=>"error","message"=>"Wrong Status selected"));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckCategory($request->category_id);
            if($CheckUser && !empty($CheckUser)){
                $UpdateUser = $this->apiModel->UpdateCategoryStatus($request->category_id,$request->status);
                if($UpdateUser){
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'category Status updated successfully!'));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'Review not found'));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Review Doesnot exist!',"items"=>$CheckUser));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage()));
            return true;
            exit();
	   }
	}
	
	public function get_category_details(){
	   //header('Content-type: application/json');
	     try{
	     function errorHandlerCatchUndefinedIndex($errno, $errstr, $errfile, $errline ) {
            echo json_encode(array("code"=>$errno,"status"=>"error","message"=>$errstr.":".$errfile."<br>".$errline,'items'=>[]));
            exit();
            }
	     set_error_handler("errorHandlerCatchUndefinedIndex");
	     
	     $postdata = file_get_contents("php://input");
	     if(empty($postdata)){
            echo json_encode(array("code"=>'202',"status"=>"error","message"=>"Empty Request data!",'items'=>[]));
            return true;
        }else{
            
            $request = json_decode($postdata);
    	    if(!isset($request->category_url)){
                echo json_encode(array("code"=>'203',"status"=>"error","message"=>"Enter the Review id",'items'=>[]));
                return true;
            }
            
            $CheckUser = $this->apiModel->CheckCategoryUrl($request->category_url);
            if($CheckUser && $CheckUser->total > 0){
                $GetCityDetails = $this->apiModel->GetCategoryDetails($request->category_url);
                if($GetCityDetails and is_object($GetCityDetails)){
                    $GetCityDetails->reviews = html_entity_decode($GetCityDetails->reviews,ENT_QUOTES|ENT_HTML5|ENT_SUBSTITUTE);
                    
                    echo json_encode(array("code"=>'200',"status"=>"success","message"=>'Review Data gets successfully!','items'=>$GetCityDetails));
                    return true;
                    exit();
                }else{
                    echo json_encode(array("code"=>'205',"status"=>"error","message"=>'Review not found','items'=>[]));
                    return true;
                    exit();
                }
            }else{
                echo json_encode(array("code"=>'206',"status"=>"error","message"=>'Review Does not exist!','items'=>[]));
                return true;
                exit();
            }
        }
        
	   }catch(Exception $ex){
	        echo json_encode(array("code"=>'207',"status"=>"error","message"=>$e->getMessage(),'items'=>[]));
            return true;
            exit();
	   }
	}
}