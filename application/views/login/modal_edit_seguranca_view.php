<?php 

  foreach ($unidade_seg as $unit) {
  
    $id_unit = $unit->id_unidade;
    $sigla_unidade = $unit->nome_sigla_unidade;
    $nome_unidade = $unit->forca_seguranca;


  }


?>

  <div class="modal-content">
   
       
        <h4 class="modal-title" id="myModalLabel">Editar unidade de segurança</h4>

        <?php

          if($atualizado != null)
          {
            echo "<br><br><h3>Unidade Atualizada</h3><br><br>";
          }

        ?>
    
    <div class="modal-body">
        <form action="<?php echo base_url() ?>/index.php/login/cadastro_conteudo/atualizar_unidade_seguranca" method="POST" >
          <label for="nova_unidade">Nome da unidade :</label><br/> 
            <input type="text" name="nova_unidade" id="nova_unidade" value="<?php echo $nome_unidade; ?>"/>
            <br>
            <label for="sigla_unidade">Sigla da unidade :</label><br/> 
            <input type="text" name="sigla_unidade" id="sigla_unidade" value="<?php echo $sigla_unidade; ?>"/>
            <br>
            <br>

            <input type="hidden" name="id_unit" name="Cadastrar" value="<?php echo $id_unit; ?>" />

            <input id="cadUnit" type="submit" name="Cadastrar" value="Cadastrar unidade" />
        </form>
    </div>

  </div>

                          