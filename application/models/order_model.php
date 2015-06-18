<?php
class order_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getPremenentAdd($uId)
	{
		$tmpArr = array();
		$q = $this->db->query("select u.*,c.country_name,s.state_nm from game_user as u JOIN game_country as c ON u.country_id = c.id JOIN game_state as s ON u.state_id = s.id where u.id =?",array($uId));
		if($q->num_rows()>0)
		{
			$row = $q->result();
			$tmpArr['address1'] = $row[0]->address1;
			$tmpArr['address2'] = $row[0]->address2;
			$tmpArr['address3'] = $row[0]->address3;
			$tmpArr['city'] = $row[0]->city;
			$tmpArr['country_name'] = $row[0]->country_name;
			$tmpArr['state_nm'] = $row[0]->state_nm;
			$tmpArr['zip'] = $row[0]->zip;
		}
		return $tmpArr;
	}
	function getOtherAdd($uId)
	{
		$data = array();
		$q = $this->db->query("select u.*,c.country_name,s.state_nm from game_address as u JOIN game_country as c ON u.country_id = c.id JOIN game_state as s ON u.state_id = s.id where u.user_id =?",array($uId));
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$tmpArr = array();
				$tmpArr['id'] = $row[0]->id;
				$tmpArr['address1'] = $row[0]->add1;
				$tmpArr['address2'] = $row[0]->add2;
				$tmpArr['address3'] = $row[0]->add3;
				$tmpArr['city'] = $row[0]->city;
				$tmpArr['country_name'] = $row[0]->country_name;
				$tmpArr['state_nm'] = $row[0]->state_nm;
				$tmpArr['zip'] = $row[0]->zip;
				$data[] = $tmpArr;
			}
		}
		return $data;
	}
	function getMyCartCount()
	{
		$whStr = "";
		if($this->session->userdata('UserID')){
	        $whStr .= " or u_id = '".$this->session->userdata('UserID')."' ";
	    }
		$qsr = "SELECT COUNT(id) as cnt FROM game_cart
				WHERE sess_id = '".session_id()."' $whStr";
	    $q = $this->db->query($qsr);
		$row = $q->result();
	    return $row[0]->cnt;
	}
}