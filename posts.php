<?php
    include("./classes/post.php");
    include("./classes/userpost.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Últimos Posts | Falaê</title>
    </head>
    <body>
        <h1>Postar</h1>
        
        <form method="post" action="addpost.php">
            <label for="idUser">IdUser:</label><input type="text" id="idUser" name="idUser" value="4" /><br />
            <label for="post">Post:</label><textarea id="post" name="post" rows="5" cols="20"></textarea><br />
            <input type="submit" value="Enviar" />
        </form>
        
        
        <h1>Postagens</h1>
        <?php
        
            $dao = new PostDAO();
            $lst = $dao->retrieve();
            for ($i=0;$i<count($lst);$i++) {
                echo "[$i] " . $lst[$i]->dtPost . " " . $lst[$i]->post . "<br />";
            }
        ?>
        
        <br />
        <h1>Últimas Postagens</h1>
        <?php
        
            $dao = new UserPostDAO();
            $lst = $dao->retrieve();
            for ($i=0;$i<count($lst);$i++) {
                echo "<div style='margin-bottom:20px'>";
                echo "[$i] " . $lst[$i]->user->nick . " " . $lst[$i]->post->dtPost .  " " . $lst[$i]->post->post;
                echo "<br>Gostei(" . $lst[$i]->likes . ") | Não gostei(" . $lst[$i]->dislikes . ")";
                echo "<form method='post' action='addreaction.php'>
                        <input type='hidden' name='idUser' value='4' />
                        <input type='hidden' name='idPost' value='" . $lst[$i]->post->idPost . "' />
                        <label for='rl'>Gostei</label><input type='radio' id='rl' name='tpReaction' value='1' />
                        <label for='rd'>Não gostei</label><input type='radio' id='rd' name='tpReaction' value='2' />
                        <input type='submit' value='Reagir!' />
                     </form>";
                echo "</div>";
            }
            
        ?>
    </body>
</html>