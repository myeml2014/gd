<div class="adminTitle" align="left">
<?php echo $this->lang->line('home_admin_account'); ?>
</div>
<?php
include_once(ADMIN_HEADER."btnControl.php");
?>
<div style="margin-top: 5px;">
<table width="100%" border="0" >
    <thead>
        <tr>
            <td colspan="5">
				<div align="right" id="divTopPagging" style="float:right;" valign="middle"></div>
			</td>
        </tr>
        <tr class="searchLinkD">
            <td align="left" width="5%"><?php echo $this->lang->line('sr'); ?>.</td>
	        <td align="center"><?php echo $this->lang->line('name'); ?></td>
            <td align="center"><?php echo $this->lang->line('login_username'); ?></td>
            <td align="center"><?php echo $this->lang->line('email'); ?></td>
            <td align="center"><?php echo $this->lang->line('status'); ?></td>
        </tr>
	<tr class="searchTr">
            <td align="center"></td>
            <td align="center"><input type="text" name="txtSearch_name" id="txtSearch_name"  onkeypress="fnfilter(event)" ></td>
	    <td align="center"><input type="text" name="txtSearch_username" id="txtSearch_username"  onkeypress="fnfilter(event)" ></td>
            <td align="center"><input type="text" name="txtSearch_email" id="txtSearch_email"  onkeypress="fnfilter(event)" ></td>
            <td align="center"></td>
        </tr>
    </thead>
    <tbody id="tblGrid">
    </tbody>
    
</table>
<div align="right" id="divBottomPagging" style="float:right"></div>
</div>
