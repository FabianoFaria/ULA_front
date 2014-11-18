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
	






</div>