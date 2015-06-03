<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
	}
	public function index()
	{
		if($this->Adminuser->is_login())
		{
			redirect('admin/home');
		}
		$this->load->view('admin/login');
	}
	public function veryfylogin()
	{
		if($this->Adminuser->is_login())
		{
			redirect('admin/home');
		}
		else
		{
			if ($this->login_check() == false)
			{
				$this->load->view('admin/login',array('err'=> $this->lang->line('login_invalid_username_and_password')));
			}
			else
			{
				redirect('admin/home');
			}
		}
		
	}
	function login_check()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");	
		if(!$this->Adminuser->verifyLogin($username,$password))
		{
			return false;
		}
		return true;	
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}
