<script>
$( "#form-haul-ipl" ).submit(function( event ) {
	alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
	event.preventDefault();
	});

$().ready(function() {
	// validate signup form on keyup and submit 
	$("#form-haul-ipl").validate({
		rules: {
			quantidade: {
				required: true,
				digits:true
			},
			medida: {
				required: true
			},
			listProdutos: {
				required: true
			}
		},
		messages: {
			quantidade: {
				required: "Quantidade é obrigatorio!",
				digits: "Quantidade deve ser apenas numeros"
			},
			medida: {
				required: "Favor informar uma medida"
			},
			listProdutos: {
				required: "Favor informar um produto"
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

		if($row_haul != null)
		{	
			$arrayE = array();
			$arrayC = array();
			$arrayProduto = array('A','B','C','D');
			$arrayModelo = array('A','B','C','D');
			$arrayUnidade = array('A','B','C','D');

			foreach ($documento as $doc) {
			 	$Ipl = $doc->IPL;
			}

			foreach($mercadoria as $merc)
			{
				$ID_haul = $merc->ID_HAUL;
				$ROW_ID = $merc->ROW_ID;
				$product = $merc->product;
				$unit = $merc->unit;
				$qty = $merc->qty;
				$brand = $merc->brand;
				$tabacalera = $merc->tabacalera;
				$titulo = "Atualizar mercadoria";
				$id_marca = $merc->id_marca;
				$nome_marca = $merc->nome_marca;
				$id_unidade = $merc->id_unidade_medida;
				$medida = $merc->unidade_medida;
				$id_produto = $merc->id_produto;
				$nome_produto = $merc->nome_produto;
				$id_tabacalera = $merc->id_tabacalera;
				$nome_tabacalera = $merc->nome_tabacalera;

			}

			//var_dump($mercadoria);
			//die;
		}
		else
		{

			$arrayE = array();
			$arrayC = array();
			$arrayProduto = array('A','B','C','D');
			$arrayModelo = array('A','B','C','D');
			$arrayUnidade = array('A','B','C','D');

			foreach ($documento as $doc) {
			 	$Ipl = $doc->IPL;
			}

			$ID_haul = null;
			$ROW_ID = $id_Row;
			$product = null;
			$unit = null;
			$qty = null;
			$brand = null;
			$tabacalera = "Nenhum";
			$titulo = "Cadastrar mercadoria";
			$id_marca = null;
			$nome_marca = null;
			$id_unidade = null;
			$medida = null;
			$id_produto = null;
			$nome_produto = null;
			$id_tabacalera = null;
			$nome_tabacalera = null;

		}

			//$data['unidades_medidas'] = $this->Cont_doct->load_unidades_medidas($idRow);
        	//$data['produtos'] = $this->Cont_doct->load_produtos($idRow);


	?>

	<h2><?php echo $titulo; ?> : <a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>"><?php echo $Ipl; ?></a></h2>


	 
	<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>">Cancelar</a>


	 <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

	 	<!-- abre o formulário de cadastro -->
	   	<?php echo form_open('login/novo_documento/cadastrar_mercadoria', 'id="form-haul-ipl"'); ?>

		<label for="listProdutos">Produto :</label><br/>
			<select name="listProdutos" id="listProdutos" >
				<?php
					if($id_produto != null)
					{
				?>
					<option value="<?php echo $id_produto; ?>"><?php echo $nome_produto ?></option>
				<?php

					}else
					{
				?>
					<option value="">Selecione um produto</option>
				<?php
					}
				?>
				<?php
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

		<label for="medida">Unidade de medida:</label><br/>
			<select name="medida" id="listMedidas" >
				<?php
					if($id_unidade != null)
					{
				?>
					<option value="<?php echo $id_unidade; ?>"><?php echo $medida ?></option>
				<?php

					}else
					{
				?>
					<option value="">Selecione unidade de medida</option>
				<?php
					}
					foreach($unidades_medidas as $medidas):
					{
						if($id_unidade != $medidas->id_unidade_medida)
						{
				?>
					<option value="<?php echo $medidas->id_unidade_medida; ?>"><?php echo $medidas->unidade_medida; ?></option>
				<?php
						}
					}endforeach;
				?>
			</select>
		<div class="error"></div>

		<label for="quantidade">Quantidade:</label><br/>
		<input type="text" name="quantidade" id="quantidade" value="<?php echo $qty ?>"/>
		<div class="error"><?php echo form_error('quantidade'); ?></div>

		<label for="marca">Marca :</label><br/>
			<select name="marca" id="listMarcasProd" >
				<?php
					if($id_marca != null)
					{
				?>
					<option value="<?php echo $id_marca; ?>"><?php echo $nome_marca ?></option>
				<?php

					}else{
				?>
					<option value="">Selecione a marca do produto</option>
				<?php
					} //fim do else...
				
					foreach($marcas_prod as $marca):
					{
						if($marca->id_marca != $id_marca)
						{
				?>
					<option value="<?php echo $marca->id_marca; ?>"><?php echo $marca->nome_marca; ?></option>
				<?php
						} //fim do if de id_marca == Marca->id_marca...
					}endforeach;
				?>
				<option value=" "> </option>
			</select>
		<div class="error"><?php echo form_error('marca'); ?></div>

		<label for="tabacalera">Tabacalera :</label><br/>
			<select name="tabacalera" id="tabacalera" >
				<?php
					if($id_tabacalera != null)
					{
				?>
					<option value="<?php echo $id_tabacalera; ?>"><?php echo $nome_tabacalera ?></option>
				<?php

					}else {
				?>
					<option value="">Selecione tabacalera</option>
				<?php
					}//Fim do else de id_tabacalera...
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
		<div class="error"><?php echo form_error('tabacalera'); ?></div>
		<br>
		<br>

		<input type="hidden" name="row_id" value="<?php echo $id_Row; ?>" />
		<input type="hidden" name="id_haul" value="<?php echo $ID_haul; ?>" />


		<input type="submit" name="Cadastrar" value="Cadastrar Mercadoria"/>
		<br>
		<br>
		<br>
		<br>

	                       
	</div>
	                       
</div>