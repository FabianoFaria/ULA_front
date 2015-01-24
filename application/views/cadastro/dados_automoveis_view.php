<script>
$( "#form-new-ipl" ).submit(function( event ) {
	alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
	event.preventDefault();
	});

$().ready(function() {
	// validate signup form on keyup and submit
	$("#form-new-ipl").validate({
		rules: {
			cat_veiculo: {
				required: {
					depends: function () {
						if($('#detalhes_veiculos').val()===''){
							return true;
						}else{
							return false;
						}
					}
				}
			},
			mark_veiculo: {
				required: false
			},
			mod_veiculo: {
				required: false
			},
			detalhes_veiculos: {
				required :{
					depends: function () {
						if($('#cat_veiculo').val()===''){
							return true;
						}else{
							return false;
						}
					}
				}
			}
		},
		messages: {
			cat_veiculo: {
				required: "Favor selecionar o tipo de veiculo!"
			},
			mark_veiculo: {
				required: "Favor selecionar a marca do carro!"
			},
			mod_veiculo: {
				required: "Favor selecionar o modelo de carro!"
			},
			detalhes_veiculos :{
				required : "Caso nâo tenha informações sobre o veiculo informar isso em detalhes"
			}
		}
	});
	
	
	jQuery.extend(jQuery.validator.messages, {
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Por favor entre com pelo menos {5} ou mais caracteres."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
     //   max: jQuery.validator.format("Por favor informe um valor menor ou igual a  {255}."),
     //   min: jQuery.validator.format("Por favor informe um valor maior ou igual a  {0}.")
    });
	
});

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
</script>
<script>

function mostraModelos2(str) {
	if (str=="") {
		document.getElementById("mod_veiculo").innerHTML="";
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
		document.getElementById("mod_veiculo").innerHTML=xmlhttp.responseText;
		 }
		 }
		xmlhttp.open("GET","<?php echo base_url();?>index.php/login/novo_documento/chamaModelos/"+str,true);
		xmlhttp.send();
		}

</script>

