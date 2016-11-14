<?php
include_once('database.php');

class ReactionVO {
    var $idReaction;
    var $idPost;
    var $idUser;
    var $dtReaction;
    var $tpReaction;
}

class ReactionDAO {
    function create($reaction) {
        $mysqli = Database::connection();

        $qry = "INSERT INTO reactions (idPost,idUser,dtReaction,tpReaction) VALUES (?,?,?,?)";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("iisi", $reaction->idPost, $reaction->idUser, $reaction->dtReaction, $reaction->tpReaction);

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

        $qry = "SELECT idReaction,idPost,idUser,dtReaction,tpReaction FROM reactions";

        $rs = $mysqli->query($qry);

        $lst = array();
        
        while ($row = $rs->fetch_assoc()) { 
            $p = new ReactionVO;
            $p->idReaction = $row['idReaction'];
            $p->idPost = $row['idPost'];
            $p->idUser = $row['idUser'];
            $p->dtReaction = $row['dtReaction'];
            $p->tpReaction = $row['tpReaction'];
                        
            array_push($lst, $p);
        }

        /* close result set */
        $rs->close();
        
        /* close connection */
        $mysqli->close();

        return $lst;
    }

    function update($reaction) {
        $mysqli = Database::connection();

        $qry = "UPDATE reactions SET idPost,idUser,dtReaction,tpReaction=? WHERE idReaction=?";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("iisii", $reaction->idPost,$reaction->idUser,$reaction->dtReaction,$reaction->tpReaction,$reaction->idReaction);

            /* execute query */
            $stmt->execute();
        }

        /* close connection */
        $mysqli->close();
    }
    
    function delete($reaction) {
        $mysqli = Database::connection();

        $qry = "DELETE FROM reactions WHERE idReaction=?";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("i", $reaction->idReaction);

            /* execute query */
            $stmt->execute();
        }

        /* close connection */
        $mysqli->close();
    }
}
?>