<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class sub_category extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		$this->load->model('category_model');
		if(!$this->Adminuser->is_login())
		{
			redirect('admin/login');
		}
	}
	public function index()
	{
		$headerData = array();
		$footerData = array();
		$data = array();
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/sub_category/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('setForm',&$this,'setForm'));
		$this->xajax->register(XAJAX_FUNCTION, array('save',&$this,'save'));
		$this->xajax->register(XAJAX_FUNCTION, array('edit',&$this,'edit'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete',&$this,'delete'));
		$this->xajax->register(XAJAX_FUNCTION, array('updateOrder',&$this,'updateOrder'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		
      	$headerData['onload'] = true; 
		$headerData['addTinymce'] = false;
		$headerData['module_js'] = $modulePathUrl.'sub_category.js';
		$this->load->view('admin/header/header',$headerData);
		$this->load->view('admin/sub_category/sub_category',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."sub_category/";
		$this->load->view('admin/header/footer',$footerData);	
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$data = $this->category_model->get_all_sub_category($start,$whArr);
		$objResponse->script('renderJson('.json_encode($data).','.$this->category_model->get_all_sub_category_count($whArr).')');
		return $objResponse;
	}
	function setForm($id)
	{
		$objResponse=new xajaxResponse();
		$data = $this->category_model->get_record($id);
		$objResponse->assign("txtSubCatNm","value",$data->cat_name);
		$objResponse->assign("selCat","value",$data->parent_id);
		$objResponse->assign("txtCatDesc","value",$data->cat_desc);
		$objResponse->assign("txtMetaKeyword","value",$data->cat_meta_keywork);
		$objResponse->assign("txtMetaDesc","value",$data->cat_meta_desc);
		$objResponse->assign("selStatus","value",$data->is_active);
		$objResponse->assign("tmpCatImg","src",BASE_URL.'images/cat_imgs/'.$data->cat_image);
		return $objResponse;
	}
	function save($arg)
	{
		$objResponse=new xajaxResponse();
		if($this->category_model->checkIsExists($arg['txtSubCatNm']))
		{
		    return $objResponse->alert($this->lang->line('msg_exist'));
		}
     	$arrVal = array();
		$arrVal['cat_name'] = $arg['txtSubCatNm'];
		$arrVal['parent_id'] = $arg['selCat'];
		$arrVal['cat_desc'] = $arg['txtCatDesc'];
		$arrVal['cat_meta_keywork'] = $arg['txtMetaKeyword'];
		$arrVal['cat_meta_desc'] = $arg['txtMetaDesc'];
		$arrVal['is_active'] = $arg['selStatus'];
		$lnk_nm = str_replace("/","_",$arg['txtSubCatNm']);
		$lnk_nm = str_replace(" ","_",$lnk_nm);
		$lnk_nm = strtolower($lnk_nm);
		$lnk_nm = str_replace("&","and",$lnk_nm);
		$arrVal['index_key'] = $lnk_nm;
		$arrVal['added_by'] = $this->session->userdata('user_id');
        $sucess = $this->db->insert('game_category',$arrVal);
        
        if($sucess)
        {
          $ins_id = $this->db->insert_id(); 
          $this->db->query("call setNextOrder($ins_id,'game_category','cat_order')");
          $objResponse->alert($this->lang->line('msg_insert'));
          if(isset($arg['CatImg']) && $arg['CatImg'] != "")
          {
                $objResponse->script("postFrm($ins_id)");
          }
          else 
          {
            $objResponse->script("fnreset()");
            $objResponse->script("xajax_load()");
          }
        }
        return $objResponse;		
	}
	function edit($id,$arg)
	{
		$objResponse=new xajaxResponse();
		if($this->category_model->checkIsExists($arg['txtSubCatNm'],$id))
		{
		    return $objResponse->alert($this->lang->line('msg_exist'));
		}
		$arrVal = array();
		$arrVal['cat_name'] = $arg['txtSubCatNm'];
		$arrVal['parent_id'] = $arg['selCat'];
		$arrVal['cat_desc'] = $arg['txtCatDesc'];
		$arrVal['cat_meta_keywork'] = $arg['txtMetaKeyword'];
		$arrVal['cat_meta_desc'] = $arg['txtMetaDesc'];
		$arrVal['is_active'] = $arg['selStatus'];
		$lnk_nm = str_replace("/","_",$arg['txtSubCatNm']);
		$lnk_nm = str_replace(" ","_",$lnk_nm);
		$lnk_nm = strtolower($lnk_nm);
		$lnk_nm = str_replace("&","and",$lnk_nm);
		$arrVal['index_key'] = $lnk_nm;
		$arrVal['added_by'] = $this->session->userdata('user_id');
        $sucess = $this->db->update('game_category',$arrVal,array('id'=>$id));
       
        if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_update'));
         if(isset($arg['CatImg']) && $arg['CatImg'] != "")
          {
                $objResponse->script("postFrm($id)");
          }
          else 
          {
            $objResponse->script("fnreset()");
            $objResponse->script("xajax_load()");
          }
        }
        return $objResponse;
	}
	function delete($id)
	{
		$objResponse=new xajaxResponse();
		$sucess = $this->db->delete('game_category',array('id'=>$id));
		if($sucess)
        {
            $objResponse->alert($this->lang->line('msg_delete'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
		return $objResponse;
	}
	function postFrm($catId)
	{
	    $config['upload_path'] = IMAGE_PATH.'cat_imgs';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']	= '10240';
	    $config['max_width']  = '4000';
	    $config['max_height']  = '4000';
		$config['req_height']  = '640';
		$config['req_width']  = '640';
	    $config['userDefFn']  = $catId;
	    $this->load->library('upload', $config);
        $this->upload->do_upload('CatImg');
        $upArr = $this->upload->data();
        $this->category_model->updateImage( $upArr['file_name'],$catId);
        redirect(BASE_URL."admin/sub_category");
	}
	function updateOrder($flg,$catId)
	{
	    $objResponse=new xajaxResponse();
	    if($flg == "up")
	    {
	        $this->category_model->stepUp($catId);
	    }
	    else
	    {
	        $this->category_model->stepDown($catId);
	    }
	    $objResponse->script("xajax_load()");
	    return $objResponse;
	}
}