<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class home extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('topflesh');
		$this->load->model('footer_links_model');
	}
	public function index()
	{
		$data = $this->category_model->loadMenu();
		$data['is_banner'] = true;
		$data['bannerArr'] = $this->topflesh->getAllBanners();
		$this->load->view('header/header',$data);
		$data2 = $this->category_model->getAllCategory();
		$this->load->view('home',$data2);
		$data3 = $this->footer_links_model->getAllFooterLinks();
		$this->load->view('header/footer',$data3);
	}
}