<?php
class country_model extends CI_Model
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
	        $whStr .= " AND country_name like '%".$whArr[0]."%' ";
	    }
		
		$data = array();
		$query = "select * from game_country where 1=1 ".$whStr." order by country_name limit $start,10";
	
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
	        $whStr .= " AND country_name like '%".$whArr[0]."%' ";
	    }		
		$query = "select count(*) as cnt from game_country WHERE 1=1 $whStr";       
		$q = $this->db->query($query);
		$chckTest = $q->result();
		return $chckTest[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('game_country', array('id' => $id), 1);
		$chckTest = $query->result();
		return $chckTest[0];
	}
	function loadMenu()
	{
		$data = array();
		$query = "select * from game_country order by country_name";
		$q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['title'][] = $row->country_name;
			}
		}
		return $data;
	}
	function getSameRecord($CountryName)
	{
		$query = "select count(*) as cnt from game_country WHERE country_name=?";       
		$q = $this->db->query($query,array($CountryName));
		$chckTest = $q->result();
		return $chckTest[0]->cnt;
	}
}