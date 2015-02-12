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

	function mostraBuscaTipo(str) {      //////////////////////////////////////////BUSCA TIPO DE VEICULOS
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
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/pesquisa/pesquisa_avancada/chamaVeiculoTipo/"+str,true);
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

	function mostraBuscaEnderecosCidades(str) {   //////////////////////////////////////////BUSCA DE ENDEREÇO
	
	if (str==" ") {
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
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/pesquisa/pesquisa_avancada/chamaEndCidades/"+str,true);
	xmlhttp.send();
	}

	<!-- buscar marcas de veículos -->

	function mostraMarcas2(str) {
	if (str=="") {
		document.getElementById("mark_veiculo").innerHTML="";
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
		document.getElementById("mark_veiculo").innerHTML=xmlhttp.responseText;
		 }
		 }
		xmlhttp.open("GET","<?php echo base_url();?>index.php/login/novo_documento/chamaMarcas/"+str,true);
		xmlhttp.send();
		}

	<!-- Buscar cidades -->

	function mostraCidades(str) {
	if (str=="") {
		document.getElementById("cidade_pesquisa").innerHTML="";
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
			document.getElementById("cidade_pesquisa").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","/sis/index.php/login/novo_documento/chamaCidade/"+str,true);
	xmlhttp.send();
	}

</script>
<div class="row sem_margin altMin">
        <div class="col-md-12 col-sm-12 col-xs-12 main-menu">
        	<div class="row">
                <h2> Pesquisar elementos cadastrados</h2>

                
                <div class="col-md-4 col-sm-5 col-xs-5 formulario_pesquisa">

                	<h3></h3>

                	<p>Pesquisa de pessoas por nome / CPF / rg / passaporte / mãe / pai</p>
                	<form>
                		<input id="palavra_chave" type="text"/> 
                		<input class="btn" type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaPessoas(palavra_chave.value)">
                	</form>	

                	<br>
	                <p>Pesquisa por CEP / endereços /Bairro</p>
	                <form>
	                	<input id="palavra_chave" type="text"/> 
	                	<input class="btn" type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaEnderecos(palavra_chave.value)">
	                </form>

	                <br>
					<p>Pesquisa por cidade</p>
					<form>
	                	<select name="estado_nascimento" id="estado_nascimento" onchange="mostraCidades(this.value)">
							<?php
								if( $id_estado != null)
								{
							?>
								<option value="<?php echo $id_estado; ?>"><?php echo $estado ?></option>
							<?php

								}else{
							?>
								<option value="" selected="true">Selecione um estado:</option>
							<?php
								}
							?>				

							<?php

								foreach ($estados as $estado): {
												    		
										// $arrayE[] = $estado->nome;
								if($estado->id_estado != $id_estado)
								{
							?>

								<option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->nome_estado; ?></option>

							<?php
								}//fim do if...


								}endforeach;

							?>
							<option value=" "> </option>
						</select>
					</form>

					<select id="cidade_pesquisa" name="cidade_nascimento">
						<option value=" "> </option>						
					</select>

				<input class="btn" type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaEnderecosCidades(cidade_pesquisa.value)">

				<div class="error"></div>

				<br>
                	<p>Pesquisa de veiculos por modelo / placa / chassi / renavan</p>
                	<form>
                		<input id="palavra_chave" type="text"/> 
                		<input class="btn" type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaVeiculos(palavra_chave.value)">
                	</form>

                	<br>

                	<p>Pesquisa de veículos por tipo</p>
                	<form>
                		<!-- combos para seleção de veículos -->
						<select id="cat_veiculo" name="cat_veiculo" >

							<?php
								if($tipo_veiculo != null)
								{
							?>
								<option value="<?php echo $id_tipo_veiculo ?>"><?php echo $tipo_veiculo ?></option>
							<?php

								}else{
							?>
								<option value="" selected="true">Selecione o tipo de veículo</option>
							<?php
								}
							?>
							
							<?php
								foreach($tipo_veiculos as $tipo_veiculo):
								{
									if($id_tipo_veiculo != $tipo_veiculo->tpve_cod)
									{
							?>
								<option value="<?php echo $tipo_veiculo->tpve_cod; ?>"><?php echo $tipo_veiculo->tpve_nome; ?></option>
							<?php
									}
								}endforeach;
							?>
						
						</select>

						<input class="btn" type="button" value="buscar" name="efetuar_busca" onclick="mostraBuscaTipo(cat_veiculo.value)">

                	<!-- fim do côdigo para seleção-->
                	</form>



				<br>

                </div>
                <div class="col-md-8 col-sm-7 col-xs-7 lista-menu">


                	<hr>


                	<table id="listResultados">
						<tr>
							<th>- </th><th>-</th><th>-</th><th>-</th><th>-</th>
						</tr>
						<tbody id="listResultadosRow">
							<tr>
								<td></td><td></td><td></td><td></td><td></td>
							</tr>
						</tbody>
                	</table>

                </div>

        	</div>
        </div>

</div>