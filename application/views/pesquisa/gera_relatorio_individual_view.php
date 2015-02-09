<html>
<head>
    <title>Sistema de registro de apreensão</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Le CSS
==========================================================-->


<link href="<?php echo base_url("/assets/ULA_front.css"); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url("/assets/font-awesome.css"); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url("/assets/jquery-ui/jquery-ui.css"); ?>" rel="stylesheet" type="text/css" />

<!--Le JavaScript
==========================================================-->



<script src="<?php echo base_url("/assets/js/jquery-1.9.1.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/bootstrap.js"); ?>"></script>
<script src="<?php echo base_url("/assets/jquery-ui/jquery-ui.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/scripts.js"); ?>"></script>

<script src="<?php echo base_url("/assets/js/jquery.validate.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/additional-methods.js"); ?>"></script>


<?php

   // var_dump($conteudo);

    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

    date_default_timezone_set( 'America/Sao_Paulo' );

  //  echo strftime( '%A, %d de %B de %Y', strtotime( date( 'Y-m-d' ) ) );

?>

</head>
    <body>
        <div class="row sem_margin">
            <div class="quebra_pagina">
                  <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br> 
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                  <h2 class="centro-relatorio">Relatório de pesquisa</h2>
                  <br>
                  <br>
                  <br>
                  <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
            </div>

		<?php

         if(!empty($extra[0]->ID_vehicle))
        {
            
        ?>
        <h2>Dados do veículo</h2>

        <p>Tipo do veículo :<?php echo $extra[0]->tpve_nome;  ?></p>
        <p>Marca do veículo : <?php echo $extra[0]->marc_nome;  ?></p>
        <p>Modelo do veículo : <?php echo $extra[0]->model;  ?></p>
        <p>Placa :<?php echo $extra[0]->placa;  ?></p>
        <p>Placa adicional:<?php echo $extra[0]->placa_extra;  ?></p>
        <p>Placa adicional:<?php echo $extra[0]->placa_extra2;  ?></p>
        <p>Chassi :<?php echo $extra[0]->chassi;  ?></p>
        <p>Renavan :<?php echo $extra[0]->renavan;  ?></p>
        <p>Estado da placa :<?php echo $extra[0]->nome_estado;  ?></p>
        <p>Cidade da placa :<?php echo $extra[0]->nome;  ?></p>
        <?php

        }
        if(!empty($extra[0]->ID_contact))
        {
           
            //Data final...
            $dataTemp2 = explode("-", $extra[0]->birth_dt);
            $dia2 = $dataTemp2[0];
            $mes2 = $dataTemp2[1];
            $ano2 = $dataTemp2[2];
            $dataFinal2 = $ano2."/".$mes2."/".$dia2;


        ?>
        <h2>Dados do indivíduo</h2>    

        <p>Nome do indivíduo :<?php echo $extra[0]->name;  ?></p>
        <p>Data de nascimento : <?php echo $dataFinal2; ?></p>
        <p>Gênero : <?php if($extra[0]->genre = 'F'){echo "Feminino";} else{echo "Masculino";} ?></p>
        <p>None do pai :<?php echo $extra[0]->father;  ?></p>
        <p>Nome da mâe :<?php echo $extra[0]->mother;  ?></p>
        <p>Rg :<?php echo $extra[0]->rg;  ?></p>
        <p>CPF :<?php echo $extra[0]->CPF;  ?></p>


        <?php

        }
        if(!empty($extra[0]->ID_addr))
        {
           

        ?>
        <h2>Dados do endereço</h2>    

        <p>Endereço :<?php echo $extra[0]->address;  ?></p>
        <p>Número : <?php echo $extra[0]->nunber;  ?></p>
        <p>Complemento : <?php echo $extra[0]->complement;  ?></p>
        <p>Bairro :<?php echo $extra[0]->district;  ?></p>
        <p>CEP :<?php echo $extra[0]->zipcode;  ?></p>
        <p>Cidade :<?php echo $extra[0]->nome;  ?></p>
        <p>UF :<?php echo $extra[0]->nome_estado;  ?></p>

        <?php
        }


        ?>

        <h2>Relação de ocorrências</h2>


        <?php


            //var_dump($conteudo);


            foreach ($conteudo as $conteudoPassado) {


                //var_dump($conteudoPassado['documento']);

                /*  Dados do documento */
                //var_dump($doct);

                    $dataEx3 = explode("-", $conteudoPassado['documento'][0]->arrest_date);
                    $month3 = $dataEx3[1];
                    $day3 = $dataEx3[2];
                    $year3 = $dataEx3[0];

                    $dataOcorrencia = $day3."-".$month3."-".$year3;

                    //  echo strftime( '%A, %d de %B de %Y', strtotime( date( 'Y-m-d' ) ) );
                ?>
                    <hr>
                    <br>

                    <h3></h3>

                    <p>Em <?php echo strftime( '%d de %B de %Y', strtotime( $dataOcorrencia ) ); ?></p>
                    <p>Auto de apresentação e apreensão <?php echo $conteudoPassado['documento'][0]->IPL; ?></p>
                    <p>Unidade de segurança - <?php echo  $conteudoPassado['documento'][0]->forca_seguranca; ?></p>
                    <p>Qualificação - <?php echo $conteudoPassado['documento'][0]->qualification; ?></p>
                <?php
                   
                    if($conteudoPassado['documento'][0]->link_arrest != null)
                    {
                    ?>
                    <p>Link para a reportagem : <?php echo $conteudoPassado['documento'][0]->link_arrest; ?></p>
                    <?php
                    }
                    if($conteudoPassado['documento'][0]->operation != null)
                    {
                    ?>
                      <p>Nome da operaçâo :  <?php echo ucfirst( mb_strtolower($conteudoPassado['documento'][0]->operation)); ?> </p>
                      <p>Resumo da operação : <?php echo ucfirst( mb_strtolower($conteudoPassado['documento'][0]->summary)); ?> </p>
                   <?php
                    }

                    if($conteudoPassado['documento'][0]->nome_estado != null)
                    {
                    ?>
                      <p>Destino da apreensâo : <?php echo $conteudoPassado['documento'][0]->nome_estado; ?> </p>
                   <?php
                    }

                    ///////***  Fim dos dados do documento /////////////

                    ?>
                    

                    ////////////////////////////////////////////////////

                    <?php

                    ////*** Dados dos veiculos apreendidos ///////
                    if(count($conteudoPassado['veiculos']) > 0){
                      ?>
                      <h3>Os seguintes veículos foram apreendidos : </h3>
                      <?php
                        for($i = 0; $i < count($conteudoPassado['veiculos']) ; $i++ ){

                             if($conteudoPassado['veiculos'][$i]->marc_nome != '')
                              {
                                $veiculoNome = $conteudoPassado['veiculos'][$i]->marc_nome;
                              }else{
                                $veiculoNome = " ";
                              }

                              if($conteudoPassado['veiculos'][$i]->mode_nome != '')
                              {
                                $veiculoModelo = $conteudoPassado['veiculos'][$i]->mode_nome;
                              }
                              else{
                                $veiculoModelo = " ";
                              }
                              /* Cor veiculo */
                              if($conteudoPassado['veiculos'][$i]->cor_veiculo != '')
                              {
                                $veiculoCor = ", cor ".$conteudoPassado['veiculos'][$i]->cor_veiculo;
                              }
                              else{
                                $veiculoCor = " ";
                              }
                              /*`Placa */
                              if($conteudoPassado['veiculos'][$i]->placa != '')
                              {
                                $veiculoPlaca = ", placa ".$conteudoPassado['veiculos'][$i]->placa;
                              }else{
                                $veiculoPlaca = " ";
                              }
                               /*`Placa extra */
                              if($conteudoPassado['veiculos'][$i]->placa_extra != '')
                              {
                                $veiculoPlacaEx = ", placa adicional ".$conteudoPassado['veiculos'][$i]->placa_extra;
                              }else{
                                $veiculoPlacaEx = " ";
                              }
                               /*`Placa extra 2*/
                              if($conteudoPassado['veiculos'][$i]->placa_extra2 != '')
                              {
                                $veiculoPlacaEx2 = ", placa adicional ".$conteudoPassado['veiculos'][$i]->placa_extra2;
                              }else{
                                $veiculoPlacaEx2 = " ";
                              }
                              /* Chassi */
                              if($conteudoPassado['veiculos'][$i]->chassi != '')
                              {
                                $veiculoChassi = ", chassi ".$conteudoPassado['veiculos'][$i]->chassi;
                              }else{
                                $veiculoChassi = " ";
                              }

                              /* Renavam */  
                              if($conteudoPassado['veiculos'][$i]->renavan != '')
                              {
                                $veiculoRenavam = ", renavan ".$conteudoPassado['veiculos'][$i]->renavan;
                              }else{
                                $veiculoRenavam = " ";
                              }

                              /* cidade e estado */
                              if($conteudoPassado['veiculos'][$i]->cidade_nome != '')
                              {
                                $veiculoCidade = ", proveniente de ".$conteudoPassado['veiculos'][$i]->cidade_nome;
                              }else{
                                $veiculoCidade = " ";
                              }


                               if($conteudoPassado['veiculos'][$i]->uf_estado != '')
                              {
                                if($veiculoCidade != " ")
                                {
                                  $veiculoEstado = "/".$conteudoPassado['veiculos'][$i]->uf_estado;
                                }else{
                                  $veiculoEstado = ", proveniente de ".$conteudoPassado['veiculos'][$i]->uf_estado;
                                }
                              }else{
                                $veiculoEstado = " ";
                              }

                        ?>
                            <p>Veículo  : <?php echo $veiculoNome.' '.$veiculoModelo.' '. $veiculoCor .' '.$veiculoPlaca.' '.$veiculoPlacaEx.' '.$veiculoPlacaEx2.' '.$veiculoChassi.' '.$veiculoCidade.''.$veiculoEstado; ?></p>
                        <?php


                        }

                    }
                  // Dados das mercadorias.....
                    if($conteudoPassado['mercadorias'][0] != null){
                      ?>
                      <h3>Foram apreendidos as seguintes mercadorias :</h3>
                      <?php
                      //var_dump($conteudoPassado['mercadorias']);

                        for($i = 0; $i < count($conteudoPassado['mercadorias']) ; $i++ ){
                          ?>
                            <p>Aproximadamente <?php echo $conteudoPassado['mercadorias'][$i]->qty .' '.$conteudoPassado['mercadorias'][$i]->unidade_medida.' de '.$conteudoPassado['mercadorias'][$i]->nome_produto; ?></p>
                          <?php
                          
                            if($conteudoPassado['mercadorias'][$i]->nome_marca != '')
                            {
                              ?>
                               <p>O produto era da marca : <?php echo $conteudoPassado['mercadorias'][$i]->nome_marca; ?></p>
                               <?php 
                            }
                            if($conteudoPassado['mercadorias'][$i]->nome_tabacalera != '' )
                            {
                              ?>
                               <p>Tabacalera : <?php echo $conteudoPassado['mercadorias'][$i]->nome_tabacalera; ?></p>
                              <?php 
                            }

                        }//Fim do for para as mercadorias...

                    }

                  // Dados dos envolvidos.....

                  if($conteudoPassado['envolvidos'][0] != null){
                    ?>
                    <h3>Foram detidos : </h3>
                    <?php
                       for($i = 0; $i < count($conteudoPassado['envolvidos']) ; $i++ ){

                          if($conteudoPassado['envolvidos'][$i]->profession != '')
                          {
                            $profissao = $conteudoPassado['envolvidos'][$i]->profession;
                          }
                          else
                          {
                            $profissao = "";
                          }

                          if($conteudoPassado['envolvidos'][$i]->father != '')
                              {
                                $filho = "filho de ";
                              }
                              else
                              {
                                $filho = " ";
                              }

                               if($conteudoPassado['envolvidos'][$i]->mother != '')
                              {
                                $filho = "filho de ";
                              }
                              else
                              {
                                $filho = " ";
                              }
                              /////////////////////////////////////////////////

                              if($conteudoPassado['envolvidos'][$i]->father != '')
                              {
                                $paiEnvolvido = ucwords( mb_strtolower($conteudoPassado['envolvidos'][$i]->father));
                              }
                              else 
                              {
                                $paiEnvolvido = "";
                              }

                              if($conteudoPassado['envolvidos'][$i]->mother != '')
                              {
                                if($paiEnvolvido != '')
                                {
                                  $maeEnvolvido = " e ".ucwords(mb_strtolower( $conteudoPassado['envolvidos'][$i]->mother));
                                } 
                                else{
                                  $maeEnvolvido = ucwords(mb_strtolower( $conteudoPassado['envolvidos'][$i]->mother));
                                }
                              }
                              else
                              {
                                $maeEnvolvido = "";
                              }
                              //////////////////////////////////////////////////

                              if($conteudoPassado['envolvidos'][$i]->birth_dt != '')
                              {
                                $dataEx4 = explode("-", $conteudoPassado['envolvidos'][$i]->birth_dt);
                                  $month4 = $dataEx4[1];
                                  $day4 = $dataEx4[2];
                                  $year4 = $dataEx4[0];
                                  $dataNascDet =  ", nascido aos ".$day4."/".$month4."/".$year4;
                              }else
                              {
                                $dataNascDet = "";
                              }

                              if($conteudoPassado['envolvidos'][$i]->birth_dt != '')
                              {

                              }
                              if($conteudoPassado['envolvidos'][$i]->nome != '')
                              {
                                $cidadeNasc = "em ".$conteudoPassado['envolvidos'][$i]->nome;
                              }
                              else{
                                $cidadeNasc = " ";
                              }

                              if($conteudoPassado['envolvidos'][$i]->nome_estado != '')
                              {
                                if($cidadeNasc != '')
                                {
                                  $estadoNasc =  "/".$conteudoPassado['envolvidos'][$i]->uf;
                                }
                                else{
                                  $estadoNasc =  "em ".$conteudoPassado['envolvidos'][$i]->uf;
                                }
                                
                              }
                              else{
                                $estadoNasc = '';
                              }

                              /* se possuir CPF */

                              if($conteudoPassado['envolvidos'][$i]->CPF != '' )
                              {
                                $cpfEnvolvido = "Portador do CPF ".$conteudoPassado['envolvidos'][$i]->CPF;
                              }else
                              {
                                $cpfEnvolvido = "";
                              }

                              /* se possuir rg */

                              if($conteudoPassado['envolvidos'][$i]->rg != '' )
                              {
                                if($cpfEnvolvido != '')
                                {
                                  $rgEnvolvido =  "e do RG ".$conteudoPassado['envolvidos'][$i]->rg;
                                }
                                else{
                                  $rgEnvolvido =  "Portador do RG ".$conteudoPassado['envolvidos'][$i]->rg;
                                }
                              }else
                              {
                                $rgEnvolvido = "";
                              }

                              /* Endereço do envolvido */

                              if($conteudoPassado['envolvidos'][$i]->address != '' )
                              {
                                $enderecoResidencia = " residente em ".mb_strtolower($conteudoPassado['envolvidos'][$i]->address);
                              }else
                              {
                                $enderecoResidencia = "";
                              }

                              /* estado e cidade do individuo */
                              if($conteudoPassado['envolvidos'][$i]->end_Cid != '')
                              {
                                $cidadeEnd = " em ".$conteudoPassado['envolvidos'][$i]->end_Cid;
                              }
                              else{
                                $cidadeEnd = "";
                              }

                              if($conteudoPassado['envolvidos'][$i]->end_uf != '')
                              {
                                if($cidadeEnd != '')
                                {
                                  $estadoEnd =  "/".$conteudoPassado['envolvidos'][$i]->end_uf;
                                }
                                else{
                                  $estadoEnd =  " em ".$conteudoPassado['envolvidos'][$i]->end_uf;
                                }
                                
                              }
                              else{
                                $estadoEnd = '';
                              }

                              /* telefone do detido  */

                              if($conteudoPassado['envolvidos'][$i]->telefone != '' )
                              {
                                $telefoneDetido = " Celular :".$conteudoPassado['envolvidos'][$i]->telefone;
                              }else
                              {
                                $telefoneDetido = "";
                              }

                          ?>
                          <p><?php echo ucwords(mb_strtolower($conteudoPassado['envolvidos'][$i]->name)).', '.$profissao.', nascido no '.$conteudoPassado['envolvidos'][$i]->nome_pais.' '.$filho.' '.$paiEnvolvido.' '.$maeEnvolvido.' '.$dataNascDet. ' '.
                  $cidadeNasc."".$estadoNasc." ,". $cpfEnvolvido. " ".$rgEnvolvido." ,".$enderecoResidencia." ".$cidadeEnd."".$estadoEnd.
                  "".$telefoneDetido; ?></p>

                          <?php
                        }
                      } // Fim do if do contato

                    if($conteudoPassado['endereco'][0] != null){
                    ?>
                      <h3>A referida apreensâo ocorreu nas proximidade do endereço :</h3>
                    <?php
                      for($i = 0; $i < 1 ; $i++ ){ //count($conteudoPassado['endereco'])
                        if($conteudoPassado['endereco'][$i]->address != '')
                        {
                          $logradouro = ucfirst( mb_strtolower($conteudoPassado['endereco'][$i]->address));
                        }
                        else {
                          $logradouro = " ";
                        }

                        if($conteudoPassado['endereco'][$i]->nunber != '')
                        {
                          $numeroEnd = "numero ".$conteudoPassado['endereco'][$i]->nunber;
                        }else{
                          $numeroEnd = "";
                        }

                        if($conteudoPassado['endereco'][$i]->nunber != '')
                        {
                          $numeroEnd = "numero ".$conteudoPassado['endereco'][$i]->nunber;
                        }else{
                          $numeroEnd = "";
                        }

                        if($conteudoPassado['endereco'][$i]->complement != '')
                        {
                          $complementEnd = " com a referência ".ucfirst( mb_strtolower($conteudoPassado['endereco'][$i]->complement));
                        }else{
                          $complementEnd = "";
                        }

                        if($conteudoPassado['endereco'][$i]->district != '')
                        {
                          $bairroEnd = " no bairro ".ucfirst( mb_strtolower($conteudoPassado['endereco'][$i]->district));
                        }else{
                          $bairroEnd = "";
                        }

                        if($conteudoPassado['endereco'][$i]->nome != '')
                        {
                          $cidadeEnd = " na cidade de  ".$conteudoPassado['endereco'][$i]->nome;
                        }else{
                          $cidadeEnd = "";
                        }

                        if($conteudoPassado['endereco'][$i]->uf != '')
                        {
                          if($conteudoPassado['endereco'][$i]->nome != '')
                          {
                            $estadoEnd = "/".$conteudoPassado['endereco'][$i]->uf;
                          }else{
                            $estadoEnd = "no estado de ".$conteudoPassado['endereco'][$i]->uf;
                          }
                        }else{
                          $estadoEnd = "";
                        }
                        ?>
                          <p><?php echo $logradouro.' '.$numeroEnd.' '.$complementEnd.' '.$bairroEnd.' '.$cidadeEnd.' '.$estadoEnd; ?></p>
                        <?php
                      }//fim do for de endereço
                    //}//fim do if de envolvidos...

                    ////////////*********** Dados do deposito da ocorrencia /////////////////
                    if($conteudoPassado['endereco_deposito'][0] != null){

                      //var_dump($conteudoPassado['endereco_deposito']);
                        if($conteudoPassado['endereco_deposito'][0]->address != '')
                        {
                          $logradouroDept = $conteudoPassado['endereco_deposito'][0]->address;
                        }
                        else {
                          $logradouroDept = " ";
                        }

                        if($conteudoPassado['endereco_deposito'][0]->nunber != '')
                        {
                          $numeroDept = "número ".$conteudoPassado['endereco_deposito'][0]->nunber;
                        }else{
                          $numeroDept = "";
                        }

                        if($conteudoPassado['endereco_deposito'][0]->complement != '')
                        {
                          $complementDept = " com a referência ".ucfirst( mb_strtolower($conteudoPassado['endereco_deposito'][0]->complement));
                        }else{
                          $complementDept = "";
                        }

                        if($conteudoPassado['endereco_deposito'][0]->district != '')
                        {
                          $bairroDept = " no bairro ".ucfirst( mb_strtolower($conteudoPassado['endereco_deposito'][0]->district));
                        }else{
                          $bairroDept = "";
                        }

                        if($conteudoPassado['endereco_deposito'][0]->nome != '')
                        {
                          $cidadeDept = " na cidade de  ".ucfirst( mb_strtolower($conteudoPassado['endereco_deposito'][0]->nome));
                        }else{
                          $cidadeDept = "";
                        }

                        if($conteudoPassado['endereco_deposito'][0]->uf != '')
                        {
                          if($conteudoPassado['endereco_deposito'][0]->nome != '')
                          {
                            $estadoDept = "/".$conteudoPassado['endereco_deposito'][0]->uf;
                          }else{
                            $estadoDept = "no estado de ".$conteudoPassado['endereco_deposito'][0]->uf;
                          }
                        }else{
                          $estadoDept = "";
                        }

                      ?>
                        <p><?php echo 'Nesta apreensâo foi localizado um depósito no seguinte endereço : '.$logradouroDept.' '.$numeroDept.' '.$complementDept.' '.$bairroDept.' '.$cidadeDept.' '.$estadoDept; ?></p>
                        
                      <?php 
                        if($conteudoPassado['produto_armazens'][0] != null){

                          ?>
                          <p>Neste depósito foram encontrado os seguintes produtos :</p> 
                          <?php

                            for($i = 0; $i < count($conteudoPassado['produto_armazens']) ; $i++ ){
                              if($conteudoPassado['produto_armazens'][$i]->nome_produto != '')
                                {
                                  $nomeProdutoDept = $conteudoPassado['produto_armazens'][$i]->nome_produto;
                                }else{
                                  $produtoDept = " ";
                                }
                                /* quantidade */

                                 if($conteudoPassado['produto_armazens'][$i]->quantidade_deposito != '')
                                {
                                  $quantProdutoDept = $conteudoPassado['produto_armazens'][$i]->quantidade_deposito;
                                }else{
                                  $quantProdutoDept = " ";
                                }

                                /* Unidade de medida */

                                if($conteudoPassado['produto_armazens'][$i]->unidade_medida != '')
                                {
                                  $unidadeProdutoDept = $conteudoPassado['produto_armazens'][$i]->unidade_medida;
                                }else{
                                  $unidadeProdutoDept = " ";
                                }


                                /* nome da marca  */
                                if($conteudoPassado['produto_armazens'][$i]->nome_marca){
                                  $marcaProd = " ,da marca :".$conteudoPassado['produto_armazens'][$i]->nome_marca;
                                }else{
                                  $marcaProd = "";
                                }

                                 /* tabacalera  */
                                if($conteudoPassado['produto_armazens'][$i]->nome_marca){
                                  $tabacaleraProd = " ,da tabacalera :".$conteudoPassado['produto_armazens'][$i]->nome_tabacalera;
                                }else{
                                  $tabacaleraProd = "";
                                }
                                ?>
                                <p><?php echo $quantProdutoDept.' '.$unidadeProdutoDept.' de '.$nomeProdutoDept.' '.$marcaProd.' '.$tabacaleraProd; ?></p>
                                <?php

                            } //Fim do for de pordutos do armazem

                        }
                        //Fim do if dos produtos do armazem


                      //fim dos dados do endereço de 
                    }///fim do if de endereço do deposito ...

                    ////////////////// Dados sobre imagens  /////////////////////
                      if($conteudoPassado['imagens'][0] != null){
                        //var_dump($conteudoPassado['imagens'][0]);

                        ?>
                        <h3>Imagens da apreensão :</h3>
                        <?php 
                        for($i = 0; $i < count($conteudoPassado['imagens']) ; $i++ ){ 
                          $tempImg = $conteudoPassado['imagens'][$i]->nome_image_doct;

                          ?>
                             <br>
                             <br>
                             <img class="list_img" src="<?php echo base_url()."/imagens_doct/".$tempImg; ?>" alt="<?php echo $conteudoPassado['imagens'][$i]->title_image; ?>" height="150" width="250" /></img>
                             <br>
                          <?php
                        }

                      } //fim do if de imagens 

                    ////////////*********** Dados para preencher a tabela /////////////////
                   }
                }///Fim do for each geral....


            ?>
            <hr>          
          
            <!-- Fim dos dados do relatorio  -->
        </div> <!-- Fim da row do relatorio  -->
    </body>
</html>
