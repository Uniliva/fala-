<?php
    include("./classes/post.php");
    date_default_timezone_set("America/Sao_Paulo");
    
    if (isset($_POST["post"])) {
        $p = new PostVO;
        $p->idUser = $_POST['idUser'];
        $p->dtPost = date('Y-m-d H:i:s'); //$_POST['dtPost'];
        $p->post   = $_POST['post'];
        
        $dao = new PostDAO;
        $dao->create($p);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>