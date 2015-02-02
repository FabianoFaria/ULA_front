<script>
$(document).ready(function () {

    jQuery.validator.addMethod('comparedata', function (value, element, param) {
        var date1=document.getElementById("dataInicial").value;
        var date2=document.getElementById("dataFinal").value;

        if ($.datepicker.parseDate('dd/mm/yy', date2) > $.datepicker.parseDate('dd/mm/yy', date1)) {
            return true;
        }else
            return false;

    }, 'Data fina deve ser maior que data inicial');

});


$().ready(function() {
    // validate signup form on keyup and submit
    $("#form-relatorio-ipl").validate({
        rules: {
            dataInicial: {
                required: true      
            },
            dataFinal: {
                required: true,
                comparedata: true
            }
        },
        messages: {
            dataInicial: {
                required: "Data inicial é obrigatorio"
            },
            dataFinal: {
                required: "Data final é obrigatorio",
                comparedata: "Data final menor que data inicial"
            }
        }

    });
});
     $( "#form-relatorio-ipl" ).submit(function( event ) {
    alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
    event.preventDefault();
    });
</script>
<?php
        
        $thisYear = date('Y');

        $anos = array($thisYear,$thisYear -1 , $thisYear -2, $thisYear -3, $thisYear -4);
?>

<div class="row sem_margin">
        <script>
               $(function() {

            //$( "#datepicker" ).datepicker();
            //$.datepicker.formatDate( "dd-mm-yy" );
            $("#dataFinal").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                maxDate: 0,
                changeMonth: true,
                changeYear: true
                });
            });
        </script>
        <script>
               $(function() {

            //$( "#datepicker" ).datepicker();
            //$.datepicker.formatDate( "dd-mm-yy" );
            $("#dataInicial").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                maxDate: 0,
                changeMonth: true,
                changeYear: true
                });
            });
        </script>
        <div class="col-md-12 col-sm-12 col-xs-12 main-menu">
        	<div class="row altMin">
                <h2> Gerar relatórios </h2>

                
                <div class="col-md-4 col-sm-4 col-xs-4 formulario_pesquisa">

                        <h3>Pesquise documentos por datas</h3>
                        <br>
                        <form action="pesquisa/relatorios_gen/visualizarRel" id="form-relatorio-ipl" method="post">
                        
                               <br>

                               <label for="dataInicial">Data inicial :</label><br/>
                                <input id="dataInicial" type="text" name="dataInicial" value=""/>
                                <div class="error"></div>

                                <br>
                               <label for="dataFinal">Data final :</label><br/>
                                <input id="dataFinal" type="text" name="dataFinal" value=""/>
                                <div class="error"></div>
                                <br>
                                <label for="destinoCarga">Informe o estado destino da apreensão :</label><br/>
                                    <select name="destinoCarga" id="destinoCarga" onchange="">
                                        <option value="">Todos</option>
                                        <?php

                                            foreach ($estados as $estado): {
                                                                        
                                                // $arrayE[] = $estado->nome;
                                        ?>

                                            <option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->nome_estado; ?></option>

                                        <?php

                                            }endforeach;

                                        ?>
                                    </select>


                                <br>
                                <br>
                                
                               <input class="btn" type="submit" name="Visualizar" value="Vizualizar Relatorio" />
                        </form>

                </div>
                <div class="col-md-8 col-sm-8 col-xs-8 lista-menu">


                </div>

        	</div>
                <br>
        <br>
        <br>
        <hr>
        </div>


</div>
