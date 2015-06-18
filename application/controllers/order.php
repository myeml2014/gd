<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class order extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('order_model');
		$this->load->model('footer_links_model');
	}
	public function index()
	{
		if($this->order_model->getMyCartCount()==0)
		{
			$this->session->set_flashdata('msg','Cart id Empty.');
			redirect('cart');
		}
		$data = $this->category_model->loadMenu();
		$this->load->view('header/header',$data);
		unset($data);
		if($this->session->userdata('UserID'))
		{
			$data = array();
			$data = $this->order_model->getPremenentAdd($this->session->userdata('UserID'));
			$data['other_add'] = $this->order_model->getOtherAdd($this->session->userdata('UserID'));
			$this->load->view('order/shippingaddress',$data);
			unset($data);
		}
		else
		{
			$this->load->view('login',array('is_order'=>'order'));
		}
		$data3 = $this->footer_links_model->getAllFooterLinks();
		$this->load->view('header/footer',$data3);
		unset($data3);
	}
}