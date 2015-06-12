<?php 
(defined ( 'BASEPATH' )) or exit ( 'No direct script access allowed' );

class users_model extends CI_Model {

	public function __construct()
    {
		parent::__construct();
	} 

	public function checkMailExist($email)
    {
	        $tableName ="game_user";	        
	        $data["email"] = $email;
	        $query= $this->db->select()->from($tableName)->where($data)->get();
	        $row = $query->row_array();
	        
	      if(count($row) > 0) 
	      {
	      	  $profileRow = array('userId'=>$row['user_id'],'fullame'=>$row['first_name'].' '.$row['last_name'],'email'=>$row['email']);    
			 // echo '<pre>';print_r($profileRow);die();     
              return $profileRow;
        }else {
            return false;
        }    
    }   	
	
	
	/////for mail function on forgot password////
    public function checkuserIdExisit()
    {
    		$userId = $this->getId(); 	    	
	        $tableName ="game_user";	  	        
	        $data["id"] = $userId;
	       //echo $userId;die();	
	        $query= $this->db->select('id')->from($tableName)->where("id",$userId)->get();
//	       / echo $this->db->last_query();die;
	      if ($query->num_rows() > 0) 
	      {
	      	  return "true";
	      }
	      else
	      {
	          return "false";
	      }    
    }  
	
	public function createRegisterUser($tableName,$data){
	
			$result=$this->db->insert($tableName,$data);
			$libId=$this->db->insert_id();
			if($result){
			return $libId;
			}else{
			return false;
			}
	
	}
	public function email_check($email){
			$sql="Select * from game_user where email='".$email."'";
			$query = $this->db->query($sql);
			//$result_arr = $query->result_array();
			$num = $query->num_rows();
			//echo '<pre>';print_r($num);die();
			if($num>0){
			return true;
			}else{
			return false;
			}
			
	}
	
	function get_record($id)
	{
		$query = $this->db->get_where('game_user', array('user_id' => $id), 1);
		$objresult =  $query->result();
		return $objresult[0];
	}
}



