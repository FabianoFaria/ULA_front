<!DOCTYPE html>
<html>
<head>
	<title>Sistema de registro de apreensão</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?php echo base_url("/index.php/area_restrita"); ?>"><h2>Sistema de registro de apreensão</h2></a>
                </div>
                <div class="navbar-collapse collapse">
                    <?php

                    $user_name = "p";

                    $user_name = $this->session->userdata('nome_usr');
                    

                    if($user_name != "p")
                    {  ?>
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Perfil <?php echo $user_name; ?></a></li>
                        <li><a href="<?php echo base_url("/index.php/logout"); ?>">Sair</a></li>
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
