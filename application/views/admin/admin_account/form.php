<script language="javascript">
var msg_user = '<?php echo $this->lang->line('require_user'); ?>';
var msg_pass = '<?php echo $this->lang->line('require_pass'); ?>';
var msg_fname = '<?php echo $this->lang->line('require_fname'); ?>';
var msg_lname = '<?php echo $this->lang->line('require_lname'); ?>';
var msg_email = '<?php echo $this->lang->line('require_email'); ?>';
var msg_status = '<?php echo $this->lang->line('require_status'); ?>';
var msg_valid_email = '<?php echo $this->lang->line('require_valid_email'); ?>';
</script>
<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
<?php echo $this->lang->line('home_admin_account'); ?>
</div>
<div id="divFromContainer" class="formDiv">
<form name="frmForm" id="frmForm" action="">
<table width="100%" border="0">
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('first_name'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left"><input type="text" name="txtFname" id="txtFname" disabled="disabled" ></td>
	<td width="10%" align="left"><?php echo $this->lang->line('last_name'); ?>:<span class="errMsg">*</span></td>
	<td align="left"><input type="text" name="txtLname" id="txtLname" disabled="disabled"></td>
</tr>
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('login_username'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left"><input type="text" name="txtUsername" id="txtUsername" disabled="disabled" ></td>
	<td width="10%" align="left"><?php echo $this->lang->line('login_password'); ?>:<span class="errMsg">*</span></td>
	<td align="left"><input type="password" name="txtPassword" id="txtPassword" disabled="disabled"></td>
</tr>
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('email'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left"><input type="text" name="txtEmail" id="txtEmail" disabled="disabled" ></td>
	<td align="left"><?php echo $this->lang->line('status'); ?>:<span class="errMsg">*</span></td>
	<td align="left">
	<select name="selStatus" id="selStatus" disabled="disabled">
		<option value=""><?php echo $this->lang->line('select_status'); ?></option>
		<option value="1">Active</option>
		<option value="0">Deactive</option>
	</select>
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