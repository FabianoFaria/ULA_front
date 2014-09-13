<?php
        
        $thisYear = date('Y');

        $anos = array($thisYear,$thisYear -1 , $thisYear -2, $thisYear -3, $thisYear -4);
?>

<div class="row sem_margin">
        <script>
                $(function() {

                $( "#primeira_data" ).datepicker();
                $.datepicker.formatDate( "yy-mm-dd" );
                });
        </script>
        <script>
                $(function() {

                $( "#segunda_data" ).datepicker();
                $.datepicker.formatDate( "yy-mm-dd" );
                });
        </script>
        <div class="col-md-12 col-sm-12 col-xs-12 main-menu">
        	<div class="row">
                <h2> Gerar relatorios </h2>

                
                <div class="col-md-4 col-sm-4 col-xs-4 formulario_pesquisa">

                        <h3>Pesquise documentos por datas</h3>
                        <br>
                        <form action="pesquisa/relatorios_gen/visualizarRel" id="form-update-ipl" method="post">
                                
                               <label for="anoRelatorio">Selecione o ano:</label><br/>
                               <select name="anoRelatorio" id="anoRelatorio">
                                <?php
                                        for($i =0 ; $i<5; $i++)
                                        {
                                                echo "<option value='".(date('Y') - $i)."'>".(date('Y') - $i)."</option>";
                                        }
                                ?>
     
                               </select>
                        <br>
                        
                                <label for="mesRelatorio">Selecione o mês:</label><br/>
                                <select name="mesRelatorio" id="mesRelatorio">
                                        <option value="1">Janeiro</option>
                                        <option value="2">Fevereiro</option>
                                        <option value="3">Março</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Maio</option>
                                        <option value="6">Junho</option>
                                        <option value="7">Julho</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                               </select>
                               <br>
                               <br>
                               <input type="submit" name="Visualizar" value="Vizualizar Relatorio" />
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
