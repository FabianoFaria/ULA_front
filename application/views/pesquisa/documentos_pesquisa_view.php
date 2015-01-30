
<?php

   // var_dump($conteudo);

    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

    date_default_timezone_set( 'America/Sao_Paulo' );

  //  echo strftime( '%A, %d de %B de %Y', strtotime( date( 'Y-m-d' ) ) );


?>

<!-- -->
<?php

        //$dataDocumento['imagens']           
        //var_dump($imagens);

/*
    if(is_string ($estadoDestino)){
        $destino = $estadoDestino;
         $idDestino = "";
    }else{
        $destino = $estadoDestino[0]->nome_estado;
        $idDestino = $estadoDestino[0]->id_estado;
    }

    //var_dump($estadoDestino);

     $dataTemp1 = explode("/", $dataRI);
        $dia1 = $dataTemp1[0];
        $mes1 = $dataTemp1[1];
        $ano1 = $dataTemp1[2];
        $dataFinal1 = $ano1."/".$mes1."/".$dia1;

        //Data final...
        $dataTemp2 = explode("/", $dataRF);
        $dia2 = $dataTemp2[0];
        $mes2 = $dataTemp2[1];
        $ano2 = $dataTemp2[2];
        $dataFinal2 = $ano2."/".$mes2."/".$dia2;

<!-- -->

*/

var_dump($documentos);


?>


