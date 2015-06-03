<div class="wrap">
	<div class="row">
    		<div class="col37">
            		<div class="left_product_bg">
							<?php
							$i=0;
							$j=1;
							$catNm = '';
							$str= '';
							$SstrOdd = '';
							$SstrEven = '';
							$selectedCatArr = array();
							foreach($cid as $id)
							{
							
								if($catNm != $cname[$i])
								{
									if($catNm !='')
									{
										$SstrEven .= '</div></div>';
										$SstrOdd .= '</div></div>';
										$str .= $SstrOdd;
										$str .= $SstrEven;
										$SstrEven = '';
										$SstrOdd ='';
										$j=1;
										$str .= '</div>';
										$str .= '</div>';
										$str .= '<div class="row"><div class="border_middle2">&nbsp;</div></div>';
									}
									$catNm = $cname[$i];
									$str .= '<div class="row">';
									$str .= '<div class="row">';
									$str .= '<div class=" hed_text3" onclick="javascript:location.href=\''.BASE_URL.'category/'.$ckey[$i].'\'">'.$cname[$i].'</div>';
									$str .= '</div>';
									$str .= '<div class="row">';
									
									$SstrEven .= '<div class="col67 last">';
									$SstrEven .= '<div class="reg_text3">';
									
									$SstrOdd .= '<div class="col67">';
									$SstrOdd .= '<div class="reg_text3">';
									
								}
								if($j%2==0)
								{
									$SstrEven .= '<a href="'.BASE_URL.'category/'.$skey[$i].'">'.$sname[$i].'</a><br />';
								}
								else
								{
									$SstrOdd .= '<a href="'.BASE_URL.'category/'.$skey[$i].'">'.$sname[$i].'</a><br />';
								}
								if($ckey[$i] == $page)
								{
									$selectedCatArr[] = $i;
								}
								$i++;
								$j++;
							}
							$SstrEven .= '</div></div>';
							$SstrOdd .= '</div></div>';
							$str .= $SstrEven;
							$str .= $SstrOdd;
							$SstrEven = '';
							$SstrOdd ='';
							$str .= '</div>';
							$str .= '</div>';
							$str .= '<div class="row"><div class="border_middle2">&nbsp;</div></div>';
							echo $str;
							?>
                    </div>
            </div>
            <div class=" col9-1 last">
                 <div class="row"> 
				 
                   <div class="row">
							<?php
							$flgLast = 1;
							if($parentId == 0)
							{
								foreach($selectedCatArr as $ind)
								{
									$cls = '';
									if($flgLast%3 == 0)
										$cls = 'last';
								?>
								<div class="col48 <?php echo $cls;?>">
										<div class="prod_img_bg">
												<div class="row">
													<div class="prod_img" onclick="javascript:location.href='<?php echo BASE_URL.'category/'.$skey[$ind]; ?>'"><img src="<?php echo ((is_file(IMAGE_PATH.'cat_imgs/'.$simg[$ind]))?BASE_URL.'images/cat_imgs/'.$simg[$ind]:BASE_URL.'images/noimage.png');?>" style="height:263px;width:263px;" /></div>
												</div>
												
												<div class="row margin_top">
												
													<div class="col33-1"><div class="hed_text4" onclick="javascript:location.href='<?php echo BASE_URL.'category/'.$skey[$ind]; ?>'"><?php echo $sname[$ind];?></div></div>
													
													<div class="col9-2 last">
														<a href="<?php echo BASE_URL.'category/'.$skey[$ind]; ?>"><div class="shop_button">Shop Now</div></a>
													</div>
													
												</div>
												
												<div class="row margin_top">
													<div class="reg_text4"><?php echo $sdesc[$ind];?></div>
												</div>          
										</div>
								</div>
								<?php
									$flgLast++;
								}
							}
							else
							{
								$j=0;
								foreach($product as $val)
								{
									$cls = '';
									if($flgLast%3 == 0)
										$cls = 'last';
									$attrVal = explode(",",$val->attr);
									$attrValArr = array();
									foreach($attrVal as $av)
									{
										$avArr = explode("#",$av);
										$attrValArr[$avArr[0]] = $avArr[1];
										unset($avArr);
									}
								?>
									<div class="col48 <?php echo $cls;?>">
											<div class="prod_img_bg">
													<div class="row">
														<div class="prod_img" onclick="javascript:location.href='<?php echo BASE_URL.'product/'.$val->pkey; ?>'"><img src="<?php echo ((is_file(IMAGE_PATH.'p_imgs/'.$val->pId.'/'.$val->pimg))?BASE_URL.'images/p_imgs/'.$val->pId.'/'.$val->pimg:BASE_URL.'images/noimage.png');?>" style="height:263px;width:263px;" /></div>
													</div>
													<div class="row margin_top">
														<div class="col8 last">
                                                		<div class="reg_text" onclick="javascript:location.href='<?php echo BASE_URL.'product/'.$val->pkey; ?>'">
                                                        	<?php echo $val->p_name;?><br>
                                                            Size: <?php echo $attrValArr[$attribute['Size']];?> <br>
                                                            Price: $<?php echo $attrValArr[$attribute['Price']]; ?>
                                                        </div>
														</div>
														<div class="col4-1 last">
															<a href="<?php echo BASE_URL.'product/'.$val->pkey; ?>"><div class="addto_cart">ADD TO CART</div></a>
														</div>
													</div>         
											</div>
									</div>
								<?php
									$flgLast++;
									$j++;
								}
							}
							?>
                    </div>
            </div>
    </div>
</div>