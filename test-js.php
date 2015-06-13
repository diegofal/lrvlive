<!DOCTYPE html>
<html>
<head>
  <style>
  p { color:blue; margin:20px; }
  span { color:red; }
  </style>
  <script src="/WEB-INF/includes/js/jquery-1.7.2.min.js"></script>
  <script>
	window.onload = function() {
		if (jQuery) {
			jQuery("#status").html("Jquery is supported");
			jQuery.each(jQuery.browser, function(i, val) {
			      $("<div>" + i + " : <span>" + val + "</span></div>").appendTo( document.body );
			});
		} else {
			var p = document.getElementById("status");
			p.innerHtml("jQuery is not supported.");
		}
	};
	
	$(document).ready(function() {	
	    $("#example").html('<ul></ul>');
	    var example_ul = $("#example ul");
	    $.each($.support, function(key, val) {
	    	example_ul.append('<li><strong>' + key + "</strong> : " + val + "</li>");
	    });
	    
	});

</script>
</head>
<body>
	<p id="status">Javascript is not enabled.</p>
	<div id="example"></div>
</body>
</html>