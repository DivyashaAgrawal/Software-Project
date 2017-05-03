<?php
	error_reporting(0);
	require_once("connection.php");
	if(isset($_POST['submit'])){
		$email = $_POST['e-mail'];
		$email = mysqli_real_escape_string($con,$email);
		$email = strip_tags($email);

		$password = $_POST['password'];
		$password = mysqli_real_escape_string($con,$password);
		$password = strip_tags($password);
		$password = MD5($password);

		$query = "SELECT Email, Password FROM persons WHERE Email='{$email}' and Password='{$password}'";
		$result = mysqli_query($con,$query);
		$num = mysqli_num_rows($result);
		if ($num == 0) // that is if no records found in database
			header('location: error.php');
		else{
			$row = mysqli_fetch_array($result);
			session_start();
			$_SESSION['email']=$row['Email'];
			header('location: home.php');	
		}
	}
?>