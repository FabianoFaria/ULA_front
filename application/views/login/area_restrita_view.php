<div class="row sem_margin">
        <div class="col-md-12 col-sm-12 col-xs-12 main-menu sem_margin sem_padding">
                <div class="row sem_margin altura-min">
                    <div class="col-md-2 col-sm-2 col-xs-2 lista-menu  sidebar sem_margin">
                        <h2>Área restrita</h2>
                        <ul class="nav nav-sidebar"> 
                                <?php
                                //trecho para habilitar ou não a edição de conteudo
                                if( ($this->session->userdata('status')) <= 1 )
                                { 
                                ?>
                                    <li><a href="<?php echo base_url(); ?>index.php/novo_documento">Inserir novo documento</a></li>
                                <?php
                                }
                                ?>
                                
                                <li><a href="<?php echo base_url(); ?>index.php/pesquisar_documento">Pesquisar cadastrados</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/pesquisa_avancada">Efetuar pesquisa de documentos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/gerarRelatorios">Gerar relatório</a></li>
                                <!-- conforme for avançando eu adiciono novos itens -->

                                <br>
                                <br>


                        </ul>


                        <br>
                        <br>
                       
                    </div> <!-- fim da classe lista-menu -->
                    <div class="col-md-10 col-sm-10 col-xs-10 lista-ipls table-responsive">
                        <h3>Últimos documentos cadastrados</h3>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Ação</th>
                              <th>Nome/número documento</th>
                              <th>Origem</th>
                              <th>Data</th>
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                                <?php 

                               
                                if($result == false)
                                {

                                ?>
                                    <p>Nenhum documento cadastrado...</p>
                                <?php

                                } else 
                                {

                                        foreach ($result as $doc) {


                                            //var_dump($doc);
                                            //die;


                                            $dataTemp = explode(" ", $doc->arrest_date);
                                            $dataEx2 = explode("-", $dataTemp[0]);
                                            $month2 = $dataEx2[1];
                                            $day2 = $dataEx2[2];
                                            $year2 = $dataEx2[0];

                                            $data_aprensao = $day2."/".$month2."/".$year2;

                                        
                                ?>
                                <tr>
                                   <td><a href="<?php echo base_url(); ?>index.php/detalhes_documento/getTheRow/<?php echo $doc->ROW_ID; ?>">Editar</a> | <a href="<?php echo base_url("index.php/deletar_documento/".$doc->ROW_ID.""); ?>">Excluir</a> </td>
                                   <td><?php echo $doc->IPL; ?></td>
                                   <td><?php echo $doc->qualification; ?></td>
                                   <td><?php echo $data_aprensao ?></td>
                                   
                                 
                                </tr>
                                <?php
                                        }//fim do foreach...
                                } //fim do else...

                                ?>
 
                         </tbody>
                        </table>
        
                        <?php echo $links; ?>
                    </div>


                </div> <!-- fim do row -->
                <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>


</div>