<div class="row sem_margin lista-ipls">
    <div class="col-md-12 col-sm-12 col-xs-12 main-menu">

        <h2>Exibição do relatório</h2>

        <p>De : <?php echo $dataFinal1; ?> até : <?php echo $dataFinal2; ?></p>

        <p>Estado(s): <?php echo $destino; ?></p>

        <div class="row">
    
                    
        <?php


            foreach ($documentos as $ocorrencia) {
                                    
               // var_dump($ocorrencia['veiculos']);

                $dataEx = explode("-", $ocorrencia['documento'][0]->arrest_date);
                    $month = $dataEx[1];
                    $day = $dataEx[2];
                    $year = $dataEx[0];

                    $dataF = $day."/".$month."/".$year;

        ?>
            <div class="col-md-12 well">

                <div class="row header-ocorrencia">

                    <div class="col-md-6">

                        <h3>Detalhes da ocorrência</h3>

                        <h4>Documento : <?php echo $ocorrencia['documento'][0]->IPL?></h4>

                        <p>Data da ocorrência : <?php echo $dataF ?></p>
                        <p>Força de segurança : <?php echo $ocorrencia['documento'][0]->forca_seguranca?></p>
                        <p>Nome da operação : <?php echo $ocorrencia['documento'][0]->operation?></p>
                        <p>Resumo da operação : <?php echo $ocorrencia['documento'][0]->summary?></p>

                    </div>


                    <?php
                        if($ocorrencia['endereco'][0] != ""){

                            //var_dump($ocorrencia['endereco'][0]);
                    ?>

                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h3>Endereço da ocorrência</h3>
                        <p>Cidade da ocorrência : <?php echo $ocorrencia['endereco'][0]->nome_estado ?></p>
                        <p>Estado da ocorrência : <?php echo $ocorrencia['endereco'][0]->nome ?></p>
                        <p>Endereço : <?php echo $ocorrencia['endereco'][0]->address ?></p>
                        <p>Número : <?php echo $ocorrencia['endereco'][0]->nunber ?></p>
                        <p>Complemento : <?php echo $ocorrencia['endereco'][0]->complement ?></p>
                        <p>Bairro : <?php echo $ocorrencia['endereco'][0]->district ?></p>


                        
                    </div>


                    <?php
                        } 
                    ?>

                </div> <!-- fim  header-ocorrencia -->
                
                <div class="row">

                    <?php
                        if($ocorrencia['endereco_deposito'][0] != ""){

                            //var_dump($ocorrencia['endereco'][0]);
                    ?>


                    <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3>Endereço do depósito</h3>
                            <p>Cidade da ocorrência : <?php echo $ocorrencia['endereco_deposito'][0]->nome_estado ?></p>
                            <p>Estado da ocorrência : <?php echo $ocorrencia['endereco_deposito'][0]->nome ?></p>
                            <p>Endereço : <?php echo $ocorrencia['endereco_deposito'][0]->address ?></p>
                            <p>Número : <?php echo $ocorrencia['endereco_deposito'][0]->nunber ?></p>
                            <p>Complemento : <?php echo $ocorrencia['endereco_deposito'][0]->complement ?></p>
                            <p>Bairro : <?php echo $ocorrencia['endereco_deposito'][0]->district ?></p>
                            
                    </div> 

                    <div class="col-md-6 col-sm-6 col-xs-6">

                    </div>





                     <?php
                        } 
                    ?> 
                </div> <!-- Fim da div row  endereço deposito  -->


                <div class="row">

                     <?php

                    if($ocorrencia['produto_armazens'][0] != "")
                    {
                        //var_dump($ocorrencia['produto_armazens']);

                    ?>
                    <h3>Produtos aprendidos no depósitos</h3>

                    <?php
                    foreach ($ocorrencia['produto_armazens'] as $produtosDep) {
                                        
                            //var_dump($produtosDep);
                    ?>
                    <div class= "col-md-6 col-sm-6 col-xs-6">

                        <p>Produto : <?php echo $produtosDep->nome_produto ?></p>
                        <p>Únidade : <?php echo $produtosDep->unidade_medida ?></p>
                        <p>Quantidade : <?php echo $produtosDep->quantidade_deposito ?></p>
                        <p>Marca : <?php echo $produtosDep->nome_marca ?></p>
                        <p>Tabacalera : <?php echo $produtosDep->nome_tabacalera ?></p>

                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6">
                    </div>

                    <hr>

                    <?php

                            }
                        }
                    ?>


                </div> <!-- Fim da div row  endereço deposito  -->

                <div class="row">

                    <h3>Veículo envolvido</h3>

                     <?php


                        foreach ($ocorrencia['veiculos'] as $veiculos) {
                                        
                            //var_dump($veiculos);

                    ?>
                     <div class="col-md-6 col-sm-6 col-xs-6">
                        <p>Tipo do veículo : <?php echo $veiculos->tpve_nome ?></p>
                        <p>Marca do veículo : <?php echo $veiculos->marc_nome ?></p>
                        <p>Modelo do veículo : <?php echo $veiculos->mode_nome ?></p>
                        <p>Placa : <?php echo $veiculos->placa ?></p>
                        <p>Chassi : <?php echo $veiculos->chassi ?></p>
                        <p>Estado : <?php echo $veiculos->nome_estado ?></p>
                     </div>

                     <div class="col-md-6 col-sm-6 col-xs-6">
                        
                     </div>


                     <hr>


                     <?php

                    }

                    ?>



                </div> <!-- Fim da div row  veiculos -->



                <div class="row">

                    <h3>Imagens da ocorrência :</h3>
                    <?php


                    foreach ($ocorrencia['imagens'] as $imagens) {   //$dataDocumento['imagens'] 
                                        
                            //var_dump($imagens);
                            if($imagens != null){
                    ?>
                        <div class="col-md-6 col-sm-6 col-xs-6">

                            <p>Nome da foto : <?php echo $imagens->title_image ?></p>
                            <img class="list_img" src="<?php echo base_url()."/imagens_doct/".$imagens->nome_image_doct; ?>" /></img>
                            <hr>

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">

                        </div>
                     <?php
                            }//fim do if
                        } //Fim do foreach...

                    ?>




                </div> <!-- Fim da div row imagens -->


            </div>  <!-- Fim do col-md-12 well -->
    
            <?php
                 } //Fim do foreach conteudo as ocorrencia....
            ?>


            <form id="gerar_doc" action="<?php echo base_url() ?>index.php/pesquisa/relatorios_gen/gera_word2" method="post">
                <input type="hidden" name="dataI" value="<?php echo $dataRI; ?>">
                <input type="hidden" name="dataF" value="<?php echo $dataRF; ?>">
                <input type="hidden" name="idEstadoDestino" value="<?php echo $idDestino; ?>">
                <input type="hidden" name="estadoDestino" value="<?php echo $destino; ?>">
                <input type="submit" value="gerar . DOC">
            </form>


        </div> <!-- Fim do row do inicio do relatorio -->

    </div><!-- Fim do col-md-12 do inicio do relatorio -->

</div> <!-- fim do row row sem_margin lista-ipls -->
     

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


    //} //Fim do foreach conteudo as ocorrencia....



?>
                

                


            