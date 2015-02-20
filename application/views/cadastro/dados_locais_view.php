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
			produto_wrs: {
				required: true
			},
			unidade_wrs: {
				required: true
			},
			quantidade_wrs: {
				required: true,
				digits:true,
				minlength: 1
			}
		},
		messages: {
			produto_wrs: {
				required: "Produto é obrigatorio!"
			},
			unidade_wrs: {
				required: "Favor selecionar uma medida"
			},
			quantidade_wrs: {
				required: "Quantidade é obrigatorio!",
				digits: "Quantidade deve ser apenas numeros",
				minlength: "Quantidade deve ter pelo menos 1 caracterer"
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

		foreach ($documento as $doc) {
			$Ipl = $doc->IPL;
		}

		if($row_local != null)
		{	
			//var_dump($local);
			//die;

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
				//$id_pais = $end->Id_pais;
				//$pais = $end->nome_pais;
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
				//$id_pais = null;
				//$pais = null;
		}

		//var_dump($endereco);
		//die;


	?>
	<h2>Cadastro de locais/armazéns/casas : <a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>"><?php echo $Ipl; ?></a></h2>

	<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>">Cancelar</a>
	 <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

	 	<!-- abre o formulário de cadastro -->
	   	<?php echo form_open('login/novo_documento/cadastrar_deposito', 'id="form-new_wrs-ipl"'); ?>


	   	<label for="produto_wrs">Produto do depósito :</label><br/> 
			<select name="produto_wrs" id="produto_wrs" >
				<?php
					if($id_produto != null)
					{
				?>
					<option selected="true" value="<?php echo $id_produto; ?>"><?php echo $nome_produto ?></option>
				<?php

					}else
					{
				?>
					<option value="">Selecione um produto</option>
				<?php
					}//fim do else...

					foreach($produtos as $prod):
					{
						if($id_produto != $prod->id_produto)
						{
				?>
					<option value="<?php echo $prod->id_produto; ?>"><?php echo $prod->nome_produto; ?></option>
				<?php
						}
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

					}else
					 {
				?>
					<option value="">Selecione uma unidade</option>
				<?php
					} //fim do else..
					foreach($unidades_medidas as $medidas):
					{
						if($medidas->id_unidade_medida != $id_unidade)
						{
				?>
					<option value="<?php echo $medidas->id_unidade_medida; ?>"><?php echo $medidas->unidade_medida; ?></option>
				<?php
						}
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

					}else
					{
				?>
					<option value="">Selecione uma marca</option>
				<?php
					}
				?>
				<?php
					foreach($marcas_prod as $marca):
					{
						if($marca->id_marca != $id_marca)
						{
				?>
					<option value="<?php echo $marca->id_marca; ?>"><?php echo $marca->nome_marca; ?></option>
				<?php
						}
					}endforeach;
				?>
				<option value=" "> </option>
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

					}else
						{
				?>
					<option value="">Selecione uma tabacalera</option>
				<?php
						}
					foreach($tabacaleira as $taba):
					{
						if($taba->id_tabacalera != $id_tabacalera)
						{
				?>
						<option value="<?php echo $taba->id_tabacalera; ?>"><?php echo $taba->nome_tabacalera; ?></option>
				<?php
						}
					}endforeach;
				?>
				<option value=" "> </option>
			</select>
		<div class="error"></div>

	   	<hr>

		<label for="endereco">Endereço do depósito :</label><br/> 
			<input type="text" name="endereco" id="endereco" value="<?php echo $logradouro; ?>"/>
		<div class="error"></div>

		<label for="numero_wrs">Número :</label><br/>
			<input type="text" id="numero_wrs" name="numero_wrs" value="<?php echo $numero; ?>"/>
		<div class="error"></div>

		<label for="complemento">Complemento :</label><br/> 
			<input type="text" name="complemento" id="complemento" value="<?php echo $complemento; ?>"/>
		<div class="error"></div>

		<label for="bairro">Bairro :</label><br/>
			<input type="text" name="bairro" id="bairro" value="<?php echo $bairro; ?>"/>
		<div class="error"></div>

		<label for="estado_apr">Estado da ocorrencia:</label><br/>
			<select name="estado_apr" id="estado_apr" onchange="mostraCidades(this.value)">
				<?php
					if( $id_estado != "")
					{
				?>
					<option value="<?php echo $id_estado; ?>"><?php echo $estado ?></option>
				<?php

					}else{
				?>
						<option value="" selected="true">Selecione um estado</option>
				<?php
						 }

					foreach ($estados as $estado): {

						if($id_estado != $estado->id_estado)
						{			    		
				?>

					<option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->nome_estado; ?></option>

				<?php
						}

					}endforeach;

				?>

				<option value=" "> </option>
			</select>
			<div class="error"><?php echo form_error('estado_apr'); ?></div>

			<label for="cidade_apr">Cidade da ocorrência:</label><br/>
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

					foreach ($singleS as $cidades): {

						if($id_cidade != $cidades->id)
						{			    		
					?>

						<option value="<?php echo $cidades->id; ?>"><?php echo $cidades->nome; ?></option>

					<?php
							}

						}endforeach;

					?>
					<option value=" "> </option>						
				</select>
			<div class="error"><?php echo form_error('cidade_apr'); ?></div>

		<label for="CEP">CEP :</label><br/>
			<input type="text" name="CEP" id="CEP" value="<?php echo $CEP; ?>"/>
		<div class="error"></div>

		<br>
		<br>

		<input type="hidden" name="row_id" value="<?php echo $id_Row; ?>" /> 
		<input type="hidden" name="id_local" value="<?php echo $id_local; ?>" />
		<input type="hidden" name="id_addr" value="<?php echo $ID_addr; ?>" />

		<input type="submit" name="Cadastrar" value="Atualizar endereço da ocorrencia" />
		<br>
		<br>
		<br>
		<br>
	                       
	</div>
	                       

	</div>

</div>