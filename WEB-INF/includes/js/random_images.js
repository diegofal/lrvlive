// JavaScript Document
function generate_random(n, type){
	images = new Array(n+1);
	if (type == "home"){
		for(i=1; i<=n; i++) {
			images[i] = '<img src="WEB-INF/assets/images/utils/img-home'+i+'.jpg" alt="img" width="508" height="141">';
		}
	} else {
		for(i=1; i<=n; i++) {
			images[i] = '<img src="WEB-INF/assets/images/utils/img-inside'+i+'.jpg" alt="img" width="508" height="122">';
		}		
	}
	index = 1+Math.round(Math.random()*(n-1));
	document.write(images[index]);
}