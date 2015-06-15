<script type="text/javascript">
var BaseUrl = '<?php echo BASE_URL;?>';
</script>
<div class="adminTitle" align="left">
<?php echo $this->lang->line('home_users'); ?>
</div>
<?php
//include_once(ADMIN_HEADER."btnControl.php");
?>
<div style="margin-top: 5px;">
<table width="100%" border="0" >
    <thead>
        <tr>
            <td colspan="7">
				<div align="right" id="divTopPagging" style="float:right;" valign="middle"></div>
			</td>
        </tr>
        <tr class="searchLinkD">
            <td align="left" width="2%">ID.</td>
			<td align="center"><?php echo $this->lang->line('name'); ?></td>
			<td align="center"><?php echo $this->lang->line('email'); ?></td>
			<td align="center"><?php echo $this->lang->line('detail'); ?></td>
        </tr>
		<tr class="searchTr">
            <td align="center" width="2%"><input type="text" name="txtSearch_id" id="txtSearch_id"  onkeypress="fnfilter(event)"  style="width:50px;" ></td>
			<td align="left" width="40%"><input type="text" name="txtSearch_nm" id="txtSearch_nm"  onkeypress="fnfilter(event)" ></td>
			<td align="left" width="40%"><input type="text" name="txtSearch_email" id="txtSearch_email"  onkeypress="fnfilter(event)" ></td>
			<td align="left" width="2%"></td>
        </tr>
    </thead>
    <tbody id="tblGrid">
    </tbody>
</table>
<div align="right" id="divBottomPagging" style="float:right"></div>
</div>