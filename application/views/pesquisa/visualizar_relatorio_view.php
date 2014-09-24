
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

?>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <h3>Detalhes da ocorrencia</h3>

        <p>Data da ocorrencia : <?php echo $ocorrencia['documento'][0]->arrest_date?></p>
        </br>
        <p>Força de segurança : <?php echo $ocorrencia['documento'][0]->forca_seguranca?></p>
        <p>Nome da operação : <?php echo $ocorrencia['documento'][0]->operation?></p>
        <p>Resumo da operação : <?php echo $ocorrencia['documento'][0]->summary?></p>




    </div> 
    <?php
        if($ocorrencia['endereco'][0] != ""){
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




<?php

        //$dados['dataI'] = $dataIni;
        //$dados['dataF'] = $dataFim;

    } //Fim do foreach conteudo as ocorrencia....

?>

                <form id="gerar_doc" action="<?php echo base_url() ?>index.php/pesquisa/relatorios_gen/relatorio_mes" method="post">
                    <input type="hidden" name="dataI" value="<?php echo $dataI; ?>">
                    <input type="hidden" name="dataF" value="<?php echo $dataF; ?>">
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