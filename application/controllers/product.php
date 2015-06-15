<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class product extends CI_Controller {	
	public $productId;
	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('footer_links_model');
	}
	public function index($page='')
	{
		$data = array();
		$this->productId = $this->getProductId($page);
		if(!isset($this->productId))
		{
			redirect(BASE_URL);
			exit;
		}

		$data = $this->category_model->loadMenu();
		$this->xajax->register(XAJAX_FUNCTION, array('addToCart',&$this,'addToCart'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$data['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		$data2 = $this->category_model->getMetaData($this->productId);
		$data['meta_keywords'] = $data2['meta_keywords'];
		$data['meta_description'] = $data2['meta_description'];
		$data['zoomJs'] = true;
		$this->load->view('header/header',$data);
		unset($data);
		unset($data2);
		$data = $this->product_model->getProductDetail($this->productId);
		$data['attribute'] = $this->category_model->getAllAttribute();
		$this->load->view('product/product',$data);
		unset($data);
		$data = $this->footer_links_model->getAllFooterLinks();
		$this->load->view('header/footer',$data);
		unset($data);
	}
	function getProductId($page)
	{
		$query = $this->db->get_where('game_product', array('index_key' => $page), 1);
		$row = $query->result();
		return $row[0]->id;
	}
	function addToCart($pId,$price)
	{
		$objResponse=new xajaxResponse();
		$arrVal = array();
		$arrVal['p_id'] = $pId;
		$arrVal['sess_id'] = session_id();
		$arrVal['quentity'] = 1;
		$arrVal['price'] = $price;
		if($this->session->userdata('UserID'))
		{
			$arrVal['u_id'] = $this->session->userdata('UserID');
		}
		
		$sucess = $this->db->insert('game_cart',$arrVal);
		if($sucess)
		{
			$objResponse->script('goTocart("'.str_replace("/","slesh",$this->uri->uri_string).'")');
		}
		return $objResponse;
	}
}