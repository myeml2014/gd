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
		$this->xajax->register(XAJAX_FUNCTION, array('removeFromCart',&$this,'removeFromCart'));
		$this->xajax->register(XAJAX_FUNCTION, array('editQuentity',&$this,'editQuentity'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$data['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		
		$this->load->view('header/header',$data);
		unset($data);
		$data = array();
		$data['cart'] = $this->cart_model->getMyCart();
		$data['bakUrl'] = $bakUrl;
		$this->load->view('cart',$data);
		$data = $this->footer_links_model->getAllFooterLinks();
		$this->load->view('header/footer',$data);
		unset($data);
		unset($data);
	}
	function removeFromCart($pId,$bakUrl)
	{
		$objResponse=new xajaxResponse();
		$u_id = '';
		$this->db->query('delete from game_cart where p_id = ? and (sess_id = ? OR u_id = ?)',array($pId,session_id(),$u_id));
		$objResponse->script('location.href="'.BASE_URL.'cart/index/'.$bakUrl.'"');
		return $objResponse;
	}
	function editQuentity($q,$pId,$bakUrl)
	{
		$objResponse=new xajaxResponse();
		return $objResponse;
	}
	function clearOldData()
	{
		$dt = date('Y').'-'.date('m').'-'.(date(d)-1);
		$this->db->delete("game_cart","datetime < '$dt' and u_id = 0");
	}
}