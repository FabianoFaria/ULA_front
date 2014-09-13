<div class="row sem_margin">

	<?php

	 		foreach ($documento as $doct) {
	 			$Ipl_number = $doct->IPL;
	 			$rowId = $doct->ROW_ID;
	 		}

	 	?>


	<h2>Continuando cadastro da apreensão : <?php echo $Ipl_number; ?></h2>


	 <div class="col-md-12 col-sm-12 col-xs-12 lista-menu">

	 	<ul>
	 		<li><a href="<?php echo base_url("index.php/login/continuando_documento/Endereco/".$rowId.""); ?>">Atualizar endereço</a></li>
	 		<li><a href="<?php echo base_url("index.php/login/continuando_documento/Mercadorias/".$rowId.""); ?>">Adicionar mercadorias apreendidas</a></li>
	 		<li><a href="<?php echo base_url("index.php/login/continuando_documento/Detidos/".$rowId.""); ?>">Adicionar detidos</a></li>
	 		<li><a href="<?php echo base_url("index.php/login/continuando_documento/Veiculos/".$rowId.""); ?>">adicionar véiculos</a></li>
	 		<li><a href="<?php echo base_url("index.php/login/continuando_documento/Depositos/".$rowId.""); ?>">Adicionar depósito</a></li>
	 		<li><a href="<?php echo base_url("index.php/login/continuando_documento/NotasAnexos/".$rowId.""); ?>">Notas e anexos</a></li>
	 		<li><a href="<?php echo base_url("index.php/login/area_restrita"); ?>">Concluir voltar para o menu principal</a></li>

	 	</ul>
	                       
	</div>
	                       

	</div>





</div>
