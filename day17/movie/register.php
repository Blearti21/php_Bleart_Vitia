<?php
 /*
  We will include config.php for connection with database.
  We will get datas from index.php file, and inster them into database when Sign up button is clicked in index.php file.
  If any of session is empty we will get a message
  */

	include_once('config.php');

	if(isset($_POST['submit']))
	{

		$name = $_POST['emri'];
		$username = $_POST['username'];
		$email = $_POST['email'];

		$tempPass = $_POST['password'];
		$password = password_hash($tempPass, PASSWORD_DEFAULT);



		

		if(empty($name) || empty($username) || empty($email) || empty($password) )
		{
			echo "You have not filled in all the fields.";
		}
		else
		{

			$sql = "INSERT INTO users(name,username,email,password) VALUES (:name, :username, :email, :password)";

			$insertSql = $conn->prepare($sql);
			

			$insertSql->bindParam(':name', $name);
			$insertSql->bindParam(':username', $username);
			$insertSql->bindParam(':email', $email);
			$insertSql->bindParam(':password', $password);

			$insertSql->execute();

			header("Location: login.php");


		}



	}


?>