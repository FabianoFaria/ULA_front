function mostraMarcas(str) {
	if (str=="") {
		document.getElementById("listMarcas").innerHTML="";
		return;
				}
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("listMarcas").innerHTML=xmlhttp.responseText;
		 }
		 }
		xmlhttp.open("GET","<?php echo base_url();?>index.php/login/novo_documento/chamaMarcas/"+str,true);
		xmlhttp.send();
		}


function mostraModelos(str) {
	if (str=="") {
		document.getElementById("listModelos").innerHTML="";
		return;
				}
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("listModelos").innerHTML=xmlhttp.responseText;
		 }
		 }
		xmlhttp.open("GET","<?php echo base_url();?>index.php/login/novo_documento/chamaModelos/"+str,true);
		xmlhttp.send();
		}