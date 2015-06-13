<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<head>
	{config_load file="config.conf" section="General"}
	<title>{#COMPANY_NAME#}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="inc/main.css">
	
</head>
{if $page != index}
	<script src="inc/main.js" type="text/javascript"></script>
	<script src="inc/cal_data.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	{literal}
	<script type="text/javascript">
	
		jQuery.fn.center = function () {
		    this.css("position","absolute");
		    this.css("top", (($(window).height() - this.outerHeight()) / 2) + 
		                                                $(window).scrollTop() + "px");
		    this.css("left", (($(window).width() - this.outerWidth()) / 2) + 
		                                                $(window).scrollLeft() + "px");
		    return this;
		}			
	</script>
	{/literal}
{/if}