<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class attribute extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		$this->load->model('attribute_model');
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
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/attribute/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('setForm',&$this,'setForm'));
		$this->xajax->register(XAJAX_FUNCTION, array('save',&$this,'save'));
		$this->xajax->register(XAJAX_FUNCTION, array('edit',&$this,'edit'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete',&$this,'delete'));
		$this->xajax->register(XAJAX_FUNCTION, array('updateOrder',&$this,'updateOrder'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
                
      	$headerData['onload'] = true; 
		$headerData['addTinymce'] = false;
		$headerData['module_js'] = $modulePathUrl.'attribute.js';
		$this->load->view('admin/header/header',$headerData);
		$this->load->view('admin/attribute/attribute',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."attribute/";
		$this->load->view('admin/header/footer',$footerData);	
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$data = $this->attribute_model->get_all($start,$whArr);
		$objResponse->script('renderJson('.json_encode($data).','.$this->attribute_model->get_all_count($whArr).')');
		return $objResponse;
	}
	function setForm($id)
	{
		$objResponse=new xajaxResponse();
		$data = $this->attribute_model->get_record($id);
		$objResponse->assign("txtTitle","value",$data->attribute);
		return $objResponse;
	}
	function save($arg)
	{
		$objResponse=new xajaxResponse();
	    $arrVal = array();
      	$arrVal['attribute'] = $arg['txtTitle'];
		$arrVal['added_by'] = $this->session->userdata('user_id');
      	$sucess = $this->db->insert('game_attribute',$arrVal);
      	if($sucess)
      	{
			$ins_id = $this->db->insert_id(); 
			$this->db->query("call setNextOrder($ins_id,'game_attribute','attr_order')");
          	$objResponse->alert($this->lang->line('msg_insert'));
			$objResponse->script("fnreset()");
          	$objResponse->script("xajax_load()");
      	}
      	return $objResponse;		
	}
	function edit($id,$arg)
	{
		$objResponse=new xajaxResponse();
		$arrVal = array();
		$arrVal['attribute'] = $arg['txtTitle'];
      	$arrVal['added_by'] = $this->session->userdata('user_id');
		$sucess = $this->db->update('game_attribute',$arrVal,array('id'=>$id));
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
		$sucess = $this->db->delete('game_attribute',array('id'=>$id));
		if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_delete'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
		return $objResponse;
	}
	function updateOrder($flg,$atrId)
	{
	    $objResponse=new xajaxResponse();
	    if($flg == "up")
	    {
	        $this->attribute_model->stepUp($atrId);
	    }
	    else
	    {
	        $this->attribute_model->stepDown($atrId);
	    }
	    $objResponse->script("xajax_load()");
	    return $objResponse;
	}
}