<script language="javascript">
var msg_img_title = '<?php echo $this->lang->line('req_title'); ?>';
</script>
<script type="text/javascript" >
tinymce.init({
	selector:'#txtOther',
	 plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen"
    ]
	});
</script>
<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
<?php echo $this->lang->line('home_footer_links'); ?>
</div>
<div id="divFromContainer" class="formDiv">
<form name="frmForm" id="frmForm" action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
<tr>
	<td width="10%" align="left">Link Title:<span class="errMsg">*</span></td>
	<td width="" align="left"><input type="text" name="txtTitle" id="txtTitle" disabled="disabled" ></td>
</tr>
<tr>
	<td width="10%" align="left">Description:</td>
	<td width="" align="left">
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