<script language="javascript">
var msg_img_title = '<?php echo $this->lang->line('req_img_title'); ?>';
var msg_img = '<?php echo $this->lang->line('req_img'); ?>';
</script>
<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
<?php echo $this->lang->line('home_top_flesh'); ?>
</div>
<div id="divFromContainer" class="formDiv">
<form name="frmForm" id="frmForm" action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
<tr>
	<td width="10%" align="left">Title:<span class="errMsg">*</span></td>
	<td width="20%" align="left"><input type="text" name="txtTitle" id="txtTitle" disabled="disabled" ></td>
	<td width="10%" align="left">Image File:<span class="errMsg">*</span></td>
	<td width="20%" align="left"><input type="file" name="fImg" id="fImg" disabled="disabled" ><img src="" alt="" height="40" width="40" id="imgImg"><input type="hidden" name="hdnImg" id="hdnImg" value=""></td>
	<td width="10%" align="left">Other:</td>
	<td width="20%" align="left">
	<textarea id="txtOther" name="txtOther"></textarea>	
	</td>
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