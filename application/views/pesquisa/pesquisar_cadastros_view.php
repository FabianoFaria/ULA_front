<script>
	function mostraBuscaPessoas(str) {       //////////////////////////////////////////BUSCA DE PESSOAS
	if (str=="") {
	document.getElementById("listResultados").innerHTML="<p>Nenhum resultado</p>";
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
	document.getElementById("listResultados").innerHTML=xmlhttp.responseText;
	}
	}
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/pesquisa/pesquisa_avancada/chamaPessoas/"+str,true);
	xmlhttp.send();
	}

	function mostraBuscaVeiculos(str) {      //////////////////////////////////////////BUSCA DE VEICULOS
	if (str=="") {
	document.getElementById("listResultados").innerHTML="<p>Nenhum resultado</p>";
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
	document.getElementById("listResultados").innerHTML=xmlhttp.responseText;
	}
	}
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/pesquisa/pesquisa_avancada/chamaVeiculo/"+str,true);
	xmlhttp.send();
	}

	function mostraBuscaEnderecos(str) {   //////////////////////////////////////////BUSCA DE ENDEREÇO
	if (str=="") {
	document.getElementById("listResultados").innerHTML="<p>Nenhum resultado</p>";
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
	document.getElementById("listResultados").innerHTML=xmlhttp.responseText;
	}
	}
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/pesquisa/pesquisa_avancada/chamaEnd/"+str,true);
	xmlhttp.send();
	}


</script>
<div class="row sem_margin altMin">
        <div class="col-md-12 col-sm-12 col-xs-12 main-menu">
        	<div class="row">
                <h2> Pesquisar elementos cadastrados</h2>

                
                <div class="col-md-5 col-sm-5 col-xs-5 formulario_pesquisa">

                	<h3></h3>

                	<p>Pesquisa de pessoas / CPF / rg / passaporte / mãe / pai</p>
                	<form>
                		<input id="palavra_chave" type="text"/> 
                		<input type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaPessoas(palavra_chave.value)">
                	</form>

                	<p>Pesquisa de veiculos/placa/chassi/renavan</p>
                	<form>
                		<input id="palavra_chave" type="text"/> 
                		<input type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaVeiculos(palavra_chave.value)">
                	</form>

                	<p>Pesquisa de endereços/Bairro/Cep</p>
                	<form>
                		<input id="palavra_chave" type="text"/> 
                		<input type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaEnderecos(palavra_chave.value)">
                	</form>

                	<br>

                </div>
                <div class="col-md-7 col-sm-7 col-xs-7 lista-menu">


                	<hr>


                	<table id="listResultados">
						<tr>
							<th>- </th><th>-</th><th>-</th><th>-</th>
						</tr>
						<tbody id="listResultadosRow">
							<tr>
								<td></td><td></td><td></td><td></td>
							</tr>
						</tbody>
                	</table>

                </div>

        	</div>
        </div>

</div>