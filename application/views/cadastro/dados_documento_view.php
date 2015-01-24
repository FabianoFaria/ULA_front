<script>
$( "#form-new-ipl" ).submit(function( event ) {
	alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
	event.preventDefault();
	});

$().ready(function() {
	// validate signup form on keyup and submit
	$("#form-new-ipl").validate({
		rules: {
			Ipl_manual: {
				required: true,
				minlength: 3
			},
			unidade_seguranca: {
				required: true
			},
			destinoCarga: {
				required: true
			}
		},
		messages: {
			Ipl_manual: {
				required: "Nome da IPL é obrigatorio!",
				minlength: "Nome da IPL deve ter no minimo 3 caracteres..."
			},
			unidade_seguranca: {
				required: "Selecione uma unidade de segurança..."
			},
			destinoCarga: {
				required: "Selecione o estado de destino..."
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
							 $arrayQuali = array('A','B','C','D');
							 $arrayUnidade = array('A','B','C','D');


							 foreach ($estados as $estado): {
							    		
							    $arrayE[] = $estado->nome_estado;

							  }endforeach;

							 foreach ($cidades as $cidade): { /*Implementar ajax aqui!!!!*/
							    		
							   $arrayC[] = $cidade->nome;

							 }endforeach;


							// var_dump($unidades_seguranca);
							// die;

	?>

	<script>
			$(function() {

			//$( "#datepicker" ).datepicker();
			//$.datepicker.formatDate( "dd-mm-yy" );
			$("#datepicker").datepicker({
				dateFormat: 'dd/mm/yy',
        		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        		maxDate: 0
        		//changeMonth: true,
        		//changeYear: true
				});
			});
	</script>

	<?php

	 	foreach ($documento as $doc) {

	 		//var_dump($documento);
	 		//die;

	 	$dataEx = explode("-", $doc->arrest_date);
        $month = $dataEx[1];
        $day = $dataEx[2];
        $year = $dataEx[0];

        $dataF = $day."/".$month."/".$year;
	 				
	?>

	<h2>Alteração dos dados do documento :<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$doc->ROW_ID.""); ?>"><?php echo $doc->IPL; ?></a> </h2>

	<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$doc->ROW_ID.""); ?>">Cancelar</a>



	 <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

	 	  <!-- abre o formulário de cadastro -->
			<?php echo form_open('login/atualizar_documento/atualizaDoc', 'id="form-update-ipl"'); ?>		

	 		<label for="qualificacao">Qualificação:</label><br/>
				<input type="radio" name="qualificacao" value="Ipl" <?php if($doc->qualification == "Ipl"){echo "checked='true'";} ?> /> IPL<br />
				<input type="radio" name="qualificacao" value="Reportagem" <?php if($doc->qualification == "Reportagem"){echo "checked='true'";} ?> /> Reportagem<br />
				<input type="radio" name="qualificacao" value="Operacao" <?php if($doc->qualification == "Operacao"){echo "checked='true'";} ?> /> Operação <br />
				<input type="radio" name="qualificacao" value="Outro" <?php if($doc->qualification == "Outro"){echo "checked='true'";} ?> /> Outro
			<div class="error"><?php echo form_error('qualificacao'); ?></div>

			<label for="unidade_seguranca">Unidade de segurança:</label><br/>
				<select name="unidade_seguranca" id="listMarcas" onchange="mostraModelos2(this.value)">
					<?php
						if(($doc->id_unidade) != 1)
						{
					?>
						<option value="<?php echo $doc->id_unidade; ?>"><?php echo $doc->forca_seguranca ?></option>
					<?php

						}
					?>
					<?php
						foreach($unidades_seguranca as $segurança)
						{
							if($doc->id_unidade != $segurança->id_unidade)
							{
					?>
						<option value="<?php echo $segurança->id_unidade; ?>"><?php echo $segurança->forca_seguranca; ?></option>
					<?php
							}
						} //fim do foreach...
					?>
				</select>
			<div class="error"><?php echo form_error('unidade_seguranca'); ?></div>

			<label for="dataOps">Data da apreensão:</label><br/>
			<input id="datepicker" type="text" name="dataOps" value="<?php echo  $dataF;  ?> "/>
			<div class="error"><?php echo form_error('dataOps'); ?></div>

			<label for="linkOps">Link da reportagem:</label><br/>
			<input type="text" name="linkOps" value="<?php echo  $doc->link_arrest; ?>"/>
			<div class="error"><?php echo form_error('linkOps'); ?></div>

			<label for="resumoOps">Resumo da operação :</label><br/>
			<textarea name="resumoOps" ><?php echo  $doc->summary;  ?></textarea>
			<div class="error"><?php echo form_error('resumoOps'); ?></div>

			<label for="nomeOps">Nome da operação :</label><br/>
			<input name="nomeOps" value="<?php echo  $doc->operation;  ?>"/>
			<div class="error"><?php echo form_error('nomeOps'); ?></div>

			<label for="destinoCarga">Destino da apreensão :</label><br/>
				<select name="destinoCarga" id="destinoCarga" onchange="">
										<?php
											if(($doc->id_estado) != 0)
											{
										?>
											<option value="<?php echo $doc->id_estado; ?>"><?php echo $doc->nome_estado ?></option>
										<?php

											}
										?>
										<?php

											foreach ($estados as $estado): {
															    		
												// $arrayE[] = $estado->nome;
												if($doc->id_estado != $estado->id_estado)
												{
										?>

											<option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->nome_estado; ?></option>
												
										<?php
												}
											}endforeach;

										?>
									</select>
			<div class="error"></div>

			 <input type="hidden" name="IPLValue" value="<?php echo  $doc->IPL;  ?>"/>
			 <input type="hidden" name="Row_id" value="<?php echo  $ROW_id;  ?>"/>

			<input type="submit" name="Cadastrar" value="Atualizar Ocorrencia" />


			<?php echo form_close(); ?>
			<!-- fecha o formulário de cadastro -->
	                       
	                       
	</div>


                

	</div>


<?php
		//fim do foreach
	 }


?>

</div>