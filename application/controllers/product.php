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

		$this->xajax->register(XAJAX_FUNCTION, array('addToCart',&$this,'addToCart'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$data['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		
		$data = $this->category_model->loadMenu();
		$data2 = $this->category_model->getMetaData($this->productId);
		$data['meta_keywords'] = $data2['meta_keywords'];
		$data['meta_description'] = $data2['meta_description'];
		$data['zoomJs'] = true;
		$this->load->view('header/header',$data);
		unset($data);
		unset($data2);
		$data = $this->product_model->getProductDetail($this->productId);
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
	function addToCart($pId)
	{
		$objResponse=new xajaxResponse();
		$objResponse->alert("1");
		return $objResponse;
	}
}