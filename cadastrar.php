<?php 
require_once 'classes/usuarios.php';
$u = new Usuario();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="corpo-form-Cad">
    <h1>Cadastrar</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome completo" maxlength="30">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
        <input type="email" name="email" placeholder="Usuário" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="confirmarSenha" placeholder="Confirmar Senha" maxlength="15">
        <input type="submit" value="CADASTRAR">

    </form>
    </div>

    <?php
    
    if(isset($_POST['nome'])) {

        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confirmarSenha']);

        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
            $u->conectar("projeto_login", "localhost", "root", "");
            if($u->msgErro == "") {
                if($senha == $confirmarSenha) {
                    if($u->cadastrar($nome, $telefone, $email, $senha)) {
                        // tudo ok
                        ?>
                        <div class="msg-sucesso">
                            Cadastrado com sucesso!
                        </div>

                        <?php
                    } else {
                        //já cadastrado
                        ?>
                        <div class="msg-erro">
                            Usuário já cadastrado!
                        </div>
                        <?php
                    }
                } else {
                    // senhas não correspondem 
                    ?> 
                    <div class="msg-erro">
                            Senhas não correspondem!
                        </div>
                    <?php
                }
            }
        }  else {
            ?>
            <div class="msg-erro">
                  <?php  echo "Preencha todos os campos!"?>
            </div>
                <?php
            }
    }

    ?>

</body>
</html>