<div class="col-md-11 col-sm-11 col-xs-11 lista-ipls table-responsive">
                        <h3>Ultimos usuarios cadastrados</h3>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Ação</th>
                              <th>Login de usuario</th>
                              <th>Nome do usuario</th>
                              <th>CPF usuario</th>
                              <th>Status</th>
                              <th>Cadastrado por</th>
                              <th>Data</th>
                              
                              
                            </tr>
                          </thead>
                          <tbody>
                                <?php 

                               
                                if($usuario == null)
                                {

                                ?>
                                    <p>Nenhum documento cadastrado...</p>
                                <?php

                                } else 
                                {

                                        foreach ($usuario as $usr) {

                                            $dataTemp = explode(" ", $usr->CREATED);
                                            $dataEx2 = explode("-", $dataTemp[0]);
                                            $month2 = $dataEx2[1];
                                            $day2 = $dataEx2[2];
                                            $year2 = $dataEx2[0];

                                            $data_cadastro = $day2."/".$month2."/".$year2;

                                            $status = $usr->status;

                                            if($status == 0)
                                             {
                                                $status_final = 'Desativado';
                                             }else
                                             if($status == 1)
                                             {
                                                $status_final = 'Ativado';
                                             }

                                        
                                ?>
                                <tr>
                                   <td><a href="<?php echo base_url(); ?>index.php/login/login/editar_usuario/<?php echo $usr->ID_user; ?>">Editar</a></td>
                                   <td><?php echo $usr->username; ?></td>
                                   <td><?php echo $usr->nome_usuario; ?></td>
                                   <td><?php echo $usr->cpf_usuario; ?></td>
                                   <td><?php echo $status_final; ?></td>
                                   <td><?php echo $usr->CREATED_BY; ?></td>
                                   <td><?php echo $data_cadastro ?></td>
                                   
                                 
                                </tr>
                                <?php
                                        }//fim do foreach...
                                } //fim do else...

                                ?>
 
                         </tbody>
                        </table>
        
                        <?php //echo $links_usr; variavel utilizada para criação de links para paginação ?>
                    </div>