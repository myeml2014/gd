<?php
class state_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	/*For display in admin grid*/
	function get_all($start = 0,$whArr=array())
	{
	    $whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND c.country_name like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND s.state_nm like '%".$whArr[1]."%' ";
	    }
		
		$data = array();
		$query = "select s.*,c.country_name from game_state as s join game_country as c ON c.id= s.country_id where 1=1 ".$whStr." order by c.country_name,s.state_nm limit $start,10";
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
	        $whStr .= " AND c.country_name like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND s.state_nm like '%".$whArr[1]."%' ";
	    }	
		$query = "select count(s.id) as cnt from game_state as s join game_country as c ON c.id= s.country_id WHERE 1=1 $whStr";       
		$q = $this->db->query($query);
		$chckTest = $q->result();
		return $chckTest[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('game_state', array('id' => $id), 1);
		$chckTest = $query->result();
		return $chckTest[0];
	}
	function getSameRecord($stateName)
	{
		$query = "select count(*) as cnt from game_state WHERE state_nm=?";       
		$q = $this->db->query($query,array($stateName));
		$chckTest = $q->result();
		return $chckTest[0]->cnt;
	}
}