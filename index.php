<?php 
	echo 'Hello World! HUHUHIHI :)))))<br>'; 
	$conn = mysqli_connect("166.62.10.54","babsqluread","101095","baobab");

	//check connection
	if(!$conn){
		die("Connect failed: ". mysqli_connect_error());
	}
	echo "Connect successfully!";
?>
