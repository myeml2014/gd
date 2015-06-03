<?php
class product_model extends CI_Model
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
	        $whStr .= " AND cat like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND sub_cat like '%".$whArr[1]."%' ";
	    }
		if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND p_name like '%".$whArr[2]."%' ";
	    }
		$data = array();
		$query = "SELECT p.id,c.cat_name as cat,subc.cat_name as sub_cat,p.p_name,if(p.is_active=1,'Active','Deactive') as status,is_feature_p FROM game_product as p
					JOIN game_category as subc ON p.cat_id = subc.id
					JOIN game_category as c ON subc.parent_id = c.id 
					WHERE 1=1 $whStr
					ORDER BY c.cat_name,subc.cat_name,p.p_order limit $start,10";
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
	        $whStr .= " AND cat like '%".$whArr[0]."%' ";
	    }
		if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND sub_cat like '%".$whArr[1]."%' ";
	    }
		if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND p_name like '%".$whArr[2]."%' ";
	    }
		$query = "SELECT count(*) as cnt FROM game_product as p
					JOIN game_category as subc ON p.cat_id = subc.id
					JOIN game_category as c ON subc.parent_id = c.id 
					WHERE 1=1 $whStr";
        $q = $this->db->query($query);
	    return $q->result()[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('game_product', array('id' => $id), 1);
		return $query->result()[0];
	}
	function loadMenu()
	{
		$data = array();
		$query = "select * from game_product where parent_id=0 and is_main_menu = 1 and is_active=1 order by cat_order";
		$q = $this->db->query($query);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data['title'][] = $row->cat_name;
			}
		}
		return $data;
	}
	function updateImage($imgArr = array(),$pId)
	{
		$this->db->delete('game_images',array('p_id'=>$pId));
		foreach($imgArr as $img)
		{
			$arrVal = array();
			$arrVal['p_id'] = $pId;
			$arrVal['img_path'] = $img;
			$arrVal['added_by'] = $this->session->userdata('user_id');
			$this->db->insert('game_images',$arrVal);
		}
	}
	function stepUp($catId)
	{
	    $q = $this->db->query("select max(cat_order) as ord from game_product where cat_order < (select cat_order from game_product where id = ?)",array($catId));
	    if($q->num_rows()>0)
	    {
	        $row = $q->row();
	        $next = $row->ord;
	        if($next != "")
	        {
    	        $q = $this->db->query("select cat_order from game_product where id = ?",array($catId));
    	        $row = $q->row();
    	        $order = $row->cat_order;
    	       
    	        $this->db->query("UPDATE game_product SET cat_order = $order where cat_order = ?",array($next));
    	        $this->db->query("UPDATE game_product SET cat_order = $next where id = ?",array($catId));
	        }
	    }    
	}
	function stepDown($catId)
	{
	    $q = $this->db->query("select min(cat_order) as ord from game_product where cat_order > (select cat_order from game_product where id = ?)",array($catId));
	    if($q->num_rows()>0)
	    {
	        $row = $q->row();
	        $next = $row->ord;
	        if($next != "")
	        {
    	        $q = $this->db->query("select cat_order from game_product where id = ?",array($catId));
    	        $row = $q->row();
    	        $order = $row->cat_order;
    	        
    	        $this->db->query("UPDATE game_product SET cat_order = $order where cat_order = ?",array($next));
    	        $this->db->query("UPDATE game_product SET cat_order = $next where id = ?",array($catId));
	        }
	    }	    
	}
	/*for display all product on home page.*/
	function getAllProduct()
	{
		$data = array();
		$query = "select * from game_product where parent_id=0 and is_active=1 order by cat_order";
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
	function get_all_sub_product($start = 0,$whArr)
	{
	    $whStr = '';
		if($whArr[0] != ''){
	        $whStr .= " AND sub_cat_name like '%".$whArr[0]."%' ";
	    }
	    if($whArr[0] != ''){
	        $whStr .= " AND cat_name like '%".$whArr[0]."%' ";
	    }
		if($whArr[1] != ''){
	        $whStr .= " AND cat_desc like '%".$whArr[1]."%' ";
	    }
		$data = array();
	    $q = $this->db->query("select *,if(is_active=1,'Active','Deactive') as status from game_sub_product where 1=1 $whStr limit $start,10");
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
			
		}
		return $data;		
	}
	function get_all_sub_product_count($whArr)
	{
	    $whStr = '';
		if($whArr[0] != ''){
	        $whStr .= " AND sub_cat_name like '%".$whArr[0]."%' ";
	    }
	    if($whArr[0] != ''){
	        $whStr .= " AND cat_name like '%".$whArr[0]."%' ";
	    }
		if($whArr[1] != ''){
	        $whStr .= " AND cat_desc like '%".$whArr[1]."%' ";
	    }
        $q = $this->db->query("select count(id) as cnt from (select * from game_sub_product where 1=1 $whStr ) as jig");
	    return $q->result()[0]->cnt;
	}
	function getAllAttribute($pId)
	{
		$q = $this->db->query("select * from game_attribute_value where product_id = ?",array($pId));
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
	function getAllImages($pId)
	{
		$data = array();
		$q = $this->db->query("select * from game_images where p_id = ?",array($pId));
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
}