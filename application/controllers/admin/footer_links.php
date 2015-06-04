<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class footer_links extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		$this->load->model('footer_links_model');
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
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/footer_links/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('setForm',&$this,'setForm'));
		$this->xajax->register(XAJAX_FUNCTION, array('save',&$this,'save'));
		$this->xajax->register(XAJAX_FUNCTION, array('edit',&$this,'edit'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete',&$this,'delete'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
                
      	$headerData['onload'] = true; 
		$headerData['addTinymce'] = true;
		$headerData['module_js'] = $modulePathUrl.'footer_links.js';
		$this->load->view('admin/header/header',$headerData);
		$this->load->view('admin/footer_links/footer_links',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."footer_links/";
		$this->load->view('admin/header/footer',$footerData);	
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$data = $this->footer_links_model->get_all($start,$whArr);
		$objResponse->script('renderJson('.json_encode($data).','.$this->footer_links_model->get_all_count($whArr).')');
		return $objResponse;
	}
	function setForm($id)
	{
		$objResponse=new xajaxResponse();
		$data = $this->footer_links_model->get_record($id);
		$objResponse->assign("txtTitle","value",$data->link_title);
		$objResponse->assign("txtOther","value",$data->content);
		$objResponse->script("setTinyMceVal(".json_encode($data->content).")");
		return $objResponse;
	}
	function save($arg)
	{
		$objResponse=new xajaxResponse();
		if($this->footer_links_model->checkIsExists($arg['txtTitle']))
		{
		    return $objResponse->alert($this->lang->line('msg_exist'));
		}
	    $arrVal = array();
      	$arrVal['link_title'] = $arg['txtTitle'];
	    $arrVal['content'] = $arg['txtOther'];
		$lnk_nm = str_replace("/","_",$arg['txtTitle']);
		$lnk_nm = str_replace(" ","_",$lnk_nm);
		$lnk_nm = strtolower($lnk_nm);
		$lnk_nm = str_replace("&","and",$lnk_nm);
		$arrVal['index_key'] = $lnk_nm;
		$arrVal['added_by'] = $this->session->userdata('user_id');
      	$sucess = $this->db->insert('game_footer_links',$arrVal);
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
		$arrVal = array();
		if($this->footer_links_model->checkIsExists($arg['txtTitle'],$id))
		{
		    return $objResponse->alert($this->lang->line('msg_exist'));
		}
		$arrVal['link_title'] = $arg['txtTitle'];
      	$arrVal['content'] = $arg['txtOther'];
		$lnk_nm = str_replace("/","_",$arg['txtTitle']);
		$lnk_nm = str_replace(" ","_",$lnk_nm);
		$lnk_nm = strtolower($lnk_nm);
		$lnk_nm = str_replace("&","and",$lnk_nm);
		$arrVal['index_key'] = $lnk_nm;
		$arrVal['added_by'] = $this->session->userdata('user_id');
      	$sucess = $this->db->update('game_footer_links',$arrVal,array('id'=>$id));
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
		$sucess = $this->db->delete('game_footer_links',array('id'=>$id));
		if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_delete'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
		return $objResponse;
	}
}