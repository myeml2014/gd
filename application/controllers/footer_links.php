<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class footer_links extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->model('footer_links_model');
		$this->load->model('category_model');               // for load main menu.
	}
	public function index($page)
	{
		$data = $this->category_model->loadMenu();
		$this->load->view('header/header',$data);
		$data2['content'] = $this->footer_links_model->getFooterContent($page);
		$this->load->view('home',$data2);
		$data3 = $this->footer_links_model->getAllFooterLinks();
		$this->load->view('header/footer',$data3);
	}
}