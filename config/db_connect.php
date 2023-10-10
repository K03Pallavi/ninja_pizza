<?php 

//using mysqli
	//parameters of function(host, un, psswd, db name)
	$conn = mysqli_connect('localhost', 'pallavi', 'pallavi1234', 'ninja_pizza');

	//check the connection
	//if connection is not proper
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}



?>