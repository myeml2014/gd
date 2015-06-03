<div id="footer">
	<div class="wrap">
    	
        	<div class="col33">
            	<div class="list">
                	<ul>
                    	<?php
						$i = 0;
						foreach($link_title as $nm)
						{
							$fUrl = BASE_URL."footer_links/".$index_key[$i];
						?>
							<li><a href="<?php echo $fUrl;?>"><?php echo $nm;?></a></li>
                       	<?php
							$i++;
						}
					   	?>
                    </ul>
                </div>
            </div>
            <div class="col6">
                <div class="row">
                	<div class="footer_middle_text">
                                201 RITCHIE ROAD, B-2 <BR />
                                CAPITOL HEIGHTS, MARYLAND 20748 <BR />
                           		<span class="footer_middle_text_hed">301-324-7825</span>
                    </div>
                </div>
                <div class="row margin_left">
                    <div class="social_icon"><img src="<?php echo BASE_URL;?>images/facebook.png" /></div>
                    <div class="social_icon"><img src="<?php echo BASE_URL;?>images/twitter.png" /></div>
                    <div class="social_icon"><img src="<?php echo BASE_URL;?>images/youtube.png" /></div>	
                </div>
                <div class="row">
                	<div class="copyright_text">Copyright 2014 GameDay Novelties. Site by Tisengine SEO. All Rights Reserved.</div>
                </div>
            </div>
            <div class="col34 last">
            		<div class="footer_logo"><img src="<?php echo BASE_URL;?>images/footer_logo.png" /></div>
            </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/script.js"></script>
</body>
</html>