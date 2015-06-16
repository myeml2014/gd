<?php 
(defined ( 'BASEPATH' )) or exit ( 'No direct script access allowed' );

class users_model extends CI_Model {

	public function __construct()
    {
		parent::__construct();
	} 
	
	public function email_check($email){
		$sql="Select * from game_user where email = ?";
		$query = $this->db->query($sql,array($email));
		$num = $query->num_rows();
		if($num>0){
			return true;
		}else{
			return false;
		}
	}
	function get_all($start = 0,$whArr=array())
	{
	    $whStr = '';
		if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND id = '".$whArr[0]."'";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND CONCAT(fname,' ',lname) like '%".$whArr[1]."%' ";
	    }
	    if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND email like '%".$whArr[0]."%' ";
	    }
		
		$data = array();
		$query = "select * from game_user where 1=1 ".$whStr." order by fname,lname limit $start,10";
	
	    $q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
			
		}
		
		return $data;
	}
	function get_all_count($whArr=array())
	{
	    $whStr = '';
		if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND id = '".$whArr[0]."'";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND CONCAT(fname,' ',lname) like '%".$whArr[1]."%' ";
	    }
	    if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND email like '%".$whArr[0]."%' ";
	    }		
		$query = "select count(id) as cnt from game_user WHERE 1=1 $whStr";       
		$q = $this->db->query($query);
		$chckTest = $q->result();
		return $chckTest[0]->cnt;
	}
	function setCart($userId)
	{
		$query = "select GROUP_CONCAT(id) as ids from game_cart where u_id=0 and sess_id = '".session_id()."'";
		$q = $this->db->query($query);
		$chckTest = $q->result();
		$ids = $chckTest[0]->ids;
		if($ids != '')
		{
			$query = "update game_cart set u_id = $userId where id in($ids)";
			$q = $this->db->query($query);
		}
	}
	/*.........................................remove below*/
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
	
	function get_record($id)
	{
		$query = $this->db->get_where('game_user', array('user_id' => $id), 1);
		$objresult =  $query->result();
		return $objresult[0];
	}
}



