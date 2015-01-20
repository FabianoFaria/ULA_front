<script>

$(function () {

   pathArray = window.location.href.split( '/' );
     protocol = pathArray[0];
     host = pathArray[2];
     urlP = protocol + '//' + host;


    $("#cadUnit").click(function (e) {
       e.preventDefault();
        var that = this,
        nova_unidade = $("#nova_unidade").val();
        sigla_unit = $("#sigla_unidade").val();

          $.ajax({
             url: urlP+"/sis/index.php/login/cadastro_conteudo/cadUnidade",
             secureuri: false,
             type : "POST",
             dataType  :'json',
             data      : {
              'nome_unidade' : nova_unidade,
              'sigla_unidade' : sigla_unit
              },
                   success : function(datra)
                    {
                       //tempTest = JSON(datra);

                       if(datra.status != 'erro')
                       {
                          var contato = datra.contato;

                          $('#myModalLabel').html("Unidade cadastrada com sucesso!");
                       }
                       else
                       {
                         $('#myModalLabel').html("Erro durante cadastro");
                       }  

                    },
                   error: function(jqXHR, textStatus, errorThrown)
                    {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus +" "+errorThrown+" "+jqXHR);
                    // STOP LOADING SPINNER
                    }

        });
        return false;

    });
       
});


function atualizarProd(IDProd,statusProd)
{
  pathArray = window.location.href.split( '/' );
     protocol = pathArray[0];
     host = pathArray[2];
     urlP = protocol + '//' + host;

     var statusP = 0;

     if(statusProd === 0)
     {
        statusP = 1;
     }else
     if(statusProd === 1){
        statusP = 0;
     }

     $.ajax({
      url: urlP+"/sis/index.php/login/cadastro_conteudo/atualizar_produto",
      secureuri: false,
      type : "POST",
      dataType  :'json',
      data      : {
        'id_produto' : IDProd,
        'novoStatus' : statusP
      },
          success : function(datra)
          {

                  var novoStat = datra.status_prod; 
                  var produtoN = datra.produto; 

                  if(datra.status_prod === '0' )
                  {
                     $('#statusProd_'+produtoN+'').html("Ativo");
                     $('#linkProd_'+produtoN+'').html("<a href='javascript:void(0);' onClick='atualizarProd("+produtoN+","+novoStat+")'>Ativar/Desativar</a>");
                  }else
                  if(datra.status_prod === '1')
                  {
                    $('#statusProd_'+produtoN+'').html("desativado");
                    $('#linkProd_'+produtoN+'').html("<a href='javascript:void(0);' onClick='atualizarProd("+produtoN+","+novoStat+")'>Ativar/Desativar</a>");
                  }


          },
              error: function(jqXHR, textStatus, errorThrown)
              {
                // Handle errors here
                console.log('ERRORS: ' + textStatus +" "+errorThrown+" "+jqXHR);
                // STOP LOADING SPINNER
              }

        });

   

  return false;

}



</script>


<div class="col-md-10 col-sm-10 col-xs-10 lista-ipls table-responsive">
                        <h3>Unidades de segurança cadastrados atualmente</h3>

                        <br>

                          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Cadastrar nova unidade</button>

                        <br>

                          <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Cadastro de unidade de segurança</h4>
                                  </div>
                                  <div class="modal-body">
                                     <form action="ajax" method="POST" >
                                        <label for="nova_unidade">Nome da unidade :</label><br/> 
                                          <input type="text" name="nova_unidade" id="nova_unidade" value=""/>
                                        <br>
                                        <label for="sigla_unidade">Sigla da unidade :</label><br/> 
                                          <input type="text" name="sigla_unidade" id="sigla_unidade" value=""/>
                                          <br>
                                          <br>
                                          <input id="cadUnit" type="submit" name="Cadastrar" value="Cadastrar unidade" />
                                     </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                          <!-- Fim da  Modal -->

                          <br>

                        <hr>

                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Ação</th>
                              <th>Nome da unidade</th>
                              <th>Sigla da unidade</th>
          
                            </tr>
                          </thead>
                          <tbody>
                                <?php 

                               
                                if($unidades_seguranca == false)
                                {

                                ?>
                                    <p>Nenhum produto cadastrado...</p>
                                <?php

                                } else 
                                {

                                        foreach ($unidades_seguranca as $units) {  

                                        
                                ?>
                                <tr>
                                   <!-- <a href="">Editar</a> -->
                                   <td><a href="<?php echo base_url(); ?>index.php/login/cadastro_conteudo/editar_unidade/<?php echo $units->id_unidade; ?>">Editar</a> </td>
                                   <td><?php echo $units->nome_sigla_unidade; ?></td>
                                   <td><?php echo $units->forca_seguranca; ?></td> 
                                  
                                   
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