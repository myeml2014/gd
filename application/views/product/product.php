<div id="section">
<div class="wrap">		
<div class="row mar_top">
    <div class="col36">
    		<div class="row">
            		<div class="hed_text"><?php echo $p_name; ?></div>
            </div>
            <div class="row">
            	<div class="reg_text"><?php echo $p_desc; ?></div>
            </div>
            <div class="row">
            	<div class="list2">
                	<ul>
                    	<li><a href="">Product Details</a></li>
                        <li><a href="">Print Page</a></li>
                        <li><a href="">Imprint Area</a></li>
                        <li><a href="">Your Art</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
            	<a href=""><div class="request_button">Request a Sample</div></a>
            </div>
            <div class="row mar_top">
            	<div class="reg_text">We're happy to send you FREE samples so you can see this product before you order!</div>
            </div>
    </div>    
	<div class="col5">
                    <?php
                    $pimgsArr = explode(",",$pimgs);
                    ?>
                	<div class="row">
                    	<div class="targetarea"><img id="multizoom1" alt="zoomable" title="" src="<?php echo (is_file(IMAGE_PATH.'p_imgs/'.$pId.'/'.$pimgsArr[0]))?BASE_URL.'images/p_imgs/'.$pId.'/'.$pimgsArr[0]:BASE_URL.'images/noimage.png';?>"/></div>
                  </div>
                	<div class="row">
                    	<div class="multizoom1 thumbs">
                        <?php
                        foreach($pimgsArr as $img)
                        {
                        ?>
                        <div class="col21">
							<div class="fl_left">
								<a href="<?php echo (is_file(IMAGE_PATH.'p_imgs/'.$pId.'/'.$img))?BASE_URL.'images/p_imgs/'.$pId.'/'.$img:BASE_URL.'images/noimage.png';?>" data-large="<?php echo (is_file(IMAGE_PATH.'p_imgs/'.$pId.'/'.$img))?BASE_URL.'images/p_imgs/'.$pId.'/'.$img:BASE_URL.'images/noimage.png';?>" data-title="" ><img src="<?php echo (is_file(IMAGE_PATH.'p_imgs/'.$pId.'/'.$img))?BASE_URL.'images/p_imgs/'.$pId.'/'.$img:BASE_URL.'images/noimage.png';?>" alt="" title="" />
								</a>
							</div>
                         </div>
                        <?php
                        }
                        ?>
                         
                         <div class="col21 last">&nbsp;</div>     
						</div>
					</div>
                </div>
    <div class="col47 last">
                		<div class="row">
                        	<div class="reg_text">Item #113680</div>
                        </div>
                        <div class="row">
                        	<div class="right_gray_color">
                        			<div class="row">
                                        <div class=" hed_text2">1. Choose Color</div>
                                    </div>
                                    <div class="helmet_box_bg">
                                    	<div class="row">
                                        		<div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Black</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/3_1.png" /></div>
                                                    <div class="helmet_color_text">Red</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Maroon</div>
                                                </div>
                                                <div class="col37 last">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">White</div>
                                                </div>
                                        </div>	
                                        <div class="row">
                                        		<div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Red</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Black</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Maroon</div>
                                                </div>
                                                <div class="col37 last">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">White</div>
                                                </div>
                                        </div>
                                        <div class="row">
                                        		<div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Red</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Black</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Maroon</div>
                                                </div>
                                                <div class="col37 last">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">White</div>
                                                </div>
                                        </div>
                                        <div class="row">
                                        		<div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Red</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Black</div>
                                                </div>
                                                <div class="col37">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">Maroon</div>
                                                </div>
                                                <div class="col37 last">
                                                	<div class="color_helmet"><img src="images/products/helmet.png" /></div>
                                                    <div class="helmet_color_text">White</div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row mar_top">
                                    	<div class="row">
                                        	<div class=" hed_text2">2. Enter Quantity or Glide</div>
                                    	</div>
                                        <div class="row">
                                        	<div class="reg_text">For prices, enter the quantity you'd to click.</div>
                                        </div>
                                        <div class="row">
                                            <div class="col67 ">
                                              <div class="row"><div class="reg_text">Quantity</div></div>
                                              <div class="row"><div class="fl_left"><input type="text"  class="white_box" value=" 206781" /></div></div>
                                              <div class="row"><div class="reg_text2">Enter the quantity you'd like, or click and drag our orange 'i' to find a quantity and price that’s best for you.</div></div>
                                            </div>
                                            <div class="col67 last">
                                              <div class="row"><div class="reg_text">Price Each</div></div>
                                              <div class="row"><div class="fl_left"><input type="text"  class="white_box" value=" 206781" /></div></div>
                                              <div class="row"><div class="reg_text2">Enter the quantity you'd like, or click and drag our orange 'i' to find a quantity and price that’s best for you.</div></div>
                                            </div>
                                        </div>
                                    <div class="row">
                                    	<a href=""><div class="next_button">Next</div></a>
                                    </div>                                    
                        	</div>
                        </div>
    </div>
</div>
<div class="row mar_top">
    <div class="row">
    	<div class="hed_text">Products Details</div>
    </div>
    <div class="row">
    	<div class="border_middle">&nbsp;</div>
    </div>
    <div class="row">
    	<div class="list3">
        	<?php echo $full_desc;?>
        </div>
    </div>
    <div class="row">
    	<div class="reg_text">
        </div>
    </div>
</div>            
</div>            
</div>