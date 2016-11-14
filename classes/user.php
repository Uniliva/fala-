<?php
include_once('database.php');

class UserVO {
    var $idUser;
    var $email;
    var $pwd;
    var $nick;
    var $picture;
    var $status;
}

class UserDAO {
    function create($usr) {
        $mysqli = Database::connection();

        $qry = "INSERT INTO users (email,pwd,nick,picture,status) VALUES (?,?,?,?,?)";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("sssss", $usr->email, $usr->pwd, $usr->nick, $usr->picture, $usr->status);

            /* execute query */
            $stmt->execute();
            
            /* close statement */
            $stmt->close();
        }

        /* close connection */
        $mysqli->close();
    }
    
    function retrieve() {
        $mysqli = Database::connection();

        $qry = "SELECT idUser,email,pwd,nick,picture,status FROM users";

        $rs = $mysqli->query($qry);

        $lst = array();
        
        while ($row = $rs->fetch_assoc()) { 
            $u = UserDAO::fromResult($row);
            array_push($lst, $u);
        }

        /* close result set */
        $rs->close();
        
        /* close connection */
        $mysqli->close();

        return $lst;
    }

    function update($usr) {
        $mysqli = Database::connection();

        $qry = "UPDATE users SET email=?,pwd=?,nick=?,picture=?,status=? WHERE idUser=?";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("sssssi", $usr->email, $usr->pwd, $usr->nick, $usr->picture, $usr->status, $usr->idUser);

            /* execute query */
            $stmt->execute();
        }

        /* close connection */
        $mysqli->close();
    }
    
    function delete($usr) {
        $mysqli = Database::connection();

        $qry = "DELETE FROM users WHERE idUser=?";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("i", $usr->idUser);

            /* execute query */
            $stmt->execute();
        }

        /* close connection */
        $mysqli->close();
    }
    
    function findByEmail($email) {
        $mysqli = Database::connection();

        $qry = "SELECT idUser,email,pwd,nick,picture,status FROM users WHERE email = ?";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $email);

            /* execute query */
            $stmt->execute();
            $rs = $stmt->get_result();
            
            $u = new UserVO;
            if ($row = $rs->fetch_assoc()) { 
                $u = UserDAO::fromResult($row);
            }
            /* close statement */
            $stmt->close();
        }

        /* close connection */
        $mysqli->close();
        
        return $u;
    }
    
    static function fromResult($row) {
        $u = new UserVO;
        $u->idUser  = $row['idUser'];
        $u->email   = $row['email'];
        $u->pwd     = $row['pwd'];
        $u->nick    = $row['nick'];
        $u->picture = $row['picture'];
        $u->status  = $row['status'];
        
        return $u;
    }
}
?>