<script language="javascript">
var msg_cat = '<?php echo $this->lang->line('req_cat_nm'); ?>';
var msg_menu = '<?php echo $this->lang->line('req_cat_in_menu'); ?>';
var msg_status = '<?php echo $this->lang->line('req_cat_status'); ?>';
</script>
<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
<?php echo $this->lang->line('category'); ?>
</div>
<div id="divFromContainer" class="formDiv">
<form name="frmForm" id="frmForm" action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('category_name'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left"><input type="text" name="txtCatNm" id="txtCatNm" disabled="disabled" ></td>
	<td width="10%" align="left"><?php echo $this->lang->line('category_desc'); ?>:</td>
	<td width="20%" align="left"><textarea name="txtCatDesc" id="txtCatDesc" disabled="disabled"></textarea></td>
</tr>
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('category_image'); ?>:</td>
	<td width="20%" align="left"><input type="file" name="CatImg" id="CatImg" disabled="disabled" ><img id="tmpCatImg" src="<?php echo BASE_URL;?>images/noimage.png" width="50px" height="50px" /></td>
	<td width="10%" align="left"><?php echo $this->lang->line('display_in_main_menu'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left">
	<select name="selIsMain" id="selIsMain">
		<option value="">Select</option>
		<option value="1">Yes</option>
		<option value="0" selected="selected">No</option>
	</select>
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