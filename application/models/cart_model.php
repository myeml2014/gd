<?php
class cart_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getMyCart()
	{
		$whStr = "";
		if($this->session->userdata('UserID')){
	        $whStr .= " or c.u_id = '".$this->session->userdata('UserID')."' ";
	    }
		$data = array();
		$qsr = "SELECT c.*, COUNT(c.p_id) AS cnt, SUM(c.price) AS p_total,p.p_name,p.index_key as pkey,(select img_path from game_images where p_id = c.p_id limit 1 )img_path
				FROM game_cart as c
				JOIN game_product as p ON c.p_id = p.id
				WHERE c.sess_id = '".session_id()."' $whStr
				GROUP BY c.p_id order by c.datetime desc";
	    $q = $this->db->query($qsr);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
			
		}
		return $data;
	}
	function getIdFromPid($pId)
	{
		if($this->session->userdata('UserID'))
		$sstr = " OR u_id = ".$this->session->userdata('UserID');
		$q = $this->db->query("select id from game_cart where p_id = ?  and (sess_id = ? $sstr) limit 0,1",array($pId,session_id()));
		$row = $q->result();
	    return $row[0]->id;
	}
	function addQuentity($pId)
	{
		$id= $this->getIdFromPid($pId);
		$this->db->query("insert into game_cart (p_id,u_id,sess_id,quentity,price) (SELECT  s.p_id,s.u_id,s.sess_id,s.quentity,s.price from game_cart as s where s.id = ?)",array($id));
	}
}