<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class top_flesh extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		$this->load->model('topflesh');
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
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/top_flesh/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('setForm',&$this,'setForm'));
		$this->xajax->register(XAJAX_FUNCTION, array('save',&$this,'save'));
		$this->xajax->register(XAJAX_FUNCTION, array('edit',&$this,'edit'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete',&$this,'delete'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
                
      	$headerData['onload'] = true; 
		$headerData['module_js'] = $modulePathUrl.'top_flesh.js';
		$this->load->view('admin/header/header',$headerData);
		$this->load->view('admin/top_flesh/top_flesh',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."top_flesh/";
		$this->load->view('admin/header/footer',$footerData);	
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$data = $this->topflesh->get_all($start,$whArr);
		$objResponse->script('renderJson('.json_encode($data).','.$this->topflesh->get_all_count($whArr).')');
		return $objResponse;
	}
	function setForm($id)
	{
		$objResponse=new xajaxResponse();
		$data = $this->topflesh->get_record($id);
		$objResponse->assign("txtTitle","value",$data->title);
		$objResponse->assign("imgImg","src",BASE_URL."images/top_flesh/".$data->link);
		$objResponse->assign("txtOther","value",$data->detail);
		return $objResponse;
	}
	function save($arg)
	{
		$objResponse=new xajaxResponse();
	    $arrVal = array();
      	$arrVal['title'] = $arg['txtTitle'];
	    $arrVal['detail'] = $arg['txtOther'];
		$arrVal['added_by'] = $this->session->userdata('user_id');
      	$sucess = $this->db->insert('tbl_top_flesh',$arrVal);
      	if($sucess)
      	{
			$ins_id = $this->db->insert_id(); 
          	$objResponse->alert($this->lang->line('msg_insert'));
          	if($arg['fImg']!="")
			{
				$objResponse->script("postFrm($ins_id)");
			}
			else
			{
          		$objResponse->script("fnreset()");
          		$objResponse->script("xajax_load()");
			}
      	}
      return $objResponse;		
	}
	function edit($id,$arg)
	{
		$objResponse=new xajaxResponse();
		$arrVal = array();
		$arrVal['title'] = $arg['txtTitle'];
      	$arrVal['detail'] = $arg['txtOther'];
		$arrVal['added_by'] = $this->session->userdata('user_id');
      	$sucess = $this->db->update('tbl_top_flesh',$arrVal,array('id'=>$id));
      	if($sucess)
      	{
        	$objResponse->alert($this->lang->line('msg_update'));
          	if($arg['fImg']!="")
			{
				$objResponse->script("postFrm($id)");
			}
			else
			{
          		$objResponse->script("fnreset()");
		    	$objResponse->script("xajax_load()");
			}
      	}
      return $objResponse;
	}
	function delete($id)
	{
		$objResponse=new xajaxResponse();
		$sucess = $this->db->delete('tbl_top_flesh',array('id'=>$id));
		if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_delete'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
		return $objResponse;
	}
	function postFrm($id)
	{
		$config['max_size']	= '10240';
		$config['max_width']  = '4000';
	    $config['max_height']  = '4000';
		$config['req_height']  = '550';
		$config['req_width']  = '1300';
		$config['upload_path'] = IMAGE_PATH.'top_flesh';
	    $config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$this->upload->do_upload('fImg');
		$upArr = $this->upload->data();
        $this->topflesh->updateImage( $upArr['file_name'],$id);
        redirect(BASE_URL."admin/top_flesh");
	}
}