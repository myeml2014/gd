<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class users extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		$this->load->model('users_model');		
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
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/users/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('setForm',&$this,'setForm'));
		$this->xajax->register(XAJAX_FUNCTION, array('save',&$this,'save'));
		$this->xajax->register(XAJAX_FUNCTION, array('edit',&$this,'edit'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete',&$this,'delete'));
		
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		
      	$headerData['onload'] = true; 
		$headerData['addTinymce'] = false;
		$headerData['module_js'] = $modulePathUrl.'users.js';
		$this->load->view('admin/header/header',$headerData);
		$this->load->view('admin/users/users',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."users/";
		$this->load->view('admin/header/footer',$footerData);	
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$data = $this->users_model->get_all($start,$whArr);
		
		$objResponse->script('renderJson('.json_encode($data).','.$this->users_model->get_all_count($whArr).')');
		
		return $objResponse;
	}
	
	function setForm($id)
	{
		$objResponse=new xajaxResponse();		
		$data = $this->users_model->get_record($id);		
		$objResponse->assign("txtusers","value",$data->users_name);
		unset($data);
		return $objResponse;
	}
	
	function save($arg)
	{
		$objResponse=new xajaxResponse();		
     	$arrVal = array();		
		$arrVal['users_name'] = $arg['txtusers'];
		$data = $this->users_model->getSameRecord($arrVal['users_name']);
		if($data > 0)
		{
			$objResponse->alert($this->lang->line('msg_exist'));
			 return $objResponse;
		}		
        $sucess = $this->db->insert('game_users',$arrVal);
		$objResponse->alert($this->lang->line('msg_insert'));
        $objResponse->script("fnreset()");
        $objResponse->script("xajax_load()");       
        return $objResponse;		
	}
	function edit($id,$arg)
	{
		$objResponse=new xajaxResponse();
		$arrVal = array();
		$arrVal['users_name'] = $arg['txtusers'];		
        $sucess = $this->db->update('game_users',$arrVal,array('id'=>$id));
       
        if($sucess)
        {			
			$objResponse->script("fnreset()");
			$objResponse->script("xajax_load()");			
        }
        return $objResponse;
	}
	function delete($id)
	{
		$objResponse=new xajaxResponse();
		$sucess = $this->db->delete('game_users',array('id'=>$id));
		if($sucess)
        {			
            $objResponse->alert($this->lang->line('msg_delete'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
		return $objResponse;
	}
	function detail($userId)
	{
		$data = array();
		$data = $this->users_model->getUserDetail($userId);
		$data['catArr'] = $this->users_model->getCategryArr();
		$this->load->view('admin/users/form',$data);	
		unset($data);
	}
}