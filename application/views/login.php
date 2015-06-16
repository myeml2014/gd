<div id="section">
  <div class="wrap">
    <div class="row">
      <div class="inner_hed_text">LOGIN</div>
    </div>	
    <?php echo form_open('users/login',array('id'=>'login-form','name'=>'loginform')); ?>
	<input type="hidden" name="ksubmit" value="vsubmit"/>
	<input type="hidden" name="hdnIsOrder" id="hdnIsOrder" value="<?php echo (isset($is_order))?$is_order:'';?>" >
    <div class="row">
      <div class="col6">
        <div class="row">
		<span class="alertmsg">
			<?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}  ?>
		</span> 
          <div class="form_field">
            <div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> User Name</div>
              <div class="col9 last">
				<input type="text" id="email" name="email" class="text_field3">
           		<?php echo form_error('email'); ?>
              </div>
            </div>
            <div class="row">
              <div class="col33  form_text51"><span class="red_clr">*</span> Password</div>
              <div class="col9 last">
				<input type="password" name="password" id="password" class="text_field3">
                <?php echo form_error('password'); ?>
              </div>
            </div>
            <div class="row">
              <div class="col33">&nbsp;</div>
              <div class="col9 last">
			 
				<input type="submit" value="Login" onclick="frmsubmit();" class="submit-but">
                <input type="button" value="Clear" class="submit-but" onclick="$('#email').val('');$('#password').val('');">
              </div>
            </div>
            <div class="row margin_top">
              <div class="col33">&nbsp;</div>
              <div class="col9 last">
                <div class="forgot_password"> <?php echo anchor('/users/forgotpassword','Forgot Password? Click Here');?></div>
              </div>
            </div>
            <div class="row">
              <div class="col33">&nbsp;</div>
              <div class="col9 last">
                <div class="row ">
                  <div class="row sub_hed2 margin_top2">You are not a member?</div>
                </div>
                <div class="row ">
                  <div class="col9 last"> <a href="<?php echo base_url();?>users/signup<?php echo (isset($is_order))?'/'.$is_order:'';?>">
                    <div class="submit-but">REGISTER NOW</div>
                    </a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col6 last">
        <div class="row">
          <div class="newsletter_hed">JOIN GAMEDAY NOVELTIES</div>
        </div>
        <div class="row">
          <div class="email_signup">Email Sign Up</div>
        </div>
        <div class="row mar_top">
          <div class="col9 last">
            <input name="email_signup" type="text" class="text_field3">
          </div>
        </div>
        <div class="row">
          <div class="col9 last"> <a href="registration.html">
            <div class="submit-but2">SUBMIT</div>
            </a> </div>
        </div>
      </div>
    </div>
    <?php echo form_close();?> </div>
</div>
<script language="javascript" type="text/javascript">
function frmsubmit()
{
	document.loginform.action="<?php echo base_url();?>users/login";
	document.loginform.submit();
}
</script>