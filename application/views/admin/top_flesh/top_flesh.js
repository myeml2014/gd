// JavaScript Document
fielterArr = ["txtSearch_title"];
function renderJson(Obj,count)
{
	jObj = Obj;
    var tbl = "";
    var counter = 0;
    $.each(jObj,function(i, item) {    	
		tbl += "<tr class='"+((i%2 == 0)?"trEven":"trOdd")+"' onclick='trEdit("+item.id+",this)'>";
		tbl += "<td>"+(hdnStart+i+1)+"</td>";
		tbl += "<td>"+item.title+"</td>";
		tbl += "<td><img src='"+BaseUrl+'images/top_flesh/'+item.link+"' height='50' width='50' alt='No Image'></td>";
		tbl += "</tr>";
    });
    if(tbl == "")
    	tbl = "<tr><td colspan='3' align='center' class='trOdd'>No Record Found.</td></tr>";
    $("#tblGrid").html(tbl);
    getPagging(hdnStart,limit,count);
}
function validate()
{
	if($("#txtTitle").val() == "")
	{
		alert(msg_img_title);
		$("#txtTitle").focus();
		return false;
	}
	return true;
}
function postFrm(id)
{
	document.frmForm.action=BaseUrl+"admin/top_flesh/postFrm/"+id;
	document.frmForm.submit();
}