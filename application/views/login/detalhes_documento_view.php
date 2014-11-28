<?php
	foreach ($Ultimo_documento as $documento) {
		$ROW_ID = $documento->ROW_ID;
		$IPL = $documento->IPL;
		$qualificação = $documento->qualification;
		$nome_operacao = $documento->operation;
		
		$linkOp = $documento->link_arrest;
		$destino = $documento->nome_estado;
		$resumo = $documento->summary;
		$created = $documento->CREATED;
		$created_by = $documento->CREATED_BY;
		//$last_update = $documento->LAST_UPDATE;
		$Update_by = $documento->UPDATE_BY;

		$dataTemp = explode(" ", $documento->LAST_UPDATE);
		$dataEx2 = explode("-", $dataTemp[0]);
        $month2 = $dataEx2[1];
        $day2 = $dataEx2[2];
        $year2 = $dataEx2[0];

         $last_update = $day2."/".$month2."/".$year2;

         if($documento->arrest_date != "0000-00-00")
         {
			$dataEx = explode("-", $documento->arrest_date);
        	$month = $dataEx[1];
        	$day = $dataEx[2];
        	$year = $dataEx[0];

        	$dataF = $day."/".$month."/".$year;
        }else
        {
        	$dataF = "";
        }

	}
		//var_dump($documento);		
		//die;




		if(($unidade_seguranca) != null )
		{
			$unidade_de_segurança = $unidade_seguranca[0]->forca_seguranca;
		}else
			$unidade_de_segurança = "Não informado";
		

?>

