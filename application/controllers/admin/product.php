<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Adminuser');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('attribute_model');
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
		$modulePathUrl = BASE_URL.APPPATH.'views/admin/product/';
		$this->xajax->register(XAJAX_FUNCTION, array('load',&$this,'load'));
		$this->xajax->register(XAJAX_FUNCTION, array('setForm',&$this,'setForm'));
		$this->xajax->register(XAJAX_FUNCTION, array('save',&$this,'save'));
		$this->xajax->register(XAJAX_FUNCTION, array('edit',&$this,'edit'));
		$this->xajax->register(XAJAX_FUNCTION, array('delete',&$this,'delete'));
		$this->xajax->register(XAJAX_FUNCTION, array('updateOrder',&$this,'updateOrder'));
		$this->xajax->register(XAJAX_FUNCTION, array('getSubCategory',&$this,'getSubCategory'));
		$this->xajax->register(XAJAX_FUNCTION, array('setFeatureProduct',&$this,'setFeatureProduct'));
		$this->xajax->processRequest();
		$this->xajax->configure('javascript URI',BASE_URL);
		$headerData['xajax_js'] = $this->xajax->getJavascript(BASE_URL);
		
      	$headerData['onload'] = true; 
		$headerData['addTinymce'] = false;
		$headerData['module_js'] = $modulePathUrl.'product.js';
		$this->load->view('admin/header/header',$headerData);
		$this->load->view('admin/product/product',$data);
		$footerData['module_path'] = ADMIN_VIEW_PATH."product/";
		$this->load->view('admin/header/footer',$footerData);	
	}
	function load($start=0,$param='')
	{
		$data = array();
		$objResponse=new xajaxResponse();
		$whArr = array();
		if($param != '')
		$whArr = explode(",",$param);
		$data = $this->product_model->get_all($start,$whArr);
		$objResponse->script('renderJson('.json_encode($data).','.$this->product_model->get_all_count($whArr).')');
		return $objResponse;
	}
	function setForm($id)
	{
		$objResponse=new xajaxResponse();
		$data = $this->product_model->get_record($id);
		$data2 = $this->category_model->get_record($data->cat_id);
		$objResponse->assign("selCat","value",$data2->parent_id);
		$objResponse->assign("spSubCat","innerHTML",$this->getSubCategoryForSetForm($data2->parent_id,$data->cat_id));
		$objResponse->assign("txtPNm","value",$data->p_name);
		$objResponse->assign("txtPDesc","value",$data->p_desc);
		$objResponse->assign("txtMetaKeyword","value",$data->meta_data);
		$objResponse->assign("txtMetaDesc","value",$data->meta_desc);
		$objResponse->assign("selStatus","value",$data->is_active);
		unset($data2);
		unset($data);
		$data = $this->product_model->getAllAttribute($id);
		foreach($data as $val)
		{
			$objResponse->assign("txtA".$val->attr_id,"value",$val->attr_value);
		}
		unset($data);
		$data = $this->product_model->getAllImages($id);
		$j=1;
		foreach($data as $val)
		{
			$objResponse->assign("img_hdn_".$j,"value",$val->img_path);
			$objResponse->assign("tImg_".$j,"src",BASE_URL.'images/p_imgs/'.$id.'/'.$val->img_path);
			$j++;
		}
		return $objResponse;
	}
	function save($arg)
	{
		$objResponse=new xajaxResponse();
		
     	$arrVal = array();
		$arrVal['cat_id'] = $arg['selSubCat'];
		$arrVal['p_name'] = $arg['txtPNm'];
		$arrVal['p_desc'] = $arg['txtPDesc'];
		$arrVal['meta_data'] = $arg['txtMetaKeyword'];
		$arrVal['meta_desc'] = $arg['txtMetaDesc'];
		$arrVal['is_active'] = $arg['selStatus'];
		$arrVal['added_by'] = $this->session->userdata('user_id');
		$lnk_nm = str_replace("/","_",$arg['txtPNm']);
		$lnk_nm = str_replace(" ","_",$lnk_nm);
		$lnk_nm = strtolower($lnk_nm);
		$lnk_nm = str_replace("&","and",$lnk_nm);
		$arrVal['index_key'] = $lnk_nm;
        $sucess = $this->db->insert('game_product',$arrVal);
        
        if($sucess)
        {
          $ins_id = $this->db->insert_id(); 
		  $this->db->query("call setNextOrder($ins_id,'game_product','p_order')");
		  $data = $this->attribute_model->getAllAttribute();
		  foreach($data as $d)
		  {
			$arrAttr = array();
			$arrAttr['attr_id'] = $d->id;
			$arrAttr['product_id'] = $ins_id;
			$arrAttr['attr_value'] = $arg['txtA'.$d->id];
			$arrAttr['added_by'] = $this->session->userdata('user_id');
			$this->db->insert('game_attribute_value',$arrAttr);
		  }
          $objResponse->alert($this->lang->line('msg_insert'));
          if(isset($arg['img_1']) && $arg['img_1'] != "")
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
		$arrVal = array();
		$arrVal['cat_id'] = $arg['selSubCat'];
		$arrVal['p_name'] = $arg['txtPNm'];
		$arrVal['p_desc'] = $arg['txtPDesc'];
		$arrVal['meta_data'] = $arg['txtMetaKeyword'];
		$arrVal['meta_desc'] = $arg['txtMetaDesc'];
		$arrVal['is_active'] = $arg['selStatus'];
		$arrVal['added_by'] = $this->session->userdata('user_id');
		$lnk_nm = str_replace("/","_",$arg['txtPNm']);
		$lnk_nm = str_replace(" ","_",$lnk_nm);
		$lnk_nm = strtolower($lnk_nm);
		$lnk_nm = str_replace("&","and",$lnk_nm);
		$arrVal['index_key'] = $lnk_nm;
        $sucess = $this->db->update('game_product',$arrVal,array('id'=>$id));
       
        if($sucess)
        {
			$this->db->delete('game_attribute_value',array('product_id'=>$id));
			$data = $this->attribute_model->getAllAttribute();
			foreach($data as $d)
			{
				$arrAttr = array();
				$arrAttr['attr_id'] = $d->id;
				$arrAttr['product_id'] = $id;
				$arrAttr['attr_value'] = $arg['txtA'.$d->id];
				$arrAttr['added_by'] = $this->session->userdata('user_id');
				$this->db->insert('game_attribute_value',$arrAttr);
			}
			$objResponse->alert($this->lang->line('msg_update'));
			if((isset($arg['img_1']) && $arg['img_1'] != "") || (isset($arg['img_2']) && $arg['img_2'] != "")  || (isset($arg['img_3']) && $arg['img_3'] != "")  || (isset($arg['img_4']) && $arg['img_4'] != ""))
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
		$sucess = $this->db->delete('game_product',array('id'=>$id));
		if($sucess)
        {
			$this->db->delete('game_attribute_value',array('product_id'=>$id));
			$this->db->delete('game_images',array('p_id'=>$id));
			$this->rrmdir(IMAGE_PATH.'p_imgs/'.$id);
            $objResponse->alert($this->lang->line('msg_delete'));
            $objResponse->script("fnreset()");
		    $objResponse->script("xajax_load()");
        }
		return $objResponse;
	}
	function postFrm($pId)
	{
	    $config['upload_path'] = IMAGE_PATH.'p_imgs/'.$pId;
		if(!is_dir(IMAGE_PATH.'p_imgs/'.$pId))
		{
			mkdir(IMAGE_PATH.'p_imgs/'.$pId,0777);
		}
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']	= '10240';
	    $config['max_width']  = '4000';
	    $config['max_height']  = '4000';
		$config['req_height']  = '640';
		$config['req_width']  = '640';
	    $this->load->library('upload', $config);
		$imgArr = array();
		for($i=1;$i<=4;$i++)
		{
			$sucess = $this->upload->do_upload('img_'.$i);
			$upArr = $this->upload->data();
			if($sucess && is_file($config['upload_path'].'/'.$upArr['file_name']))
			{
				$imgArr[] = $upArr['file_name'];
			}
			else if(is_file($config['upload_path'].'/'.$_REQUEST['img_hdn_'.$i])) 
			{
				$imgArr[] = $_REQUEST['img_hdn_'.$i];
			}
			unset($upArr);
		}
		$this->product_model->updateImage($imgArr,$pId);
        redirect(BASE_URL."admin/product");
	}
	function updateOrder($flg,$catId)
	{
	    $objResponse=new xajaxResponse();
	    if($flg == "up")
	    {
	        $this->product_model->stepUp($catId);
	    }
	    else
	    {
	        $this->product_model->stepDown($catId);
	    }
	    $objResponse->script("xajax_load()");
	    return $objResponse;
	}
	function getSubCategory($catId)
	{
		$objResponse=new xajaxResponse();
		$carArr = $this->category_model->getAllSubCategory($catId);
		$i=0;
		$str = '<select id="selSubCat" name="selSubCat">';
		$str .= '<option value="">-Select-</option>';
		foreach($carArr['cat_id'] as $id)
		{
			$str .= '<option value="'.$id.'">'.$carArr['cat_nm'][$i].'</option>';
			$i++;
		}
		$str .= '</select>';
		$objResponse->assign("spSubCat",'innerHTML',$str);
		return $objResponse;
	}
	function getSubCategoryForSetForm($catId,$ScatId)
	{
		$carArr = $this->category_model->getAllSubCategory($catId);
		$i=0;
		$str = '<select id="selSubCat" name="selSubCat">';
		$str .= '<option value="">-Select-</option>';
		foreach($carArr['cat_id'] as $id)
		{
			$str .= '<option value="'.$id.'" '.(($ScatId == $id)?'selected="selected"':'').'>'.$carArr['cat_nm'][$i].'</option>';
			$i++;
		}
		return $str .= '</select>';
	}
	function setFeatureProduct($id,$flg)
	{
			if($flg)
			{
				$this->db->update('game_product',array('is_feature_p'=>1),array('id'=>$id));
			}
			else
			{
				$this->db->update('game_product',array('is_feature_p'=>0),array('id'=>$id));
			}
	}
	function rrmdir($dir)
	{
		foreach(glob($dir . '/*') as $file)
		{
			if(is_dir($file))
				rrmdir($file);
			else
				unlink($file);
		}
		rmdir($dir);
	}
}