<?php
    //Esse eu vou deixar para vocês fazerem por completo
    //Sugiro usar sessão para guardar o usuário caso a senha esteja correta, e redirecioná-lo para tela de postagens
    //Se a senha estiver errada, redicionar para a tela de login.


// Conexão com o banco de dados
include_once('database.php');
include_once('user.php');

// Inicia sessões
session_start();

// Recupera o login
$login = isset($_POST["email"]) ? $_POST["email"] : FALSE;
// Recupera a senha, a criptografando em MD5
$senha = isset($_POST["pwd"]) ? $_POST["pwd"]: FALSE;

// Usuário não forneceu a senha ou o email
if(!$login || !$senha)
{
    header("Location: ../index.php?status=Forneneça o email e senha!");
}else{
    $u = new UserVO;
    $u =  UserDAO::findByEmail($_POST["email"]);

    if (!empty($u->email)) {
        if(!strcmp($senha, $u->pwd))
        {
    // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
            $_SESSION["email"] =$u->email;
            $_SESSION["pwd"]= $u->pwd;
            $_SESSION["nick"]=  $u->nick ;
            $_SESSION["picture"]=  $u->picture;
            $_SESSION["status"]=  $u->status ;
        header("Location: ../posts.php");
      }
      // Senha inválida
    else
        {
            unset($_SESSION["email"]);
            unset($_SESSION["pwd"]);
           header("Location: ../index.php?status=Senha inválida!");

        }
    }// Login inválido
    else
    {
        unset($_SESSION["email"]);
        unset($_SESSION["pwd"]);
        header("Location: ../index.php?status=O login fornecido não é valido!");
    }


}
?>


