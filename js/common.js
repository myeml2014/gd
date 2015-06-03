/*by jig*/
var hdnStart = 0;
var jObj;
var limit = 10;
var fielterArr = [];
function fnadd()
{
	getFormPop(1);
	$("form :input").attr("disabled",false);
	//$("#btnAdd").attr("disabled",true);
	$("#btnAdd").removeClass("button");
	$("#btnAdd").addClass("disbutton");
	$("#btnEdit").attr("disabled",true);
	$("#btnEdit").removeClass("button");
	$("#btnEdit").addClass("disbutton");
	$("#btnDelete").attr("disabled",true);
	$("#btnDelete").removeClass("button");
	$("#btnDelete").addClass("disbutton");
	$("#btnReset").removeClass("disbutton");
	$("#btnReset").addClass("button");
	$("tr").removeClass("trSelected");
	$("#act").val("ADD");
}
function fnreset()
{
	$("form [type = 'text']").val("");
	$("form [type = 'password']").val("");
	$("form textarea").val("");
	$("form select").val("");
	$("form [type = 'checkbox']").attr("checked",false);
	$("form [type = 'radio']").attr("checked",false);
	
	$("form :input").attr("disabled",true);
	
	$("#btnAdd").attr("disabled",false);
	$("#btnAdd").removeClass("disbutton");
	$("#btnAdd").addClass("button");
	
	$("#btnEdit").removeClass("button");
	$("#btnEdit").addClass("disbutton");

	$("#btnDelete").removeClass("button");
	$("#btnDelete").addClass("disbutton");
	
	$("#btnReset").removeClass("button");
	$("#btnReset").addClass("disbutton");
	$("tr").removeClass("trSelected");
	hdnStart = 0;
	getFormPop(0);
}
function trEdit(id,trObj)
{
	$("#pkId").val(id);
	$("tr").removeClass("trSelected");
	$(trObj).addClass("trSelected");
	
	$("#btnAdd").attr("disabled",true);
	$("#btnAdd").removeClass("button");
	$("#btnAdd").addClass("disbutton");
	$("#btnEdit").attr("disabled",false);
	$("#btnEdit").removeClass("disbutton");
	$("#btnEdit").addClass("button");
	$("#btnDelete").attr("disabled",false);
	$("#btnDelete").removeClass("disbutton");
	$("#btnDelete").addClass("button");
	$("#btnReset").attr("disabled",false);
	$("#btnReset").removeClass("disbutton");
	$("#btnReset").addClass("button");
	xajax_setForm(id)
}
function fndelete()
{
	if(!confirm(msg_del_conf))
	{
		return false;
	}
	xajax_delete($("#pkId").val());
}
function fnedit()
{
	getFormPop(1);
	$("form :input").attr("disabled",false);
	//$("#btnAdd").attr("disabled",true);
	$("#btnAdd").removeClass("button");
	$("#btnAdd").addClass("disbutton");
	$("#btnEdit").attr("disabled",true);
	$("#btnEdit").removeClass("button");
	$("#btnEdit").addClass("disbutton");
	$("#btnDelete").attr("disabled",true);
	$("#btnDelete").removeClass("button");
	$("#btnDelete").addClass("disbutton");
	$("#btnReset").attr("disabled",false);
	$("#btnReset").removeClass("disbutton");
	$("#btnReset").addClass("button");
	$("#act").val("EDIT");
}
function fnsave()
{
	if(!validate())
		return false;
    if($("#act").val() == "ADD")
	xajax_save(xajax.getFormValues('frmForm'));
	else if($("#act").val() == "EDIT")
	xajax_edit($("#pkId").val(),xajax.getFormValues('frmForm'));
}
function getFormPop(flg)
{
	var elm = document.getElementById("mask");
	if(flg ==1)
	{ 
		elm.style.width='100%';
		elm.style.height='100%';
		elm.style.display="";
	}
	else
	{
		elm.style.width=0;
		elm.style.height=0;
		elm.style.display="none";
	}
}
function fnfilter(e)
{
	if(e.keyCode==13)
	{
		var param='';
		var sap = '';
		for(i=0;i<fielterArr.length;i++){
			param += sap+$("#"+fielterArr[i]).val();
			sap = ',';
		}
		xajax_load(0,param);
	}
	return false;
}
function getPagging(intCurrent, intLimit, intTotal)
{
	intPage = intCurrent / intLimit;
	intLastPage = Math.floor( parseFloat(intTotal) / parseFloat(intLimit));
	strResult = '<div id="pagger">';
	if(intCurrent != 0) // Not First Page
	{
		strResult += '<a href="#" onclick="paging('+(intCurrent-intLimit)+')">';
		strResult += '<span class="previous_next">&laquo; Previous</span></a>';
	}
	else
	{
		strResult += '<a href="#" class="disabled"><span class="previous_next">&laquo; Previous</span></a>';
	}
	
	if(intLastPage < 6) // Total pages less then 7
	{
		for(i=0;i<intTotal;i+=intLimit)
		{
			if((i/intLimit) == intPage)
			{
				strResult += '<a href="#" class="selected">';
				strResult += ((i / intLimit)+1);
				strResult += '</a>';
			}
			else
			{
				strResult += '<a href="#" onclick="paging('+i+')">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
		}
	}
	else if(intPage < 6) // Current Page From First 6 Pages
	{
		for(i=0;i<((intPage+2)*intLimit);i+=intLimit)
		{
			if((i/intLimit) == intPage)
			{
				strResult += '<a href="#" class="selected">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
			else
			{
				strResult += '<a href="#" onclick="paging('+i+')">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
		}
		strResult += '<input id="searchtext1" type="text" ';
		strResult += 'onkeypress="return searchpage(this.value,'+intLimit+','+intLastPage+',event.keyCode);" />';
		for(i=((intLastPage*intLimit) - intLimit);i<=intTotal;i+=intLimit)
		{
			strResult += '<a href="#" onclick="paging('+i+')">';
			strResult += ((i/intLimit)+1);
			strResult += '</a>';
		}
	}
	else if(intPage > (intLastPage - 5)) // Current Page From Last 6 Pages
	{
		for(i=0;i<(2*intLimit);i+=intLimit)
		{
			if((i/intLimit) == intPage)
			{
				strResult += '<a href="#" class="selected">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
			else
			{
				strResult += '<a href="#" onclick="paging('+i+')">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
		}
		strResult += '<input id="searchtext1" type="text" ';
		strResult += 'onkeypress="return searchpage(this.value,'+intLimit+','+intLastPage+',event.keyCode);" />';
		for(i=((intPage-2)*intLimit);i<intTotal;i+=intLimit)
		{
			if((i/intLimit) == intPage)
			{
				strResult += '<a href="#" class="selected">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
			else
			{
				strResult += '<a href="#" onclick="paging('+i+')">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
		}
	}
	else if(intPage <= (intLastPage - 5)) // Current Page Between First 6 Pages and Last 6 Pages
	{
		for(i=0;i<(2*intLimit);i+=intLimit)
		{
			strResult += '<a href="#" onclick="paging('+i+')">';
			strResult += ((i/intLimit)+1);
			strResult += '</a>';
		}
		strResult += '<input id="searchtext1" type="text" ';
		strResult += 'onkeypress="return searchpage(this.value,'+intLimit+','+intLastPage+',event.keyCode);" />';
		for(i=((intPage-2)*intLimit);i<((intPage+2)*intLimit);i+=intLimit)
		{
			if((i/intLimit) == intPage)
			{
				strResult += '<a href="#" class="selected">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
			else
			{
				strResult += '<a href="#" onclick="paging('+i+')">';
				strResult += ((i/intLimit)+1);
				strResult += '</a>';
			}
		}
		strResult += '<input id="searchtext2" type="text" ';
		strResult += 'onkeypress="return searchpage(this.value,'+intLimit+','+intLastPage+',event.keyCode);" />';
		for(i=((intLastPage*intLimit) - intLimit);i<intTotal;i+=intLimit)
		{
			strResult += '<a href="#" onclick="paging('+i+')">';
			strResult += ((i/intLimit)+1);
			strResult += '</a>';
		}
	}
	
	if((intCurrent+intLimit) < intTotal) // Not First Page
	{
		strResult += '<a href="#" onclick="paging('+(intCurrent+intLimit)+')">';
		strResult += '<span class="previous_next">Next &raquo;</span></a>';
	}
	else
	{
		strResult += '<a href="#" class="disabled"><span class="previous_next">Next &raquo;</span></a>';
	}
	strResult += '</div>';
	
	document.getElementById("divTopPagging").innerHTML = strResult;
	document.getElementById("divBottomPagging").innerHTML = strResult;
}
function paging(intStart)
{
	var param='';
	var sap = '';
	for(i=0;i<fielterArr.length;i++){
		param += sap+$("#"+fielterArr[i]).val();
		sap = ',';
	}
	hdnStart = intStart;
	xajax_load(intStart,param);
}
function jObjCount(Obj)
{
	var count = 0;
	$.each(Obj, function(i, item) {
		count++;
	});
	return count;
}
function validEmail(strEmail)
{	
	if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
		return true;
	else
		return false;
}