<script language="javascript" type="text/javascript">
function validate(f)
{
	document.loginform.action="<?php echo base_url();?>users/login";
	document.loginform.submit();
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
                  <div class="row sub_hed2 margin_top2"><input type="radio" id="rdoadd1" name="rdoadd" value="0">Use Your Permanent Address</div>
            </div>
			<div class="row ">
				<div class="col33  form_text51">
				<?php
				
				?>
				</div>
			</div>
			<div class="row ">
                  <div class="row sub_hed2 margin_top2"><input type="radio" id="rdoadd2" name="rdoadd" value="-1">Add New Shipping Address</div>
            </div>
            <div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Select Country</div>
              <div class="col9 last">
				<select name="country" id="country" onchange="xajax_getState(this.value)" class="text_field3" required>
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
				<select name="state" id="state" class="text_field3" required>
				<option value="">-Select-</option>
				</select>
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Address 1</div>
              <div class="col9 last">
				<input type="text" id="add1" name="add1" class="text_field3">
              </div>
            </div>
            <div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Address 2</div>
              <div class="col9 last">
				<input type="text" name="add2" id="add2" class="text_field3">
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Address 3</div>
              <div class="col9 last">
				<input type="text" name="add3" id="add3" class="text_field3">
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> City</div>
              <div class="col9 last">
				<input type="text" name="city" id="city" class="text_field3">
              </div>
            </div>
			<div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Zip</div>
              <div class="col9 last">
				<input type="text" name="zip" id="zip" class="text_field3">
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