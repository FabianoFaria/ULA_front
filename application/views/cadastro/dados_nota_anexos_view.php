<script>
$( "#form-new-file-ipl" ).submit(function( event ) {
	alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
	event.preventDefault();
	});

$().ready(function() {
	// validate signup form on keyup and submit
	$("#form-new-file-ipl").validate({
		rules: {
			file_name: {
				required: true,
				minlength: 3
			},
			file_send: {
				required: true
			}
		},
		messages: {
			file_name: {
				required: "Nome do arquivo é obrigatorio!",
				minlength: "Nome do deve ter no minimo 3 caracteres..."
			},
			file_send: {
				required: "Arquivo é obrigatorio!"
				
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

		if($row_anexo != null)
		{	

			foreach ($anexo as $anx) {
			 	$ID_anexo = $anx->ID_anexos;
			 	$id_row = $anx->id_row;
			 	$nome_arquivo = $anx->nome_arquivo;
			 	$location = $anx->location;
			}


		}else
		{
			$ID_anexo = null;
			$id_row = null;
			$nome_arquivo = null;
			$location = null;
		}
	?>
	<h2>Atualizar notas e anexos :<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>"><?php echo $Ipl; ?></a> </h2>
	<hr>

	<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>">Cancelar</a>
		<div class="well">
		   <!-- abre o formulário de cadastro -->
		   <?php // echo form_open('novo_documento/cadastrarProtocolo', 'id="form-new-ipl"'); ?>

		<?php //echo $error;?>

		<?php echo form_open_multipart('login/novo_documento/cadastrar_anexo_arquivo', 'id="form-new-file-ipl"');?>

		<label for="file_name">Nome do arquivo:</label><br/>
		<input type="text" name="file_name" id="file_name" value="<?php echo $nome_arquivo; ?>"/>
		<div class="error"><?php echo form_error('file_name'); ?></div>

		<label for="file_send">Indique o caminho para o arquivo:</label><br/>
		<input type="file" id="file_send" name="file_send" value="<?php echo set_value('file_send'); ?>"/>
		<div class="error"><?php echo form_error('file_send'); ?></div>

		<input type="hidden" name="row_id" value="<?php echo $id_Row; ?>" />
		<input type="hidden" name="ID_anexo" value="<?php echo $ID_anexo; ?>" />
		<BR>
		<br>
		<br>

		<input type="submit" name="Cadastrar" value="Cadastrar nota e anexo" />
	   </div>


</div>