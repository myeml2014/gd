<script language="javascript">
function reset()
{
	$("#frmReg :input").val('');
}
function validate(frm)
{
	if(!validEmail($("#email").val()))
	{
		alert("Please Enter Valid Email.");
		$("#email").focus();
		return false;
	}
	if($("#pass").val() != $("#repass").val())
	{
		alert("Password Not Match.");
		$("#repass").focus();
		return false;
	}
	if($("#spEmail").html() != '')
	{
		alert("Email Already Exists.");
		$("#email").focus();
		return false;
	}

}
</script>
<form name="frmReg" id="frmReg" method="post" action="<?php echo BASE_URL."users/signup";?>" onsubmit="return validate(this)">
<input type="hidden"  name="hdnTime" id="hdnTime" value="<?php echo time();?>" >
<div id="section">
<div class="wrap">
		<div class="row">
        	<div class="inner_hed_text">REGISTRATION</div>
        </div>
		<div class="row">
        	<div class="col6">
            		<div class="row">
                		<div class="form_field">
                        		<div class="row">
                                	<div align="center"><span class="red_clr"><?php echo validation_errors(); ?></span></div>
                                </div>
								<div class="row">
                                	<div class="col33  form_text51"><span class="red_clr">*</span> First Name</div>
                                    <div class="col9 last"><input name="fname" id="fname" type="text" class="text_field3" required></div>
                                </div>
                                <div class="row">
                                	<div class="col33  form_text51"><span class="red_clr">*</span> Last Name</div>
                                    <div class="col9 last"><input name="lname" id="lname" type="text" class="text_field3" required></div>
                                </div>
                               	<div class="row">
                                	<div class="col33  form_text51"><span class="red_clr">*</span> Email</div>
                                    <div class="col9 last"><input name="email" id="email" type="text" class="text_field3" onblur="xajax_emailExists(this.value)" required><span id="spEmail" class="red_clr"></span></div>
                                </div>
                                <div class="row">
                                	<div class="col33  form_text51">Password</div>
                                    <div class="col9 last"><input name="pass" id="pass" type="password" class="text_field3" required></div>
                                </div>
                                <div class="row">
                                	<div class="col33  form_text51">Re-Password</div>
                                    <div class="col9 last"><input name="repass" id="repass" type="password" class="text_field3" required></div>
                                </div>
                                <div class="row">
                                	<div class="col33  form_text51">Cell Phone</div>
                                    <div class="col9 last"><input name="phone" id="phone" type="text" class="text_field3"></div>
                                </div>
                                <div class="row">
                                	<div class="col33  form_text51">Gender</div>
                                    <div class="col9 last">
									<select name="gender" id="gender" class="text_field3" required>
									<option value="" >-Select-</option>
									<option value="M">Male</option>
									<option value="F">Female</option>
									</select>
									</div>
                                </div>
                                <div class="row">
                                	<div class="col33  form_text51">Select Country</div>
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
                                	<div class="col33  form_text51">Select State</div>
                                    <div class="col9 last" id="divState">
									<select name="state" id="state" class="text_field3" required>
									<option value="">-Select-</option>
									</select>
									</div>
                                </div>
								<div class="row">
                                	<div class="col33  form_text51">Address 1</div>
                                    <div class="col9 last"><input name="add1" id="add1" type="text" class="text_field3" required></div>
                                </div>
								<div class="row">
                                	<div class="col33  form_text51">Address 2</div>
                                    <div class="col9 last"><input name="add2" id="add2" type="text" class="text_field3" required></div>
                                </div>
								<div class="row">
                                	<div class="col33  form_text51">Address 3</div>
                                    <div class="col9 last"><input name="add3" id="add3" type="text" class="text_field3"></div>
                                </div>
								<div class="row">
                                	<div class="col33  form_text51">City</div>
                                    <div class="col9 last"><input name="city" id="city" type="text" class="text_field3" required></div>
                                </div>
								<div class="row">
                                	<div class="col33  form_text51">Zip</div>
                                    <div class="col9 last"><input name="zip" id="zip" type="text" class="text_field3" required></div>
                                </div>
                        </div>      	          
                	</div>
            </div>
            <div class="col6 last">
            		<div class="row ">
						<div class="row form_text51 margin_top">I am interested in these additional gameday categories </div>                                
                        <div class="col66 form_text51 margin_top">
							<?php
							$q = $this->db->get_where('game_category',array('parent_id'=>0,'is_active'=>1));
							foreach($q->result() as $row){
							?>
							<input name="cats[]" id="cats.<?php echo $row->id;?>" type="checkbox" value="<?php echo $row->id;?>" />&nbsp;<?php echo $row->cat_name;?><br />
							<?php
							}
							?>
                        </div>
                        <div class="col66 last">
                        </div>    
                    </div>
            		<div class="row">
                    			<div class="sub_hed">Celebrate Your Child's Birthday</div>
                    </div>
            		 <div class="row">
                                	<div class="col33 last  form_text51">Birth Date</div>
                                    <div class="col3 last">
									<select name="day" id="day" class="text_field3">
                                      <option value="">Day</option>
									  <?php
									  for($i=1;$i<=31;$i++)
									  {
									  ?>
									  <option value="<?php echo $i;?>"><?php echo $i;?></option>
									  <?php
									  }
									  ?>
                                    </select>
									</div>
									<div class="col3 last">
									<select name="month" id="month" class="text_field3">
                                      <option valie="">Month</option>
									  <?php
									  for($i=1;$i<=12;$i++)
									  {
									  ?>
									  <option value="<?php echo $i;?>"><?php echo $i;?></option>
									  <?php
									  }
									  ?>
                                    </select>
									</div>
                                    <div class="col33 last">
									<select class="text_field3" name="year" id="year" >
                                      <option value="">Year</option>
									  <?php
									  for($i=1990;$i<=(date('Y')+0);$i++)
									  {
									  ?>
									  <option value="<?php echo $i;?>"><?php echo $i;?></option>
									  <?php
									  }
									  ?>
                                    </select>
									</div>
	                </div>
                   <div class="row">
                                	<div class="col3 last form_text51">&nbsp;</div>
                                    <div class="col9 last">
                                    </div>
               		</div>
                    <div class="row margin_top2">
                                    <div class="col9 last">
										<input type="submit" name="btnSubmit" value="Submit" class="submit-but">
										<input type="button" value="Clear" class="submit-but" onclick="reset()">
                                    </div>
                   </div>
            </div>
        </div>
</div>            
</div>