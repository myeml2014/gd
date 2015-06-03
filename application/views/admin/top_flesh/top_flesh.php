<script type="text/javascript">
var BaseUrl = '<?php echo BASE_URL;?>';
</script>
<div class="adminTitle" align="left">
<?php echo $this->lang->line('home_top_flesh'); ?>
</div>
<?php
include_once(ADMIN_HEADER."btnControl.php");
?>
<div style="margin-top: 5px;">
<table width="100%" border="0" >
    <thead>
        <tr>
            <td colspan="3">
				<div align="right" id="divTopPagging" style="float:right;" valign="middle"></div>
			</td>
        </tr>
        <tr class="searchLinkD">
           <td align="left" width="5%"><?php echo $this->lang->line('sr'); ?>.</td>
	        <td align="center">Title</td>
	        <td align="center">Image</td>
        </tr>
		  <tr class="searchTr">
            <td align="center"></td>
            <td align="left"><input type="text" name="txtSearch_title" id="txtSearch_title"  onkeypress="fnfilter(event)" ></td>
            <td></td>
        </tr>
    </thead>
    <tbody id="tblGrid">
    </tbody>
    
</table>
<div align="right" id="divBottomPagging" style="float:right"></div>
</div>