<div id="divForm" align="center" style="" >
<div class="adminTitle" style="width: 100%" align="left">
User Detail
</div>
<div id="divFromContainer" class="formDiv">
	<table width="100%">
		<tr>
			<td align="right" width="40%">Name:</td>
			<td align="left"><?php echo $fname.' '.$lname;?></td>
		</tr>
		<tr>
			<td align="right">Email:</td>
			<td align="left"><?php echo $email;?></td>
		</tr>
		<tr>
			<td align="right">Mobile:</td>
			<td align="left"><?php echo $mobile;?></td>
		</tr>
		<tr>
			<td align="right">Address 1:</td>
			<td align="left"><?php echo $address1;?></td>
		</tr>
		<tr>
			<td align="right">Address 2:</td>
			<td align="left"><?php echo $address2;?></td>
		</tr>
		<tr>
			<td align="right">Address 3:</td>
			<td align="left"><?php echo $address3;?></td>
		</tr>
		<tr>
			<td align="right">City:</td>
			<td align="left"><?php echo $city;?></td>
		</tr>
		<tr>
			<td align="right">State:</td>
			<td align="left"><?php echo $state_nm;?></td>
		</tr>
		<tr>
			<td align="right">Country:</td>
			<td align="left"><?php echo $country_name;?></td>
		</tr>
		<tr>
			<td align="right">Zip:</td>
			<td align="left"><?php echo $zip;?></td>
		</tr>
		<tr>
			<td align="right">Zip:</td>
			<td align="left"><?php echo $zip;?></td>
		</tr>
		<tr>
			<td align="right">Children's Birth Day:</td>
			<td align="left"><?php echo date('d-M-Y',strtotime($child_birth_date));?></td>
		</tr>
		<tr>
			<td align="right">Interested Category:</td>
			<td align="left"><?php 
			$insArr = explode(",",$cat_ids);
			
			foreach($insArr as $id)
			{
				if($id != '' && $catArr[$id])
				echo $catArr[$id].'<br>';	
			}
			?></td>
		</tr>
	</table>
</div>
</div>