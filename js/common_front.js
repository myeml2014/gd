/*
Common javascript for front side..
*/
function goTocart(url)
{
	location.href=BaseUrl+"cart/index/"+url;
}
function searchProduct()
{
	var val = $("#txtHeadSearch").val();
	location.href=BaseUrl+"category/search/"+val;
}
function filter(e)
{
	if(e.keyCode == 13)
	{
		searchProduct();
	}
}
function searchTxtFocus(flg)
{
	if (flg == 1) {
		$("#txtHeadSearch").val('');
		return;
	}
	else if($("#txtHeadSearch").val() == ""){
		$("#txtHeadSearch").val('search for keyword(s)...');
		return;
	}
}