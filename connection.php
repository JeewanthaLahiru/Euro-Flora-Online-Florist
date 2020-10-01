<?php

    try{
        $servernamedb = "localhost";
        $usernamedb = "root";
        $passworddb = "";

        $conn = new PDO("mysql:host=$servernamedb;dbname=shopdb",$usernamedb,$passworddb);

    }catch(PDOException $e){
        echo $e;
    }

?>