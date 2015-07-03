<!DOCTYPE html>
<html>
<head>
<title>:: Welcome to Gameday Novelties ::</title>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/style_admin.css">
<script language="javascript">
function validate(frm)
{
	if(frm.selStatus == "")
	{
		alert("Please Select Status.");
		return false;
	}
}
</script>
</head>
<body>
<table width="100%" border="1">
	<tr>
		<td>
			<table width="100%">
				<tr>
					<td><?php echo $orderId;?></td>
					<td><?php echo $order_date;?></td>
					<td><?php echo $order_status;?><br>Status</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			Products Information
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%">
				<tr>
					<td>
						PRODUCT
					</td>
					<td>
						SELLING PRICE
					</td>
					<td>
						QUANTITY
					</td>
					<td>
						TOTAL
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $p_name;?>
					</td>
					<td>
						<?php echo $order_amount;?>
					</td>
					<td>
						<?php echo $p_qty;?>
					</td>
					<td>
						<?php echo $order_amount;?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			Customer Information
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0">
				<tr>
					<td>Email:</td>
					<td><?php echo $p_qty;?></td>
					<td>Mobile:</td>
					<td><?php echo $mobile;?></td>
				</tr>
				
				<tr>
					<td>Name:</td>
					<td><?php echo $name;?></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">Permanent Address 
					</td>
					<td colspan="2">Shipping Address 
					</td>
				</tr>
				<tr>
					<td>Address1:</td>
					<td><?php echo $address1;?></td>
					<td>Address1:</td>
					<td><?php echo $address1;?></td>
				</tr>
				<tr>
					<td>Address2:</td>
					<td><?php echo $address2;?></td>
					<td>Address2:</td>
					<td><?php echo $address2;?></td>
				</tr>
				<tr>
					<td>Address3:</td>
					<td><?php echo $address3;?></td>
					<td>Address3:</td>
					<td><?php echo $address3;?></td>
				</tr>
				<tr>
					<td>City:</td>
					<td><?php echo $city;?></td>
					<td>City:</td>
					<td><?php echo $city;?></td>
				</tr>
				<tr>
					<td>State:</td>
					<td><?php echo $state_nm;?></td>
					<td>State:</td>
					<td><?php echo $state_nm;?></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td><?php echo $country_name;?></td>
					<td>Country:</td>
					<td><?php echo $country_name;?></td>
				</tr>
				<tr>
					<td>Zip:</td>
					<td><?php echo $zip;?></td>
					<td>Zip:</td>
					<td><?php echo $zip;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			Customer Notes
		</td>
	</tr>
	<tr>
		<td>
			Notes
		</td>
	</tr>
	<tr>
		<td>
			<form method="post" action="<?php echo BASE_URL.'admin/orders/changestatus/'.$orderId.'/'.$from;?>" onsubmit="return validate(this)">
			<table width="100%">
				<tr>
					<td align="right" width="40%">Change Status:</td>
					<td align="left" width="10%">
					<select id="selStatus" name="selStatus">
						<option value="">-Select Status-</option>
						<?php
						if($order_status == 0)
							echo '<option value="1">Confirm</option>';
						else if($order_status == 1)
							echo '<option value="2">Processing</option>';
						else if($order_status == 2)
							echo '<option value="3">QC</option>';
						else if($order_status == 3)
							echo '<option value="4">Dispatched</option>';
						else if($order_status == 4)
							echo '<option value="5">Delivered</option>';
						else if($order_status == 5)
							echo '<option value="6">Archive</option>';
						?>
					</select>
					</td>
					<td align="left">
					<input type="submit" name="btnSubmit" id="btnSubmit" class="submit" value="Save" >&nbsp;<input type="button" class="submit" value="Close" onclick="window.close()">
					</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
</body>
</html>