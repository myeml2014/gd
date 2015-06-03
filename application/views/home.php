<?php
if(!isset($content))
{
?>
<div id="section">
    		<div class="section_top_part">
                <div class="wrap">
                	<div class="row">
						<div class="wrap2">
                        	<div class="col12 fl_left"><img src="<?php echo BASE_URL;?>images/welcome-text.png" /></div>
                        </div>                
                	</div>
                	<div class="row">
                	<div class="wrap">
                    	<div class="home_text">
                        	GameDay’s paper novelty products are a perfect fit for sports, television/movies, music, historic, food, and just about any event.
<br><br>
GameDay Novelties products are also perfect for branding/promotion and our mobile phone app technology allow custom QR codes or images to be scanned by smart phones for seamless interaction
with our products and the internet allowing sponsors and advertisers to gather detailed analytics. 

<br>
SPORTS TV/MOVIES MUSIC HISTORIC FOOD MASCOT CUSTOM QR CODES
                        
                        </div>
                    </div>
                </div>
            	</div>
            </div>
            <div class="middle_section_part">
            		<div class="wrap">
                    	<div class="row">
                        		<div class="heading">Featured Products</div>
                        </div>
                        <div class="row margin_top">
                               <?php
							   $i = 0;
							   foreach($cat_id as $id)
							   {
									if(($i+1)%3 == 0)
									$is_last = " last";
									else
									$is_last = "";
									if(file_exists("images/cat_imgs/".$cat_image[$i]))
									$img_path = BASE_URL."images/cat_imgs/".$cat_image[$i];
									else
									$img_path = BASE_URL."images/noimage.png";
									
									$cat_link = BASE_URL."category/".$index_key[$i];
							   	?>
						    		<div class="col4 <?php echo $is_last;?>">
		                                <div class="row">
        		                        	<div class="radius_box">
                                    		<div class="box_img"><a href="<?php echo $cat_link;?>"><img src="<?php echo $img_path;?>" /></a></div>
                                            <div class="shop"><a href="<?php echo $cat_link;?>"><img src="<?php echo BASE_URL;?>images/shopnow.png" /></a></div>
                                    	</div>
                						</div>
                                        <div class="row">
                                        	<div class="radius_blue_box">
                                            	<div class="box_hed"><a href="<?php echo $cat_link;?>" class="box_hed"><?php echo $cat_nm[$i];?></a></div>
                                            </div>
                                        </div>
                                </div>
									
								<?php
									$i++;
								}
								?>
                        </div>
                    </div>
            </div>
    </div>
<?php
}
else
{
?>
<div id="section">
	<div class="middle_section_part">
		<div class="wrap">
			<div class="row">
			<?php echo $content; ?>
			</div>
		</div>
	</div>
</div>
<?php	 
}
?>