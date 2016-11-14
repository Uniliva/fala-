<?php
    include("./classes/reaction.php");
    date_default_timezone_set("America/Sao_Paulo");
    
    if (isset($_POST["idUser"]) && isset($_POST["idPost"])) {
        $r = new ReactionVO;
        $r->idPost = $_POST['idPost'];
        $r->idUser = $_POST['idUser'];
        $r->dtReaction = date('Y-m-d H:i:s'); //$_POST['dtReaction'];
        $r->tpReaction = $_POST['tpReaction'];
               
        $dao = new ReactionDAO;
        $dao->create($r);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>