<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

    include_once("config.php");
    $sql = "select * from users";
    $getUser = $conn->prepare($sql);

    $getUser->execute();

    $user=$getUser->fetchAll();



?>

  <table>
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
    </thead>
    
    <tbody>
        <?php
            foreach($users as $user){
                ?>
            <tr>
                <td><?= $user['id']?></td>
                <td><?= $user['name']?></td>
                <td><?= $user['surname']?></td>
                <td><?= $user['email']?></td>
                <td> <?="<a href='delete.php?id=$user[id]'>Delete</a>"?></td>
            </tr>
            <?php 
                } 
            ?>


    </tbody>

    </table>

    <a href="index.php">go to indeksss</a>

</body>
</html>