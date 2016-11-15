
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Falaê</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

    <div class="container">
      <div class="info">

        <h1>Falaê</h1><span>Falaê e um sistema de comunicação desenvolvido pelos alunos da fatec de Osasco.<br/>
          Atraves do Falaê é possivel postar mensagens. ler o que seus amigos estão dizendo e curtir odiar as mensagens.</span>
      </div>
    </div>
    <div  class="form">
      <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
      <form method="post" action="adduser.php" class="register-form">
        <input type="text" name="email" placeholder="E-mail"/>
        <input type="text" name="nick" placeholder="Nick"/>
        <input type="password" name="pwd" placeholder="Senha"/>
          <input type="text" name="picture" placeholder="Foto"/>
        <input type="text" name="status" placeholder="Status"/>
          <input type="submit" value="Criar">
        <!-- <button >Criar</button> -->
        <p class="message">Tem uma conta? <a href="#">Entre</a></p>
      </form>


      <form method="post" action="./classes/authenticate.php" class="login-form">
          <label class="lab"><?php  echo isset($_GET["status"])? $_GET["status"]:""; ?></label>
        <input type="text"  name="email" placeholder="E-mail"/>
        <input type="password" name="pwd" placeholder="Senha"/>
          <input type="submit" value="Entrar">

        <p class="message">Não esta registrado? <a href="#">Cadastre-se</a></p>
      </form>
    </div>
    
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

</body>
</html>
