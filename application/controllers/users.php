<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('category_model');
		$this->load->model('footer_links_model');
	}

	public function index()
	{
		if($this->session->userdata('MemberID')!=''){
			redirect('home');
		}else{
			$data = $this->category_model->loadMenu();
			$this->load->view('header/header',$data);
			$this->load->view('login');
			$data3 = $this->footer_links_model->getAllFooterLinks();
			$this->load->view('header/footer',$data3);
		}
	}

	public function signup($is_order = '')
	{
		if($this->input->post('btnSubmit'))
		{
			$this->form_validation->set_rules('fname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'callback_username_check');
			$this->form_validation->set_rules('hdnTime', 'Not Human', 'callback_chkSubmitTime');
			if($this->form_validation->run())
			{
				$arrVal = array();
				$arrVal['email'] = $this->input->post('email');
				$arrVal['password'] = md5($this->input->post('pass'));
				$arrVal['fname'] = $this->input->post('fname');
				$arrVal['lname'] = $this->input->post('lname');
				$arrVal['address1'] = $this->input->post('add1');
				$arrVal['address2'] = $this->input->post('add2');
				$arrVal['address3'] = $this->input->post('add3');
				$arrVal['city'] = $this->input->post('city');
				$arrVal['country_id'] = $this->input->post('country');
				$arrVal['state_id'] = $this->input->post('state');
				if($this->input->post('year') != '' && $this->input->post('month') != '' && $this->input->post('day') != '')
				$arrVal['child_birth_date'] = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
				$arrVal['gender'] = $this->input->post('gender');
				$arrVal['zip'] = $this->input->post('zip');
				$catArr = $this->input->post('cats');
				$arrVal['cat_ids'] = implode(",",$catArr);
				$sucess = $this->db->insert('game_user',$arrVal);
				$ins_id = $this->db->insert_id();
				$this->sendEmail($ins_id,$this->input->post('email'),$this->input->post('fname'),$this->input->post('lname'));
				if($this->input->post('hdnIsOrder') == 'order')
				{
					$array=array('UserID'=>$ins_id,'UserEmail'=>$this->input->post('email'),'full_name'=>$this->input->post('fname').' '.$this->input->post('lname'));
					$this->session->set_userdata($array);
					$this->users_model->setCart($ins_id);
					redirect('order');
					unset($array);
				}
				else
				redirect('users');
				exit;
			}
			else
			{
				redirect('users/signup'.(isset($is_order))?'/'.$is_order:'');
			}
		}
		$data = $this->category_model->loadMenu();
		$data['main_content']='signup';

		$this->xajax->register(XAJAX_FUNCTION, array('getState',&$this,'getState'));
		$this->xajax->register(XAJAX_FUNCTION, array('emailExists',&$this,'emailExists'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$data['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		$data1 = $this->footer_links_model->getAllFooterLinks();
		$data['id'] = $data1['id'];
		$data['link_title']= $data1['link_title'];
		$data['index_key']= $data1['index_key'];
		$data['is_order'] = $is_order;
		$this->load->view('header/template',$data);
		unset($data);
		unset($data1);
	}
	function username_check($val)
	{
		if($this->users_model->email_check($val))
		{
			$this->form_validation->set_message('username_check', 'Email ALready Exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	function chkSubmitTime($val)
	{
		$diff = time() - $val;
		if($diff<10)
		{
			$this->form_validation->set_message('chkSubmitTime', 'From is not fill by human.');
			return false;
		}
		else
		{
			return true;
		}
	}
	function emailExists($val)
	{
		$objResponse=new xajaxResponse();
		if($this->users_model->email_check($val))
		$objResponse->assign('spEmail','innerHTML','Email Already Exists.');
		else
		$objResponse->assign('spEmail','innerHTML','');
		return $objResponse;
	}
	public function login()
	{
		$this->form_validation->set_rules('email','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<em>','</em>');
		if($this->input->post('ksubmit'))
		{
			if($this->form_validation->run())
			{
				$email=trim($this->input->post('email'));
				$password=trim($this->input->post('password'));
				$this ->db->select('id, email, password,fname,lname');
				$this ->db->from('game_user');
				$this ->db->where('email	= '."'".$email."'");
				$this ->db->where('password = '."'".md5($password)."'");
				$this ->db->where('status',1);
				$this ->db->limit(1);
				$query = $this->db->get();
				$result=$query->_fetch_assoc();
				if($query->num_rows()==1)
				{
					$array=array('UserID'=>$result['id'],'UserEmail'=>$result['email'],'full_name'=>$result['fname'].' '.$result['lname']);
					$this->session->set_userdata($array);
					$this->users_model->setCart($result['id']);
					if($this->input->post('hdnIsOrder') == 'order')
					redirect('order');
					else
					redirect('home');
				}else{
					$this->session->set_flashdata('message','User does not exits for this email.');
					if($this->input->post('hdnIsOrder') == 'order')
					redirect('order');
					else
					redirect('users');
				}
			}
			else
			{
				$this->session->set_flashdata('message','Please check your email or password..');
				redirect('users');
			}
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('UserID');
		$this->session->sess_destroy();
		redirect(BASE_URL.'users');
	}
	public function sendEmail($id,$email,$fname,$lname)
	{
		$code = rand(10000000,99999999);
		$this->db->update('game_user',array('verifycode'=>$code),array('id'=>$id));
		$this->load->library('email');
		$this->email->clear();
		$config['mailtype'] = "html";
		$this->email->initialize($config);
		$this->email->from('myeml2014@outlook.com','Admin@gameday');
		$this->email->to($email);
		/*
		$getAllTemp=$this->load->model('admin/email_template_model');
		$getAllTemp->setId('4');
		$result = $getAllTemp->getAllEmail();
		*/
		$this->email->subject('Verify Email Address From Gameday');
		$msg = '<!DOCTYPE html>';
		$msg .= '<html>';
		$msg .= '<head>';
		$msg .= '<title>:: Welcome to Gameday Novelties ::</title>';
		$msg .= '</head>';
		$msg .= '<body>';
		$msg .= '<p>Hi '.$fname.' '.$lname.'</p>';
		$msg .= '<p>Please click on below link for verify your email address.</p>';
		$msg .= '<p><a href="'.BASE_URL.'users/verify/'.$code.'">'.BASE_URL.'users/verify/'.$code.'</a></p>';
		$msg .= '<p>Thanks.</p>';
		$msg .= '</body>';
		$msg .= '</html>';
		$this->email->message($msg);
		$this->email->send();
	}
	function verify($code)
	{
		//remain...
	}
	/*.................................remove below...*/


	public	function forgotpassword()
	{
		if($this->session->userdata('UserID')!=''):
			//redirect('users/forgotpassword');
		endif;
		$data['main_content']='login';
		$data['title']='Admin Forgot Password';
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
		//echo '<pre>';print_r($this->form_validation->run ());die();
		if ($this->form_validation->run () == FALSE) {
			$this->session->set_flashdata('message','Please enter valid email.');
		}
		else
		{
			$usersObj = $this->load->model('admin/welcome_model');
			$usersObj->setUserEmail($this->input->post('email'));
			$checkResult = $usersObj->checkMailExist();
			//echo '<pre>';print_r($checkResult);die();
			if($checkResult == false){
				$this->session->set_flashdata('message',' User does not exits for this email.');
			}else {
					/////////// Send mail to register user here//////////
				/* Start Email Send Code  */
				$this->email->clear();
				$config['mailtype'] = "html";
				$this->email->initialize($config);

				/*$thisDomain = str_replace('www.', '', $_SERVER['HTTP_HOST']);
				$this->email->from('noreply@'.$thisDomain);*/

				$thisDomain = "membersupport@gameday.com";
				$this->email->from($thisDomain);
				$this->email->to($this->input->post('email'));
				$mesage =(trim($checkResult['userId'])).'||'.trim(($checkResult['UserName']));

				$stringMessage = trim(str_replace('==', '', base64_encode($mesage)));
				$getAllTemp=$this->load->model('admin/email_template_model');
				$getAllTemp->setId('4');
				$result = $getAllTemp->getAllEmail();

				$this->email->subject($result['subject_en']);

				$search=array("[FIRSTNAME]","[BASEURL]","[STRINGMESSAGE]");
				$replace=array(ucfirst($checkResult['first_name']),$this->config->base_url(),$stringMessage);
				$message=str_replace($search,$replace,strip_tags($result['body_en'],'<br><a><p><br />'));
				//echo $message;die;

				$this->email->message($message);
				$this->email->send();
				//echo $this->email->print_debugger();die();
				$this->session->set_flashdata('message','Please check you mail  for password.');
				/* End Email Send Code */
				redirect('users/forgotpassword');
			}
		}
		$this->load->view('header/template',$data);
	}

	public function emailCheck()
	{
		$this->load->model('admin/welcome_model');
		$email=$_POST['email'];
		if($_POST['act']='emailcheck' && $email!=''){
			$result=$this->welcome_model->email_check($email);

			if($result==true){
				echo "Email already exist in database!";
			}else{
				echo "";
			}
		}else{
			echo false;
		}
	}

	public function dashboard()
	{
		//echo '<pre>';print_r($this->session->userdata);die();
		if($this->session->userdata('UserID')==''){
			redirect('admin/welcome');
		}elseif($this->session->userdata('UserID')!=''&&$this->session->userdata('userType')=='1'){
			$data['main_content']='home';
		}else{
			$data['main_content']='home';
		}
		$data['title']='Admin Dashboard';
		$this->load->view('admin/includes/template',$data);
	}

	public function resetPassword()
	{
		if($this->session->userdata('UserID')!=''):
			redirect('admin/index/resetPassword');
		endif;
			$data['main_content']='admin_index';
			$data['title']='Change Password';
			$originalString =  base64_decode($this->input->post('emailid'));
			$userDetails = explode('||',$originalString);
			//echo '<pre>';print_r($userDetails);die();
			if(!$this->session->userdata('f_UserID')){
				$this->session->set_userdata('f_UserID',$userDetails[0]);
			}

			//$userId  = $userDetails[0];
			$this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cnfrmnewpassword', 'Confirm New Password', 'trim|required|xss_clean|matches[newpassword]');

			if ($this->form_validation->run () == FALSE) {
			}
			else {
				$userObj = $this->load->model('admin/welcome_model');
				$userObj->setId($userDetails[0]);
				$userObj->setNewpassword($this->input->post('newpassword'));
				$userCheck=$userObj->checkuserIdExisit();
				if($userCheck=="true"){
					$msgchange=$userObj->resetuserPassword();
					if($msgchange=="true") {
						$this->session->set_flashdata('message','Your password reset successfully!');
						redirect('admin/welcome/');
					}else {
						$this->session->set_flashdata('message','Password does not match!');
					}
				}else {
					$this->session->set_flashdata('message','User Do not exist!');
				}
			}
		$this->load->view('admin/includes/template',$data);
	}

	public function register()
	{
		$this->load->library('email');
		$data = $this->category_model->loadMenu();
		$data['main_content']='signup';

		$this->form_validation->set_rules('txtFname', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtLname', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('txtPassword', 'New Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txtRePassword', 'Confirm New Password', 'trim|required|xss_clean|matches[txtPassword]');
		//$this->form_validation->set_rules('selCountry', 'Country', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<em>','</em>');

		if($this->input->post('ksubmit'))
		{

			if (!$this->form_validation->run ())
			{
				$data['txtFname']=$this->input->post('txtFname');
				$data['txtLname']=$this->input->post('txtLname');
				$data['txtEmail']=$this->input->post('txtEmail');
				$data['txtPassword']=$this->input->post('txtPassword');
				$data['txtRePassword']=$this->input->post('txtRePassword');
				//$data['selCountry']=$this->input->post('selCountry');
			}
			else
			{
				$checkResult = $this->users_model->checkMailExist($this->input->post('txtEmail'));
				$checkResult = false;
				//echo '<pre>';print_r($checkResult);die();
				if($checkResult==false)
				{
					$verifycode = generate_code();
					$txtFname=$this->input->post('txtFname');
					$txtMname=$this->input->post('txtMname');
					$txtLname=$this->input->post('txtLname');
					$txtEmail=$this->input->post('txtEmail');
					$txtPassword=$this->input->post('txtPassword');
					$txtRePassword=$this->input->post('txtRePassword');
					$addr1=$this->input->post('addr1');
					$addr2=$this->input->post('addr2');
					$selCountry=$this->input->post('selCountry');
					$txtDOB=$this->input->post('txtDOB');
					$txtCBD=$this->input->post('txtCBD');
					$gender=$this->input->post('gender');

					if($txtPassword==$txtRePassword)
					{
						$insdata=array('email'=>$txtEmail,
						'password'=>md5($txtPassword),
						'confirm_password'=>md5($txtRePassword),
						'first_name'=>$txtFname,
						'middle_name'=>$txtPassword,
						'last_name'=>$txtLname,
						'address1'=>$addr1,
						'address2'=>$addr2,
						'country_id'=>$selCountry,
						'birth_date'=>$txtDOB,
						'child_birth_date'=>$txtCBD,
						'gender'=>$gender,
						'status'=>1,
						'verifycode'=>$verifycode
						);
						$msgchange = $this->db->insert('game_user',$insdata);
						$ins_id = $this->db->insert_id();
						if($ins_id)
						{
							$chkCat=$this->input->post('chkCat');
							foreach($chkCat as $cat)
							{
								$data = array();
								$data['user_id'] = $ins_id;
								$data['category_id'] = $cat;
								$msgchange = $this->db->insert('game_user_interest',$data);
							}
						}

							if($msgchange==true)
							{
								$this->email->clear();
								$config['mailtype'] = "html";
								$this->email->initialize($config);
								$thisDomain = "membersupport@gameday.com";
								$this->email->from($thisDomain);
								$this->email->to($this->input->post('txtEmail'));
								$this->email->subject($txtFname.' '.$txtLname.' have been registered successfully!');
								$message="Hi ".$txtFname." , <br><br> Your account will be activated with in 24 hours! <br></br> Sincerely,\n\n<br>GameDay Team";
								$this->email->message($message);
								$this->email->send();

								$this->session->set_flashdata('message','You have registered successfully. Please verify email address.');
								redirect('users/home');
							}
							else{
								$this->session->set_flashdata('message','You are  not registered!');
								redirect('users/register');
							}
					}
					else
					{
						$this->session->set_flashdata('message','password does not match!');
						redirect('users/register');
					}
				}
				else
				{
					$this->session->set_flashdata('message','Entered email has been already registered with us!');
					redirect('users/register');
				}
			}
		}
		$data1 = $this->footer_links_model->getAllFooterLinks();
		$data['id'] = $data1['id'];
		$data['link_title']= $data1['link_title'];
		$data['index_key']= $data1['index_key'];

		$this->load->model('country_model');
		//$data['country'] = $this->country_model->get_all();

		$this->load->view('header/template',$data);
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
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
