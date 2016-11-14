<?php

class Database {
    
    public static function connection() {
        $mysqli = new mysqli("localhost", "root", "usbw", "mydb", 3307);
        if ($mysqli->connect_error) {
            print "Failed to connect.";
            exit();
        }
        return $mysqli;
    }
}

?>