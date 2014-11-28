<script>
jQuery.validator.addMethod("verificaCPF", function(value, element) {

        value = value.replace('.','');

        value = value.replace('.','');

        cpf = value.replace('-','');

        while(cpf.length < 11) cpf = "0"+ cpf;

        var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;

        var a = [];

        var b = new Number;

        var c = 11;

        for (i=0; i<11; i++){

            a[i] = cpf.charAt(i);

            if (i < 9) b += (a[i] * --c);

        }

        if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }

        b = 0;

        c = 11;

        for (y=0; y<10; y++) b += (a[y] * c--);

        if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;

        return true;

}); // Mensagem padrão

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
                required: {
                    depends: function () {
                        if($('#novaSenha').val()!=''){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }
            },
            cpfName: {
                 verificaCPF: {
                    depends: function () {
                        if($('#cpfName').val()!=''){
                            return true;
                        }else{
                            return false;
                        }
                    //return $("#CPF").val()!='';
                    }
                }
                //verificaCPF: true
            },
             confirmaSenha: {
                required: {
                     depends: function () {
                        if($('#confirmaSenha').val()!=''){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                equalTo: "#novaSenha"
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
            cpfName: {
                required: "Favor informar um CPF valido"
            },
            confirmaSenha: {
                required: "Favor confirmar a nova senha",
                equalTo: "Senha de confirmação deve ser identica a nova senha"
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
                $cpf_usuario = $user->cpf_usuario;
                $acao = "atualizarUsuario";
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
            $status = "1";
            $cpf_usuario = "";
            $acao = "registrarUsuario";
            $btnLabel = "Cadastrar usuario";
        }

        if($usuario_atualizador != null)
        {
            $acao = "atualizarUsuarioAlvo";
        }

            //$data['unidades_medidas'] = $this->Cont_doct->load_unidades_medidas($idRow);
            //$data['produtos'] = $this->Cont_doct->load_produtos($idRow);


    ?>

    <h2><?php echo $btnLabel; ?> : <a href="<?php echo base_url("/index.php/area_restrita"); ?>"><?php echo $username; ?></a></h2>


     
    <a href="<?php echo base_url("/index.php/area_restrita"); ?>">Cancelar</a>


     <div class="col-md-12 col-sm-12 col-xs-12 lista-menu well">

        <!-- abre o formulário de cadastro -->

        <form id="form-user-ipl" action="<?php echo base_url("index.php/login/login/".$acao.""); ?>" method="post">

            <label for="loginName">Login  :</label><br/>
            <input type="text" name="loginName" id="loginName" value="<?php echo $username ?>"/>
            <div class="error"></div>
            
            <br>

            <label for="userName">Nome de usuario :</label><br/>
            <input type="text" name="userName" id="userName" value="<?php echo $nome_usuario ?>"/>
            <div class="error"></div>
            
            <br>

            <label for="cpfName">CPF do usuario :</label><br/>
            <input type="text" name="cpfName" id="cpfName" value="<?php echo $cpf_usuario ?>"/>
            <div class="error"></div>
            
            <br>

            <label for="statusUsr">Status :</label><br/>
            <input type="radio" name="statusUsr" value="Ativo" <?php if($status == '1'){echo "checked='true'";} ?> /> Ativado<br />
            <input type="radio" name="statusUsr" value="Desativado" <?php if($status == '0'){echo "checked='true'";} ?>/> Desativado<br />
            <div class="error"></div>
            
            <br>

            <label for="novaSenha">Nova senha :</label><br/>
            <input type="password" name="novaSenha" id="novaSenha" value=""/>
            <div class="error"></div>
            
            <br>

            <label for="confirmaSenha">Confirma nova senha :</label><br/>
            <input type="password" name="confirmaSenha" id="confirmaSenha" value=""/>
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