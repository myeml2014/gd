<?php
class main_menu extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function get_all($start = 0,$whArr=array())
	{
	    $whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND menu_title like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[0]) && $whArr[1] != ''){
	        $whStr .= " AND menu_link like '%".$whArr[1]."%' ";
	    }
		$data = array();
	    $q = $this->db->query("select id,menu_title,menu_link,if(is_static=1,'Static','Dynamic') as staticordynamic,if(status=1,'Active','Deactive') as activeornot,if(lang_flag=1,'Gujarati','English') as lang from tbl_main_menu where 1=1 $whStr order by lang limit $start,10");
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
	        $whStr .= " AND menu_title like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND menu_link like '%".$whArr[1]."%' ";
	    }
        $q = $this->db->query("select count(*) as cnt from tbl_main_menu where 1=1 $whStr ");
	    return $q->result()[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('tbl_main_menu', array('id' => $id), 1);
		return $query->result()[0];
	}
	function loadMenu()
	{
		$query = "select * from tbl_main_menu where lang_flag = ".LANG_FLG." ";
		$q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['title'][] = $row->menu_title;
				$data['link'][] = $row->menu_link;
			}
			
		}
		return $data;
	}
	function getContent($link)
	{
		$query = $this->db->get_where('tbl_main_menu', array('menu_link' => $link), 1);
		if($query->result()[0]->is_static == 0)
		return false;
		else
		return $query->result()[0]->content;
	}
}
?>