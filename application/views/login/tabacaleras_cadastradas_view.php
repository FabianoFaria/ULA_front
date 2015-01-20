<script>

$(function () {

   pathArray = window.location.href.split( '/' );
     protocol = pathArray[0];
     host = pathArray[2];
     urlP = protocol + '//' + host;


    var minlength = 3;

    $("#cadTaba").click(function (e) {
       e.preventDefault();
        var that = this,
        value = $("#novo_taba").val();

          $.ajax({
             ContentType : 'application/x-www-form-urlencoded; charset=UTF-8',
             url: urlP+"/sis/index.php/login/cadastro_conteudo/cadTabacalera", ///ULA_front2/index.php/login/cadastro_conteudo/cadTabacalera",
             secureuri: false,
             type : "POST",
             dataType  :'json',
             data      : {
              'nome_tabacalera' : value
              },
                   success : function(datra)
                    {
                       //tempTest = JSON(datra);

                       if(datra.status != 'erro')
                       {
                          var tabacalera = datra.tabacalera;

                          $('#myModalLabel').html("Tabacalera cadastrada com sucesso!");
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


function atualizarTaba(IDTab,statusTaba)
{
  pathArray = window.location.href.split( '/' );
     protocol = pathArray[0];
     host = pathArray[2];
     urlP = protocol + '//' + host;

     var statusT = 0;

     if(statusTaba === 0)
     {
        statusT = 1;
     }else
     if(statusTaba === 1){
        statusT = 0;
     }

     $.ajax({
      ContentType : 'application/x-www-form-urlencoded; charset=UTF-8',
      url: urlP+"/sis/index.php/login/cadastro_conteudo/atualizar_tabacalera", ///ULA_front2/index.php/login/cadastro_conteudo/atualizar_tabacalera",
      secureuri: false,
      type : "POST",
      dataType  :'json',
      data      : {
        'id_tabacalera' : IDTab,
        'novoStatus' : statusT
      },
          success : function(datra)
          {

                  var novoStat = datra.status_taba; 
                  var tabacaleraN = datra.tabacalera; 

                  if(datra.status_taba === '0' )
                  {
                     $('#statusTab_'+tabacaleraN+'').html("Ativo");
                     $('#linkTab_'+tabacaleraN+'').html("<a href='javascript:void(0);' onClick='atualizarTaba("+tabacaleraN+","+novoStat+")'>Ativar/Desativar</a>");
                  }else
                  if(datra.status_taba === '1')
                  {
                    $('#statusTab_'+tabacaleraN+'').html("desativado");
                    $('#linkTab_'+tabacaleraN+'').html("<a href='javascript:void(0);' onClick='atualizarTaba("+tabacaleraN+","+novoStat+")'>Ativar/Desativar</a>");
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
                        <h3>Tabacaleras cadastrados atualmente</h3>

                        <br>

                          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Cadastrar nova tabacalera</button>

                        <br>

                          <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Cadastro de tabacalera</h4>
                                  </div>
                                  <div class="modal-body">
                                     <form action="ajax" method="POST" >
                                        <label for="novo_taba">Nome da tabacalera :</label><br/> 
                                          <input type="text" name="novo_taba" id="novo_taba" value=""/>
                                          <input id="cadTaba" type="submit" name="Cadastrar" value="Cadastrar tabacalera" />
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
                              <th>Nome da Tabacalera</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                                <?php 

                               
                                if($tabacaleras == false)
                                {

                                ?>
                                    <p>Nenhuma tabacalera cadastrado...</p>
                                <?php

                                } else 
                                {

                                        foreach ($tabacaleras as $tab) {

                                        
                                ?>
                                <tr>
                                   <td id="linkTab_<?php echo $tab->id_tabacalera; ?>"><a href="javascript:void(0);" onClick='atualizarTaba(<?php echo $tab->id_tabacalera; ?>,<?php echo $tab->deletado; ?>)'>Ativar/Desativar</a> </td>
                                   <td><?php echo $tab->nome_tabacalera; ?></td>
                                   <td id="statusTab_<?php echo $tab->id_tabacalera; ?>"><?php if($tab->deletado == 0){ echo "Ativo";} else {echo "desativado";} ?></td> 
                                  
                                 
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