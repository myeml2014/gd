<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class category extends CI_Controller {	
	public $catId;
	public $parentId;
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
		if($page != "search")
		{
			$this->getCatId($page);
		}
		$data = $this->category_model->loadMenu();
		if(!isset($this->parentId) && $page != "search")
		{
			redirect(BASE_URL);
			exit;
		}
		
		$this->xajax->register(XAJAX_FUNCTION, array('addToCart',&$this,'addToCart'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$data['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		if($page != "search")
		{
			$data2 = $this->category_model->getMetaData($this->catId);
			$data['meta_keywords'] = $data2['meta_keywords'];
			$data['meta_description'] = $data2['meta_description'];
		}
		$this->load->view('header/header',$data);
		unset($data);
		unset($data2);
		
		$data = $this->category_model->getAllSubcategoryAll();
		$data['parentId'] = $this->parentId;
		$data['page'] = $page;
		if($this->parentId != 0 || $page == "search")
		{
			if($page == "search")
			{
				$data['keyword'] = $this->uri->segment(3);
				$data['product'] = $this->category_model->getAllProductAll("search",$data['keyword']);	
			}
			else
			{
				$data['product'] = $this->category_model->getAllProductAll($this->catId);	
			}
			$data['attribute'] = $this->category_model->getAllAttribute();
		}
		$this->load->view('category/category',$data);
		unset($data);
		$data = $this->footer_links_model->getAllFooterLinks();
		$this->load->view('header/footer',$data);
		unset($data);
	}
	function getCatId($page)
	{
		$q  = $this->db->query('SELECT id,parent_id  FROM  game_category WHERE index_key = ? ',array($page));
		if($q->num_rows()>0)
		{
		   $row = $q->row();
		   $this->catId = $row->id;
		   $this->parentId = $row->parent_id;
		}
	}
	function addToCart($pId,$price)
	{
		$objResponse=new xajaxResponse();
		$arrVal = array();
		$arrVal['p_id'] = $pId;
		$arrVal['sess_id'] = session_id();
		$arrVal['quentity'] = 1;
		$arrVal['price'] = $price;
		if(0)
		{
			$arrVal['u_id'] = $u_id;
		}
		
		$sucess = $this->db->insert('game_cart',$arrVal);
		if($sucess)
		{
			$objResponse->script('goTocart("'.str_replace("/","slesh",$this->uri->uri_string).'")');
		}
		return $objResponse;
	}
}