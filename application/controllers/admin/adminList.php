<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class adminList extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		if(!$this->Adminuser->is_login())
		{
			redirect('admin/login');
		}
	}
	public function index()
	{
		$headerData = array();
		$footerData = array();
		$data = array();
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/admin_account/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('setForm',&$this,'setForm'));
		$this->xajax->register(XAJAX_FUNCTION, array('save',&$this,'save'));
		$this->xajax->register(XAJAX_FUNCTION, array('edit',&$this,'edit'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete',&$this,'delete'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
                
        $headerData['onload'] = true; 
		$headerData['module_js'] = $modulePathUrl.'adminList.js';
		$this->load->view('admin/header/header',$headerData);
		$this->load->view('admin/admin_account/adminList',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."admin_account/";
		$this->load->view('admin/header/footer',$footerData);	
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$data = $this->Adminuser->get_all($start,$whArr);
		$objResponse->script('renderJson('.json_encode($data).','.$this->Adminuser->get_all_count($whArr).')');
		return $objResponse;
	}
	function setForm($id)
	{
		$objResponse=new xajaxResponse();
		$data = $this->Adminuser->get_record($id);
		$objResponse->assign("txtFname","value",$data->fname);
		$objResponse->assign("txtLname","value",$data->lname);
		$objResponse->assign("txtUsername","value",$data->username);
		$objResponse->assign("txtPassword","value","******************************");
		$objResponse->assign("txtEmail","value",$data->email);
		$objResponse->assign("selStatus","value",$data->status);
		return $objResponse;
	}
	function save($arg)
	{
		$objResponse=new xajaxResponse();
		if($this->Adminuser->checkisUserExists($arg['txtUsername']))
		{
			return $objResponse->alert($this->lang->line('user_exists'));
		}
        $arrVal = array();
        $arrVal['fname'] = ucfirst($arg['txtFname']);
        $arrVal['lname'] = ucfirst($arg['txtLname']);
        $arrVal['email'] = $arg['txtEmail'];
        $arrVal['username'] = $arg['txtUsername'];
        $arrVal['password'] = md5($arg['txtPassword']);
        $arrVal['status'] = $arg['selStatus'];
	$arrVal['added_by'] = $this->session->userdata('user_id');
        $sucess = $this->db->insert('tbl_admin',$arrVal);
        if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_insert'));
            $objResponse->script("fnreset()");
            $objResponse->script("xajax_load()");
        }
        return $objResponse;		
	}
	function edit($id,$arg)
	{
		$objResponse=new xajaxResponse();
		if($this->Adminuser->checkisUserExists($arg['txtUsername'],$id))
		{
			return $objResponse->alert($this->lang->line('user_exists'));
		}
		$arrVal = array();
		$arrVal['fname'] = ucfirst($arg['txtFname']);
		$arrVal['lname'] = ucfirst($arg['txtLname']);
		$arrVal['email'] = $arg['txtEmail'];
        $arrVal['username'] = $arg['txtUsername'];
		$arrVal['status'] = $arg['selStatus'];
        $arrVal['added_by'] = $this->session->userdata('user_id');
		$sucess = $this->db->update('tbl_admin',$arrVal,array('id'=>$id));
        if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_update'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
        return $objResponse;
	}
	function delete($id)
	{
		$objResponse=new xajaxResponse();
		$sucess = $this->db->delete('tbl_admin',array('id'=>$id));
		if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_delete'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
		return $objResponse;
	}
}
