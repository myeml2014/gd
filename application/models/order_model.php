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
				$tmpArr['id'] = $row->id;
				$tmpArr['address1'] = $row->add1;
				$tmpArr['address2'] = $row->add2;
				$tmpArr['address3'] = $row->add3;
				$tmpArr['city'] = $row->city;
				$tmpArr['country_name'] = $row->country_name;
				$tmpArr['state_nm'] = $row->state_nm;
				$tmpArr['zip'] = $row->zip;
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
	function get_all($start = 0,$whArr=array(),$fixCondition)
	{
	    $whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND name like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND p_name like '%".$whArr[1]."%' ";
	    }
		if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND p_qty like '%".$whArr[2]."%' ";
	    }
		if(isset($whArr[3]) && $whArr[3] != ''){
	        $whStr .= " AND order_amount = '".$whArr[3]."' ";
	    }
		if(isset($whArr[4]) && $whArr[4] != ''){
	        $whStr .= " AND order_status = '".$whArr[4]."' ";
	    }
		$data = array();
		$query = "SELECT o.*,CONCAT(u.fname,' ',u.lname) as name,p.p_name,if(o.order_status=0,'Pending',if(o.order_status=1,'Shipped','')) as order_status FROM  game_order AS o
					JOIN game_user as u ON o.u_id = u.id
					JOIN game_product as p ON o.p_id = p.id 
				WHERE 1=1 ".$fixCondition." ".$whStr." order by order_date desc limit $start,10";
	    $q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
			
		}
		
		return $data;
	}
	function get_all_count($whArr=array(),$fixCondition)
	{
		$whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND name like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND p_name like '%".$whArr[1]."%' ";
	    }
		if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND p_qty like '%".$whArr[2]."%' ";
	    }
		if(isset($whArr[3]) && $whArr[3] != ''){
	        $whStr .= " AND order_amount = '".$whArr[3]."' ";
	    }
		if(isset($whArr[4]) && $whArr[4] != ''){
	        $whStr .= " AND order_status = '".$whArr[4]."' ";
	    }
		$data = array();
		$query = "SELECT count(o.id) as cnt FROM  game_order AS o
					JOIN game_user as u ON o.u_id = u.id
					JOIN game_product as p ON o.p_id = p.id 
				WHERE 1=1 ".$fixCondition." $whStr";
	    $q = $this->db->query($query);
		$chckTest = $q->result();
		return $chckTest[0]->cnt;
	}
	function getOrderDetail($orderId)
	{
		$data = array();
		$statusArr = array('Pending','Confirm','Processing','QC','Dispatched','Delivered','Archive');
		$query = "SELECT o.*,CONCAT(u.fname,' ',u.lname) as name,u.email,u.mobile,u.address1,u.address2,u.address3,u.city,s.state_nm,c.country_name,u.zip,p.p_name FROM  game_order AS o
					JOIN game_user as u ON o.u_id = u.id
					JOIN game_country as c ON u.country_id = c.id
					JOIN game_state as s ON u.state_id = s.id
					JOIN game_product as p ON o.p_id = p.id 
					WHERE o.id= ? ";
	    $q = $this->db->query($query,array($orderId));
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['order_date'] = $row->order_date;
				$data['order_status'] = $statusArr[$row->order_status];
				$data['p_name'] = $row->p_name;
				$data['order_amount'] = $row->order_amount;
				$data['p_qty'] = $row->p_qty;
				$data['name'] = $row->name;
				$data['email'] = $row->email;
				$data['mobile'] = $row->mobile;
				$data['address1'] = $row->address1;
				$data['address2'] = $row->address2;
				$data['address3'] = $row->address3;
				$data['city'] = $row->city;
				$data['state_nm'] = $row->state_nm;
				$data['country_name'] = $row->country_name;
				$data['zip'] = $row->zip;
			}
		}
		return $data;
	}
}