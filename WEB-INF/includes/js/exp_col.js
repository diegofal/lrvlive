// JavaScript Document
function exp_col(id1, id2){
	ID1 = document.getElementById(id1);
	ID2 = document.getElementById(id2);
	ID1.style.display = "none";
	ID2.style.display = "";
}

function operation_all(n, option){
	if (option == "expand"){
		for(i=1;i<=n;i++) 	{	
			ID1 = document.getElementById(i+"0");
			ID2 = document.getElementById(i+"1");
			ID1.style.display = "none";
			ID2.style.display = "";			
		}
	} else {
		for(i=1;i<=n;i++) 	{	
			ID1 = document.getElementById(i+"1");
			ID2 = document.getElementById(i+"0");
			ID1.style.display = "none";
			ID2.style.display = "";			
		}
	}
}