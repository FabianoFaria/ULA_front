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
	document.getElementById("cidade_apr").innerHTML=xmlhttp.responseText;
	}
	}
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/login/novo_documento/chamaCidade/"+str,true);
	xmlhttp.send();
}

$( "#form-new_wrs-ipl" ).submit(function( event ) {
	alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
	event.preventDefault();
	});

$().ready(function() {
	// validate signup form on keyup and submit
	$("#form-new_wrs-ipl").validate({
		rules: {
			endereco: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			endereco: {
				required: "Endereço é obrigatorio!",
				minlength: "Endereço deve ter no minimo 3 caracteres..."
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
</script>
<div class="row sem_margin">

	<?php

		$arrayE = array();
		$arrayC = array();
		$arrayProduto = array('A','B','C','D');
		$arrayModelo = array('A','B','C','D');
		$arrayUnidade = array('A','B','C','D');

		foreach ($documento as $doc) {
			$Ipl = $doc->IPL;
		}

		if($row_local != null)
		{	
			

			foreach($local as $loc)
			{
				$id_local = $loc->ID_wrs;
				$ROW_ID = $loc->ROW_ID;
				$unidade_wrs = $loc->unidade_produto_deposito;
				$produto_wrs = $loc->produto_deposito;
				$marca_wrs = $loc->marca_produto_deposito;
				$quantidade_wrs = $loc->quantidade_deposito;
				$tabacalera_wrs = $loc->tabacalera_produto_deposito;

				$id_marca = $loc->id_marca;
				$nome_marca = $loc->nome_marca;
				$id_produto = $loc->id_produto;
				$nome_produto = $loc->nome_produto;
				$id_tabacalera = $loc->id_tabacalera;
				$nome_tabacalera = $loc->nome_tabacalera;
				$id_unidade = $loc->id_unidade_medida;
				$medida = $loc->unidade_medida;
			}

			//var_dump($local);
			//die;
		}
		else{
			$id_local = null;
			$ROW_ID = null;
			$unidade_wrs = null;
			$produto_wrs = null;
			$marca_wrs = null;
			$quantidade_wrs = null;
			$tabacalera_wrs = null;

			$id_marca = null;
			$nome_marca = null;
			$id_produto = null;
			$nome_produto = null;
			$id_tabacalera = null;
			$nome_tabacalera = null;
			$id_unidade = null;
			$medida = null;
		}

		if($endereco != null)
		{
			foreach ($endereco as $end) {
				$ID_addr = $end->ID_addr;
				$EndRowid = $end->ROW_ID;
				$logradouro = $end->address;
				$numero = $end->nunber;
				$complemento = $end->complement;
				$bairro = $end->district;
				$CEP = $end->zipcode;
				$pais = $end->country;
				$action = "atualizar_documento/atualizaAddr";
				$id_cidade = $end->id;
				$cidade = $end->nome;
				$id_estado = $end->id_estado;
				$estado = $end->nome_estado;
				$id_pais = $end->Id_pais;
				$pais = $end->nome_pais;
				}
		}else{

			//var_dump($endereco);
			//die;

				$ID_addr = null;
				$EndRowid = null;
				$logradouro = null;
				$numero = null;
				$complemento = null;
				$bairro = null;
				$CEP = null;
				$pais = null;
				$action = "";
				$id_cidade = null;
				$cidade = null;
				$id_estado = null;
				$estado = null;
				$id_pais = null;
				$pais = null;
		}

		//var_dump($endereco);
		//die;


	?>
	<h2>Cadastro de locais/armazens/casas : <a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>"><?php echo $Ipl; ?></a></h2>

	<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>">Cancelar</a>
	 <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

	 	<!-- abre o formulário de cadastro -->
	   	<?php echo form_open('login/novo_documento/cadastrar_deposito', 'id="form-new_wrs-ipl"'); ?>


	   	<label for="produto_wrs">Produto do deposito :</label><br/> 
			<select name="produto_wrs" id="produto_wrs" >
				<?php
					if($id_produto != null)
					{
				?>
					<option value="<?php echo $id_produto; ?>"><?php echo $nome_produto ?></option>
				<?php

					}
				?>
				<?php
					foreach($produtos as $prod):
				{
				?>
					<option value="<?php echo $prod->id_produto; ?>"><?php echo $prod->nome_produto; ?></option>
				<?php
					}endforeach;
				?>
			</select>
		<div class="error"></div>

		<label for="unidade_wrs">Unidade do produto :</label><br/> 
			<select name="unidade_wrs" id="unidade_wrs" >
				<?php
					if($id_unidade != null)
					{
				?>
					<option value="<?php echo $id_unidade; ?>"><?php echo $medida ?></option>
				<?php

					}
				?>
				<?php
					foreach($unidades_medidas as $medidas):
					{
				?>
					<option value="<?php echo $medidas->id_unidade_medida; ?>"><?php echo $medidas->unidade_medida; ?></option>
				<?php
					}endforeach;
				?>
			</select>
		<div class="error"></div>

		<label for="quantidade_wrs">Quantidade do produto :</label><br/> 
			<input type="text" name="quantidade_wrs" id="quantidade_wrs" value="<?php echo $quantidade_wrs; ?>"/>
		<div class="error"></div>

		<label for="marca_wrs">Marca do produto :</label><br/> 
			<select name="marca_wrs" id="marca_wrs" >
				<?php
					if($id_marca != null)
					{
				?>
					<option value="<?php echo $id_marca; ?>"><?php echo $nome_marca ?></option>
				<?php

					}else{
				?>
				<?php
					}
				?>
				<?php
					foreach($marcas_prod as $marca):
					{
				?>
					<option value="<?php echo $marca->id_marca; ?>"><?php echo $marca->nome_marca; ?></option>
				<?php
					}endforeach;
				?>
			</select>
		<div class="error"></div>

		<label for="tabacalera_wrs">Tabacalera :</label><br/> 
			<select name="tabacalera_wrs" id="tabacalera_wrs" >
				<?php
					if($id_tabacalera != null)
					{
				?>
					<option value="<?php echo $id_tabacalera; ?>"><?php echo $nome_tabacalera ?></option>
				<?php

					}
				?>
				<?php
					foreach($tabacaleira as $taba):
				{
				?>
					<option value="<?php echo $taba->id_tabacalera; ?>"><?php echo $taba->nome_tabacalera; ?></option>
				<?php
					}endforeach;
				?>
			</select>
		<div class="error"></div>

	   	<hr>

		<label for="endereco">Endereço do deposito :</label><br/> 
			<input type="text" name="endereco" id="endereco" value="<?php echo $logradouro; ?>"/>
		<div class="error"></div>

		<label for="tipo_wrs">Numero :</label><br/>
			<input type="text" name="tipo_wrs" value="<?php echo $numero; ?>"/>
		<div class="error"></div>

		<label for="complemento">Complemento :</label><br/> 
			<input type="text" name="complemento" id="complemento" value="<?php echo $logradouro; ?>"/>
		<div class="error"></div>

		<label for="bairro">Bairro :</label><br/>
			<input type="text" name="bairro" id="bairro" value="<?php echo $numero; ?>"/>
		<div class="error"></div>

		<label for="estado_apr">Estado da ocorrencia:</label><br/>
			<select name="estado_apr" id="estado_apr" onchange="mostraCidades(this.value)">
				<?php
					if( $id_estado != null)
					{
				?>
					<option value="<?php echo $id_estado; ?>"><?php echo $estado ?></option>
				<?php

					}
				?>

				<?php

					foreach ($estados as $estado): {
									    		
						// $arrayE[] = $estado->nome;
				?>

					<option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->nome_estado; ?></option>

				<?php

					}endforeach;

				?>

			</select>
			<div class="error"><?php echo form_error('estado_apr'); ?></div>

			<label for="cidade_apr">Cidade da ocorrencia:</label><br/>
				<select id="cidade_apr" name="cidade_apr">
					<?php
						if($id_cidade != null)
						{
					?>
						<option value="<?php echo $id_cidade; ?>"><?php echo $cidade ?></option>
					<?php

						}else{
					?>
						<option value="">Selecione uma cidade:</option>
					<?php
						}
					?>
											
				</select>
			<div class="error"><?php echo form_error('cidade_apr'); ?></div>

		<label for="CEP">CEP :</label><br/>
			<input type="text" name="CEP" id="CEP" value="<?php echo $CEP; ?>"/>
		<div class="error"></div>

		<br>
		<br>

		<input type="hidden" name="row_id" value="<?php echo $id_Row; ?>" />
		<input type="hidden" name="id_local" value="<?php echo $id_local; ?>" />

		<input type="submit" name="Cadastrar" value="Atualizar endereço da ocorrencia" />
		<br>
		<br>
		<br>
		<br>
	                       
	</div>
	                       

	</div>

</div>