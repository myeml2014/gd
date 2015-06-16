<script language="javascript">
var IMAGE_PATH = '<?php echo IMAGE_PATH;?>';
var BASE_URL = '<?php echo BASE_URL;?>';
var bakUrl = '<?php echo $bakUrl;?>';
var finalTotal = 0;
function renderJson(Obj)
{
	var tbl = '';
	var clsCounter = 0;
	var finalTotal = 0;
    $.each(Obj,function(i, item) {    	
		tbl += '<tr>';
		tbl += '<td><img src="'+BASE_URL+'images/p_imgs/'+item.p_id+'/'+item.img_path+'" width="30px" height="30px"></td>';
		tbl += '<td><a href="'+BASE_URL+'product/'+item.pkey+'">'+item.p_name+'</a><span width="80px;" style="float: right;margin-right: 20px;" ><a href="javascript:void(0)" onclick="javascript:xajax_removeFromCart('+item.p_id+',\''+bakUrl+'\')">Remove</a></span></td>';
		tbl += '<td><a href="javascript:void(0)" onclick="javascript:xajax_editQuentity(-1,'+item.p_id+')" ><strong>-</strong></a>&nbsp'+item.cnt+'&nbsp;<a href="javascript:void(0)" onclick="javascript:xajax_editQuentity(1,'+item.p_id+')" ><strong>+</strong></a></td>';
		tbl += '<td>'+item.p_total+'</td>';
		tbl += "</tr>";
		finalTotal = finalTotal + parseInt(item.p_total);
		clsCounter++;
    });
    tbl += '<tr>';
	tbl += '<td></td>';
	tbl += '<td colspan="2" align="right">Total</td>';
	tbl += '<td>'+finalTotal+'</td>';
	tbl += '<tr>';
	tbl += '<td></td>';
	tbl += '<td colspan="2" align="right"><input type="button" value="Continue Shoping" onclick="location.href=\''+BASE_URL+(bakUrl.replace("slesh","/"))+'\'" class="submit-but"></td>';
	tbl += '<td><input type="button" value="Place Order" class="submit-but" onclick="location.href=\''+BASE_URL+'order\'"></td>';
	tbl += '</tr>';
    $("#tblGrid").html(tbl);
}
</script>
<div id="section">
<div class="wrap">
<div class="row"><div class="border_middle2">&nbsp;

<table width="100%" border="1">
<thead id="tkart">
<tr>
	<td></td>
	<td>Product Name</td>
	<td>Quentity</td>
	<td width="5%">Price</td>
</tr>
</thead>
<tbody id="tblGrid">
</tbody>
</table>
</div></div>
</div>
</div>