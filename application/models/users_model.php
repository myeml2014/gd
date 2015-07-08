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
	function getUserDetail($userId)
	{
		$data = array();
		$query = "SELECT u.*,c.country_name,s.state_nm
					FROM game_user AS u
					JOIN game_country AS c ON u.country_id = c.id
					JOIN game_state AS s ON u.state_id = s.id 
					WHERE u.id = ?";
		$q = $this->db->query($query,array($userId));
		foreach($q->result() as $row)
		{
			$data['email'] = $row->email;
			$data['mobile'] = $row->mobile;
			$data['fname'] = $row->fname;
			$data['lname'] = $row->lname;
			$data['address1'] = $row->address1;
			$data['address2'] = $row->address2;
			$data['address3'] = $row->address3;
			$data['city'] = $row->city;
			$data['country_name'] = $row->country_name;
			$data['state_nm'] = $row->country_name;
			$data['zip'] = $row->zip;
			$data['child_birth_date'] = $row->child_birth_date;
			$data['gender'] = $row->gender;
			$data['cat_ids'] = $row->cat_ids;
		}
		return $data;
	}
	function getCategryArr()
	{
		$data = array();
		$q = $this->db->get_where('game_category',array('parent_id'=>0,'is_active'=>1));
		foreach($q->result() as $row){
			$data[$row->id] = $row->cat_name;
		}
		return $data;
	}
}