<div class="row sem_margin">

	<?php

			foreach ($documento as $doc) {
				$Ipl = $doc->IPL;
			}


		//Os dados dos estados e cidades são carregados separadamente
		if($cidadeAdr != null)
		{
			$nome_cidade = $cidadeAdr[0]->nome;
			$id_cidade = $cidadeAdr[0]->id;
		}else
		{
			$nome_cidade = "";
			$id_cidade = "";
		}

		if($estadoAdr != null)
		{
			$nome_estado = $estadoAdr[0]->nome_estado;
			$id_estado = $estadoAdr[0]->id_estado;
		}else
		{
			$nome_estado = "";
			$id_estado = "";
		}

		if($row_Auto != null)
		{

		
			foreach ($automoveis as $auto) {
				 $ID_auto = $auto->ID_vehicle;
				 $cor_veio = $auto->cor_veiculo;
				 $Chassi = $auto->chassi;
				 $Renavan = $auto->renavan;
				 $placa = $auto->placa;
				 $placa_extra1 = $auto->placa_extra;
				 $placa_extra2 = $auto->placa_extra2;

				// $id_cidade = $auto->id;
				// $nome_cidade = $auto->nome;
				// $id_estado = $auto->id_estado;
				// $nome_estado = $auto->nome_estado;

				$id_tipo_veiculo = $auto->category;
				$tipo_veiculo = $auto->tpve_nome;
				$id_marca = $auto->brand;
				$nome_marca = $auto->marc_nome;
				if(!is_numeric()){

				}
				$id_modelo = $auto->mode_cod;
				$nome_modelo = $auto->mode_nome;



				$detalhes_veic = $auto->detalhes_veiculos;
			}

			 //var_dump($marcasP);

			//var_dump($automoveis);
			//die;

		}else
		{
			$ID_auto = null;
			$cor_veio = null;
			$Chassi = null;
			$Renavan = null;
			$placa = null;
			$placa_extra1 = null;
			$placa_extra2 = null;
				 
			//$id_cidade = null;
			//$nome_cidade = null;
			//$id_estado = null;
			//$nome_estado = null;

			$id_tipo_veiculo = null;
			$tipo_veiculo = null;
			$id_marca = null;
			$nome_marca = null;
			$id_modelo = null;
			$nome_modelo = null;
			$detalhes_veic = null;

		}

			//Passa as variavreis do objeto automovel para as variaveis no formulario...
	?>
							<script>
								function mostraCidades(str) {
								  if (str=="") {
								    document.getElementById("cidade_apr").innerHTML="";
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
								      document.getElementById("listCidades").innerHTML=xmlhttp.responseText;
								    }
								  }
								  xmlhttp.open("GET","<?php echo base_url(); ?>index.php/login/novo_documento/chamaCidade/"+str,true);
								  xmlhttp.send();
								}
							</script>

			<h2>Cadastro de automoveis :<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>"><?php echo $Ipl; ?></a> </h2>

			<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>">Cancelar</a>
			<br>



			 <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

			 	  <!-- abre o formulário de cadastro -->
			   <?php echo form_open('login/novo_documento/cadatrar_veiculo', 'id="form-new-ipl"'); ?>

				<label for="cat_veiculo">Categoria do veiculo :</label><br/>
					<select name="cat_veiculo" onchange="mostraMarcas2(this.value)">

						<?php

						
							if($tipo_veiculo != null)
							{
						?>
							<option value="<?php echo $id_tipo_veiculo ?>"><?php echo $tipo_veiculo ?></option>
						<?php

							}else{
						?>
							<option value="" selected="true">Selecione o tipo de veiculo</option>
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
				<div class="error"><?php echo form_error('cat_veiculo'); ?></div>

				<label for="mark_veiculo">Marca do veiculo:</label><br/>
					<select name="mark_veiculo" id="mark_veiculo" onchange="mostraModelos2(this.value)">
						<?php
							if($id_marca != null)
							{
						?>
							<option selected="true" value="<?php echo $id_marca; ?>"><?php echo $nome_marca ?></option>

						<?php
								foreach ($marcasP as $marck) {
								if($marck->marc_cod != $id_marca){
						?>
								<option value="<?php  echo $marck->marc_cod ?>"><?php  echo $marck->marc_nome ?></option>
						<?php
									}//fim do if para cidades iguais...
								}//fim do foreach das cidades do estado carregado

							}//fim do if id_marca != null
							else{
						?>
							<option value="">selecione a marca do veiculo</option>
						<?php
							}
						?>
						<option value=" "> </option>
					</select>
				<div class="error"></div>

				<label for="mod_veiculo">Modelo veiculo:</label><br/>
					<!-- <select name="mod_veiculo" id="mod_veiculo" > -->
						<?php
						//	if($id_modelo != null)
						//	{
						?>
						<!--	<option value="<?php // echo $id_modelo ?>"><?php // echo $nome_modelo ?></option> -->
						<?php
							//	foreach ($modelosP as $model) {
							//	if($model->mode_cod != $id_modelo){
						?>
							<!--	<option value="<?php // echo $model->mode_cod ?>"><?php // echo $model->mode_nome ?></option> -->
						<?php
							//		}//fim do if para cidades iguais...
							//	}//fim do foreach das cidades do estado carregado

							//} //fim do if id_modelo != null
							//else{
						?>
							<!-- <option value="">selecione o modelo do veiculo</option> --> 
						<?php

						 //	}
						?>
					<!--	<option value=" "> </option>
					</select> --> 
				<!-- input para o modelo do veiculo-->
				<input type="text" name="mod_veiculo" value="<?php echo $nome_modelo; ?>"/>
				<div class="error"></div>

				<label for="cor_veiculo">Cor do veiculo: </label><br/>
				<input type="text" name="cor_veiculo" value="<?php echo $cor_veio; ?>"/>		
				<div class="error"></div>


				<label for="chassi">Chassi:</label><br/>
				<input type="text" name="chassi" value="<?php echo $Chassi; ?>"/>
				<div class="error"><?php echo form_error('chassi'); ?></div>

				<label for="renavan">Renavan :</label><br/>
				<input type="text" name="renavan" value="<?php echo $Renavan; ?>"/>
				<div class="error"><?php echo form_error('renavan'); ?></div>

				<label for="placa_n">Placa :</label><br/>
				<input type="text" name="placa_n" value="<?php echo $placa; ?>"/>
				<div class="error"><?php echo form_error('placa_n'); ?></div>

				<label for="placa_ex">Placa adicional:</label><br/>
				<input type="text" name="placa_ex" value="<?php echo $placa_extra1; ?>"/>
				<div class="error"><?php echo form_error('placa_ex'); ?></div>

				<label for="placa_ex2">Placa adicional 2:</label><br/>
				<input type="text" name="placa_ex2" value="<?php echo $placa_extra2; ?>"/> 
				<div class="error"><?php echo form_error('placa_ex2'); ?></div>

				<label for="estado">Estado :</label><br/>
					<select name="estado_apr" onchange="mostraCidades(this.value)">
						<?php
							if( $id_estado != null)
							{
						?>
							<option value="<?php echo $id_estado; ?>"><?php echo $nome_estado ?></option>
						<?php

							}else{

						?>
							<option value="">Selecione um estado</option>
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
				<br>

				<label for="cidade">Cidade :</label><br/>
					<select id="listCidades" name="cidade_apr">
						<?php
							if($id_cidade != null)
							{

						?>
							<option selected="true" value="<?php echo $id_cidade; ?>"><?php echo $nome_cidade ?></option>

						<?php
							foreach ($cidadesSingle as $city) {
								if($city->id != $id_cidade){
						?>
								<option value="<?php  echo $city->id ?>"><?php  echo $city->nome ?></option>
						<?php
								}//fim do if para cidades iguais...
							}//fim do foreach das cidades do estado carregado

							}else{ //fim do if do id cidade != null
						?>
							<option value="">Selecione uma cidade:</option>
						<?php
							}
						?>
						<option value=" "> </option>		
					</select>
				<br>
				<label for="detalhes_veiculos">Comentarios sobre automóveis :</label><br/>
				<textarea id="detalhes_veiculos" name="detalhes_veiculos"><?php echo $detalhes_veic; ?></textarea>

				<br>

				<input type="hidden" name="row_id" value="<?php echo $id_Row; ?>" />
				<input type="hidden" name="id_auto" value="<?php echo $ID_auto ?>" />

				<input type="submit" name="Cadastrar" value="Atualizar dados do automovel" />
				<br>
				<br>

				</div>
		</div>

	</div>
	<?php ?>
