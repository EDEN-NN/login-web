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
    <div id="corpo-form">
    <h1>ENTRAR</h1>
    <form method="POST">
        <input name='email' type="email" placeholder="Usuário">
        <input name='senha' type="password" placeholder="Senha">
        <input type="submit" value="ACESSAR">
        <a href="cadastrar.php">Ainda não está inscrito?</a>
    </form>
    </div>

    <?php 
    
    if(isset($_POST['email'])) {

        $email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
        if(!empty($email) && !empty($senha)) {
            // email e senha inseridos
            $u->conectar("projeto_login", "localhost", "root", "");
            if($u->msgErro == "") {
                if($u->logar($email, $senha)) {
                    // consta no banco
                    header('Location:areaprivada.php');
                } else {
                    // não consta no banco
                    ?>
                    <div class="msg-erro">
                        Email e/ou senha estão incorretos!
                    </div>
                    <?php
                    
                    }
            } else {
                    ?>
                    <div class="msg-erro">
                        <?php echo "Erro: ".$u->msgErro; ?>
                    </div>
                    <?php
                }
        } else {
            // campo vazio
            ?>
            <div class="msg-erro">
                Preencha todos os campos!
            </div>
            <?php
            }
        }

    ?>

</body>
</html>