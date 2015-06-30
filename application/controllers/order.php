<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class order extends CI_Controller {	
	function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('order_model');
		$this->load->model('cart_model');
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
		$this->xajax->register(XAJAX_FUNCTION, array('getState',&$this,'getState'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$data['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
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
	function getState($countryId)
	{
		$objResponse=new xajaxResponse();
		$str = '';
		$str .= '<select name="state" id="state" class="text_field3" required>';
		$str .= '<option value="">-Select-</option>';
		$q = $this->db->get_where('game_state',array('country_id'=>$countryId));
		foreach($q->result() as $row){
			$str .= '<option value="'.$row->id.'">'.$row->state_nm.'</option>';
		}
		$str .= '</select>';
		$objResponse->assign("divState","innerHTML",$str);
		return $objResponse;
	}
	function shipping()
	{
		if($this->input->post('btnSubmit'))
		{
			if($this->input->post('rdoadd') == "-1")
			{
				$this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
				$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
				$this->form_validation->set_rules('add1', 'Address 1', 'trim|required|xss_clean');
				$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
				$this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');
				if($this->form_validation->run())
				{
					$arrVal = array();
					$arrVal['user_id'] = $this->session->userdata('UserID');
					$arrVal['country_id'] = $this->input->post('country');
					$arrVal['state_id'] = $this->input->post('state');
					$arrVal['add1'] = $this->input->post('add1');
					$arrVal['add2'] = $this->input->post('add2');
					$arrVal['add3'] = $this->input->post('add3');
					$arrVal['city'] = $this->input->post('city');
					$arrVal['zip'] = $this->input->post('zip');
					$this->db->insert('game_address',$arrVal);
					unset($arrVal);
					$addressId = $this->db->insert_id();
				}
				else{
					redirect('order');
				}
			}
			else
			{
				$addressId = $this->input->post('rdoadd');
			}
			$data = $this->cart_model->getMyCart();
			foreach($data as $v)
			{
				$arrVal = array();
				$arrVal['u_id'] = $this->session->userdata('UserID');
				$arrVal['p_id'] = $v->p_id;
				$arrVal['p_qty'] = $v->cnt;
				$arrVal['order_amount'] = $v->p_total;
				$arrVal['payment_status'] = 0;
				$arrVal['order_status'] = 0;
				$arrVal['order_date'] = date("Y-m-d H:i:s");
				$arrVal['address_id'] = 0;
				$this->db->insert('game_order',$arrVal);
				unset($data);
			}
			$this->db->query('delete from game_cart where u_id = ?',array($this->session->userdata('UserID')));
			redirect('order/payment');
		}
	}
	function payment()
	{
		echo "Here";exit;
	}
}