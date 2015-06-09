// JavaScript Document
fielterArr = ["txtSearch_p_nm","txtSearch_p_desc"];
function renderJson(Obj,count)
{
	jObj = Obj;
    var tbl = "";
    var counter = 0;
	var tCat='';
	var tScat = '';
	var clsCounter = 0
    $.each(jObj,function(i, item) {    	
		
		if(tCat != item.cat)
		{
			tCat = item.cat
			clsCounter = 0;
			tbl += "<tr class='trEven'>";
			tbl += "<td></td>";
			tbl += "<td colspan='6' align='left'><span class='errMsg'>"+item.cat+"</span></td>";
			tbl += "</tr>";
		}
		if(tScat != item.sub_cat)
		{
			tScat = item.sub_cat
			clsCounter = 0;
			tbl += "<tr class='trEven'>";
			tbl += "<td></td>";
			tbl += "<td></td>";
			tbl += "<td colspan='5' align='left'><strong>"+item.sub_cat+"</strong></td>";
			tbl += "</tr>";
		}
		
		
		tbl += "<tr class='"+((clsCounter%2 == 0)?"trOdd":"trEven")+"' onclick='trEdit("+item.id+",this)'>";
		tbl += "<td>"+(hdnStart+i+1)+"</td>";
		
		tbl += "<td></td>";
		tbl += "<td></td>";
		tbl += "<td>"+item.p_name+"</td>";
		tbl += "<td><input type='checkbox' name='checkbox' value='"+item.id+"' onclick='xajax_setFeatureProduct(this.value,this.checked)' "+((item.is_feature_p == 1)?"checked":"")+"></td>";
		tbl += "<td>"+item.status+"</td>";
		tbl += "<td><input type='image' src='"+BaseUrl+"images/up.png' height='20px' onclick=\"xajax_updateOrder('up',"+item.id+")\"  />&nbsp;<input type='image' src='"+BaseUrl+"images/down.png' height='20px' onclick=\"xajax_updateOrder('down',"+item.id+")\"  /></td>";
		tbl += "</tr>";
		clsCounter++;
    });
    if(tbl == "")
    	tbl = "<tr><td colspan='7' align='center' class='trOdd'>No Record Found.</td></tr>";
    $("#tblGrid").html(tbl);
    getPagging(hdnStart,limit,count);
}
function validate()
{
	if($("#selCat").val() == "")
	{
		alert(msg_cat);
		$("#selCat").focus();
		return false;
	}
	if($("#selSubCat").val() == "")
	{
		alert(msg_sub_cat);
		$("#selSubCat").focus();
		return false;
	}
	if($("#txtPNm").val() == "")
	{
		alert(msg_p);
		$("#txtPNm").focus();
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
function postFrm(pId)
{
	document.frmForm.action=BaseUrl+"admin/product/postFrm/"+pId;	
	document.frmForm.submit();
}
function addMoreImg()
{
	var Old = $("#spImg").html();
	var nId = getMaxFileId();
	if(nId>5)
	{
		alert("You can not upload more than 5 Images.");
		return false;
	}
	Old += '<p><input type="file" id="img_'+nId+'" name="img_'+nId+'">&nbsp;&nbsp;<img src="'+BaseUrl+'images/noimage.png" id="tImg_'+nId+'" name="tImg_'+nId+'" width="30"></p>';
	$("#spImg").html(Old);
}
function getMaxFileId()
{
	var max = 0;
	$("[type='file']").each(function(index,obj) { 
		var tmp = (obj.id).split('_');
		var tmp1 = parseInt(tmp[1]);
		if(tmp1>max)
			max = tmp1;
	});
	return max+1;
}
function setTinyMceVal(contentVal)
{
	tinyMCE.get("txtFullDesc").setContent(contentVal);
}