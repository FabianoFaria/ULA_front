<div class="row sem_margin">




        <div class="col-md-12 col-sm-12 col-xs-12 main-menu">

                <h2>Área restrita - Atualizar documento</h2>

                <div class="col-md-6 col-sm-6 col-xs-6 lista-menu">

                	<h3>Ultimos registros<h3>
                        <ul>
                       	<?php
							foreach ($last_docs as $docs) {
							  $IPL_doc = $docs->IPL;
                              $Row_id = $docs->ROW_ID;
                        ?>
                            <li><a href="login/atualizar_documento/view/<?php echo $Row_id; ?>"><?php echo $IPL_doc ?></a></li>
                        <?php
								echo "<br>";
							}

						?>
                        </ul>

                </div>
        
        </div>

</div>