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
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
// Recupera a senha, a criptografando em MD5
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : FALSE;

// Usuário não forneceu a senha ou o login
if(!$login || !$senha)
{
    alert( "Você deve digitar sua senha e login!");
    exit;
}else{
    $u = new UserVO;
    $u = findByEmail($_POST[$login]);

    if (!empty($u->email)) {
        if(!strcmp($senha, $u->pwd))
        {
    // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
            $_SESSION["email"] =$u->email;
            $_SESSION["pwd"]= $u->pwd;
        header("Location: posts.php");
        exit;
      }
      // Senha inválida
    else
        {
            alert( "Senha inválida!");
            exit;
        }
    }// Login inválido
    else
    {
        alert( "O login fornecido por você é inexistente!");
        exit;
    }


}


