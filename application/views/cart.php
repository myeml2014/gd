<script language="javascript">
var IMAGE_PATH = '<?php echo IMAGE_PATH;?>';
var BASE_URL = '<?php echo BASE_URL;?>';
var bakUrl = '<?php echo $bakUrl;?>';
var finalTotal = 0;
function renderJson(Obj)
{
	var tbl = '';
	var clsCounter = 0;
	var finalTotal = 0;
    $.each(Obj,function(i, item) {    	
		tbl += '<tr>';
		tbl += '<td height="100" align="center" valign="middle" class="reg_text"><div align="center"><img src="'+BASE_URL+'images/p_imgs/'+item.p_id+'/'+item.img_path+'" width="50%;"></div></td>';
		tbl += '<td align="center" valign="middle" class="reg_text"><div align="center">RED</div></td>';
		tbl += '<td align="center" valign="middle" class="reg_text"><div align="center">'+item.p_name+'</div></td>';
		tbl += '<td align="center" valign="middle" class="reg_text"><div align="center">'+item.price+'</div></td>';
		tbl += '<td align="center" valign="middle" class="reg_text"><div align="center"><input type="text" size="1" value="'+item.cnt+'" ></div></td>';
		tbl += '<td align="center" valign="middle" class="reg_text"><div align="center">'+item.p_total+'</div></td>';
		tbl += '<td align="center" valign="middle" class="reg_text">&nbsp;&nbsp;<input type="button" value="Delete" class="submit-but" onclick="xajax_removeFromCart('+item.p_id+',\''+bakUrl+'\')"></td>';
		tbl += "</tr>";
		finalTotal = finalTotal + parseInt(item.p_total);
		clsCounter++;
    });
    $("#tblGrid").html(tbl);
	$("#spSubTot").html(finalTotal);
	$("#spTot").html(finalTotal);
}
</script>
<div id="section">
<div class="wrap">
		<div class="row">
        	<div class="inner_hed_text">SHOPPING CART</div>
        </div>
        <div class="row mar_top">
			<div class="row" align="centre">
				<span class="alertmsg">
					<?php if($this->session->flashdata('msg')){echo "<br>".$this->session->flashdata('msg')."<br><br>";}  ?>
				</span>
			</div>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                <thead>
					<tr>
					  <td width="14%" height="40" align="center" valign="middle" bgcolor="#f2f2f2" class="reg_text"><div align="center">Image</div></td>
					  <td width="14%" align="center" valign="middle" bgcolor="#f2f2f2" class="reg_text"><div align="center">Color</div></td>
					  <td width="37%" align="center" valign="middle" bgcolor="#f2f2f2" class="reg_text"><div align="center">Product Name</div></td>
					  <td width="7%" align="center" valign="middle" bgcolor="#f2f2f2" class="reg_text"><div align="center">Price</div></td>
					  <td width="7%" align="center" valign="middle" bgcolor="#f2f2f2" class="reg_text"><div align="center">QTY</div></td>
					  <td width="12%" align="center" valign="middle" bgcolor="#f2f2f2" class="reg_text"><div align="center">Sub Total</div></td>
					  <td width="9%" align="center" valign="middle" bgcolor="#f2f2f2" class="reg_text"><div align="center">Delete</div></td>
					</tr>
					<tr>
					  <td colspan="7" align="center" class="reg_text">&nbsp;</td>
					</tr>
				</thead>
				<tbody id="tblGrid">
				</tbody>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right"><table width="9%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div class="submit-but">Update</div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="right" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" class="reg_text">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                </tr>
                <tr>
                  <td width="14%" align="center" bgcolor="#CCCCCC" class="reg_text"><div align="center"></div></td>
                  <td width="14%" align="center" valign="top" bgcolor="#CCCCCC" class="reg_text"><div align="center"></div></td>
                  <td width="17%" align="center" valign="top" bgcolor="#CCCCCC" class="reg_text"><div align="center"></div></td>
                  <td width="19%" align="center" valign="top" bgcolor="#CCCCCC" class="reg_text"><div align="center"></div></td>
                  <td width="34%" align="right" valign="top" bgcolor="#CCCCCC" class="reg_text"><div align="right"><strong>Sub Total: <?php echo CURRENCY;?> <span id="spSubTot"></span></strong></div></td>
                  <td width="2%" align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text"><div align="center"></div></td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text"><div align="right"><strong>Total: <?php echo CURRENCY;?> <span id="spTot"></span></strong></div></td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="center" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                  <td align="right" valign="top" bgcolor="#CCCCCC" class="reg_text">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="35" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                  	<div class=" col38">&nbsp;</div>
                  	<div class="col38">
						<input type="button" value="Continue Shopping" onclick="location.href='<?php echo BASE_URL.str_replace("slesh","/",$bakUrl);?>'" class="submit-but3">
                    </div>
                    <div class="col38">
						<input type="button" value="Proceed To Checkout" onclick="location.href='<?php echo BASE_URL.'order/';?>'" class="submit-but3">
                    </div>
                    <div class="col38 last">&nbsp;</div>
					</td>
                </tr>
              </table>
			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                <tr>
                  <td height="35" align="left" valign="middle" bgcolor="#F2F2F2"><span class="reg_text3">&nbsp;COUPAN CODE</span></td>
                </tr>
                <tr>
                  <td height="150" align="center" valign="middle"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" class="reg_text"><div align="center">If you have a coupan code, enter in the box below and click &quot;Go&quot;.</div></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="74%" align="center" valign="middle"><label></label>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="right"><label>
                                    <input type="text" name="textfield" id="textfield" class="text_field5">
                                  </label></td>
                                </tr>
                            </table></td>
                          <td width="26%" height="30" align="center"><a href="#"><div class="submit-but">Go</div></a></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
      </div>
		<div class="row">
        	<div class="col6">
            </div>
            <div class="col6 last">
            </div>
        </div>
</div>
</div>