<script type="text/javascript">
var BaseUrl = '<?php echo BASE_URL;?>';
var page = '<?php echo $page;?>';
</script>
<div class="adminTitle" align="left">
<?php echo $this->lang->line('home_orders'); ?>
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
            <td align="left" width="5%">Sr.</td>
			<td align="center"><?php echo $this->lang->line('name'); ?></td>
			<td align="center"><?php echo $this->lang->line('product_name'); ?></td>
			<td align="center"><?php echo $this->lang->line('quantity'); ?></td>
			<td align="center"><?php echo $this->lang->line('total'); ?></td>
			<td align="center"><?php echo $this->lang->line('status'); ?></td>
			<td align="center">Detail</td>
        </tr>
		<tr class="searchTr">
            <td align="center" width="2%"></td>
			<td align="left" width="8%"><input type="text" name="txtSearch_nm" id="txtSearch_nm"  onkeypress="fnfilter(event)" ></td>
			<td align="left" width="8%"><input type="text" name="txtSearch_product" id="txtSearch_product"  onkeypress="fnfilter(event)" ></td>
			<td align="left" width="8%"><input type="text" name="txtSearch_qty" id="txtSearch_qty"  onkeypress="fnfilter(event)" ></td>
			<td align="left" width="8%"><input type="text" name="txtSearch_total" id="txtSearch_total"  onkeypress="fnfilter(event)" ></td>
			<td align="left" width="8%">
				<select name="txtSearch_status" id="txtSearch_status"  onchange="fnfilter(event,true)" >
					<option value="">-Filter-</option>
					<option value="0">Pending</option>
					<option value="1">Confirmed</option>
					<option value="2">Processing</option>
					<option value="3">Quality Check</option>
					<option value="4">Dispatched</option>
					<option value="4">Delivered</option>
				</select>
			</td>
			<td align="center" width="2%"></td>
        </tr>
    </thead>
    <tbody id="tblGrid">
    </tbody>
    
</table>
<div align="right" id="divBottomPagging" style="float:right"></div>
</div>