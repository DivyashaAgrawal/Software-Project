<?php
	session_start();
	require_once("connection.php");
	if(isset($_GET['add'])){
		$id=$_GET['id'];
		$value= 1;
		$query = "UPDATE items SET cart='{$value}' WHERE PID=".$id;
		if(mysqli_query($con, $query)){
			header("location:home.php");
		}
	}
 ?>