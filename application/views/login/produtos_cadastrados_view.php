<div class="col-md-10 col-sm-10 col-xs-10 lista-ipls table-responsive">
                        <h3>Produtos cadastrados atualmente</h3>

                        <br>

                          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Cadastrar novo produto</button>

                        <br>

                          <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                  </div>
                                  <div class="modal-body">
                                     <form action="ajax" method="POST" >
                                        <label for="novo_prod">Nome do produto :</label><br/> 
                                          <input type="text" name="novo_prod" id="novo_prod" value=""/>
                                          <input type="submit" name="Cadastrar" value="Cadastrar produto" />
                                          <input type="hidden" name="id_addr" value="" />
                                     </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
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