<div class="row sem_margin">
	<h2>Detalhes da apreensão</h2>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>IPL : <?php echo $IPL; ?></h3>
		<br>


		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/continueDoc/".$ROW_ID.""); ?>"><i class="fa fa-pencil"></i> Editar</a> - <a href="<?php echo base_url("index.php/deletar_documento/".$ROW_ID.""); ?>"><i class="fa fa-ban"></i> Excluir documeto</a></h4>
		 <?php
		 	}
		 ?>
			<table class="detalhesIpl">
				<tr>
					<th>Qualificação</th><th>Unidade de segurança</th><th>Nome da operação</th><th>Data da apreensão</th><th>Link para a operação/apreensão:</th>
				</tr>

				<tr>
					<td><?php echo $qualificação ?></td><td><?php echo $unidade_de_segurança ?></td><td><?php echo $nome_operacao ?></td><td><?php echo $dataF ?></td><td><?php echo $linkOp; ?></td>
				</tr>
				<tr>
					<th>Resumo :</th><th>Destino da carga:</th><th>Criado por :</th><th>Ultima modificação</th><th>Modificado por</th>
				</tr>
				<tr>
					<td><?php echo $resumo; ?></td><td><?php echo $destino; ?></td><td><?php echo $created_by; ?></td><td><?php echo $last_update; ?></td><td><?php echo $Update_by; ?></td>
				</tr>


			</table>

		<hr>
	</div>

	<?php  

		if($cidadeAdr != null)
		{
			$cidade = $cidadeAdr[0]->nome;
		}else
		{
			$cidade = "";
		}

		if($estadoAdr != null)
		{
			$estado = $estadoAdr[0]->nome_estado;
		}else
		{
			$estado = "";
		}
		
		

		if($endereco != null)
		{
			foreach ($endereco as $end) {
				$EndRowid = $end->ROW_ID;
				$logradouro = $end->address;
				$numero = $end->nunber;
				$complemento = $end->complement;
				$bairro = $end->district;
				$CEP = $end->zipcode;
				$pais = $end->country;
				$actionAdr = "";
			} //fim do foraech
		}else{
			$EndRowid = "";
			$logradouro = "";
			$numero = "";
			$complemento = "";
			$bairro = "";
			$CEP = "";
			$pais = "";
			$actionAdr = "";
		}
	?>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>Endereço</h3>

		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/Endereco/".$ROW_ID.""); ?>"><i class="fa fa-pencil"></i> Editar</a></h4>
		 <?php
		 	}
		 ?>


			<table class="table endereco_Doct">
				<tr>
					<th>Endereço :</th><th>Numero :</th><th>Complemento:</th><th>Bairro:</th><th>Cidade:</th><th>Estado :</th><th>CEP :</th>
				</tr>
				<tr>
					<td><?php echo $logradouro; ?></td><td><?php echo $numero; ?></td><td><?php echo $complemento; ?></td><td><?php echo $bairro; ?></td><td><?php echo $cidade; ?></td><td><?php echo $estado; ?></td><td><?php echo $CEP; ?></td>
				</tr>

			</table>

		<hr>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>Mercadorias</h3>

		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/Mercadorias/".$ROW_ID.""); ?>"><i class="fa fa-plus-square-o"></i> Adicionar</a></h4>
		 <?php
		 	}
		 ?>

		 <table class="table table-striped mercadorias_list">
			<tr>
				<th>Ações</th><th>Mercadorias</th><th>Unidade</th><th>Quantidade</th><th>Marca</th><th>Tabacalera</th>
			</tr>

		<?php  
		foreach ($mercadorias as $merc) {
			$IdMerc = $merc->ID_HAUL;
			$produto = $merc->nome_produto;
			$unidadeMedida = $merc->unidade_medida;
			$quantidade = $merc->qty;
			$marcaMercadoria = $merc->nome_marca;
			$marcaTabacalera = $merc->nome_tabacalera;
		?>
			<tr>
				<td>
					<?php 
						//trecho para habilitar ou não a edição de conteudo
						if( ($this->session->userdata('status')) <= 1 )
						{ 
						?>
						 	<a href="<?php echo base_url("index.php/detalhes_documento/atualizar_mercadoria/".$ROW_ID."/".$IdMerc.""); ?>"><i class="fa fa-pencil"></i> Editar</a> | <a href="<?php echo base_url("index.php/deletar_mercadoria/".$ROW_ID."/".$IdMerc.""); ?>"><i class="fa fa-ban"></i> Excluir</a></li>
						 <?php
						} 
					 ?>
				</td>
				<td><?php echo $produto; ?></td>
				<td><?php echo $unidadeMedida; ?></td>
				<td><?php echo $quantidade; ?></td>
				<td><?php echo $marcaMercadoria; ?></td>
				<td><?php echo $marcaTabacalera; ?></td>
			</tr>


		<?php
		} //fim do foreach

		?>
		</table>
		<hr>
	</div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>Pessoas envolvidas</h3>

		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/Detidos/".$ROW_ID.""); ?>"><i class="fa fa-plus-square-o"></i> Adicionar</a></h4>
		 <?php
		 	}
		 ?>

		<table class="table table-striped mercadorias_list">
			<tr>
				<th>Ações</th><th>Nome do envolvido</th><th>RG</th><th>CPF</th><th>Data de nascimento</th><th>Mâe do envolvido</th><th>Pai do envolvido</th>
			</tr>

		<?php
		foreach ($envolvidos as $envol) {
			$IdEnvol = $envol->ID_contact;
			$nomeEnvolvido = $envol->name;
			$CPFEnvol = $envol->CPF;
			$RGEnvol = $envol->rg;
			$paiEnvol = $envol->father;
			$motherEnvol = $envol->mother;
			$nascimentoEnvol = $envol->birth_dt;
			$cidadeEnvol = $envol->birth_city;
			$estadoEnvol = $envol->birth_state;
			$paisEnvol = $envol->birth_country;

			if($envol->birth_dt != "0000-00-00")
			{
				$dataCon = explode("-", $envol->birth_dt);
        		$month = $dataCon[1];
        		$day = $dataCon[2];
        		$year = $dataCon[0];

        		$dataT = $day."/".$month."/".$year;
			}else
			{
				$dataT = "";
			}
		
		?>

			<tr>
				<td>
					<?php 
						//trecho para habilitar ou não a edição de conteudo
						if( ($this->session->userdata('status')) <= 1 )
						{ 
						?>
						 	<a href="<?php echo base_url("index.php/detalhes_documento/atualizar_contato/".$ROW_ID."/".$IdEnvol.""); ?>"><i class="fa fa-pencil"></i> Editar</a> | <a href="<?php echo base_url("index.php/deletar_pessoas/".$ROW_ID."/".$IdEnvol.""); ?>"><i class="fa fa-ban"></i> Excluir</a></li>
						 <?php
						}
					 ?>
				</td>
				<td><?php echo $nomeEnvolvido; ?></td>
				<td><?php echo $RGEnvol; ?></td>
				<td><?php echo $CPFEnvol; ?></td>
				<td><?php echo $dataT;?></td>
				<td><?php echo $motherEnvol; ?></td>
				<td><?php echo $paiEnvol; ?></td>
			</tr> 

		<?php
			
		} //Fim do foreach

		?>
		</table>
		<hr>
	</div> 


	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>Automoveis envolvidos</h3>

		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/Veiculos/".$ROW_ID.""); ?>"><i class="fa fa-plus-square-o"></i> Adicionar</a></h4>
		 <?php
		 	}
		 ?>


		<table class="table automoveis_list table-striped">
			<tr>
				<th>Ações</th><th>Veículo</th><th>Modelo</th><th>Marca</th><th>Chassi</th><th>Renavam</th><th>Placa</th><th>Cidade PLaca</th><th>UF Placa</th>
			</tr>
		<?php 

		foreach ($automoveis as $carro) {

			$id_carro = $carro->ID_vehicle;
			$carroRowid = $carro->ROW_ID;
			$categoria = $carro->tpve_nome;
			$modelo = $carro->mode_nome;
			$marca = $carro->marc_nome;
			$chassi = $carro->chassi;
			$renavan = $carro->renavan;
			$placa = $carro->placa;
			$cidade = $carro->cidade_nome;
			$estado = $carro->nome_estado;


			//tbl_modelos.mode_nome, tbl_marcas.marc_nome
			?>

			<tr>
				<td>
					<?php 
						//trecho para habilitar ou não a edição de conteudo
						if( ($this->session->userdata('status')) <= 1 )
						{ 
						?>
							<a href="<?php echo base_url("index.php/detalhes_documento/atualizar_auto/".$ROW_ID."/".$id_carro.""); ?>"><i class="fa fa-pencil"></i> Editar</a> | <a href="<?php echo base_url("index.php/deletar_automoveis/".$ROW_ID."/".$id_carro.""); ?>"><i class="fa fa-ban"></i> Excluir</a> </li>
						<?php
						} 

					 ?>
				</td>
				<td><?php echo $categoria; ?></td>
				<td><?php echo $marca; ?></td>
				<td><?php echo $modelo; ?></td>
				<td><?php echo $chassi; ?></td>
				<td><?php echo $renavan; ?></td>
				<td><?php echo $placa; ?></td>
				<td><?php echo $cidade; ?></td>
				<td><?php echo $estado; ?></td>
			</tr>
			
			<?php
		}// fim do foreach

		?>
		</table>
		<hr>
	</div>

	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>Armazem/Casa/Locais da aprensão</h3>


		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/Depositos/".$ROW_ID.""); ?>"><i class="fa fa-plus-square-o"></i> Adicionar</a></h4>
		 <?php
		 	}
		 ?>
		 <table class="table automoveis_list table-striped">
			<tr>
				<th>Ações</th><th>Produto</th><th>Quantidade</th><th>Unidade</th><th>Marca</th>
			</tr>

		<?php  
		foreach ($locais as $local) {

			//var_dump($local);
			//die;
			/*
				public 'ID_wrs' => string '20' (length=2)
				  public 'ROW_ID' => string '113' (length=3)
				  public 'unidade_produto_deposito' => string '2' (length=1)
				  public 'produto_deposito' => string '2' (length=1)
				  public 'marca_produto_deposito' => string '1' (length=1)
				  public 'quantidade_deposito' => string '45' (length=2)
				  public 'tabacalera_produto_deposito' => string '1' (length=1)
				  public 'CREATED' => string '2014-09-08 14:23:20' (length=19)
				  public 'CREATED_BY' => string 'qwe' (length=3)
				  public 'LAST_UPDATE' => string '2014-09-08 14:23:20' (length=19)
				  public 'UPDATED_BY' => string 'qwe' (length=3)
				  public 'id_tabacalera' => string '1' (length=1)
				  public 'nome_tabacalera' => string 'Nenhuma' (length=7)
				  public 'descricao' => string '' (length=0)
				  public 'deletado' => string '0' (length=1)
				  public 'id_produto' => string '2' (length=1)
				  public 'nome_produto' => string 'Narguile' (length=8)
				  public 'id_marca' => string '1' (length=1)
				  public 'nome_marca' => string 'Nenhuma' (length=7)
				  public 'img_logo' => null
				  public 'id_unidade_medida' => string '2' (length=1)
				  public 'sigla_unidade' => string 'kg' (length=2)
				  public 'unidade_medida' => string 'Quilo' (length=5)
			

			*/

			$IdLocal = $local->ID_wrs;
			$produto = $local->nome_produto;
			$quantidade = $local->quantidade_deposito;
			$unidadeMedida = $local->unidade_medida;
			$marcaP = $local->nome_marca;

		?>
		<tr>
			<td>
			<?php 
				//trecho para habilitar ou não a edição de conteudo
				if( ($this->session->userdata('status')) <= 1 )
				{ 
				?>
				 	<a href="<?php echo base_url("index.php/detalhes_documento/atualizar_warehouse/".$ROW_ID."/".$IdLocal.""); ?>"><i class="fa fa-pencil"></i> Editar</a> | <a href="<?php echo base_url("index.php/deletar_warehouse/".$ROW_ID."/".$IdLocal.""); ?>"><i class="fa fa-ban"></i> Excluir</a></li>
				 <?php
				}
			?>
				</td>
				<td><?php echo $produto; ?></td>
				<td><?php echo $quantidade; ?></td>
				<td><?php echo $unidadeMedida; ?></td>
				<td><?php echo $marcaP; ?></td>
		</tr>

		<?php

		} //Fim do foreach

		?>
		</table>
		<hr>
	</div> 

	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>Notas e anexos</h3>


		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/NotasAnexos/".$ROW_ID.""); ?>"><i class="fa fa-plus-square-o"></i> Adicionar</a></h4>
		 <?php
		 	}
		 ?>

		<?php  
		foreach ($anexos as $anexo) {
			$Idanexos = $anexo->ID_anexos;
			$ID_row = $anexo->id_row;
			$nome_do_arquivo = $anexo->nome_arquivo;
			$local_arquivo = $anexo->location;
		?>

			<li>Nome do arquivo : <?php echo $nome_do_arquivo; ?> |  <a href="<?php echo base_url()."/uploads/".$local_arquivo; ?>"><i class="fa fa-download"></i></a> | 
			<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
			?>
			 	<a href="<?php echo base_url("index.php/detalhes_documento/atualizar_anexos/".$ROW_ID."/".$Idanexos.""); ?>"><i class="fa fa-pencil"></i> Editar</a> | <a href="<?php echo base_url("index.php/deletar_anexo/".$ROW_ID."/".$Idanexos.""); ?>"><i class="fa fa-ban"></i> Excluir</a></li>
			 <?php
			} else
			{
				echo "</li>";
			}
			?>

			
			<?php

		}

		?>

		<hr>
	</div> 

	<div class="col-md-12 col-sm-12 col-xs-12">
		<h3>Imagens da operação/apreensão</h3>


		<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
		?>
		 <h4><a href="<?php echo base_url("index.php/continuar_documento/Imagens_doct/".$ROW_ID.""); ?>"><i class="fa fa-plus-square-o"></i> Adicionar</a></h4>
		 <?php
		 	}
		 ?>

		 <table class="table automoveis_list table-striped">
			<tr>
				<th>Ações</th><th>Imagem</th><th>titulo</th><th>Foto</th>
			</tr>

		<?php  
		foreach ($fotos as $foto) {
			$Idfoto = $foto->id_image;
			$id_row = $foto->id_row;
			$title_image = $foto->title_image;
			$filename = $foto->nome_image_doct;
			
		?>
			<?php
			//trecho para habilitar ou não a edição de conteudo
			if( ($this->session->userdata('status')) <= 1 )
			{ 
			?>
			 	
			<tr>
			<td>
			<?php 
				//trecho para habilitar ou não a edição de conteudo
				if( ($this->session->userdata('status')) <= 1 )
				{ 
				?>
				 	<a href="<?php echo base_url("index.php/detalhes_documento/atualizar_img/".$id_row."/".$Idfoto.""); ?>"><i class="fa fa-pencil"></i> Editar</a> | <a href="<?php echo base_url("index.php/deletar_image/".$ROW_ID."/".$Idfoto.""); ?>"><i class="fa fa-ban"></i> Excluir</a></li>
				 <?php
				}
			?>
				</td>
				<td><?php echo $Idfoto; ?></td>
				<td><?php echo $title_image; ?></td>
				<td>
					<img class="list_img" src="<?php echo base_url()."/imagens_doct/".$filename; ?>" /></img>
				</td>
		</tr>

			 <?php
			}
			

		} //fim do for each

		?>	
		</table>
		<hr>
	</div>




</div>