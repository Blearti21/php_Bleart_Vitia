<?php

    $host="localhost";
    $db="dbbleart";
    $user="root";
    $pass="";

    try{
        $pdo= new PDO("mysql:host=$host; dbname=$db",$user,$pass);
        $sql = "ALTER TABLE products ADD email VARCHAR(255)";

        $pdo->exec($sql);
        echo "Coum create successfully";

    }catch(Exception $e){
        echo "Error createin table" . $e->getMessage();
    }


?>