<?php
class category_model extends CI_Model
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
	        $whStr .= " AND cat_name like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND cat_desc like '%".$whArr[1]."%' ";
	    }
		$data = array();
	    $q = $this->db->query("select id,cat_name,cat_desc,cat_image,is_main_menu,if(is_active=1,'Active','Deactive') as status,is_active from game_category where parent_id=0 $whStr order by cat_order limit $start,10");
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
	        $whStr .= " AND cat_name like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND cat_desc like '%".$whArr[1]."%' ";
	    }
        $q = $this->db->query("select count(*) as cnt from game_category where parent_id=0 $whStr ");
		$row = $q->result();
	    return $row[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('game_category', array('id' => $id), 1);
		$row = $query->result();
		return $row[0];
	}
	function loadMenu()
	{
		$data = array();
		$query = "select * from game_category where parent_id=0 and is_main_menu = 1 and is_active=1 order by cat_order";
		$q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['title'][] = $row->cat_name;
			}
		}
		return $data;
	}
	function updateImage($imgpath,$catId)
	{
	    $this->db->query("UPDATE game_category SET cat_image=? where id = ?",array($imgpath,$catId));
	}
	function stepUp($catId)
	{
	    $q = $this->db->query("select max(cat_order) as ord from game_category where cat_order < (select cat_order from game_category where id = ?)",array($catId));
	    if($q->num_rows()>0)
	    {
	        $row = $q->row();
	        $next = $row->ord;
	        if($next != "")
	        {
    	        $q = $this->db->query("select cat_order from game_category where id = ?",array($catId));
    	        $row = $q->row();
    	        $order = $row->cat_order;
    	       
    	        $this->db->query("UPDATE game_category SET cat_order = $order where cat_order = ?",array($next));
    	        $this->db->query("UPDATE game_category SET cat_order = $next where id = ?",array($catId));
	        }
	    }    
	}
	function stepDown($catId)
	{
	    $q = $this->db->query("select min(cat_order) as ord from game_category where cat_order > (select cat_order from game_category where id = ?)",array($catId));
	    if($q->num_rows()>0)
	    {
	        $row = $q->row();
	        $next = $row->ord;
	        if($next != "")
	        {
    	        $q = $this->db->query("select cat_order from game_category where id = ?",array($catId));
    	        $row = $q->row();
    	        $order = $row->cat_order;
    	        
    	        $this->db->query("UPDATE game_category SET cat_order = $order where cat_order = ?",array($next));
    	        $this->db->query("UPDATE game_category SET cat_order = $next where id = ?",array($catId));
	        }
	    }	    
	}
	/*for display all category on home page.*/
	function getAllCategory()
	{
		$data = array();
		$query = "select * from game_category where parent_id=0 and is_active=1 order by cat_order";
		$q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['cat_id'][] = $row->id;
				$data['cat_nm'][] = $row->cat_name;
				$data['cat_image'][] = $row->cat_image;
				$data['index_key'][] = $row->index_key;
			}
		}
		return $data;
	}
	/*
	For display on home page.
	*/
	function getAllSubcategoryAll()
	{
		$data = array();
		$query = "select * from game_cat_subcat_home";
		$q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['cid'][] = $row->cid;
				$data['cname'][] = $row->cname;
				$data['cimg'][] = $row->cimg;
				$data['ckey'][] = $row->ckey;
				$data['sid'][] = $row->sid;
				$data['sname'][] = $row->sname;
				$data['simg'][] = $row->simg;
				$data['skey'][] = $row->skey;
				$data['sdesc'][] = $row->sdesc;
			}
		}
		return $data;
	}
	function getAllSubCategory($catId)
	{
		$data = array();
		$query = "select * from game_category where parent_id=? and is_active=1 order by cat_order";
		$q = $this->db->query($query,array($catId));
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['cat_id'][] = $row->id;
				$data['cat_nm'][] = $row->cat_name;
				$data['cat_image'][] = $row->cat_image;
				$data['index_key'][] = $row->index_key;
			}
		}
		return $data;
	}
	function get_all_sub_category($start = 0,$whArr=array())
	{
	    $whStr = '';
		if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND sub_cat_name like '%".$whArr[0]."%' ";
	    }
	    if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND cat_name like '%".$whArr[1]."%' ";
	    }
		if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND cat_desc like '%".$whArr[2]."%' ";
	    }
		$data = array();
	    $q = $this->db->query("select *,if(is_active=1,'Active','Deactive') as status from game_sub_category where 1=1 $whStr limit $start,10");
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;		
	}
	function get_all_sub_category_count($whArr=array())
	{
	    $whStr = '';
		if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND sub_cat_name like '%".$whArr[0]."%' ";
	    }
	    if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND cat_name like '%".$whArr[1]."%' ";
	    }
		if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND cat_desc like '%".$whArr[2]."%' ";
	    }
        $q = $this->db->query("select count(id) as cnt from (select * from game_sub_category where 1=1 $whStr ) as jig");
		$row = $q->result();
	    return $row[0]->cnt;
	}
	function getAllProductAll($sCat)
	{
		$data = array();
	    $q = $this->db->query("select * from game_get_product where cat_id =?",array($sCat));
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
	function getMetaData($catId)
	{
		$data = array();
	    $q = $this->db->query("select cat_meta_keywork as meta_keywords,cat_meta_desc as meta_description from game_category where id =?",array($catId));
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['meta_keywords'] = $row->meta_keywords;
				$data['meta_description'] = $row->meta_description;
			}
		}
		return $data;
	}
	function getAllAttribute()
	{
		$data = array();
		$q = $this->db->query("select * from game_attribute");
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[$row->attribute] = $row->id;
			}
		}
		return $data;
	}
	function checkIsExists($catNm,$id='')
	{
		if($id == '')
	    $q = $this->db->query("select count(*) as cnt from game_category where cat_name = ?",array($catNm));
		else 
		$q = $this->db->query("select count(*) as cnt from game_category where id != ? and cat_name = ?",array($id,$catNm));
	    $row = $q->result();
	    return $row[0]->cnt;
	}
}