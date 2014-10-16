<script>
jQuery.validator.addMethod("verificaCPF", function(value, element) {

	    value = value.replace('.','');

	    value = value.replace('.','');

	    cpf = value.replace('-','');

	    while(cpf.length < 11) cpf = "0"+ cpf;

	    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;

	    var a = [];

	    var b = new Number;

	    var c = 11;

	    for (i=0; i<11; i++){

	        a[i] = cpf.charAt(i);

	        if (i < 9) b += (a[i] * --c);

	    }

	    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }

	    b = 0;

	    c = 11;

	    for (y=0; y<10; y++) b += (a[y] * c--);

	    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

	    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;

	    return true;

}); // Mensagem padrão



$( "#form-new-contact-ipl" ).submit(function( event ) {
	alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
	event.preventDefault();
	});

$().ready(function() {
	// validate signup form on keyup and submit
	$("#form-new-contact-ipl").validate({
		rules: {
			nomeD: {
				required: {
					depends: function () {
						if($('#comentariosDet').val()===''){
							return true;
						}else{
							return false;
						}
					//return $("#CPF").val()!='';
					}
				},
				minlength: 3
			},
			CPF: {
				 verificaCPF: {
					depends: function () {
						if($('#CPF').val()!=''){
							return true;
						}else{
							return false;
						}
					//return $("#CPF").val()!='';
					}
				}
				//verificaCPF: true
			},
			estado_nascimento: {
				required: false
			},
			cidade_nascimento: {
				required: false
			},
			telefone: {
				digits: true
			},
			comentariosDet: {
				required :{
					depends: function () {
						if($('#nomeD').val()===''){
							return true;
						}else{
							return false;
						}
					//return $("#CPF").val()!='';
					}
				}
			}
		},
		messages: {
			nomeD: {
				required: "Nome do envolvido é oblrigatorio",
				minlength: "Nome do envolvido deve ter pelo menos 3 caracteres..."
			},
			CPF: {
				//required: " l",
				//verificaCPF: "CPF deve ser um CPF valido!"
			},
			estado_nascimento: {
				required: "Selecione um estado"
			},
			cidade_nascimento: {
				required: "Selecione uma cidade"
			},
			telefone: {
				digits: "Somente digitos.."
			},
			comentariosDet: {
				required : "Comentarios sâo obrigatorios"
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

function mostraCidades(str) {
	if (str=="") {
		document.getElementById("cidade_nascimento").innerHTML="";
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
			document.getElementById("cidade_nascimento").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","<?php echo base_url(); ?>index.php/login/novo_documento/chamaCidade/"+str,true);
	xmlhttp.send();
	}


function mostraCidadesB(str) {
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

</script>

<div class="row sem_margin">
	<?php

		foreach ($documento as $doc) {
			$Ipl = $doc->IPL;
		}

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


		if($row_contact != null)
		{
			foreach( $contato as $cont)
			{
				$titulo = "Atualizar";
				$btnLabel = "Atualizar";
				$id_contact = $cont->ID_contact;
				$ROW_ID = $cont->ROW_ID;
				$name = $cont->name;
				$gernre = $cont->genre;
				$CPF = $cont->CPF;
				$rg = $cont->rg;
				$passport = $cont->passport;
				$father = $cont->father;
				$mother = $cont->mother;
				//
				$birth_city = $cont->birth_city;
				$birth_state = $cont->birth_state;
				$birth_country = $cont->birth_country;
				$country_id = $cont->birth_country;
				$country_name = $cont->nome_pais;
				//$endereco_detido = $cont->endereco_contato;
				//$id_cidade = $cont->id;
				//$cidade = $cont->nome;
				//$id_estado = $cont->id_estado;
				//$estado = $cont->nome_estado;
				 //public 'id_operadora' => string '1' (length=1)
      			 //public 'nome_operadora' => string 'Tim' (length=3)
      			 //public 'logo' => null

				$telefone = $cont->telefone;
				$marca_telefone = $cont->marca_telefone;
				$modelo_telefone = $cont->modelo_telefone;
				$IMEI = $cont->IMEI;
				$operadora = $cont->id_operadora;
				$nome_operadora = $cont->nome_operadora;
				$comentarioDet = $cont->comentarios_detidos;

				$birth_dt = $cont->birth_dt;

				//var_dump($birth_dt);
				//die;

				if($birth_dt == "0000-00-00")
		    	{
		    		$dataF = "";
		    	}else
				if($birth_dt != "")
				{
					$birth_dt = explode("-", $cont->birth_dt);
		        	$month = $birth_dt[1];
		        	$day = $birth_dt[2];
		        	$year = $birth_dt[0];

		        	$dataF = $day."/".$month."/".$year;
		    	}else
		    	{
		    		$dataF = "";
		    	}

			}
		}else
		{
			$titulo = "Cadastrar";
			$btnLabel = "Cadastrar";
			$id_contact = null;
			$ROW_ID = Null;
			$name = Null;
			$gernre = "F";
			$CPF = Null;
			$rg = "";
			$passport = "";
			$father = "";
			$mother = "";
			$birth_dt = "";
			$birth_city ="";
			$birth_state = "";
			$birth_country = "";
			$endereco_detido = "";
			//$country_id = null;
			//$country_name = "";
			//$id_estado = null;
			//$estado = null;

			$telefone = null;
			$marca_telefone = null;
			$modelo_telefone = null;
			$IMEI = null;
			$operadora = null;
			$comentarioDet = "";

			$id_pais = null;
			$pais = null;
			$dataF = "";
		}

		if($endereco != null)
		{	
			foreach( $endereco as $end_det)
			{	
				$id_addr = $end_det->ID_addr;
				$id_pais_det = $end_det->Id_pais;
				$nome_pais_det = $end_det->nome_pais;
				$id_estado_det = $end_det->state;
				$estado_det = $end_det->nome_estado;
				$id_cidade_det = $end_det->city;
				$cidade_det = $end_det->nome;

				$endereco_det = $end_det->address;
				$numero_det = $end_det->nunber;
				$complemento_det = $end_det->complement;
				$distrito_det = $end_det->district;
				$cep_det = $end_det->zipcode;
			}
		}
		else{
			$id_pais_det = null;
			$nome_pais_det = null;
			$id_estado_det = null;
			$estado_det = null;
			$id_cidade_det = null;
			$cidade_det = null;

			$endereco_det = null;
			$numero_det = null;
			$complemento_det = null;
			$distrito_det = null;
			$cep_det = null;
			$id_addr = null;
		}


		//var_dump($contato);
		//die;

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
        		maxDate: 0,
        		changeMonth: true,
        		changeYear: true,
        		yearRange: "-100:+0"
				});
			});
		</script>

		<h2><?php echo $titulo; ?> Dados do detido :<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>"><?php echo $Ipl; ?></a>
</h2>
	<hr>
	

	<a href="<?php echo base_url("/index.php/detalhes_documento/getTheRow/".$id_Row.""); ?>">Cancelar</a>


	 <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

	 	  <!-- abre o formulário de cadastro -->
	   <?php echo form_open('login/novo_documento/cadastrar_envolvido', 'id="form-new-contact-ipl"'); ?>

	   	<label for="nomeD">Nome do detido:</label><br/>
		<input type="text" name="nomeD" id="nomeD" value="<?php echo $name; ?>"/>
		<div class="error"><?php echo form_error('nomeD'); ?></div>

		<label for="genero">Nome do detido:</label><br/>
		<input type="radio" name="genero" value="F" <?php if($gernre == "F"){echo "checked='true'";} ?> /> Feminino<br />
		<input type="radio" name="genero" value="M" <?php if($gernre == "M"){echo "checked='true'";} ?> /> Masculino<br />
		<div class="error"><?php echo form_error('nomeD'); ?></div>

		<label for="CPF">CPF :</label><br/>
		<input type="text" name="CPF" id="CPF" value="<?php echo $CPF; ?>"/>
		<div class="error"><?php echo form_error('CPF'); ?></div>

		<label for="rg">RG :</label><br/>
		<input type="text" name="rg" value="<?php echo $rg; ?>"/>
		<div class="error"><?php echo form_error('rg'); ?></div>

		<label for="passaporte">Passaporte :</label><br/>
		<input type="text" name="passaporte" value="<?php echo $passport; ?>"/>
		<div class="error"><?php echo form_error('passaporte'); ?></div>

		<label for="nome_pai">Nome do pai :</label><br/>
		<input type="text" name="nome_pai" value="<?php echo $father; ?>"/>
		<div class="error"><?php echo form_error('nome_pai'); ?></div>

		<label for="nome_mae">Nome do mâe :</label><br/>
		<input type="text" name="nome_mae" value="<?php echo $mother; ?>"/>
		<div class="error"><?php echo form_error('nome_mae'); ?></div>

		<label for="nascimento">Data de nascimento :</label><br/>
		<input id="datepicker" type="text" name="nascimento" value="<?php echo $dataF; ?>"/>
		<div class="error"><?php echo form_error('nascimento'); ?></div>

		<label for="pais_nascimento">Pais de nascimento :</label><br/>
			<select name="pais_nascimento" id="pais_nascimento" onchange="mostraEstCID(this.value)">
					
				<?php
					if( $country_id != null)
					{
				?>
					<option value="<?php echo $country_id; ?>"><?php echo $country_name ?></option>
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
					<option value=" "> </option>
				</select>

		<div class="error"></div>

		<label for="estado_nascimento">Estado de nascimento :</label><br/>
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
			<div class="error"></div>

		<label for="cidade_nascimento">Cidade de nascimento :</label><br/>
			<select id="cidade_nascimento" name="cidade_nascimento">
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
		<div class="error"></div>


		<br>
		<hr>
		<h3>Dados do endereço do detido :</h3>
		<br>

		<label for="endereco_contato">Endereço :</label><br/>
		<input type="text" name="endereco_contato" id="endereco_contato" value="<?php echo $endereco_det; ?>"/>
		<div class="error"></div>

		<label for="numero_addr_contato">Numero:</label><br/>
		<input type="text" name="numero_addr_contato" value="<?php  echo $numero_det; ?>"/>
		<div class="error"></div>

		<label for="complemento_contato">Complemento:</label><br/>
		<input type="text" name="complemento" value="<?php echo $complemento_det; ?>"/>
		<div class="error"></div>

		<label for="bairro">Bairro:</label><br/>
		<input type="text" name="bairro" value="<?php echo $distrito_det; ?>"/>
		<div class="error"></div>

		<label for="CEP">CEP:</label><br/>
		<input type="text" name="CEP" value="<?php echo $cep_det; ?>"/>
		<div class="error"></div>

		<label for="pais_detido">Pais de nascimento :</label><br/>
			<select name="pais_detido" id="pais_detido" onchange="mostraEstCID(this.value)">
					
				<?php
					if( $id_pais_det != null)
					{
				?>
					<option value="<?php echo $id_pais_det; ?>"><?php echo $nome_pais_det; ?></option>
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
						if($id_pais_det != $pais->Id_pais)
						{
				?>

					<option value="<?php echo $pais->Id_pais; ?>"><?php echo $pais->nome_pais; ?></option>

				<?php
						}

					}endforeach;

				?>
					<option value=" "> </option>
				</select>

		<div class="error"></div>

		<label for="estado_apr">Estado :</label><br/>
			<select name="estado_apr" id="estado_apr" onchange="mostraCidadesB(this.value)">
				<?php
					if( $id_estado_det != null)
					{
				?>
					<option value="<?php echo $id_estado_det; ?>"><?php echo $estado_det ?></option>
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
					if($estado->id_estado != $id_estado_det)
					{
				?>

					<option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->nome_estado; ?></option>

				<?php
					}//fim do if...


					}endforeach;

				?>
				<option value=" "> </option>
			</select>
			<div class="error"></div>

		<label for="cidade_apr">Cidade :</label><br/>
			<select id="cidade_apr" name="cidade_apr">
				<?php

						if($id_cidade_det != null)
						{

					?>
						<option selected="true" value="<?php echo $id_cidade_det; ?>"><?php echo $cidade_det ?></option>

					<?php
						foreach ($estadoDet as $city) {
							if($city->id != $id_cidade_det){
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
		<div class="error"></div> 
		<input type="hidden" name="Addr_id" value="<?php echo $id_addr; ?>" />





		<hr>
		<h3>Dados de contato do detido :</h3>
		<br>

		<label for="telefone">Telefone :</label><br/>
		<input type="text" name="telefone" id="telefone" value="<?php echo $telefone; ?>"/>
		<div class="error"></div>

		<label for="marca_telefone">Marca telefone :</label><br/>
		<input type="text" name="marca_telefone" id="marca_telefone" value="<?php echo $marca_telefone; ?>"/>
		<div class="error"></div>

		<label for="modelo_telefone">Modelo telefone :</label><br/>
		<input type="text" name="modelo_telefone" id="modelo_telefone" value="<?php echo $modelo_telefone; ?>"/>
		<div class="error"></div>

		<label for="IMEI">IMEI :</label><br/>
		<input id="IMEI" type="text" name="IMEI" value="<?php echo $IMEI; ?>"/>
		<div class="error"></div>

		<label for="operadora">Operadora :</label><br/>
			<select id="operadora" name="operadora">
				<?php
					if($operadora != null)
					{
				?>
					<option value="<?php echo $operadora; ?>"><?php echo $nome_operadora; ?></option>
				<?php

					}else{
				?>
					<option value="">Selecione uma operadora:</option>
				<?php
					}
				?>


					<?php
						foreach ($operadoras as $operadoraS) {
							if($operadoraS->id_operadora != $operadora){
					?>
							<option value="<?php  echo $operadoraS->id_operadora ?>"><?php  echo $operadoraS->nome_operadora ?></option>
					<?php
							}//fim do if para cidades iguais...
						}//fim do foreach das cidades do estado carregado
					?>
					<option value=" "> </option>							
				</select>
		<div class="error"></div>
		<br>

		<label for="comentariosDet">Comentarios sobre detidos :</label><br/>
		<textarea id="comentariosDet" name="comentariosDet"><?php echo $comentarioDet; ?></textarea>

		<br>
		<br>

		<input type="hidden" name="row_id" value="<?php echo $id_Row; ?>" />
		<input type="hidden" name="contact_id" value="<?php echo $id_contact; ?>" />

		<input type="submit" name="Cadastrar" value="<?php echo $btnLabel; ?> dados do detido" />
		<br>
		<br>

	                       
	</div>
	<?php

?>

</div>