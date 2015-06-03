<script type="text/javascript">
var BaseUrl = '<?php echo BASE_URL;?>';
</script>
<div class="adminTitle" align="left">
<?php echo $this->lang->line('home_product'); ?>
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
			<td align="center"><?php echo $this->lang->line('category'); ?></td>
			<td align="center"><?php echo $this->lang->line('sub_category'); ?></td>
	        <td align="center"><?php echo $this->lang->line('product_name'); ?></td>
			<td align="center"><?php echo $this->lang->line('featured_products'); ?></td>
			<td align="center"><?php echo $this->lang->line('status'); ?></td>
			<td align="center"><?php echo $this->lang->line('order'); ?></td>
        </tr>
		<tr class="searchTr">
            <td align="center" width="2%"></td>
			<td align="left" width="8%"><input type="text" name="txtSearch_cat_nm" id="txtSearch_cat_nm"  onkeypress="fnfilter(event)" ></td>
            <td align="left" width="8%"><input type="text" name="txtSearch_sub_cat_nm" id="txtSearch_sub_cat_nm"  onkeypress="fnfilter(event)" ></td>
			<td align="center"><input type="text" name="txtSearch_p_nm" id="txtSearch_p_nm"  onkeypress="fnfilter(event)" ></td>
			<td align="center" width="2%"></td>
			<td align="center" width="2%"></td>
			<td align="center" width="2%"></td>
        </tr>
    </thead>
    <tbody id="tblGrid">
    </tbody>
    
</table>
<div align="right" id="divBottomPagging" style="float:right"></div>
</div>