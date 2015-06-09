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
		if(isset($sessionUserId)){
	        $whStr .= " or c.u_id = '$sessionUserId' ";
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
}