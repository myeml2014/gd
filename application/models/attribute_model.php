<?php
class attribute_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function get_all($start = 0,$whArr=array())
	{
	    $whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND attribute like '%".$whArr[0]."%' ";
	    }
		$data = array();
	    $q = $this->db->query("select * from game_attribute where 1=1 $whStr order by attr_order limit $start,10");
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
			
		}
		return $data;		
	}
	function get_all_count($whArr = array())
	{
	    $whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND attribute like '%".$whArr[0]."%' ";
	    }
        $q = $this->db->query("select count(*) as cnt from game_attribute where 1=1 $whStr ");
	    $row = $q->result();
	    return $row[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('game_attribute', array('id' => $id), 1);
		$row = $query->result();
		return $row[0];
	}
	function stepUp($catId)
	{
	    $q = $this->db->query("select max(attr_order) as ord from game_attribute where attr_order < (select attr_order from game_attribute where id = ?)",array($catId));
	    if($q->num_rows()>0)
	    {
	        $row = $q->row();
	        $next = $row->ord;
	        if($next != "")
	        {
    	        $q = $this->db->query("select attr_order from game_attribute where id = ?",array($catId));
    	        $row = $q->row();
    	        $order = $row->attr_order;
    	       
    	        $this->db->query("UPDATE game_attribute SET attr_order = $order where attr_order = ?",array($next));
    	        $this->db->query("UPDATE game_attribute SET attr_order = $next where id = ?",array($catId));
	        }
	    }    
	}
	function stepDown($catId)
	{
	    $q = $this->db->query("select min(attr_order) as ord from game_attribute where attr_order > (select attr_order from game_attribute where id = ?)",array($catId));
	    if($q->num_rows()>0)
	    {
	        $row = $q->row();
	        $next = $row->ord;
	        if($next != "")
	        {
    	        $q = $this->db->query("select attr_order from game_attribute where id = ?",array($catId));
    	        $row = $q->row();
    	        $order = $row->attr_order;
    	        
    	        $this->db->query("UPDATE game_attribute SET attr_order = $order where attr_order = ?",array($next));
    	        $this->db->query("UPDATE game_attribute SET attr_order = $next where id = ?",array($catId));
	        }
	    }	    
	}
	//for display in product.
	function getAllAttribute()
	{
		$data = array();
	    $q = $this->db->query("select * from game_attribute order by attr_order");
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
			
		}
		return $data;
	}
	function checkIsExists($txt)
	{
	    $q = $this->db->query("select count(*) as cnt from game_attribute where attribute = ?",array($txt));
	    $row = $q->result();
	    return $row[0]->cnt;
	}
}