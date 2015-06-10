<div id="section">
<div class="wrap"
	 
<div class="row"><div class="border_middle2">&nbsp;

<table width="100%" border="1">
<tbody id="tkart">
<tr>
	<td></td>
	<td>Product Name</td>
	<td>Quentity</td>
	<td width="5%">Price</td>
</tr>
<?php
$finalTotal = 0;
foreach($cart as $o)
{
?>
<tr>
	<td><img src="<?php echo (is_file(IMAGE_PATH.'p_imgs/'.$o->p_id.'/'.$o->img_path))?BASE_URL.'images/p_imgs/'.$o->p_id.'/'.$o->img_path:BASE_URL.'images/noimage.png';?>" width="30px" height="30px"></td>
	<td><a href="<?php echo BASE_URL."product/".$o->pkey;?>"><?php echo $o->p_name;?></a><span width="80px;" style="float: right;margin-right: 20px;" ><a href="javascript:void(0)" onclick="javascript:xajax_removeFromCart(<?php echo $o->p_id;?>,'<?php echo $bakUrl;?>')">Remove</a></span></td>
	<td><a href="javascript:void(0)" onclick="javascript:xajax_editQuentity(-1,<?php echo $o->p_id;?>,'<?php echo $bakUrl;?>')"><strong>-</strong></a>&nbsp;<?php echo $o->cnt;?>&nbsp;<a href="javascript:void(0)" onclick="javascript:xajax_editQuentity(1,<?php echo $o->p_id;?>,'<?php echo $bakUrl;?>')"><strong>+</strong></a></td>
	<td><?php echo $o->p_total;?></td>
</tr>
<?php
	$finalTotal = $finalTotal + $o->p_total;
}
?>
<tr>
	<td></td>
	<td colspan="2" align="right">Total</td>
	<td><?php echo $finalTotal;?></td>
</tr>
<tr>
	<td></td>
	<td colspan="2" align="right"><input type="button" value="Continue Shoping" onclick="location.href='<?php echo BASE_URL.str_replace("slesh","/",$bakUrl);?>'"></td>
	<td><input type="button" value="Place Order"></td>
</tr>
</tbody>
</table>
</div></div>
</div>
</div>