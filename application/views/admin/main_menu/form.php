<script type="text/javascript" >
tinymce.init({
	selector:'#txtContent',
	 plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen"
    ]
	});
</script>
<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
Main Menu
</div>
<div id="divFromContainer" class="formDiv">
<form name="frmForm" id="frmForm" action="">
<table width="100%" border="0">
<tr>
	<td width="10%" align="left">Order:</td>
	<td width="20%" align="left"><input type="text" name="txtOrder" id="txtOrder" disabled="disabled" ></td>
	<td width="10%" align="left">Menu Title:</td>
	<td width="20%" align="left"><input type="text" name="txtMenuTitle" id="txtMenuTitle" disabled="disabled" ></td>
</tr>
<tr>
	<td width="10%" align="left">Menu Link:</td>
	<td width="20%" align="left"><input type="text" name="txtMenuLink" id="txtMenuLink" disabled="disabled" ></td>
	<td width="10%" align="left">Static/Dynamic:</td>
	<td width="20%" align="left">
	<select name="selStaticOrDynamic" id="selStaticOrDynamic">
		<option value="">Select</option>
		<option value="1">Static</option>
		<option value="0">Dynamic</option>
	</select>
	</td>
</tr>
<tr>
	<td width="10%" align="left">Status:</td>
	<td width="20%" align="left">
	<select name="selStatus" id="selStatus">
		<option value="">Select</option>
		<option value="1">Active</option>
		<option value="0">Deactive</option>
	</select>
	</td>
	<td width="10%" align="left">Language:</td>
	<td width="20%" align="left">
	<select name="selLang" id="selLang">
		<option value="">Select</option>
		<option value="1">Gujarati</option>
		<option value="2">English</option>
	</select>
	</td>
</tr>
<tr>
	<td width="10%" align="left">Content:</td>
	<td align="left" colspan="3"><textarea id="txtContent" name="txtContent"></textarea></td>
	
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