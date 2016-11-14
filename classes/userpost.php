<?php
include_once('user.php');
include_once('post.php');
include_once('database.php');

class UserPostVO {
    var $post;
    var $user;
    var $likes;
    var $dislikes;
}

class UserPostDAO {

    function retrieve() {
        $mysqli = Database::connection();

        $qry = "SELECT posts.idPost,posts.idUser,posts.dtPost,posts.post
                    , users.idUser,users.email,users.pwd,users.nick,users.picture,users.status
                    , sum(case when reactions.tpReaction = 1 then 1 else 0 end) as likes
                    , sum(case when reactions.tpReaction = 2 then 1 else 0 end) as dislikes
                FROM posts 
                INNER JOIN users ON users.IdUser = posts.IdUser 
                LEFT JOIN reactions ON reactions.IdPost = posts.IdPost
                GROUP BY posts.idPost,posts.idUser,posts.dtPost,posts.post
                        ,users.idUser,users.email,users.pwd,users.nick,users.picture,users.status
                ORDER BY posts.dtPost DESC
                LIMIT 0, 30";

        $rs = $mysqli->query($qry);

        $lst = array();
        
        while ($row = $rs->fetch_assoc()) { 
            $up = new UserPostVO();
            
            $up->post = PostDAO::fromResult($row);
            $up->user = UserDAO::fromResult($row);
            $up->likes = $row['likes'];
            $up->dislikes = $row['dislikes'];
            
            array_push($lst, $up);
        }

        /* close result set */
        $rs->close();
        
        /* close connection */
        $mysqli->close();

        return $lst;
    }
    
}
?>