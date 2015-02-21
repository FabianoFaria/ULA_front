<script>
	function mostraBusca(str) {
	if (str=="") {
	document.getElementById("listResultadosRow").innerHTML="<p>Nenhum resultado</p>";
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
	document.getElementById("listResultadosRow").innerHTML=xmlhttp.responseText;
	}
	}
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/pesquisa/pesquisa_avancada/chamaDoct/"+str,true);
	xmlhttp.send();
	}

	function mostraBuscaData(str) {
	if (str=="") {
	document.getElementById("listResultadosRow").innerHTML="<p>Nenhum resultado</p>";
	return;
	 }else{
	 	var retorno = str.split("/");
	 	var data = retorno[2]+'_'+retorno[1]+'_'+retorno[0];
	 }
	if (window.XMLHttpRequest) {
	 // code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	 } else { // code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	 if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById("listResultadosRow").innerHTML=xmlhttp.responseText;
	}
	}
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/pesquisa/pesquisa_avancada/chamaDoctData/"+data,true);
	xmlhttp.send();
	}

	$(function() {
		$("#datepicker").datepicker({
			dateFormat: 'dd/mm/yy',
        	dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        	dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        	dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        	monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        	monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        	maxDate: 0,
        	changeMonth: true,
        	changeYear: true,
        	yearRange: "-10:+0"
		});
	});
</script>

<div class="row sem_margin">
        <div class="col-md-12 col-sm-12 col-xs-12 main-menu">
        	<div class="row altMin">
                <h2> Pesquisar documento</h2>

                
                <div class="col-md-4 col-sm-4 col-xs-4 formulario_pesquisa">

                	<h3>-</h3>

                	<p>Informe uma palavra para pesquisa</p>
                	<form>
                		<input id="palavra_chave" type="text"/> 
                		<input type="button" value="buscar" name="efetuar_busca" onclick="mostraBusca(palavra_chave.value)">
                	</form>

                	<br>
                	<br>

                	<p>Pesquisa de documento por data</p>

                	<form>
						<input id="datepicker" type="text" name="dataOps" value=""/>
                		<input type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaData(datepicker.value)">
                	</form>

                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 lista-menu">


                	<hr>


                	<table id="listResultados">
						<!-- <tr>
							<th>IPL </th><th>Unidade de segurança</th><th>Nome da operação</th><th>Data da apreensão</th>
						</tr> -->
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