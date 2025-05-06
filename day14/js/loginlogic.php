<?php

require 'config.php';

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
	$password = $_POST['password'];

    if(empty($username) || empty($password))
  {
    echo"Fill all the fields!";
    header("refresh:2; url=login.php");


  }else{
    $sql = "s"
  }

}
   


?>