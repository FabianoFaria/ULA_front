
<?php

   // var_dump($conteudo);
?>

<div class="row sem_margin">
    <div class="col-md-12 col-sm-12 col-xs-12 main-menu">

        <h2>Exibição do relatorio</h2>
        <div class="row">
    
                    
<?php

    foreach ($conteudo as $ocorrencia) {
                            
       // var_dump($ocorrencia['veiculos']);

        $dataEx = explode("-", $ocorrencia['documento'][0]->arrest_date);
            $month = $dataEx[1];
            $day = $dataEx[2];
            $year = $dataEx[0];

            $dataF = $day."/".$month."/".$year;

?>
    <div class="col-md-6 col-sm-6 col-xs-6 well">
        <h3>Detalhes da ocorrencia</h3>

        <p>Data da ocorrencia : <?php echo $dataF ?></p>
        </br>
        <p>Força de segurança : <?php echo $ocorrencia['documento'][0]->forca_seguranca?></p>
        <p>Nome da operação : <?php echo $ocorrencia['documento'][0]->operation?></p>
        <p>Resumo da operação : <?php echo $ocorrencia['documento'][0]->summary?></p>




    </div> 
    <?php
        if($ocorrencia['endereco'][0] != ""){

            //var_dump($ocorrencia['endereco'][0]);
    ?>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <h3>Endereço da ocorrencia</h3>
        <p>Cidade da ocorrencia : <?php echo $ocorrencia['endereco'][0]->nome_estado ?></p>
        <p>Estado da ocorrencia : <?php echo $ocorrencia['endereco'][0]->nome ?></p>
        <p>Endereço : <?php echo $ocorrencia['endereco'][0]->address ?></p>
        <p>Numero : <?php echo $ocorrencia['endereco'][0]->nunber ?></p>
        <p>Complemento : <?php echo $ocorrencia['endereco'][0]->complement ?></p>
        <p>Bairro : <?php echo $ocorrencia['endereco'][0]->district ?></p>


        
    </div>   
    <?php
        } 
    ?> 

    <div class="row sem_margin">   

        <div class="col-md-6 col-sm-6 col-xs-6">


            <?php


            foreach ($ocorrencia['veiculos'] as $veiculos) {
                                
                    //var_dump($veiculos);

                ?>

            <h3>Veiculo envolvido</h3>
            <p>Tipo do veiculo : <?php echo $veiculos->tpve_nome ?></p>
            <p>Marca do veiculo : <?php echo $veiculos->marc_nome ?></p>
            <p>Modelo do veiculo : <?php echo $veiculos->mode_nome ?></p>
            <p>Placa : <?php echo $veiculos->placa ?></p>
            <p>Chassi : <?php echo $veiculos->chassi ?></p>
            <p>Estado : <?php echo $veiculos->nome_estado ?></p>

            <hr>

            <?php

                }

            ?>

        </div>




    </div>


    <div class="row sem_margin">   

        <div class="col-md-6 col-sm-6 col-xs-6">

            <h3>Imagens da ocorrencia :</h3>
            <?php


            foreach ($ocorrencia['imagens'] as $imagens) {   //$dataDocumento['imagens'] 
                                
                    //var_dump($imagens);
                    if($imagens != null){
                ?>

            
            <p>Nome da foto : <?php echo $imagens->title_image ?></p>
            <img class="list_img" src="<?php echo base_url()."/imagens_doct/".$imagens->nome_image_doct; ?>" /></img>
            <hr>

            <?php
                    }//fim do if
                } //Fim do foreach...

            ?>

        </div>




    </div>





<?php

            /*
                 public 'ID_main' => string '294' (length=3)
      public 'ROW_ID' => string '131' (length=3)
      public 'parent_id' => string '131' (length=3)
      public 'parent_TBL' => string 'tbl_doct' (length=8)
      public 'CHILD_ID' => string '11' (length=2)
      public 'CHILD_TBL' => string 'tbl_image_doct' (length=14)
      public 'UPDATED_BY' => string 'Niguem' (length=6)
      public 'LAST_UPDATE' => string '0000-00-00 00:00:00' (length=19)
      public 'CREATED_BY' => string 'qwe' (length=3)
      public 'CREATED' => string '2014-09-25 03:07:44' (length=19)
      public 'id_image' => string '11' (length=2)
      public 'id_row' => string '131' (length=3)
      public 'title_image' => string 'Foto A' (length=6)
      public 'nome_image_doct' => string '13d6d38b47e0d6a9b714618e37751984.jpg' (length=36)
      public 'UPDATE_BY' => string 'Ninguem' (length=7)

            */
    


        //$dados['dataI'] = $dataIni;
        //$dados['dataF'] = $dataFim;


    } //Fim do foreach conteudo as ocorrencia....


?>

                <form id="gerar_doc" action="<?php echo base_url() ?>index.php/pesquisa/relatorios_gen/relatorio_mes" method="post">
                    <input type="hidden" name="dataI" value="<?php echo $dataRI; ?>">
                    <input type="hidden" name="dataF" value="<?php echo $dataRF; ?>">
                    <input type="submit" value="gerar . DOC">
                </form>


            </div> <!-- fim do row -->
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr>


        </div>
    </div>