<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function getCurrentAcademicYear(){
        try {
            $sql = "SELECT id FROM academic_years WHERE current_year='Yes' AND status='Active' LIMIT 1";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            return $query->row();
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getAllAcademicYear(){
        try {
            $sql = "SELECT * FROM academic_years WHERE status='Active'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            return $query->result_array();
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function checkStudentByID($id){
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT * FROM students WHERE id='$id'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            if($query->num_rows() > 0){
                return true;
            }else{
                return false;
            }
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getStudentDetails($id){
        try {
            $sql = "SELECT * FROM students st LEFT JOIN students_details sd ON sd.student_id=st.id WHERE st.id='$id'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->row();
            
        }catch (Exception $e) {
            return [];
        }
    }
    
    public function getParentDetails($id){
        try {
            $sql = "SELECT pr.* FROM parents pr INNER JOIN student_to_parent_assignment sp ON pr.id=sp.parent_id WHERE sp.student_id='$id'";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            return [];
        }
    }
    
    public function getPreviousQualification($id){
        try {
            $sql = "SELECT * FROM students_previous_qualification pq WHERE pq.student_id='$id' ORDER BY pq.year DESC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            return [];
        }
    }
    
    public function getStudentCourses($id){
        try {
            $sql = "SELECT cs.id,cs.status,ay.name AS AcademicYear,cl.name AS className,co.name AS courseName FROM student_to_class_assignment cs LEFT JOIN academic_years ay ON ay.id=cs.academic_id INNER JOIN classes cl ON cl.id=cs.class_id INNER JOIN course co ON co.id=cl.course_id WHERE cs.student_id='$id' ORDER BY ay.start_date DESC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            return [];
        }
    }
    
    public function getStudentCustomFields(){
        try {
            $sql = "SELECT * FROM custom_fields cf WHERE cf.status='Active' AND cf.used_for='Student' ORDER BY cf.date_added ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getStudentCategories(){
        try {
            $sql = "SELECT * FROM student_category sc WHERE sc.status='Active' ORDER BY sc.date_added ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getAllCountries(){
        try {
            $sql = "SELECT * FROM ze_country sc WHERE sc.status='Active' ORDER BY sc.name ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $query->result();
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getStatesByCountry($req){
        try {
            $sql = "SELECT * FROM ze_state sc WHERE sc.status='Active' && sc.country_id='$req->country_id' ORDER BY sc.name ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $query->result_object();
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getCitiesByState($req){
        try {
            $sql = "SELECT * FROM ze_city sc WHERE sc.status='Active' && sc.state_id='$req->state_id' ORDER BY sc.name ASC";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $query->result_object();
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    public function getNewAdmisssionNumber(){
        try {
            $query = $this->db->query("SHOW TABLE STATUS LIKE 'students'");
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            return $query->row();
            
        }catch (Exception $e) {
            return false;
        }
    }
    
    
    public function getAllBirthDay($page=1, $limit=20) {
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT bday.* FROM ((SELECT st.first_name,st.last_name,st.dob,st.roll_number,st.class_id,STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(st.dob), '-', DAY(st.dob)) ,'%Y-%c-%e') as birthday,'Student' as from_tbl FROM students st ) UNION ALL
                (SELECT te.first_name,te.last_name,te.dob,te.teacher_id,'',STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(te.dob), '-', DAY(te.dob)) ,'%Y-%c-%e') as birthday,'Teacher' as from_tbl FROM teachers te ) ) bday WHERE birthday>=CURDATE() ORDER BY bday.dob ASC LIMIT $start,$limit";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllStudentsWithAttendance() {
        try {
            $sql = "SELECT (SELECT COUNT(id) FROM students WHERE status='Active') AS TotalStud,(SELECT COUNT(id) FROM student_attendance WHERE att_date=CURDATE() AND (attendance='Present' OR attendance='Half Day')) AS TotalPresent,
            (SELECT COUNT(id) FROM student_attendance WHERE att_date=CURDATE() AND attendance='Absent') AS TotalAbsent ";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->row();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllTeacherssWithAttendance() {
        try {
            $sql = "SELECT (SELECT COUNT(id) FROM teachers WHERE status='Active') AS TotalTechr,(SELECT COUNT(id) FROM teacher_attendance WHERE att_date=CURDATE() AND (attendance='Present' OR attendance='Half Day')) AS TotalPresent,
            (SELECT COUNT(id) FROM teacher_attendance WHERE att_date=CURDATE() AND attendance='Absent') AS TotalAbsent ";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->row();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllNews($page=1, $limit=20) {
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT * FROM news ORDER BY date_added DESC LIMIT $start,$limit";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllEventsToday($page=1, $limit=20) {
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT * FROM events WHERE event_date=CURDATE() ORDER BY date_added DESC LIMIT $start,$limit";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllEventsWeek($page=1, $limit=20) {
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT * FROM events WHERE event_date>=CURDATE() AND event_date<(CURDATE() + INTERVAL 7 DAY) ORDER BY event_date ASC LIMIT $start,$limit";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    public function getAllEventsMonth($page=1, $limit=20) {
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT * FROM events WHERE event_date BETWEEN CURDATE() AND LAST_DAY(CURDATE()) ORDER BY event_date ASC LIMIT $start,$limit";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllEventsNextMonth($page=1, $limit=20) {
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT * FROM events WHERE event_date BETWEEN STR_TO_DATE(CONCAT(YEAR(CURDATE() + INTERVAL 1 MONTH), '-', MONTH(CURDATE() + INTERVAL 1 MONTH), '-', '01') ,'%Y-%c-%e') AND LAST_DAY(CURDATE() + INTERVAL 1 MONTH) ORDER BY event_date ASC LIMIT $start,$limit";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllHolidays($page=1, $limit=20) {
        try {
            $start = ($page - 1) * 20;
            $sql = "SELECT * FROM holidays WHERE leave_date>=CURDATE() ORDER BY leave_date ASC LIMIT $start,$limit";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllCourses() {
        try {
            $sql = "SELECT * FROM course";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllClasses() {
        try {
            $sql = "SELECT cl.*,(SELECT name FROM course co WHERE co.id=cl.course_id) as Course FROM classes cl";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return [];
            }
            
            return $query->result_array();
            
        }catch (Exception $e) {
            $error_msg = array('error: ',$e->getMessage());
            return [];
        }
    }
    
    public function getAllStudentList($request){
        try{
            $flag = 0;
            $sql = "SELECT st.*,cl.name AS className,co.name AS courseName FROM students st LEFT JOIN classes cl ON cl.id=st.class_id LEFT JOIN course co ON co.id=cl.course_id ";
            if(isset($request->name) and !empty($request->name)){
                $sql .=" WHERE (st.first_name LIKE '%$request->name%' OR st.last_name LIKE '%$request->name%')";
                $flag++;
            }
            
            if(isset($request->roll_number) and !empty($request->roll_number)){
                if($flag == 0){
                    $sql .=" WHERE st.roll_number='$request->roll_number' ";
                }else{
                    $sql .=" AND st.roll_number='$request->roll_number' ";
                }
                $flag++;
            }
            
            if(isset($request->admission_number) and !empty($request->admission_number)){
                if($flag == 0){
                    $sql .=" WHERE st.admission_number='$request->admission_number' ";
                }else{
                    $sql .=" AND st.admission_number='$request->admission_number' ";
                }
                $flag++;
            }
            
            if(isset($request->gender) and !empty($request->gender)){
                if($flag == 0){
                    $sql .=" WHERE st.gender='$request->gender' ";
                }else{
                    $sql .=" AND st.gender='$request->gender' ";
                }
                $flag++;
            }
            
            if(isset($request->blood_group) and !empty($request->blood_group)){
                if($flag == 0){
                    $sql .=" WHERE st.blood_group='$request->blood_group' ";
                }else{
                    $sql .=" AND st.blood_group='$request->blood_group' ";
                }
                $flag++;
            }
            
            if(isset($request->status) and !empty($request->status)){
                if($flag == 0){
                    $sql .=" WHERE st.status='$request->status' ";
                }else{
                    $sql .=" AND st.status='$request->status' ";
                }
                $flag++;
            }
            
            if(isset($request->class) and !empty($request->class)){
                if($flag == 0){
                    $sql .=" WHERE st.class_id='$request->class' ";
                }else{
                    $sql .=" AND st.class_id='$request->class' ";
                }
                $flag++;
            }
            
            if(isset($request->course) and !empty($request->course)){
                if($flag == 0){
                    $sql .=" WHERE co.id='$request->course' ";
                }else{
                    $sql .=" AND co.id='$request->course' ";
                }
                $flag++;
            }
         
            $sql .=" ORDER BY st.first_name ASC";
            
            $query = $this->db->query($sql);        
            return $query->result_array();
        }catch(Exception $ex){
	        return $ex->getMessage();
	   }
    }
    
    public function getStudentList($request){
        try{
            $flag = 0;
            $page = $request->page - 1;
            $start = $page * $request->limit;
            $sql = "SELECT st.*,cl.name AS className,co.name AS courseName FROM students st LEFT JOIN classes cl ON cl.id=st.class_id LEFT JOIN course co ON co.id=cl.course_id ";
            
            if(isset($request->name) and !empty($request->name)){
                $sql .=" WHERE (st.first_name LIKE '%$request->name%' OR st.last_name LIKE '%$request->name%')";
                $flag++;
            }
            
            if(isset($request->roll_number) and !empty($request->roll_number)){
                if($flag == 0){
                    $sql .=" WHERE st.roll_number='$request->roll_number' ";
                }else{
                    $sql .=" AND st.roll_number='$request->roll_number' ";
                }
                $flag++;
            }
            
            if(isset($request->admission_number) and !empty($request->admission_number)){
                if($flag == 0){
                    $sql .=" WHERE st.admission_number='$request->admission_number' ";
                }else{
                    $sql .=" AND st.admission_number='$request->admission_number' ";
                }
                $flag++;
            }
            
            if(isset($request->gender) and !empty($request->gender)){
                if($flag == 0){
                    $sql .=" WHERE st.gender='$request->gender' ";
                }else{
                    $sql .=" AND st.gender='$request->gender' ";
                }
                $flag++;
            }
            
            if(isset($request->blood_group) and !empty($request->blood_group)){
                if($flag == 0){
                    $sql .=" WHERE st.blood_group='$request->blood_group' ";
                }else{
                    $sql .=" AND st.blood_group='$request->blood_group' ";
                }
                $flag++;
            }
            
            if(isset($request->status) and !empty($request->status)){
                if($flag == 0){
                    $sql .=" WHERE st.status='$request->status' ";
                }else{
                    $sql .=" AND st.status='$request->status' ";
                }
                $flag++;
            }
            
            if(isset($request->class) and !empty($request->class)){
                if($flag == 0){
                    $sql .=" WHERE st.class_id='$request->class' ";
                }else{
                    $sql .=" AND st.class_id='$request->class' ";
                }
                $flag++;
            }
            
            if(isset($request->course) and !empty($request->course)){
                if($flag == 0){
                    $sql .=" WHERE co.id='$request->course' ";
                }else{
                    $sql .=" AND co.id='$request->course' ";
                }
                $flag++;
            }
         
            $sql .=" ORDER BY st.first_name ASC LIMIT $start, $request->limit";
            
            $query = $this->db->query($sql);        
            return $query->result_array();
        }catch(Exception $ex){
	        return false;
	   }
    }
    
    public function getStudentPagination($request = []){
        try{
            $flag = 0;
            $sql = "SELECT COUNT(*) as Pages FROM students st LEFT JOIN classes cl ON cl.id=st.class_id LEFT JOIN course co ON co.id=cl.course_id ";
            
            if(isset($request->name) and !empty($request->name)){
                $sql .=" WHERE (st.first_name LIKE '%$request->name%' OR st.last_name LIKE '%$request->name%')";
                $flag++;
            }
            
            if(isset($request->roll_number) and !empty($request->roll_number)){
                if($flag == 0){
                    $sql .=" WHERE st.roll_number='$request->roll_number' ";
                }else{
                    $sql .=" AND st.roll_number='$request->roll_number' ";
                }
                $flag++;
            }
            
            if(isset($request->admission_number) and !empty($request->admission_number)){
                if($flag == 0){
                    $sql .=" WHERE st.admission_number='$request->admission_number' ";
                }else{
                    $sql .=" AND st.admission_number='$request->admission_number' ";
                }
                $flag++;
            }
            
            if(isset($request->gender) and !empty($request->gender)){
                if($flag == 0){
                    $sql .=" WHERE st.gender='$request->gender' ";
                }else{
                    $sql .=" AND st.gender='$request->gender' ";
                }
                $flag++;
            }
            
            if(isset($request->blood_group) and !empty($request->blood_group)){
                if($flag == 0){
                    $sql .=" WHERE st.blood_group='$request->blood_group' ";
                }else{
                    $sql .=" AND st.blood_group='$request->blood_group' ";
                }
                $flag++;
            }
            
            if(isset($request->status) and !empty($request->status)){
                if($flag == 0){
                    $sql .=" WHERE st.status='$request->status' ";
                }else{
                    $sql .=" AND st.status='$request->status' ";
                }
                $flag++;
            }
            
            if(isset($request->class) and !empty($request->class)){
                if($flag == 0){
                    $sql .=" WHERE st.class_id='$request->class' ";
                }else{
                    $sql .=" AND st.class_id='$request->class' ";
                }
                $flag++;
            }
            
            if(isset($request->course) and !empty($request->course)){
                if($flag == 0){
                    $sql .=" WHERE co.id='$request->course' ";
                }else{
                    $sql .=" AND co.id='$request->course' ";
                }
                $flag++;
            }
            
            $query = $this->db->query($sql);        
            return $query->row();
        }catch(Exception $ex){
	        return false;
	   }
    }
    
    public function getParentList($request){
        try{
            $flag = 0;
            $page = $request->page - 1;
            $start = $page * $request->limit;
            $sql = "SELECT * FROM parents pr ";
            
            if(isset($request->name) and !empty($request->name)){
                $sql .=" WHERE (pr.first_name LIKE '%$request->name%' OR pr.last_name LIKE '%$request->name%')";
                $flag++;
            }
            
            if(isset($request->mobile) and !empty($request->mobile)){
                if($flag == 0){
                    $sql .=" WHERE pr.mobile LIKE '$request->mobile%' ";
                }else{
                    $sql .=" AND pr.mobile LIKE '$request->mobile%' ";
                }
                $flag++;
            }
            
            if(isset($request->email) and !empty($request->email)){
                if($flag == 0){
                    $sql .=" WHERE pr.email LIKE '$request->email%' ";
                }else{
                    $sql .=" AND pr.email LIKE '$request->email%' ";
                }
                $flag++;
            }
         
            $sql .=" ORDER BY pr.first_name ASC LIMIT $start, $request->limit";
            
            $query = $this->db->query($sql);        
            return $query->result_array();
        }catch(Exception $ex){
	        return false;
	   }
    }
    
    public function CheckStudentByIDNew($id){
        try{
            $sql = "SELECT id FROM students WHERE id='$id'";
            $query = $this->db->query($sql);        
            return $query->row();
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function CheckStudentWithDetails($req){
        try{
            $sql = "SELECT * FROM students WHERE roll_number='$req->roll_number' OR admission_number='$req->admission_number'";
            $query = $this->db->query($sql);        
            return $query->row();
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function AddNewStudent($data){
        try{
            $this->db->trans_begin();
            $sql = "INSERT INTO students(roll_number,first_name,middle_name,last_name,mobile,email,password,access_key,photo,dob,gender,blood_group,doj,address,city_id,state_id,country_id,pincode,class_id,admission_number,created_by,status)
                    VALUES('$data[roll_number]','$data[first_name]','$data[middle_name]','$data[last_name]','$data[mobile]','$data[email]','$data[password]','$data[access_key]','$data[photo]','$data[dob]','$data[gender]','$data[blood_group]','$data[doj]','$data[address]','$data[city_id]','$data[state_id]','$data[country_id]','$data[pincode]','$data[class_id]','$data[admission_number]','$data[created_by]','$data[status]')";
            $this->db->query($sql);
            $insert_id = $this->db->insert_id();
            $sql = "INSERT INTO students_details(student_id,birth_place,nationality,language,religion,student_category,is_handicapped,handicap_details)
                    VALUES('$insert_id','$data[birth_place]','$data[nationality]','$data[language]','$data[religion]','$data[student_category]','$data[is_handicapped]','$data[handicap_details]')";
            $query = $this->db->query($sql);
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $insert_id;
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function getParentsByStudent($request){
        try{
            $sql = "SELECT * FROM parents pr ";
            $query = $this->db->query($sql);
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $query->result_array();
        }catch(Exception $ex){
	        return false;
	   }
    }
    
    public function CheckParentWithDetails($req){
        try{
            $sql = "SELECT * FROM parents WHERE mobile='$req->mobile' OR email='$req->email'";
            $query = $this->db->query($sql);        
            return $query->row();
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function AddNewParent($data){
        try{
            $this->db->trans_begin();
            $sql = "INSERT INTO parents(first_name,last_name,mobile,relationship,email,password,office_phone,education,occupation,income,gender,dob,address,city_id,state_id,country_id,pincode,role,created_by,status)
                    VALUES('$data[first_name]','$data[last_name]','$data[mobile]','$data[relationship]','$data[email]','$data[password]','$data[office_phone]','$data[education]','$data[occupation]','$data[income]','$data[gender]','$data[dob]','$data[address]','$data[city_id]','$data[state_id]','$data[country_id]','$data[pincode]','$data[role]','$data[created_by]','$data[status]')";
            $this->db->query($sql);
            $insert_id = $this->db->insert_id();
            $sql = "INSERT INTO student_to_parent_assignment(parent_id,student_id)
                    VALUES('$insert_id','$data[student_id]')";
            $query = $this->db->query($sql);
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
            }
            
            $db_error = $this->db->error();
            if (isset($db_error['code']) and (!empty($db_error['code']) and $db_error['code'] !== 0)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false;
            }
            
            return $insert_id;
        }catch(Exception $ex){
	        return false;
	    }
    }
    
    public function InsertSubmitResultOptional($data){
        $this->db->insert('online_test_optional_submission',$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    
}