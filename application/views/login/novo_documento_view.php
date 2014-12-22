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
				minlength: 3,
				remote: 'login/novo_documento/iplExist'
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
				minlength: "Nome da IPL deve ter no minimo 3 caracteres...",
				remote: 'Já existe uma ipl com esse titulo'
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
        <div class="col-md-12 col-sm-12 col-xs-12 main-menu">

                <h2>Área restrita - Novo documento</h2>
                <div class="row sem_margin">

                	<?php

							 $arrayE = array();
							 $arrayC = array();
							 $arrayQuali = array('A','B','C','D');
							 $arrayUnidade = array('A','B','C','D');

							 foreach ($cidades as $cidade): { /*Implementar ajax aqui!!!!*/
							    		
							   $arrayC[] = $cidade->nome;

							 }endforeach;


						$stringD = $IPL;
							
					?>
					 <script>
						$(function() {

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


	                <div class="col-md-12 col-sm-12 col-xs-12 lista-menu">
	                	<h3>Detalhes do documento</h3>
	                	<hr>
	                </div>

	                <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">
	                	<h3>Detalhes da apreensão</h3>
	                	<hr>
	                	  <!-- abre o formulário de cadastro -->
							<form id="form-new-ipl" action="novo_documento/cadastrarProtocolo" method="post">

							    <label for="Ipl_manual">IPL:</label><br/>
							    <input type="text" name="Ipl_manual" id="Ipl_manual" value=" "/>
							    <div class="error"></div>

							    <label for="qualificacao">Qualificação:</label>
							    <br>
							    	<input type="radio" name="qualificacao" value="Ipl"  checked="true"/> IPL<br />
									<input type="radio" name="qualificacao" value="Reportagem" /> Reportagem<br />
									<input type="radio" name="qualificacao" value="Operacao" /> Operação
								<div class="error"></div>
							    
							    <label for="unidade_seguranca">Unidade de segurança:</label><br/>
							    	<select name="unidade_seguranca" id="unidade_seguranca" onchange="">
										<option value="" selected="true">selecione uma unidade de segurança</option>
										<?php
											foreach($unidades_seguranca as $segurança):
											{
										?>
											<option value="<?php echo $segurança->id_unidade; ?>"><?php echo $segurança->forca_seguranca; ?></option>
										<?php
											}endforeach;
										?>
									</select>
							    <div class="error"></div>

							    <label for="dataOps">Data da apreensão:</label><br/>
							    <input id="datepicker" type="text" name="dataOps" value="<?php echo set_value('dataOps'); ?>"/>
							    <div class="error"><?php echo form_error('dataOps'); ?></div>

							    <label for="linkOps">Link da reportagem:</label><br/>
							    <input type="text" name="linkOps" value="<?php echo set_value('linkOps'); ?>"/>
							    <div class="error"><?php echo form_error('linkOps'); ?></div>

							    <label for="resumoOps">Resumo da operação :</label><br/>
							    <textarea name="resumoOps"></textarea>
							    <div class="error"></div>						    

							    <label for="nomeOps">Nome da operação :</label><br/>
							    <input name="nomeOps" value="<?php echo set_value('nomeOps'); ?>"/>
							    <div class="error"></div>					

							    <label for="destinoCarga">Destino da apreensão :</label><br/>
							   		<select name="destinoCarga" id="destinoCarga" onchange="">
										<option value="">Informe o estado de destino :</option>
										<?php

											foreach ($estados as $estado): {
															    		
												// $arrayE[] = $estado->nome;
										?>

											<option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->nome_estado; ?></option>

										<?php

											}endforeach;

										?>
									</select>
							   	<div class="error"></div>						

	                </div>
	               
							    <input type="hidden" name="IPLValue" value="<?php echo  $stringD;  ?>"/>

							    <input  type="submit" id="cadDocumento" name="Cadastrar" value="Cadastrar ocorrencia" />
							    <br>
							    <div class="error"></div>


							</form>
							    <!-- fecha o formulário de cadastro -->
	                       

	                </div>
	               
	               


	            </div>
	        
        </div>
     </div>
