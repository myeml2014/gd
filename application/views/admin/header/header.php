<!DOCTYPE html>
<html>
<head>
<title>:: Welcome to Gameday Novelties ::</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo ((isset($meta_keywords))?$meta_keywords:''); ?>">
<meta name="description" content="<?php echo ((isset($meta_description))?$meta_description:''); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/style_admin.css">
<?php echo (isset($xajax_js))?$xajax_js:'';?>
<script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
<?php
if(isset($addTinymce))
{
?>
<script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>tinymce/tinymce.min.js"></script>
<?php
}
?>
<script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/common.js"></script>
<script language="javascript">
var msg_del_conf = '<?php echo $this->lang->line('confirm_delete'); ?>';
</script>
<?php 
if(isset($module_js))
{
?>
<script language="javascript" type="text/javascript" src="<?php echo $module_js;?>"></script>
<?php
}
if(isset($onload))
{
?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	xajax_load();
});
</script>
<?php
}
?>
</head>
<body>
<div id="main" align="center">
	<div class="header">
	<div class="logo"><a href="index.php?view=adm_home"><img src="<?php echo BASE_URL;?>images/logo.png" alt="" /></a></div>
	<div class="title"><?php echo $this->lang->line('home_welcome_msg'); ?></div> 
	<div class="logout"><a href="<?php echo BASE_URL;?>admin/login/logout" class="leftMenuNor"><?php echo $this->lang->line('home_logout'); ?></a></div>
	</div>
	
	<hr style="height:1px; width:auto; color:#467caf;"></hr>
	<div class="clearfix"></div>
	
	<div style="float: left" id="my_menu" class="sdmenu">
		<div> 
			<span><?php echo $this->lang->line('home_setup'); ?></span>
			<a  href="<?php echo BASE_URL;?>admin/adminList" <?php if($this->uri->segment(2) == "adminList")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_admin_account'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/category" <?php if($this->uri->segment(2) == "category")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_category'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/sub_category" <?php if($this->uri->segment(2) == "sub_category")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_sub_category'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/product" <?php if($this->uri->segment(2) == "product")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_product'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/users" <?php if($this->uri->segment(2) == "users")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_users'); ?></a>
			<span><?php echo $this->lang->line('home_order_process'); ?></span>
			<a  href="<?php echo BASE_URL;?>admin/orders/index/pending" <?php if($this->uri->segment(2) == "orders" && $this->uri->segment(4) == "pending")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_pending_orders'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/orders/index/confirm" <?php if($this->uri->segment(2) == "orders" && $this->uri->segment(4) == "confirm")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_confirm_orders'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/orders/index/processing" <?php if($this->uri->segment(2) == "orders" && $this->uri->segment(4) == "processing")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_processing_orders'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/orders/index/qc" <?php if($this->uri->segment(2) == "orders" && $this->uri->segment(4) == "qc")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_qc_orders'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/orders/index/dispatched" <?php if($this->uri->segment(2) == "orders" && $this->uri->segment(4) == "dispatched")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_dispatched_orders'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/orders/index/delivered" <?php if($this->uri->segment(2) == "orders" && $this->uri->segment(4) == "delivered")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_delivered_orders'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/orders" <?php if($this->uri->segment(2) == "orders"  && $this->uri->segment(4) == "")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_all_orders'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/orders/index/archive" <?php if($this->uri->segment(2) == "orders" && $this->uri->segment(4) == "archive")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_archive_orders'); ?></a>
			<span><?php echo $this->lang->line('home_settings'); ?></span>
			<a  href="<?php echo BASE_URL;?>admin/country" <?php if($this->uri->segment(2) == "country")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_country'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/state" <?php if($this->uri->segment(2) == "state")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_state'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/attribute" <?php if($this->uri->segment(2) == "attribute")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_attribute'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/top_flesh" <?php if($this->uri->segment(2) == "top_flesh")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_top_flesh'); ?></a>
			<a  href="<?php echo BASE_URL;?>admin/footer_links" <?php if($this->uri->segment(2) == "footer_links")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_footer_links'); ?></a>
			
			
			<?php
			if($this->session->userdata('user_id') == '-1')
			{
			?>
			<a  href="<?php echo BASE_URL;?>admin/main_menu_list" <?php if($this->uri->segment(2) == "main_menu_list")echo 'style="background-color: #066;color: #FFF;";'?>><?php echo $this->lang->line('home_main_menu'); ?></a>
			
			<?php
			}
			?>
		</div>
	</div>
   <div id="right-main" align="center">