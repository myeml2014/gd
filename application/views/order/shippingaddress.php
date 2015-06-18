<script language="javascript" type="text/javascript">
function validate(f)
{
	document.loginform.action="<?php echo base_url();?>users/login";
	document.loginform.submit();
}
function usedAddress(val)
{
	if(val == -1)
	{
		$("#country").attr("disabled",false);
		$("#state").attr("disabled",false);
		$("#add1").attr("disabled",false);
		$("#add2").attr("disabled",false);
		$("#add3").attr("disabled",false);
		$("#city").attr("disabled",false);
		$("#zip").attr("disabled",false);
	}
	else
	{
		$("#country").attr("disabled",true);
		$("#state").attr("disabled",true);
		$("#add1").attr("disabled",true);
		$("#add2").attr("disabled",true);
		$("#add3").attr("disabled",true);
		$("#city").attr("disabled",true);
		$("#zip").attr("disabled",true);
		
		$("#country").val('');
		$("#state").val('');
		$("#add1").val('');
		$("#add2").val('');
		$("#add3").val('');
		$("#city").val('');
		$("#zip").val('');
	}
}
</script>
<div id="section">
  <div class="wrap">
    <div class="row">
      <div class="inner_hed_text">Shipping Address</div>
    </div>
	<form name="frm" id="frm" method="post" action="order/shipping" onsubmit="return validate(this)">
    <div class="row">
      <div class="col6">
        <div class="row">
          <div class="form_field">
			<div class="row ">
                  <div class="row sub_hed2 margin_top2"><input type="radio" id="rdoadd0" name="rdoadd" value="0" checked="checked" onclick="usedAddress(this.value)">Use Your Permanent Address</div>
            </div>
			<div class="row ">
				<div class="col33  form_text51">
				<?php
				echo '<pre>';
				echo 'Address 1:'.$address1."<br>";
				echo 'Address 2:'.$address2."<br>";
				echo 'Address 3:'.$address3."<br>";
				echo 'City     :'.$city."<br>";
				echo 'State    :'.$state_nm."<br>";
				echo 'Country  :'.$country_name."<br>";
				echo 'Zip      :'.$zip."<br>";
				echo '</pre>';
				?>
				</div>
			</div>
			<?php
			foreach($other_add as $v)
			{
			?>
				<div class="row ">
                  <div class="row sub_hed2 margin_top2"><input type="radio" id="rdoadd<?php echo $v['id'];?>" name="rdoadd" value="<?php echo $v['id'];?>" checked="checked" onclick="usedAddress(this.value)">Use This Address</div>
				</div>
				<div class="row ">
					<div class="col33  form_text51">
					<?php
					echo '<pre>';
					echo 'Address 1:'.$v['address1']."<br>";
					echo 'Address 2:'.$v['address2']."<br>";
					echo 'Address 3:'.$v['address3']."<br>";
					echo 'City     :'.$v['city']."<br>";
					echo 'State    :'.$v['state_nm']."<br>";
					echo 'Country  :'.$v['country_name']."<br>";
					echo 'Zip      :'.$v['zip']."<br>";
					echo '</pre>';
					?>
					</div>
				</div>
			<?php
			}
			?>
			<div class="row ">
                  <div class="row sub_hed2 margin_top2"><input type="radio" id="rdoadd2" name="rdoadd" value="-1" onclick="usedAddress(this.value)" >Add New Shipping Address</div>
            </div>
            <div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Select Country</div>
              <div class="col9 last">
				<select name="country" id="country" onchange="xajax_getState(this.value)" class="text_field3" required disabled="disabled">
				<option value="">-Select-</option>
				<?php
				$q = $this->db->get_where('game_country');
				foreach($q->result() as $row){
				?>
				<option value="<?php echo $row->id;?>"><?php echo $row->country_name;?></option>
				<?php
				}
				?>
				</select>
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span>Select State</div>
              <div class="col9 last" id="divState">
				<select name="state" id="state" class="text_field3" required disabled="disabled">
				<option value="">-Select-</option>
				</select>
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Address 1</div>
              <div class="col9 last">
				<input type="text" id="add1" name="add1" class="text_field3" disabled="disabled">
              </div>
            </div>
            <div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Address 2</div>
              <div class="col9 last">
				<input type="text" name="add2" id="add2" class="text_field3" disabled="disabled">
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Address 3</div>
              <div class="col9 last">
				<input type="text" name="add3" id="add3" class="text_field3" disabled="disabled">
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> City</div>
              <div class="col9 last">
				<input type="text" name="city" id="city" class="text_field3" disabled="disabled">
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Zip</div>
              <div class="col9 last">
				<input type="text" name="zip" id="zip" class="text_field3" disabled="disabled">
              </div>
            </div>
            <div class="row">
              <div class="col33">&nbsp;</div>
              <div class="col9 last">
				<input type="submit" value="Next" onclick="frmsubmit();" class="submit-but">
              </div>
            </div>
          </div>
        </div>
      </div>      
	  </form>
</div>