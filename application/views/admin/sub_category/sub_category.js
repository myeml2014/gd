// JavaScript Document
fielterArr = ["txtSearch_cat_nm","txtSearch_sub_cat_nm","txtSearch_cat_desc"];
function renderJson(Obj,count)
{
	var tmp = "";
	jObj = Obj;
    var tbl = "";
    var counter = 0;
	var j=0;
    $.each(jObj,function(i, item) {    	
		
		if(tmp != item.cat_name)
		{
			tmp = item.cat_name;
			tbl += "<tr class='trEven'>";
			tbl += "<td></td>";
			tbl += "<td colspan='6'>"+item.cat_name+"</td>";
			tbl += "<tr>";
			j=1;
		}
		tbl += "<tr class='"+((j%2 == 0)?"trEven":"trOdd")+"' onclick='trEdit("+item.id+",this)'>";
		tbl += "<td>"+(hdnStart+i+1)+"</td>";
		tbl += "<td></td>";
		tbl += "<td>"+item.sub_cat_name+"</td>";
		tbl += "<td>"+item.cat_desc+"</td>";
		tbl += "<td><img src='"+((item.cat_image == "" || item.cat_image == null)?BaseUrl+"images/noimage.png":BaseUrl+'images/cat_imgs/'+item.cat_image)+"'  width='50px' height='50px' ></td>";
		tbl += "<td>"+item.status+"</td>";
		tbl += "<td><input type='image' src='"+BaseUrl+"images/up.png' height='20px' onclick=\"xajax_updateOrder('up',"+item.id+")\"  />&nbsp;<input type='image' src='"+BaseUrl+"images/down.png' height='20px' onclick=\"xajax_updateOrder('down',"+item.id+")\"  /></td>";
		tbl += "</tr>";
		j++
    });
    if(tbl == "")
    	tbl = "<tr><td colspan='7' align='center' class='trOdd'>No Record Found.</td></tr>";
    $("#tblGrid").html(tbl);
    getPagging(hdnStart,limit,count);
}
function validate()
{
	if($("#txtSubCatNm").val() == "")
	{
		alert(msg_sub_cat);
		$("#txtSubCatNm").focus();
		return false;
	}
	if($("#selCat").val() == "")
	{
		alert(msg_cat);
		$("#selCat").focus();
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
	document.frmForm.action=BaseUrl+"admin/sub_category/postFrm/"+catId;	
	document.frmForm.submit();
}