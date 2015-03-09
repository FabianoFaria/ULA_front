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
            <div class="quebra_espaco_capa">
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
                    <div class="bloco_capa">
                      <h1 class="titulo_capa">RELATÓRIO DE PESQUISA </h1>
                    </div>
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
        <h2 class="texto_categoria">Dados do veículo</h2>

        <p class="texto_normal">Tipo do veículo :<?php echo $extra[0]->tpve_nome;  ?></p>
        <p class="texto_normal">Marca do veículo : <?php echo $extra[0]->marc_nome;  ?></p>
        <p class="texto_normal">Modelo do veículo : <?php echo $extra[0]->model;  ?></p>
        <p class="texto_normal">Placa :<?php echo $extra[0]->placa;  ?></p>
        <p class="texto_normal">Placa adicional:<?php echo $extra[0]->placa_extra;  ?></p>
        <p class="texto_normal">Placa adicional:<?php echo $extra[0]->placa_extra2;  ?></p>
        <p class="texto_normal">Chassi :<?php echo $extra[0]->chassi;  ?></p>
        <p class="texto_normal">Renavan :<?php echo $extra[0]->renavan;  ?></p>
        <p class="texto_normal">Estado da placa :<?php echo $extra[0]->nome_estado;  ?></p>
        <p class="texto_normal">Cidade da placa :<?php echo $extra[0]->nome;  ?></p>
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
        <h2 class="texto_categoria">Dados do indivíduo</h2>    

        <p class="texto_normal">Nome do indivíduo :<?php echo $extra[0]->name;  ?></p>
        <p class="texto_normal">Data de nascimento : <?php echo $dataFinal2; ?></p>
        <p class="texto_normal">Gênero : <?php if($extra[0]->genre = 'F'){echo "Feminino";} else{echo "Masculino";} ?></p>
        <p class="texto_normal">None do pai :<?php echo $extra[0]->father;  ?></p>
        <p class="texto_normal">Nome da mâe :<?php echo $extra[0]->mother;  ?></p>
        <p class="texto_normal">Rg :<?php echo $extra[0]->rg;  ?></p>
        <p class="texto_normal">CPF :<?php echo $extra[0]->CPF;  ?></p>


        <?php

        }
        if(!empty($extra[0]->ID_addr))
        {
           

        ?>
        <h2 class="texto_categoria">Dados do endereço</h2>    

        <p class="texto_normal">Endereço :<?php echo $extra[0]->address;  ?></p>
        <p class="texto_normal">Número : <?php echo $extra[0]->nunber;  ?></p>
        <p class="texto_normal">Complemento : <?php echo $extra[0]->complement;  ?></p>
        <p class="texto_normal">Bairro :<?php echo $extra[0]->district;  ?></p>
        <p class="texto_normal">CEP :<?php echo $extra[0]->zipcode;  ?></p>
        <p class="texto_normal">Cidade :<?php echo $extra[0]->nome;  ?></p>
        <p class="texto_normal">UF :<?php echo $extra[0]->nome_estado;  ?></p>

        <?php
        }


        ?>

        <h2 class="texto_categoria">Relação de ocorrências</h2>


        <?php


            //var_dump($conteudo);

            $totalCaixaCigarros = 0;
            $totalPresosRelatorio = 0;


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

                    <p class="data_ocorrencia">Em <?php echo strftime( '%d de %B de %Y', strtotime( $dataOcorrencia ) ); ?></p>
                    <p class="texto_normal">Auto de apresentação e apreensão <?php echo $conteudoPassado['documento'][0]->IPL; ?></p>
                    <p class="texto_normal">Unidade de segurança - <?php echo  $conteudoPassado['documento'][0]->forca_seguranca; ?></p>
                    <p class="texto_normal">Qualificação - <?php echo $conteudoPassado['documento'][0]->qualification; ?></p>
                <?php
                   
                    if($conteudoPassado['documento'][0]->link_arrest != null)
                    {
                    ?>
                    <p class="texto_normal">Link para a reportagem : <?php echo $conteudoPassado['documento'][0]->link_arrest; ?></p>
                    <?php
                    }
                    if($conteudoPassado['documento'][0]->operation != null)
                    {
                    ?>
                      <p class="texto_normal">Nome da operação :  <?php echo ucfirst( mb_strtolower($conteudoPassado['documento'][0]->operation)); ?> </p>
                      <p class="texto_normal">Resumo da operação : <?php echo ucfirst( mb_strtolower($conteudoPassado['documento'][0]->summary)); ?> </p>
                   <?php
                    }

                    if($conteudoPassado['documento'][0]->nome_estado != null)
                    {
                    ?>
                      <p class="texto_normal">Destino da apreensão : <?php echo $conteudoPassado['documento'][0]->nome_estado; ?> </p>
                   <?php
                    }

                    if($conteudoPassado['documento'][0]->total_arrest != null){
                        $totalPresosRelatorio = $totalPresosRelatorio + $conteudoPassado['documento'][0]->total_arrest;
                      ?>
                      <p class="texto_normal">Pessoas presas : <?php echo $conteudoPassado['documento'][0]->total_arrest; ?> pessoa(s)</p>
                      <?php
                    }

                    ///////***  Fim dos dados do documento /////////////

                    ?>
                    

                  
                    <?php

                    ////*** Dados dos veiculos apreendidos ///////
                    if(count($conteudoPassado['veiculos']) > 0){
                      ?>
                      <h3 class="texto_categoria">Os seguintes veículos foram apreendidos : </h3>
                      <?php
                        for($i = 0; $i < count($conteudoPassado['veiculos']) ; $i++ ){
                             if($conteudoPassado['veiculos'][$i]->category != '')
                              {
                                $veiculoTipo = $conteudoPassado['veiculos'][$i]->tpve_nome;
                              }else{
                                $veiculoTipo = " ";
                              }

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

                              if($conteudoPassado['veiculos'][$i]->city_adicional != ''){
                                 foreach ($cidades as $cidade): {
                                    // $arrayE[] = $estado->nome;
                                    if($cidade->id == $conteudoPassado['veiculos'][$i]->city_adicional)
                                    { 
                                      $procedenciaCityAdd = " de ".$cidade->nome;
                                    }
                                  }endforeach;
                              }else{
                                $procedenciaCityAdd = " ";
                              }

                              if($conteudoPassado['veiculos'][$i]->state_adicional != ''){
                                  foreach ($estados as $estado): {
                                    // $arrayE[] = $estado->nome;
                                    if($estado->id_estado == $conteudoPassado['veiculos'][$i]->state_adicional)
                                    { 
                                      if($procedenciaCityAdd != " "){
                                        $procedenciaEstAdd = "/".$estado->uf;
                                      } else{
                                        $procedenciaEstAdd = " de ".$estado->uf;
                                      } //...else
                                    } //fim do if procedencia cidade
                                  }endforeach;
                              }else{
                                $procedenciaEstAdd = " ";
                              }

                               /*`Placa extra 2*/
                              if($conteudoPassado['veiculos'][$i]->placa_extra2 != '')
                              {
                                $veiculoPlacaEx2 = ", placa adicional ".$conteudoPassado['veiculos'][$i]->placa_extra2;
                              }else{
                                $veiculoPlacaEx2 = " ";
                              }

                              if($conteudoPassado['veiculos'][$i]->city_adicional2 != ''){
                                 foreach ($cidades as $cidade): {
                                    // $arrayE[] = $estado->nome;
                                    if($cidade->id == $conteudoPassado['veiculos'][$i]->city_adicional2)
                                    { 
                                      $procedenciaCityAdd2 = " de ".$cidade->nome;
                                    }
                                  }endforeach;
                              }else{
                                $procedenciaCityAdd2 = " ";
                              }

                              if($conteudoPassado['veiculos'][$i]->state_adicional2 != ''){
                                  foreach ($estados as $estado): {
                                    // $arrayE[] = $estado->nome;
                                    if($estado->id_estado == $conteudoPassado['veiculos'][$i]->state_adicional2)
                                    { 
                                      if($procedenciaCityAdd2 != " "){
                                        $procedenciaEstAdd2 = "/".$estado->uf;
                                      } else{
                                        $procedenciaEstAdd2 = " de ".$estado->uf;
                                      } //...else
                                    } //fim do if procedencia cidade
                                  }endforeach;
                              }else{
                                $procedenciaEstAdd2 = " ";
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

                              if($conteudoPassado['veiculos'][$i]->detalhes_veiculos != '')
                              {
                                $veiculoObs = "Obs : ".$conteudoPassado['veiculos'][$i]->detalhes_veiculos;
                              }else{
                                $veiculoObs = "";
                              }

                        ?>
                            <p class="texto_normal">Veículo  : <?php echo $veiculoTipo.' '.$veiculoNome.' '.$veiculoModelo.' '. $veiculoCor.' '.$veiculoChassi.' '.$veiculoRenavam.' '.$veiculoPlaca.' '.$veiculoCidade.''.$veiculoEstado.' '.$veiculoPlacaEx.' '.$procedenciaCityAdd.' '.$procedenciaEstAdd.' '.$veiculoPlacaEx2.' '.$procedenciaCityAdd2.' '.$procedenciaEstAdd2; ?></p>
                            <p class="texto_normal"><?php echo $veiculoObs; ?></p>
                        <?php


                        }

                    }
                  // Dados das mercadorias.....
                    if($conteudoPassado['mercadorias'][0] != null){
                      ?>
                      <h3 class="texto_categoria">Foram apreendidas as seguintes mercadorias :</h3>
                      <?php
                      //var_dump($conteudoPassado['mercadorias']);

                        for($i = 0; $i < count($conteudoPassado['mercadorias']) ; $i++ ){
                          ?>
                            <p class="texto_normal">Aproximadamente <?php echo $conteudoPassado['mercadorias'][$i]->qty .' '.$conteudoPassado['mercadorias'][$i]->unidade_medida.' de '.$conteudoPassado['mercadorias'][$i]->nome_produto; ?></p>
                          <?php
                          
                            if($conteudoPassado['mercadorias'][$i]->nome_marca != '')
                            {
                              ?>
                               <p class="texto_normal">O produto era da marca : <?php echo $conteudoPassado['mercadorias'][$i]->nome_marca; ?></p>
                               <?php 
                            }
                            if($conteudoPassado['mercadorias'][$i]->nome_tabacalera != '' )
                            {
                              ?>
                               <p class="texto_normal">Tabacalera : <?php echo $conteudoPassado['mercadorias'][$i]->nome_tabacalera; ?></p>
                              <?php 
                            }

                            //Efetuar soma das caixas de cigarro...

                            if(($conteudoPassado['mercadorias'][$i]->product == 10) && ($conteudoPassado['mercadorias'][$i]->unit == 7)){
                              
                            $totalCaixaCigarros = $totalCaixaCigarros + $conteudoPassado['mercadorias'][$i]->qty;

                            }

                        }//Fim do for para as mercadorias...

                    }

                  // Dados dos envolvidos.....

                  if($conteudoPassado['envolvidos'][0] != null){
                    ?>
                    <h3 class="texto_categoria">Foram presos : </h3>
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
                          <p class="texto_normal"><?php echo ucwords(mb_strtolower($conteudoPassado['envolvidos'][$i]->name)).'  '.$profissao.', nascido no'.$conteudoPassado['envolvidos'][$i]->nome_pais.' '.$filho.' '.$paiEnvolvido.' '.$maeEnvolvido.' '.$dataNascDet. ' '.
                  $cidadeNasc."".$estadoNasc." ". $cpfEnvolvido. " ".$rgEnvolvido." ".$enderecoResidencia." ".$cidadeEnd."".$estadoEnd.
                  "".$telefoneDetido; ?></p>

                          <?php
                        }
                      } // Fim do if do contato

                    if($conteudoPassado['endereco'][0] != null){
                    ?>
                      <h3 class="texto_categoria">A referida apreensão ocorreu nas proximidade do endereço :</h3>
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
                          $numeroEnd = "número ".$conteudoPassado['endereco'][$i]->nunber;
                        }else{
                          $numeroEnd = "";
                        }

                        if($conteudoPassado['endereco'][$i]->nunber != '')
                        {
                          $numeroEnd = "número ".$conteudoPassado['endereco'][$i]->nunber;
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
                          <p class="texto_normal"><?php echo $logradouro.' '.$numeroEnd.' '.$complementEnd.' '.$bairroEnd.' '.$cidadeEnd.' '.$estadoEnd; ?></p>
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
                        <p class="texto_normal"><?php echo 'Nesta apreensão foi localizado um depósito no seguinte endereço : '.$logradouroDept.' '.$numeroDept.' '.$complementDept.' '.$bairroDept.' '.$cidadeDept.' '.$estadoDept; ?></p>
                        
                      <?php 
                        if($conteudoPassado['produto_armazens'][0] != null){

                          ?>
                          <p class="texto_normal">Neste depósito foram encontrado os seguintes produtos :</p> 
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
                                <p class="texto_normal"><?php echo $quantProdutoDept.' '.$unidadeProdutoDept.' de '.$nomeProdutoDept.' '.$marcaProd.' '.$tabacaleraProd; ?></p>
                                <?php

                                 //Efetuar soma das caixas de cigarro...

                                  if($conteudoPassado['produto_armazens'][$i]->produto_deposito == 10 && $conteudoPassado['produto_armazens'][$i]->unidade_produto_deposito == 7){
                                    
                                    $tempMilhar = number_format($conteudoPassado['produto_armazens'][$i]->quantidade_deposito, 0,",","");

                                    $totalCaixaCigarros = $totalCaixaCigarros + $tempMilhar;

                                  }

                            } //Fim do for de pordutos do armazem

                        }
                        //Fim do if dos produtos do armazem


                      //fim dos dados do endereço de 
                    }///fim do if de endereço do deposito ...

                    ////////////////// Dados sobre imagens  /////////////////////
                      if($conteudoPassado['imagens'][0] != null){
                        //var_dump($conteudoPassado['imagens'][0]);

                        ?>
                        <h3 class="texto_categoria ">Imagens da apreensão :</h3>
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
            <br>

                      <table>
                          <thead>
                              <tr style='background-color: #EEE'>
                                  <th> Total de apreensões do relatório</th>
                                  <th>
                                  </th>
                              </tr>
                          </thead>    
                          <tbody>
                              <tr>
                                  <td>Total de presos  </td>
                                  <td><?php echo $totalPresosRelatorio; ?></td>            
                              </tr>
                              <tr>
                                  <td>Total de caixas de cigarro  </td>
                                  <td><?php echo $totalCaixaCigarros; ?></td>            
                              </tr>
                              
                          </tbody>
                     </table>           
          
            <!-- Fim dos dados do relatorio  -->
        </div> <!-- Fim da row do relatorio  -->
    </body>
</html>
