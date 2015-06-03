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
		$this->getCatId($page);
		$data = $this->category_model->loadMenu();
		if(!isset($this->parentId))
		{
			redirect(BASE_URL);
			exit;
		}
		$cat_id = $this->catId;
		$data2 = $this->category_model->getMetaData($cat_id);
		$data['meta_keywords'] = $data2[0]->meta_keywords;
		$data['meta_description'] = $data2[0]->meta_description;
		$this->load->view('header/header',$data);
		unset($data);
		unset($data2);
		
		$data = $this->category_model->getAllSubcategoryAll();
		$data['parentId'] = $this->parentId;
		$data['page'] = $page;
		if($this->parentId != 0)
		{
			$data['product'] = $this->category_model->getAllProductAll($this->catId);
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
}