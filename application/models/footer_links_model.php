<?php
class footer_links_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function get_all($start = 0,$whArr=array())
	{
	    $whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND link_title like '%".$whArr[0]."%' ";
	    }
		$data = array();
	    $q = $this->db->query("select * from game_footer_links where 1=1 $whStr order by id limit $start,10");
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
	        $whStr .= " AND link_title like '%".$whArr[0]."%' ";
	    }
        $q = $this->db->query("select count(*) as cnt from game_footer_links where 1=1 $whStr ");
		$row = $q->result();
	    return $row[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('game_footer_links', array('id' => $id), 1);
		$row = $query->result();
		return $row[0];
	}
	function getAllFooterLinks()
	{
		$q = $this->db->query("select * from game_footer_links");
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['id'][] = $row->id;
				$data['link_title'][] = $row->link_title;
				$data['index_key'][] = $row->index_key;
			}
			
		}
		return $data;		
	}
	function getFooterContent($page)
	{
		$content = "";
		 $q = $this->db->query("select content from game_footer_links where index_key = ?",array($page));
		if($q->num_rows()>0)
		{
			$row = $q->result();
			$content = $row[0]->content;
		}
		return $content;	
	}
}