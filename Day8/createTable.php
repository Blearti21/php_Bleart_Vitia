<?php

    $host="localhost";
    $db="dbbleart";
    $user="root";
    $pass="";

    try{
        $pdo= new PDO("mysql:host=$host; dbname=$db",$user,$pass);
        $sql = "CREATE TABLE users (
        id INT(6) NOT NULL PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password varchar(50) Not null)";

        $pdo->exec($sql);
        echo "Table is created successfully";

    }catch(Exception $e){
        echo "Error createin table" . $e->getMessage();
    }


?>