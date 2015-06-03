// JavaScript Document
fielterArr = ["txtSearch_menu_title","txtSearch_menu_link"];
function renderJson(Obj,count)
{
	jObj = Obj;
    var tbl = "";
    var counter = 0;
    $.each(jObj,function(i, item) {    	
		tbl += "<tr class='"+((i%2 == 0)?"trEven":"trOdd")+"' onclick='trEdit("+item.id+",this)'>";
		tbl += "<td>"+(hdnStart+i+1)+"</td>";
		tbl += "<td>"+item.id+"</td>";
		tbl += "<td>"+item.menu_title+"</td>";
		tbl += "<td>"+item.menu_link+"</td>";
		tbl += "<td>"+item.staticordynamic+"</td>";
		tbl += "<td>"+item.activeornot+"</td>";
		tbl += "<td>"+item.lang+"</td>";
		tbl += "</tr>";
    });
    if(tbl == "")
    	tbl = "<tr><td colspan='7' align='center' class='trOdd'>No Record Found.</td></tr>";
    $("#tblGrid").html(tbl);
    getPagging(hdnStart,limit,count);
}
function validate()
{
	$("#txtContent").val(tinyMCE.get("txtContent").getContent());
	return true;
}
function setTinyMceVal(contentVal)
{
	tinyMCE.get("txtContent").setContent(contentVal);
}