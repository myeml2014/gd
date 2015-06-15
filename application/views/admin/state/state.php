<script type="text/javascript">
var BaseUrl = '<?php echo BASE_URL;?>';
</script>
<div class="adminTitle" align="left">
<?php echo $this->lang->line('home_state'); ?>
</div>
<?php
include_once(ADMIN_HEADER."btnControl.php");
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
            <td align="left" width="5%">Sr.</td>
			<td align="center"><?php echo $this->lang->line('country'); ?></td>
			<td align="center"><?php echo $this->lang->line('home_state'); ?></td>
        </tr>
		<tr class="searchTr">
            <td align="center" width="2%"></td>
			<td align="left" width="45%"><input type="text" name="txtSearch_country_nm" id="txtSearch_country_nm"  onkeypress="fnfilter(event)" ></td>
			<td align="left" width="48%"><input type="text" name="txtSearch_state_nm" id="txtSearch_state_nm"  onkeypress="fnfilter(event)" ></td>
        </tr>
    </thead>
    <tbody id="tblGrid">
    </tbody>
    
</table>
<div align="right" id="divBottomPagging" style="float:right"></div>
</div>