<div class="col-md-10 col-sm-10 col-xs-10 lista-ipls table-responsive">
                        <h3>Produtos cadastrados atualmente</h3>

                        <br>

                          <a class="btn" href="#">Cadastrar novo produto</a>

                        <br>
                        <hr>

                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Ação</th>
                              <th>Nome do produto</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                                <?php 

                               
                                if($produtos == false)
                                {

                                ?>
                                    <p>Nenhum produto cadastrado...</p>
                                <?php

                                } else 
                                {

                                        foreach ($produtos as $prd) {

                                        
                                ?>
                                <tr>
                                   <td><a href="<?php echo base_url(); ?>index.php/login/cadastro_conteudo/atualizar_produto/<?php echo $prd->id_produto; ?>">Editar</a> | <a href="<?php echo base_url("index.php/login/cadastro_conteudo/atualizar_produto/".$prd->id_produto.""); ?>">Excluir</a> </td>
                                   <td><?php echo $prd->nome_produto; ?></td>
                                   <td><?php if($prd->deletado == 0){ echo "Ativo";} else {echo "desativado";} ?></td>
                                   
                                 
                                </tr>
                                <?php
                                        }//fim do foreach...
                                } //fim do else...

                                ?>
 
                         </tbody>
                        </table>
        
                        <?php //echo $links; ?>
                    </div>


                </div> <!-- fim do row -->
                <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>