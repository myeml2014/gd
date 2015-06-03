<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Welcome to Gameday Novelties ::</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
<link href="<?php echo BASE_URL;?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASE_URL;?>css/menu-nav.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
<script src="<?php echo BASE_URL;?>js/responsiveslides.min.js"></script>
<script type="text/javascript">
$(function () {
  $("#slider4").responsiveSlides({
	auto: true,
	pager: true,
	nav: true,
	speed: 1000,
	namespace: "callbacks",
	before: function () {
	  $('.events').append("<li>before event fired.</li>");
	},
	after: function () {
	  $('.events').append("<li>after event fired.</li>");
	}
  });
});
</script>
</head>
<body>
<div id="container">
<div id="header">
    		<div class="top_header">
            		
                    <div class="wrap">
                    	<div class="row margin_top">
                        	<div class=" fl_left"><img src="<?php echo BASE_URL;?>images/bookmark.png" /></div>
                        	<div class="top_strip_text"><a href="">Bookmark us</a></div>
                            <div class="top_strip_text">|</div>
                            
                            <div class=" fl_left"><img src="<?php echo BASE_URL;?>images/rss.png" /></div>
                        	<div class="top_strip_text"><a href="">RSS</a></div>
                            <div class="top_strip_text">|</div>
                            
                            <div class=" fl_left"><img src="<?php echo BASE_URL;?>images/report_error.png" /></div>
                        	<div class="top_strip_text"><a href="">Report error</a></div>
                            <div class="top_strip_text">|</div>
                            
                            <div class=" fl_left"><img src="<?php echo BASE_URL;?>images/support.png" /></div>
                        	<div class="top_strip_text"><a href="">Support</a></div>
                            <div class="top_strip_text">|</div>
                            
                             <div class=" fl_left"><img src="<?php echo BASE_URL;?>images/profile.png" /></div>
                        	<div class="top_strip_text"><a href="">Profile</a></div>
                            <div class="top_strip_text">|</div>
                        	
                            
                             <div class=" fl_left"><img src="<?php echo BASE_URL;?>images/setting.png" /></div>
                        	<div class="top_strip_text"><a href="">Setting</a></div>
                            <div class="top_strip_text">|</div>
                            
                             <div class=" fl_left"><img src="<?php echo BASE_URL;?>images/shopping_cart.png" /></div>
                        	<div class="top_strip_text"><a href="">e-commerce shopping cart</a></div>
                            <div class="top_strip_text">|</div>
                            
                             <div class=" fl_left"><img src="<?php echo BASE_URL;?>images/client_login.png" /></div>
                        	<div class="top_strip_text"><a href="">Client Login</a></div>
                            <div class="top_strip_text">|</div>
                            
                        	<div class="top_strip_text"><a href="">Campus Ambassador</a></div>
                        </div>
                    </div>
            </div>
            
            <div class="middle_header">
            	<div class="wrap">
                	<div class="col8">
                    	<div class="logo"><img src="<?php echo BASE_URL;?>images/logo_text.png" /></div>
                    </div>
                    <div class="col46 last">
                        <div class="row">
                        	<div class="col9"><div class=" fl_left" style="width:100%;"><input type="text" class="search_box" value="search for keyword(s)..." />
                        	</div></div>
                            <div class="col3 last">
                            		<a href=""><div class="search_button">Search</div></a>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
<div class="navigation">
            <div class="wrap">
			<div class="row">
           			<div class="col99 last">
                            <div class="col1">
                            	<div class="home_icon"><a href="<?php echo BASE_URL;?>"><img src="<?php echo BASE_URL;?>images/home-icon.png" /></a></div>
                            </div>
                            <div class="col11 last">
                            		<div class="">
                <a class="toggleMenu" href="#">Menu</a>
                <ul class="nav">
                	<?php
					foreach($title as $lnk_nm)
					{
						$lnk_nm_url = str_replace("/","_",$lnk_nm);
						$lnk_nm_url = str_replace(" ","_",$lnk_nm_url);
						$lnk_nm_url = strtolower($lnk_nm_url);
					?>
						<li><a href="<?php echo BASE_URL."category/".$lnk_nm_url;?>" class=""><?php echo $lnk_nm;?></a></li>
					<?php
					}
					?>
	            </ul>
                </div>      
                      </div>
                    </div>
                    <div class="col35 last">
                            <div class="col66">
                            	<div class="row">
                                	<div class="col67 last">
                                   	  <div class="fl_left"><input type="text"  class="white_box" value=" 206781" />
                                   	  </div>
                                    </div>
                                    <div class="col67 last">
                                    	<div class="blue_box2"><div class="followers">Followers</div></div>
                                    </div>
                                </div>
                                <div class="row">
                                		<div class="hed_brd_text">B/RD Counter</div>
                                </div>
                            </div>
                            <div class="col66 last">
                            	<div class="row">
                                	<div class="col67 last">
                                   	  <div class="fl_left"><input type="text"  class="white_box" value=" 206781" />
                                   	  </div>
                                    </div>
                                    <div class="col67 last">
                                    	<div class="blue_box2"><div class="followers">Readers</div></div>
                                    </div>
                                </div>
                                <div class="row">
                                		<div class="hed_brd_text">RSS COUNTER</div>
                                </div>
                            </div>
                    </div>
					</div>
            </div>      
            </div>
           <?php
		   if($is_banner)
		   {
		   ?>
			<div class="row">
			<div class="slider">
				<div  id="top" class="callbacks_container">
			      <ul class="rslides" id="slider4">	
				  <?php
				  	foreach($bannerArr as $banner)   
					{
					?>
                    	<li><img src="<?php echo BASE_URL.'images/top_flesh/'.$banner ;?>" alt=""></li>
					<?php
					}
					?>
			      </ul>
			    </div>
			</div>
            </div>
    		<?php
			}
			?>
    </div>