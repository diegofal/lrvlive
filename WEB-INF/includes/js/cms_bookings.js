function expand(id)
{
	ID2 = document.getElementById("expand_"+id);
	ID1 = document.getElementById("colapse_"+id);
	if (ID1 && ID2)
	{
		ID1.style.display = "none";
		ID2.style.display = "";
	}
}

function colapse(id)
{
	ID1 = document.getElementById("expand_"+id);
	ID2 = document.getElementById("colapse_"+id);
	if (ID1 && ID2)
	{
		ID1.style.display = "none";
		ID2.style.display = "";
	}
}

function openwind(file_link, width, height, scrollbar) {
	var parameters;
	var winx = (screen.width - width) / 2;
    var winy = (screen.height - height) / 2;
	
	parameters = "width="+width+", height="+height+", top="+winy+", left="+winx+", status=no, scrollbars="+scrollbar;
	
	win = window.open(file_link,'view',parameters);
	win.window.focus();
}