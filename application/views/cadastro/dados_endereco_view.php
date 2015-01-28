<script>
$( "#form-new-addr-ipl" ).submit(function( event ) {
	alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
	event.preventDefault();
	});

$().ready(function() {
	// validate signup form on keyup and submit
	$("#form-new-addr-ipl").validate({
		rules: {
			endereco: {
				required: false,
				minlength: 3
			},
			estado_apr: {
				required: false
			},
			cidade_apr: {
				required: false
			}
		},
		messages: {
			endereco: {
				required: "Pelo menos um endereço deve ser informado!",
				minlength: "Endereço deve ter pelo menos 3 caracteres..."
			},
			estado_apr: {
				required: "Selecione um estado"
			},
			cidade_apr: {
				required: "Selecione uma cidade"
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



			foreach ($estados as $estado): {
							    		
				$arrayE[] = $estado->nome_estado;

			}endforeach;

			foreach ($cidades as $cidade): { /*Implementar ajax aqui!!!!*/
							    		
				$arrayC[] = $cidade->nome;

			}endforeach;

			foreach ($documento as $doc): {
							    		
				$IPL = $doc->IPL;

			}endforeach;

		//Os dados dos estados e cidades são carregados separadamente
		if($cidadeAdr != null)
		{
			$cidade = $cidadeAdr[0]->nome;
			$id_cidade = $cidadeAdr[0]->id;
		}else
		{
			$cidade = "";
		}

		if($estadoAdr != null)
		{
			$estado = $estadoAdr[0]->nome_estado;
			$id_estado = $estadoAdr[0]->id_estado;
		}else
		{
			$estado = "";
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
			$id_pais = $end->Id_pais;
			$pais = $end->nome_pais;

			//var_dump($endereco);
			//die;

			}
		}else{
			$EndRowid = "";
			$logradouro = "";
			$numero = "";
			$complemento = "";
			$bairro = "";
			$cidade = "";
			$estado = "";
			$CEP = "";
			$pais = "";
			$ID_addr =null;
			$action = "novo_documento/cadastro_endereco";
			$id_pais = null;
			$pais = null;
		}

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
								      document.getElementById("cidade_apr").innerHTML=xmlhttp.responseText;
								    }
								  }
								  xmlhttp.open("GET","<?php echo base_url(); ?>index.php/login/novo_documento/chamaCidade/"+str,true);
								  xmlhttp.send();
								}

								function mostraEstCID(str) {
								  if (str=="") {
								    document.getElementById("cidade_apr").innerHTML="tre";
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
								      document.getElementById("cidade_apr").innerHTML=str;
								    }
								  }
								  xmlhttp.open("GET","<?php echo base_url(); ?>index.php/login/novo_documento/chamaCidade/"+str,true);
								  xmlhttp.send();
								}
							</script>

		<h2>Dados do endereço :<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>"> <?php echo $IPL; ?></a></h2>
		<hr>
		<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>">Cancelar</a>
		<div class="lista-menu well">



		<!-- abre o formulário de cadastro -->
		<?php //echo form_open('login/'.$action, 'id="form-new-ipl"'); ?>

		<form id="form-new-addr-ipl" action="<?php echo base_url("/index.php/login/")."/".$action; ?>" method="post">

			<label for="pais_apr">Pais da ocorrencia:</label><br/>

				<select name="pais_apr" id="pais_apr" onchange="mostraEstCID(this.value)">
					
				<?php
					if( $id_pais != null)
					{
				?>
					<option value="<?php echo $id_pais; ?>"><?php echo $pais ?></option>
				<?php

					}else {
				?>
					<option value="33" select="true">Brasil</option>
				<?php
					}
				?>
			
				<?php

					foreach ($paises as $pais): {
									    		
						// $arrayE[] = $estado->nome;
				?>

					<option value="<?php echo $pais->Id_pais; ?>"><?php echo $pais->nome_pais; ?></option>

				<?php

					}endforeach;

				?>
				</select>
			<div class="error"></div>

			<label for="estado_apr">Estado da ocorrencia:</label><br/>
			<select name="estado_apr" id="estado_apr" onchange="mostraCidades(this.value)">
				<?php
					if( $id_estado != null)
					{
				?>
					<option value="<?php echo $id_estado; ?>"><?php echo $estado ?></option>
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
			<div class="error"><?php echo form_error('estado_apr'); ?></div>

			<label for="cidade_apr">Cidade da ocorrencia:</label><br/>
				<select id="cidade_apr" name="cidade_apr">
					<?php
						if($id_cidade != null)
						{

					?>
						<option selected="true" value="<?php echo $id_cidade; ?>"><?php echo $cidade ?></option>

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
			<div class="error"><?php echo form_error('cidade_apr'); ?></div>

			<label for="endereco">Endereço da ocorrencia:</label><br/>
				<input type="text" name="endereco" id="endereco" value="<?php echo $logradouro; ?>"/>
			<div class="error"><?php echo form_error('endereco'); ?></div>

			<label for="numero_addr">Número:</label><br/>
			<input type="text" name="numero_addr" value="<?php echo $numero; ?>"/>
			<div class="error"><?php echo form_error('numero_addr'); ?></div>

			<label for="complemento">Complemento:</label><br/>
			<input type="text" name="complemento" value="<?php echo $complemento; ?>"/>
			<div class="error"><?php echo form_error('complemento'); ?></div>

			<label for="bairro">Bairro:</label><br/>
			<input type="text" name="bairro" value="<?php echo $bairro; ?>"/>
			<div class="error"><?php echo form_error('bairro'); ?></div>

			<label for="CEP">CEP:</label><br/>
			<input type="text" name="CEP" value="<?php echo $CEP; ?>"/>
			<div class="error"><?php echo form_error('CEP'); ?></div>

			<input type="hidden" name="Row_id" value="<?php echo  $ROW_id;  ?>"/>
			<input type="hidden" name="Addr_id" value="<?php echo  $ID_addr;  ?>"/>


			<input type="submit" name="Cadastrar" value="Atualizar endereço da ocorrencia" />




		</form>
		<!-- fecha o formulário de cadastro -->


	</div>



</div>