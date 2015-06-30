<!DOCTYPE html>
<html>
<head>
<title><?php echo (isset($Title))?$Title:'';?></title>
<link href="<?php echo BASE_URL;?>css/login.css" rel="stylesheet" type="text/css">
<script language="javascript">
function SubmitForm()
{
	if(document.login.username.value == ''){
		alert('<?php echo $this->lang->line('require_user'); ?>.');
		document.login.username.focus();
		return false;
	}
	
	if(document.login.password.value == ''){
		alert('<?php echo $this->lang->line('require_pass'); ?>.');
		document.login.password.focus();
		return false;
	}
	document.login.submit();
}
function Reset()
{
	var frm = document.login;
	frm.username.value="";
	frm.password.value="";
	return false;
}
</script>
</head>
<body onLoad="javascript:document.login.username.focus();">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  class="tableMainBackground">
        <div class="logoclass" style="height:120px;"></div>
    </td>
  </tr>
  <tr>
    <td height="100%" class="tableMainBackground" align="center" valign="middle" id="PageContent">
    	<table width="35%" border="0" cellspacing="0" cellpadding="0" class="whitebackground">
    	  <tr>
              <td align="center" valign="top" class="tableMainBackground">
                <table width="95%" align="center" border="0" cellspacing="0" cellpadding="0" class="tableMainBackground">
              <tr>
                <td align="left" class="WelcomescreenHeadingpurple">Gameday admin</td>
              </tr>
              <tr>
                <td align="center" >
                <form name="login" action="<?php echo BASE_URL."admin/login/veryfylogin";?>" method="post">
            	<input type="hidden" name="act" value="Submit">
                <table width="100%" height="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableMiddleBackground_roundedcorner">
                    <tr>
                      <td height="25" colspan="2" align="center" class="messageFont">&nbsp;<?php echo (isset($err))?$err:''; ?></td>
                    </tr>
                    <tr>
                      <td width="36%" height="25" align="right"><b><?php echo $this->lang->line('login_username'); ?>:</b></td>
                      <td width="64%" align="left"><input name="username" type="text" size="20"  class="textInput" style="width:200px;"></td>
                    </tr>
                    <tr>
                      <td height="25" align="right"><b><?php echo $this->lang->line('login_password'); ?>:</b></td>
                      <td align="left"><input name="password" type="password" size="20"  class="textInput" style="width:200px;"></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                      <td  align="left"><input name="Submit" class="button" type="submit"  onClick="return SubmitForm();" value="<?php echo $this->lang->line('Submit'); ?>"> 
                      <input type="button" class="button"  value="<?php echo $this->lang->line('Reset'); ?>" onClick="Reset();"></td>
                    </tr>
                </table>
                </form>
                </td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
            </table>
            </td>
  	    </tr>
  	  </table>
    </td>
  </tr>
</table>
</body>
</html>