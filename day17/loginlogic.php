<?php

 session_start();
 include_once("config.php");
 if(isset($_POST['submit']))
 {
    $username = $_POST['username'];

    $password = $_POST['password'];

    if(empty( $username)||empty( $username)){
        echo "Please fill in all fields";
    }
    else{
        $sql = "SELECT id, name, username, email, password from users where
        username:username";

        $selectUser = $conn->prepare($sql); 
         $selectUser->bindParam(":username" ,$username);
          $selectUser->execute();
          $data = $selectUser->fetchAll();


          if($data == false){
            echo "the username does not exist";
          }else{
            if(password_verify($password,$data['password'])){
                $_SESSION['id']=$data ['id'];
                $_SESSION['username']=$data ['username'];
                $_SESSION['name']=$data ['name'];
                $_SESSION['email']=$data ['email'];

                header("Location: dashboard.php");

            
          }
          else{
            echo "the password is notvalid";
          }
        
        }


          
    }
 }


?>