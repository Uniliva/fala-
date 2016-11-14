<?php
    include("./classes/user.php");

    if (isset($_POST["email"])) {
        $usr = new UserVO;
        $usr->email = $_POST["email"];
        $usr->pwd = $_POST["pwd"];
        $usr->nick = $_POST["nick"];
        $usr->picture = $_POST["picture"];
        $usr->status = $_POST["status"];
        
        $dao = new UserDAO;
        $dao->create($usr);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>