<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class orders extends CI_Controller {
	var $filter = '';
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		$this->load->model('order_model');		
		if(!$this->Adminuser->is_login())
		{
			redirect('admin/login');
		}
	}
	public function index($page = '')
	{
		$this->filter = $page;
		$headerData = array();
		$footerData = array();
		$data = array();
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/order/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		
      	$headerData['onload'] = true; 
		$headerData['addTinymce'] = false;
		$headerData['module_js'] = $modulePathUrl.'order.js';
		$this->load->view('admin/header/header',$headerData);
		$data['page'] = $page;
		$this->load->view('admin/order/order',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."order/";
		$this->load->view('admin/header/footer',$footerData);
		unset($data);
		unset($footerData);
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$fixCondition = '';
		if($this->filter == 'pending')
		$fixCondition = ' AND order_status = 0';
		else if($this->filter == 'confirm')
		$fixCondition = ' AND order_status = 1';
		else if($this->filter == 'processing')
		$fixCondition = ' AND order_status = 2';
		else if($this->filter == 'qc')
		$fixCondition = ' AND order_status = 3';
		else if($this->filter == 'dispatched')
		$fixCondition = ' AND order_status = 4';
		else if($this->filter == 'delivered')
		$fixCondition = ' AND order_status = 5';
		else if($this->filter == 'archive')
		$fixCondition = ' AND order_status = 6';
		else
		$fixCondition = ' AND order_status != 6';
	
		$data = $this->order_model->get_all($start,$whArr,$fixCondition);
		$objResponse->script('renderJson('.json_encode($data).','.$this->order_model->get_all_count($whArr,$fixCondition).')');	
		return $objResponse;
	}
	function detail($orderId,$from)
	{
		$data = array();
		$data = $this->order_model->getOrderDetail($orderId);
		$data['from'] = $from;
		$data['orderId'] = $orderId;
		$this->load->view('admin/order/form',$data);
		unset($data);
	}
	function changestatus($orderId,$from)
	{
		if($this->input->post("btnSubmit") && $this->input->post("selStatus") != '')
		{
			$this->db->update('game_order',array('order_status'=>$this->input->post("selStatus")),array('id'=>$orderId));
		}
		redirect(BASE_URL."admin/orders/detail/$orderId/$from");
	}
}