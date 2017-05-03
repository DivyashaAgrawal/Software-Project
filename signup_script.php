<?php
	error_reporting(0);
	require_once("connection.php");
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$name = mysqli_real_escape_string($con,$name);
		$name = strip_tags($name);
		
		$email = $_POST['e-mail'];
		$email = mysqli_real_escape_string($con,$email);
		$email = strip_tags($email);
		
		$password = $_POST['password'];
		$password = mysqli_real_escape_string($con,$password);
		$password = strip_tags($password);
		$password = MD5($password);
		
		$contact = $_POST['contact'];
		$contact = mysqli_real_escape_string($con,$contact);
		$contact = strip_tags($contact);

		$city = $_POST['city'];
		$city = mysqli_real_escape_string($con,$city);
		$city = strip_tags($city);

		$address = $_POST['address'];
		$address = mysqli_real_escape_string($con,$address);
		$address = strip_tags($address);
		
		$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		$regex_num = "/^[789][0-9]{9}$/";
		$query = "SELECT * FROM persons WHERE Email='$email'";
		$result = mysqli_query($con, $query);
		$num = mysqli_num_rows($result);

		if ($num != 0)
			{
			$m = "<span style='color:red;'>Email Already Exists</span>";
			header('location: signup.php?m1='.$m);
			}
		else if (!preg_match($regex_email, $email))
			{
			$m = "<span style='color: red;'>Not a valid Email Id</span>";
			header('location: signup.php?m1='.$m);
			}
		else if (!preg_match($regex_num, $contact))
			{
			$m = "<span style='color: red;'>Not a valid phone number</span>";
			header('location: signup.php?m2='.$m);
			}
		else{
			
			$query = "INSERT INTO persons
			(Name, Email, Password, Contact, City, Address)
			VALUES
			('{$name}','{$email}','{$password}','{$contact}','{$city}','{$address}')";
			if(mysqli_query($con,$query)){
				session_start();
				$_SESSION['email']=$email;
				header('location: home.php');	
			}else{
				echo "error while inserting the records".mysqli_error($con);
			}
		}
	}
?>