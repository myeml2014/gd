// JavaScript Document
fielterArr = ["txtSearch_id"];
fielterArr = ["txtSearch_nm"];
fielterArr = ["txtSearch_email"];
function renderJson(Obj,count)
{
	jObj = Obj;
    var tbl = "";
    var counter = 0;
	var tCountry='';
	var tScat = '';
	var clsCounter = 0
    $.each(jObj,function(i, item) {
		tbl += "<tr class='"+((clsCounter%2 == 0)?"trOdd":"trEven")+"' onclick='trEdit("+item.id+",this)'>";
		tbl += "<td>"+item.id+"</td>";
		tbl += "<td  align='left'>"+item.fname+" "+item.lname+"</td>";
		tbl += "<td  align='left'>"+item.email+"</td>";
		tbl += "<td  align='left'><a href='"+BaseUrl+"admin/users/detail/"+item.id+"'>Detail</a></td>";
		tbl += "</tr>";
		clsCounter++;
    });
    if(tbl == "")
    	tbl = "<tr><td colspan='2' align='center' class='trOdd'>No Record Found.</td></tr>";
    $("#tblGrid").html(tbl);
    getPagging(hdnStart,limit,count);
}
function validate()
{
	if($("#txtCountry").val() == "")
	{
		alert(msg_country);
		$("#txtCountry").focus();
		return false;
	}
	
	return true;
}
function postFrm(pId)
{
	document.frmForm.action=BaseUrl+"admin/country/postFrm/"+pId;	
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