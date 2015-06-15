<script language="javascript">
var msg_state = '<?php echo $this->lang->line('req_c_state'); ?>';
</script>
<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
<?php echo $this->lang->line('home_state'); ?>
</div>
<div id="divFromContainer" class="formDiv">
<form name="frmForm" id="frmForm" action="" method="post" enctype="multipart/form-data">
<table border="0" width="100%">
<tr>
	<td width="10%" align="left"><?php echo $this->lang->line('home_country'); ?>:<span class="errMsg">*</span></td>
	<td width="20%" align="left">
		<select name="country" id="country" onchange="xajax_getState(this.value)" class="text_field3" required>
		<option value="">-Select-</option>
		<?php
		$q = $this->db->get_where('game_country');
		foreach($q->result() as $row){
		?>
		<option value="<?php echo $row->id;?>"><?php echo $row->country_name;?></option>
		<?php
		}
		?>
		</select>
	</td>
	<td width="10%" align="left"><?php echo $this->lang->line('home_state'); ?>:<span class="errMsg">*</span></td>
	<td width="40%" align="left"><input type="text" id="txtstate" name="txtstate" required /> </td>
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