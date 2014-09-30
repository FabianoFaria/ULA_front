<script>
$( "#form-user-ipl" ).submit(function( event ) {
    alert( "Cadastro será enviado para avaliação!, você será redirecionado para a pagina principal" );
    event.preventDefault();
    });

$().ready(function() {
    // validate signup form on keyup and submit 
    $("#form-user-ipl").validate({
        rules: {
            loginName: {
                required: true
            },
            userName: {
                required: true
            },
            statusUsr: {
                required: true
            },
             novaSenha: {
                required: true
            },
             confirmaSenha: {
                required: true
            }
        },
        messages: {
            loginName: {
                required: "Nome de login é obrigatorio!"
            },
            userName: {
                required: "Username é obrigatorio"
            },
            statusUsr: {
                required: "Favor informar um produto"
            },
            novaSenha: {
                required: "Favor informar uma nova senha"
            },
            confirmaSenha: {
                required: "Favor confirmar a nova senha"
            }
        }
    });
    
    
    jQuery.extend(jQuery.validator.messages, {
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Por favor entre com pelo menos {5} ou mais caracteres."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
     //   max: jQuery.validator.format("Por favor informe um valor menor ou igual a  {255}."),
     //   min: jQuery.validator.format("Por favor informe um valor maior ou igual a  {0}.")
    });
    
});
</script>
<div class="row sem_margin">

    <?php

        if($usuario != null)
        {   
        
            foreach($usuario as $user)
            {
                $ID_user = $user->ID_user;
                $username = $user->username;
                $nome_usuario = $user->nome_usuario;
                $status = $user->status;
                $acao = "";
                $btnLabel = "Atualizar usuario";
            }

            //var_dump($mercadoria);
            //die;
        }
        else
        {
            $ID_user = "";
            $username = "";
            $nome_usuario = "";
            $status = "";
            $acao = "";
            $btnLabel = "Cadastrar usuario";
        }

            //$data['unidades_medidas'] = $this->Cont_doct->load_unidades_medidas($idRow);
            //$data['produtos'] = $this->Cont_doct->load_produtos($idRow);


    ?>

    <h2><?php echo $btnLabel; ?> : <a href="<?php echo base_url("/index.php/area_restrita"); ?>"><?php echo $username; ?></a></h2>


     
    <a href="<?php echo base_url("/index.php/area_restrita"); ?>">Cancelar</a>


     <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

        <!-- abre o formulário de cadastro -->

        <form id="form-user-ipl" action="login/novo_documento/cadastrar_mercadoria" method="post">

            <label for="loginName">Login  :</label><br/>
            <input type="text" name="loginName" id="loginName" value="<?php echo $username ?>"/>
            <div class="error"></div>
            
            <br>

            <label for="userName">Nome de usuario :</label><br/>
            <input type="text" name="userName" id="userName" value="<?php echo $nome_usuario ?>"/>
            <div class="error"></div>
            
            <br>

            <label for="statusUsr">Status :</label><br/>
            <input type="radio" name="statusUsr" value="Ativo" <?php if($status == '1'){echo "checked='true'";} ?> /> Ativado<br />
            <input type="radio" name="statusUsr" value="Desativado" <?php if($status == '0'){echo "checked='true'";} ?>/> Desativado<br />
            <div class="error"></div>
            
            <br>

            <label for="novaSenha">Nova senha :</label><br/>
            <input type="text" name="novaSenha" id="novaSenha" value=""/>
            <div class="error"></div>
            
            <br>

            <label for="confirmaSenha">Confirma nova senha :</label><br/>
            <input type="text" name="confirmaSenha" id="confirmaSenha" value=""/>
            <div class="error"></div>
            
            <br>
            <br>

            <input type="hidden" name="id_usr" value="<?php echo $ID_user; ?>" />


            <input type="submit" name="submitBtn" value="<?php echo $btnLabel; ?>" />
        </form>
        <br>
        <br>
        <br>
        <br>

                           
</div>
                           




</div>