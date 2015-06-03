<?php
class Adminuser extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function is_login()
	{
		return $this->session->userdata('user_id')!=false;
	}
	function verifyLogin($username,$password)
	{
		$query = $this->db->get_where('tbl_admin', array('username' => $username,'password'=>md5($password), 'status'=>1), 1);
		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			$this->session->set_userdata('user_id', $row->id);
			return true;
		}
		return false;
	}
	function get_all($start = 0,$whArr=array())
	{
	    $whStr = '';
	    if(isset($whArr[0]) && $whArr[0] != ''){
	        $whStr .= " AND (fname like '%".$whArr[0]."%' OR lname like '%".$whArr[0]."%') ";
	    }
	    if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND username like '%".$whArr[1]."%' ";
	    }
	    if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND email like '%".$whArr[2]."%' ";
	    }
		$data = array();
        $q = $this->db->query("select id,CONCAT(fname,' ',lname) as name,username,email,if(status=1,'Active','Deactive') AS status from tbl_admin where id>0 $whStr order by fname,lname limit $start,10");
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
	        $whStr .= " AND (fname like '%".$whArr[0]."%' OR lname like '%".$whArr[0]."%') ";
	    }
	    if(isset($whArr[1]) && $whArr[1] != ''){
	        $whStr .= " AND username like '%".$whArr[1]."%' ";
	    }
	    if(isset($whArr[2]) && $whArr[2] != ''){
	        $whStr .= " AND email like '%".$whArr[2]."%' ";
	    }
        $q = $this->db->query("select count(*) as cnt from tbl_admin where id>0 $whStr ");
	    return $q->result()[0]->cnt;
	}
	function get_record($id)
	{
		$query = $this->db->get_where('tbl_admin', array('id' => $id), 1);
		return $query->result()[0];
	}
	function checkisUserExists($userName,$id=0)
	{
		$query = $this->db->query('select * from tbl_admin where username = ? and id != ?', array($userName,$id));
		if ($query->num_rows() > 0)
		{
			return true;
		}
		return false;
	}
}
?>