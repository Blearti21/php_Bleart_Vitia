<?php

include_once("config.php");


$id=$_GET['id'];
$sql = "SELECT * FROM users where id=:id";



$prep = $conn->prepare($sql);


$prep->bindParam(':id',$id);

$prep->execute();

$data = $prep->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>


    <style>


        form>input {
            margin-bottom: 10px;
            font-size: 20px;
            padding: 5px;
        }


        button {
            background: none;
            border: none;
            border: 1px solid black;
            padding: 10px 40px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
    <form action="update.php" method="POST">
        
        <input type="" name="id" value="<?php echo $data['id'] ?>"><br>
        <input type="" name="username" value="<?php echo $data['username'] ?>"><br>
        <input type="" name="surname" value="<?php echo $data['surname'] ?>"><br>
        <input type="" name="email" value="<?php echo $data['email'] ?>"><br>
        <button type="submit" name="update">Update</button>

    </form>


</body>
</html>

