<?php
	function message($id){
		$con= mysqli_connect("localhost","root","","vtc");
	

		$query = "SELECT cart FROM items WHERE PID=".$id;
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_array($result)){
			if($row['cart'] == 0){
				return "Add to cart";
			}else{
				return "Added!";
			}
		}
	}
?>