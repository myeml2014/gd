<script language="javascript">
var msg_p = '<?php echo $this->lang->line('req_p_nm'); ?>';
var msg_cat = '<?php echo $this->lang->line('req_p_cat'); ?>';
var msg_sub_cat = '<?php echo $this->lang->line('req_p_sub_cat'); ?>';
var msg_status = '<?php echo $this->lang->line('req_cat_status'); ?>';
</script>
<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
<?php echo $this->lang->line('home_product'); ?>
</div>
<div id="divFromContainer" class="formDiv">
<form name="frmForm" id="frmForm" action="" method="post" enctype="multipart/form-data">
<input type="hidden" id="img_hdn_1" name="img_hdn_1" >
<input type="hidden" id="img_hdn_2" name="img_hdn_2" >
<input type="hidden" id="img_hdn_3" name="img_hdn_3" >
<input type="hidden" id="img_hdn_4" name="img_hdn_4" >
<table width="100%" border="0">
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('category'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left">
	<select id="selCat" name="selCat" onchange="xajax_getSubCategory(this.value)">
	<option value="">-Select-</option>
	<?php
	$carArr = $this->category_model->getAllCategory();
	$i=0;
	foreach($carArr['cat_id'] as $id)
	{
	?>
		<option value="<?php echo $id;?>"><?php echo $carArr['cat_nm'][$i];?></option>
	<?php
		$i++;
	}
	?>
	</select>
	</td>
	<td width="10%" align="left"><?php echo $this->lang->line('sub_category'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left">
	<span id="spSubCat">
	<select id="selSubCat" name="selSubCat">
	<option value="">-Select-</option>
	</select>
	</span>
	</td>
	<td width="10%" align="left"><?php echo $this->lang->line('product_name'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left"><input type="text" name="txtPNm" id="txtPNm" disabled="disabled" ></td>
	<td width="10%" align="left"><?php echo $this->lang->line('product_desc'); ?>:</td>
	<td width="20%" align="left"><textarea name="txtPDesc" id="txtPDesc" disabled="disabled"></textarea></td>
</tr>
<tr>
	<td colspan="8" align="left">Attribute</td>
</tr>
<tr>
	<td colspan="8" align="left" >
	<table width="100%" >
<?php
$data = $this->attribute_model->getAllAttribute();
$i=0;
$str = '';
foreach($data as $d)
{
	if($i == 0)
	{
		$str .= '<tr>';
	}
	else if($i%4 == 0)
	{
		$str .= '</tr><tr>';
	}
	$str .= '<td>'.$d->attribute.'</td>';
	$str .= '<td><input type="text" id="txtA'.$d->id.'" name="txtA'.$d->id.'"></td>';
	$i++;
}
if($i%4 == 1)
	$str .= '<td></td><td></td><td></td><td></td><td></td><td></td><tr>';
if($i%4 == 2)
	$str .= '<td></td><td></td><td></td><td></td><tr>';
if($i%4 == 3)
	$str .= '<td></td><td></td><tr>';
if($i%4 == 0)
	$str .= '<tr>';
echo $str;
?>
	</table>
	</td>
</tr>
<tr>
	<td colspan="8" align="left">Images</td>
</tr>
<tr>
	<td colspan="4" align="left">
	<p><input type="file" id="img_1" name="img_1">&nbsp;&nbsp;<img src="<?php echo BASE_URL;?>images/noimage.png" id="tImg_1" name="tImg_1" width="30"></p>
	<p><input type="file" id="img_2" name="img_2">&nbsp;&nbsp;<img src="<?php echo BASE_URL;?>images/noimage.png" id="tImg_2" name="tImg_2" width="30"></p>
	</td>
	<td colspan="4" align="left">
	<p><input type="file" id="img_3" name="img_3">&nbsp;&nbsp;<img src="<?php echo BASE_URL;?>images/noimage.png" id="tImg_3" name="tImg_3" width="30"></p>
	<p><input type="file" id="img_4" name="img_4">&nbsp;&nbsp;<img src="<?php echo BASE_URL;?>images/noimage.png" id="tImg_4" name="tImg_4" width="30"></p>
	</span>
	</td>
</tr>
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('meta_keyword'); ?>:</td>
	<td align="left"><textarea id="txtMetaKeyword" name="txtMetaKeyword"></textarea></td>
	<td width="10%" align="left"><?php echo $this->lang->line('meta_desc'); ?>:</td>
	<td align="left"><textarea id="txtMetaDesc" name="txtMetaDesc"></textarea></td>
	
</tr>
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('status'); ?>:<span class="errMsg">*</span></td>
	<td align="left">
	<select id="selStatus" name="selStatus">
		<option value="">Select</option>
		<option value="1">Active</option>
		<option value="0">Deactive</option>
	</select>
	</td>
	<td width="10%" align="left"></td>
	<td align="left"></td>
	
</tr>
</table>
<input type="hidden" id="pkId" name="pkId" >
<input type="hidden" id="act" name="act" >
</form>
</div>
<div id="divFromButton" style="padding: 10px;">
<input type="button" id="btnSave" name="btnSave" class="button" value="<?php echo $this->lang->line('btn_save'); ?>" onClick="fnsave()" >
<input type="button" id="btnClose" name="btnClose" class="button" value="<?php echo $this->lang->line('btn_close'); ?>" onClick="fnreset()" >
</div>
</div>