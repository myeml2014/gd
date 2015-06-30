// JavaScript Document
fielterArr = ["txtSearch_cat_nm","txtSearch_cat_desc"];
function renderJson(Obj,count)
{
	jObj = Obj;
    var tbl = "";
    var counter = 0;
    $.each(jObj,function(i, item) {    	
		tbl += "<tr class='"+((i%2 == 0)?"trEven":"trOdd")+"' onclick='trEdit("+item.id+",this)'>";
		tbl += "<td>"+(hdnStart+i+1)+"</td>";
		tbl += "<td>"+item.cat_name+"</td>";
		tbl += "<td>"+item.cat_desc+"</td>";
		tbl += "<td><img src='"+((item.cat_image == "" || item.cat_image == null)?BaseUrl+"images/noimage.png":BaseUrl+'images/cat_imgs/'+item.cat_image)+"'  width='50px' height='50px' ></td>";
		tbl += "<td>"+item.status+"</td>";
		tbl += "<td><input type='image' src='"+BaseUrl+"images/up.png' height='20px' onclick=\"xajax_updateOrder('up',"+item.id+")\"  />&nbsp;<input type='image' src='"+BaseUrl+"images/down.png' height='20px' onclick=\"xajax_updateOrder('down',"+item.id+")\"  /></td>";
		tbl += "</tr>";
    });
    if(tbl == "")
    	tbl = "<tr><td colspan='7' align='center' class='trOdd'>No Record Found.</td></tr>";
    $("#tblGrid").html(tbl);
    getPagging(hdnStart,limit,count);
}
function validate()
{
	if($("#txtCatNm").val() == "")
	{
		alert(msg_cat);
		$("#txtCatNm").focus();
		return false;
	}
	if($("#selIsMain").val() == "")
	{
		alert(msg_menu);
		$("#selIsMain").focus();
		return false;
	}
	if($("#selStatus").val() == "")
	{
		alert(msg_status);
		$("#selStatus").focus();
		return false;
	}
	
	return true;
}
function postFrm(catId)
{
	document.frmForm.action=BaseUrl+"admin/category/postFrm/"+catId;	
	document.frmForm.submit();
}