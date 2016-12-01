<?php
include("./classes/post.php");
include("./classes/userpost.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Posts | Falaê</title>

    <link rel="stylesheet" href="./css/posts.css">
    <link href="https://fonts.googleapis.com/css?family=Tillana" rel="stylesheet">

</head>
<body>
<header class="falae">

        <img class="image" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg" alt="">
        <div class="ch1">Falaê</div>


</header>

<div class="perfil" >
    <img src="<?php echo $_SESSION["picture"] ?>" alt="">
    <div class="nick"> <?php echo $_SESSION["nick"] ?></div><br/>
    <div class="status"> <?php echo $_SESSION["status"] ?></div>
</div>
<div class="postar">
    <p>Falaê o que você esta pensando:</p>

    <form method="post" action="addpost.php">
       <input class="oculo" type="text" id="idUser" name="idUser" value= <?php echo $_SESSION["idUser"] ?> />
        <textarea id="post" name="post" rows="5" cols="20"></textarea>
        <input class="btnEnviar" type="submit" value="Postar"/>


    </form>

</div>

<h1>Postagens</h1>
<?php

$dao = new PostDAO();
$lst = $dao->retrieve();
for ($i=0;$i<count($lst);$i++) {
    echo"<div class='postagem'>";
    echo "[$i] " . $lst[$i]->dtPost . " " . $lst[$i]->post . "<br />";
    echo "</div>";
}
?>

<?php

$dao = new UserPostDAO();
$lst = $dao->retrieve();
for ($i=0;$i<count($lst);$i++) {
    echo"<div class='postagem'>";
        echo "<div style='margin-bottom:20px'>";
        echo "<img class='postagemImg' src='" . $lst[$i]->user->picture . "' >" . $lst[$i]->user->nick . " <br/> em " . $lst[$i]->post->dtPost .  "<br/><br/> " . $lst[$i]->post->post;
        echo "<br><img class='postagemImgReacion' src='./img/like.png'  >" . $lst[$i]->likes ." <img class='postagemImgReacion' src='./img/deslike.png' >" . $lst[$i]->dislikes;
                    echo "<form method='post' action='addreaction.php'>
                            <input type='hidden' name='idUser' value='4' />
                            <input type='hidden' name='idPost' value='" . $lst[$i]->post->idPost . "' />
                            <label for='rl'>Gostei</label><input type='radio' id='rl' name='tpReaction' value='1' />
                            <label for='rd'>Não gostei</label><input type='radio' id='rd' name='tpReaction' value='2' />
                            <input type='submit' value='Reagir!' />
                        </form>";
        echo "</div>";
    echo "</div>";
}

?>







</body>
</html>




