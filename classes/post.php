<?php
include_once('database.php');

class PostVO {
    var $idPost;
    var $idUser;
    var $dtPost;
    var $post;
}

class PostDAO {
    function create($post) {
        $mysqli = Database::connection();

        $qry = "INSERT INTO posts (idUser,dtPost,post) VALUES (?,?,?)";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("sss", $post->idUser, $post->dtPost, $post->post);

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

        $qry = "SELECT idPost,idUser,dtPost,post FROM posts";

        $rs = $mysqli->query($qry);

        $lst = array();
        
        while ($row = $rs->fetch_assoc()) { 
            $p = PostDAO::fromResult($row);
            array_push($lst, $p);
        }

        /* close result set */
        $rs->close();
        
        /* close connection */
        $mysqli->close();

        return $lst;
    }

    function update($post) {
        $mysqli = Database::connection();

        $qry = "UPDATE posts SET idUser=?,dtPost=?,post=? WHERE idPost=?";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("sssi", $post->idUser, $post->dtPost, $post->post, $post->idPost);

            /* execute query */
            $stmt->execute();
        }

        /* close connection */
        $mysqli->close();
    }
    
    function delete($post) {
        $mysqli = Database::connection();

        $qry = "DELETE FROM posts WHERE idPost=?";

        /* create a prepared statement */
        if ($stmt = $mysqli->prepare($qry)) {

            /* bind parameters for markers */
            $stmt->bind_param("i", $post->idPost);

            /* execute query */
            $stmt->execute();
        }

        /* close connection */
        $mysqli->close();
    }
    
    static function fromResult($row) {
        $p = new PostVO;
        $p->idPost = $row['idPost'];
        $p->idUser = $row['idUser'];
        $p->dtPost = $row['dtPost'];
        $p->post   = $row['post'];
        
        return $p;
    }
}
?>