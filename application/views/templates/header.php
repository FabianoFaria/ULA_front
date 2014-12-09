<!DOCTYPE html>
<html>
<head>
	<title>Sistema de registro de apreensão</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> -->

	<!--Le CSS
==========================================================-->


<link href="<?php echo base_url("/assets/ULA_front.css"); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url("/assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url("/assets/font-awesome.css"); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url("/assets/jquery-ui/jquery-ui.css"); ?>" rel="stylesheet" type="text/css" />

<!--Le JavaScript
==========================================================-->



<script src="<?php echo base_url("/assets/js/jquery-1.9.1.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/bootstrap.js"); ?>"></script>
<script src="<?php echo base_url("/assets/jquery-ui/jquery-ui.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/scripts.js"); ?>"></script>

<script src="<?php echo base_url("/assets/js/jquery.validate.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/additional-methods.js"); ?>"></script>




</head>
    <body>
		<div class="row sem_margin">

            <div class="navbar navbar-inverse box_user" role="navigation">
              <div class="row sem_margin">
                <div class=" col-md-3">
                  <a class="navbar-brand" href="<?php echo base_url("/index.php/area_restrita"); ?>"><h3>Sistema de registro de apreensão</h3></a>
                </div>
                <div class="col-md-3">
                </div>
                <div class="navbar-collapse collapse col-md-6">
                    <?php

                    $user_name = "p";

                    $user_name = $this->session->userdata('nome_usr');
                    

                    if($user_name != "p")
                    {  ?>
                      <ul class="nav navbar-nav navbar-right nav-pills">
                        <li><a id="drop5" href="#" data-toggle="dropdown" role="button">Dashboard <span class="caret"></a>
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">

                              <li role="presentation">
                                  <a href="<?php echo base_url("/index.php/login/login/usuariosCadastrados"); ?>"><i class="fa fa-cubes"></i> Usuarios cadastrados </a>
                              </li>
                           </ul>
                        </li>
                       
                        <?php
                            //trecho para habilitar ou não a edição de conteudo
                          if( ($this->session->userdata('status')) <= 1 )
                            { 
                        ?>
                        <li>
                            <a id="drop4" href="#" data-toggle="dropdown" role="button">Cadastro <i class="fa fa-plus-circle"></i>
<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">


                                <li role="presentation">
                                  <a href="<?php echo base_url("/index.php/login/login/cadastrarUsuario"); ?>"><i class="fa fa-user"></i> Usuario </a>
                                </li>
                                <li role="presentation">
                                  <a href="<?php echo base_url("/index.php/login/cadastro_conteudo/produtos_cadastrados"); ?>"><i class="fa fa-cubes"></i> Produtos </a>
                                </li>
                                <!-- <li role="presentation">
                                  <a href="#"><i class="fa fa-cubes"></i> Veiculos</a>
                                </li> -->

                              </ul>
                          </li>
                          <?php
                            }
                        ?>
                              
                           
                        <li>
                            <a id="drop4" href="#" data-toggle="dropdown" role="button"><?php echo $user_name; ?> <i class="fa fa-user"></i><span class="caret"></span></a>
                            <ul id="menu1" class="dropdown-menu" aria-labelledby="drop4" role="menu">
                              <li role="presentation">
                                <a href="<?php echo base_url("/index.php/login/login/perfil"); ?>"><i class="fa fa-user"></i> Perfil </a>
                              </li>
                              <li role="presentation">
                                <a href="#"><i class="fa fa-cogs"></i>
 Configuração</a>
                              </li>
                            </ul>

                        </li>

                        <li><a href="<?php echo base_url("/index.php/logout"); ?>">Sair <i class="fa fa-times"></i>
</a></li>
                      </ul>
                      <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Pesquisar...">
                      </form>
                    <?php
                    }else
                    {
                        echo "algo errafo";
                    }


                    ?>
                </div>
              </div>
            </div>


			
		
		</div>

