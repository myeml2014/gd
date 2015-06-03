<div class="adminTitle" align="left">
Main Menu
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
	        <td align="center">Order</td>
			<td align="center">Menu Title</td>
			<td align="center">Menu Link</td>
			<td align="center">Static/Dynamic</td>
			<td align="center">Status</td>
			<td align="center">Language</td>
        </tr>
		<tr class="searchTr">
            <td align="center"></td>
			<td align="center"></td>
            <td align="left"><input type="text" name="txtSearch_menu_title" id="txtSearch_menu_title"  onkeypress="fnfilter(event)" ></td>
			<td align="center"><input type="text" name="txtSearch_menu_link" id="txtSearch_menu_link"  onkeypress="fnfilter(event)" ></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
        </tr>
    </thead>
    <tbody id="tblGrid">
    </tbody>
    
</table>
<div align="right" id="divBottomPagging" style="float:right"></div>
</div>