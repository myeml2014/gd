// JavaScript Document
fielterArr = ["txtSearch_nm","txtSearch_product","txtSearch_qty","txtSearch_total","txtSearch_status"];
function renderJson(Obj,count)
{
	jObj = Obj;
    var tbl = "";
    var counter = 0;
	var tCountry='';
	var tScat = '';
	var clsCounter = 0
    $.each(jObj,function(i, item) {    	
		
		clsCounter = 0;
		tbl += "<tr class='"+((clsCounter%2 == 0)?"trOdd":"trEven")+"' >";
		tbl += "<td>"+(hdnStart+i+1)+"</td>";
		tbl += "<td  align='left'>"+item.name+"</td>";
		tbl += "<td  align='left'>"+item.p_name+"</td>";
		tbl += "<td  align='left'>"+item.p_qty+"</td>";
		tbl += "<td  align='left'>"+item.order_amount+"</td>";
		tbl += "<td  align='left'>"+item.order_status+"</td>";
		tbl += "<td  align='left'><a href='"+BaseUrl+"admin/orders/detail/"+item.id+"/"+page+"'>Detail</a></td>";
		tbl += "</tr>";
		clsCounter++;
    });
    if(tbl == "")
    	tbl = "<tr><td colspan='6' align='center' class='trOdd'>No Record Found.</td></tr>";
    $("#tblGrid").html(tbl);
    getPagging(hdnStart,limit,count);
}