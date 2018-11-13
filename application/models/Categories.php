<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function check_slug($data){
        $sql = "SELECT * FROM be_category WHERE slug='$data' LIMIT 1";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function SubmitMainTest($data){
    $this->db->insert('online_test_mains_submission',$data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
    }
    
    public function SubmitOptionalTest($data){
    $this->db->insert('online_test_optional_submission',$data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
    }
    
    
    public function InsertSubmitResultOptional($data){
        $this->db->insert('online_test_optional_submission',$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function GetOnlineTestPrelimsQues($data){
        $sql = "SELECT * FROM online_test_questions_prelims WHERE question_type='$data' ORDER BY date_added DESC LIMIT 100";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function GetUserDetail($data){
    $sql = "SELECT * FROM user WHERE id='$data'";
    $query = $this->db->query($sql);        
    return $query->result_array();
    }
    
    public function GetOnlineTestPrelimsSubmitted($data){
    $sql = "SELECT * FROM online_test_submit_prelims WHERE user_id='$data[user_id]' AND question_type='$data[quetion_id]'";
    $query = $this->db->query($sql);        
    return $query->result_array();
    }
    
    public function GetSpecialUserForPrelims($data){
    $sql = "SELECT * FROM online_test_prelime_user_access WHERE user_id='$data[user_id]' AND question_id='$data[quetion_id]'";
    $query = $this->db->query($sql);        
    return $query->result_array();
    }
    
}