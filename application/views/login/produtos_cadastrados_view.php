<script>

$(function () {

   pathArray = window.location.href.split( '/' );
     protocol = pathArray[0];
     host = pathArray[2];
     urlP = protocol + '//' + host;


    var minlength = 3;

    $("#cadProd").click(function (e) {
       e.preventDefault();
        var that = this,
        value = $("#novo_prod").val();

          $.ajax({
             url: urlP+"/sis/index.php/login/cadastro_conteudo/cadProduto",
             secureuri: false,
             type : "POST",
             dataType  :'json',
             data      : {
              'nome_produto' : value
              },
                   success : function(datra)
                    {
                       //tempTest = JSON(datra);

                       if(datra.status != 'erro')
                       {
                          var contato = datra.contato;

                          $('#myModalLabel').html("Produto cadastrado com sucesso!");
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
                                    <h4 class="modal-title" id="myModalLabel">Cadastro de produtos</h4>
                                  </div>
                                  <div class="modal-body">
                                     <form action="ajax" method="POST" >
                                        <label for="novo_prod">Nome do produto :</label><br/> 
                                          <input type="text" name="novo_prod" id="novo_prod" value=""/>
                                          <input id="cadProd" type="submit" name="Cadastrar" value="Cadastrar produto" />
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
                                   <td id="linkProd_<?php echo $prd->id_produto; ?>"><a href="javascript:void(0);" onClick='atualizarProd(<?php echo $prd->id_produto; ?>,<?php echo $prd->deletado; ?>)'>Ativar/Desativar</a> </td>
                                   <td><?php echo $prd->nome_produto; ?></td>
                                   <td id="statusProd_<?php echo $prd->id_produto; ?>"><?php if($prd->deletado == 0){ echo "Ativo";} else {echo "desativado";} ?></td> 
                                  
                                 
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