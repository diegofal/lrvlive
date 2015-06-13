/*** Color Picker Object ***/
var arrColorPickerObjects=[];
function ColorPicker(sName,sParent)
	{
	this.oParent=sParent;
	if(sParent)
		{
		this.oName=sParent+"."+sName;
		this.oRenderName=sName+sParent;
		}
	else
		{
		this.oName=sName;
		this.oRenderName=sName;
		}
	arrColorPickerObjects.push(this.oName);

	this.url="color_picker.htm";
	this.onShow=function(){return true;};
	this.onHide=function(){return true;};
	this.onPickColor=function(){return true;};
	this.onRemoveColor=function(){return true;};
	this.onMoreColor=function(){return true;};	
	this.show=showColorPicker;
	this.hide=hideColorPicker;
	this.hideAll=hideColorPickerAll;
	this.color;
	this.customColors=[];
	this.refreshCustomColor=refreshCustomColor;
	this.isActive=false;
	this.txtCustomColors="Custom Colors";
	this.txtMoreColors="More Colors...";
	this.align="left";
	this.currColor="#ffffff";//default current color
	this.RENDER=drawColorPicker;
	}
function drawColorPicker()
	{	
	var arrColors=[["#800000","#8b4513","#006400","#2f4f4f","#000080","#4b0082","#800080","#000000"],
				["#ff0000","#daa520","#6b8e23","#708090","#0000cd","#483d8b","#c71585","#696969"],
				["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"],
				["#ff6347","#ffd700","#32cd32","#87ceeb","#00bfff","#9370db","#ff69b4","#dcdcdc"],
				["#ffdab9","#ffffe0","#98fb98","#e0ffff","#87cefa","#e6e6fa","#dda0dd","#ffffff"]]
	var sHTMLColor="<table id='dropColor' style=\"z-index:1;display:none;position:absolute;border:#9b95a6 1px solid;cursor:default;background-color:#E9E8F2;padding:2px\" unselectable=on cellpadding=0 cellspacing=0 width=143 height=109><tr><td unselectable=on>"
	sHTMLColor+="<table align=center cellpadding=0 cellspacing=0 border=0 unselectable=on>";
	for(var i=0;i<arrColors.length;i++)
		{
		sHTMLColor+="<tr>";
		for(var j=0;j<arrColors[i].length;j++)
			sHTMLColor+="<td onclick=\"grabcolor('"+arrColors[i][j]+"')\" onmouseover=\"this.style.border='#777777 1px solid'\" onmouseout=\"this.style.border='#E9E8F2 1px solid'\" style=\"cursor:default;padding:1px;border:#E9E8F2 1px solid;\" unselectable=on>"+
				"<table style='margin:0;width:13px;height:13px;background:"+arrColors[i][j]+";border:white 1px solid' cellpadding=0 cellspacing=0 unselectable=on>"+
				"<tr><td unselectable=on></td></tr>"+
				"</table></td>";
		sHTMLColor+="</tr>";		
		}
	
	//~~~ custom colors ~~~~
	sHTMLColor+="<tr><td colspan=8 id=idCustomColor"+this.oRenderName+"></td></tr>";
	
	//~~~ remove color & more colors ~~~~
	sHTMLColor+= "<tr>";
	sHTMLColor+= "<td unselectable=on>"+
		"<table style='margin-left:1px;width:14px;height:14px;background:#E9E8F2;' cellpadding=0 cellspacing=0 unselectable=on>"+
		"<tr><td onclick=\"hidecolorpicker()\" onmouseover=\"this.style.border='#777777 1px solid'\" onmouseout=\"this.style.border='white 1px solid'\" style=\"cursor:default;padding:1px;border:white 1px solid;font-family:verdana;font-size:10px;font-color:black;line-height:9px;\" align=center valign=top unselectable=on>x</td></tr>"+
		"</table></td>";
	sHTMLColor+= "<td colspan=7 unselectable=on>"+
		"<table style='margin:1px;width:117px;height:16px;background:#E9E8F2;border:white 1px solid' cellpadding=0 cellspacing=0 unselectable=on>"+
		"<tr><td  onmouseover=\"this.style.border='#777777 1px solid';this.style.background='#8d9aa7';this.style.color='#ffffff'\" onmouseout=\"this.style.border='#E9E8F2 1px solid';this.style.background='#E9E8F2';this.style.color='#000000'\" style=\"cursor:default;padding:1px;border:#efefef 1px solid\" style=\"font-family:verdana;font-size:9px;font-color:black;line-height:9px;padding:1px\" align=center valign=top nowrap unselectable=on>Click To select Color</td></tr>"+
		"</table></td>";
	sHTMLColor+= "</tr>";
	
	sHTMLColor+= "</table>";			
	sHTMLColor+="</td></tr></table>";
	document.write(sHTMLColor);
	}
   function showColorPicker(oEl)
	{
	document.getElementById("dropColor").style.display="";
	}
	function hidecolorpicker()
	{
		document.getElementById("dropColor").style.display="none";
	}
	function grabcolor(colorid)
	{
		document.getElementById('colorcode').value=""+colorid+"";
		//document.getElementById('colorcode').style.backgroundColor=""+colorid+"";
    hidecolorpicker();
	}

