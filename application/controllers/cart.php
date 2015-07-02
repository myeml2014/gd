<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cart extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->model('cart_model');
		$this->load->model('footer_links_model');
		$this->load->model('category_model');
	}
	public function index($bakUrl = '')
	{
		$this->clearOldData();
		$data = $this->category_model->loadMenu();
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('removeFromCart',&$this,'removeFromCart'));
		$this->xajax->register(XAJAX_FUNCTION, array('editQuentity',&$this,'editQuentity'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$data['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		$data['onload'] = true; 
		$this->load->view('header/header',$data);
		unset($data);
		$data = array();
		$data['cart'] = $this->cart_model->getMyCart();
		$data['bakUrl'] = $bakUrl;
		$this->load->view('cart',$data);
		$data = $this->footer_links_model->getAllFooterLinks();
		$this->load->view('header/footer',$data);
		unset($data);
	}
	function load()
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$data = $this->cart_model->getMyCart();
		$objResponse->script('renderJson('.json_encode($data).')');
		return $objResponse;
	}
	function removeFromCart($pId,$bakUrl)
	{
		$objResponse=new xajaxResponse();
		if($this->session->userdata('UserID'))
			$u_id = $this->session->userdata('UserID');
		else
		$u_id = '';
		$this->db->query('delete from game_cart where p_id = ? and (sess_id = ? OR u_id = ?)',array($pId,session_id(),$u_id));
		$objResponse->script('xajax_load()');
		return $objResponse;
	}
	function editQuentity($q,$pId,$bakUrl)
	{
		$objResponse=new xajaxResponse();
		if($q == '-1')
		{
			$id = $this->cart_model->getIdFromPid($pId);
			if($id != '')
			{
				$this->db->query('delete from game_cart where id='.$id);
			}
		}
		else if($q == '1')
		{
			$this->cart_model->addQuentity($pId);
		}
		$objResponse->script('xajax_load();');
		return $objResponse;
	}
	function clearOldData()
	{
		$dt = date('Y').'-'.date('m').'-'.(date('d')-1);
		$this->db->delete("game_cart","datetime < '$dt' and u_id = 0");
	}
}