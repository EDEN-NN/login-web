<?php 

Class Usuario {

private $pdo;
public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha) {
        global $pdo;
        global $msgErro;

       try {
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        return true;
    } catch (PDOException $e) {
        $msgErro = $e->getMessage();
       throw new PDOException($e);
    }
}

    public function cadastrar($nomeUsuario, $telefone, $email, $senha) {
        
        global $pdo;
        //verificar se há um email cadastrado
        $sql = $pdo->prepare("SELECT idUsuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount() > 0) {
            return false; //já cadastrado
        } else {
            // não cadastrado
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e,:s)");
            $sql->bindValue(":n", $nomeUsuario);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha) {
        global $pdo;

        $sql = $pdo->prepare("SELECT idUsuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->Execute();
        if($sql->rowCount() > 0) {
            // pessoa cadastrada, criar sessão

            $dado = $sql->fetch();
            session_start();
            $_SESSION['idUsuario'] = $dado['idUsuario'];
            return true;

        } else {
            // pessoa não cadastrada
            return false;
        }
     }
}
?>