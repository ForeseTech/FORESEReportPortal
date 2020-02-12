<?php

/***********************/
/* SQL-CONNECTIONS.PHP */
/***********************/

/* This function inits a connection variable and returns it. */
function getConnection(){
	$server = "localhost";
	$username = "reports";
	$password = "Reports123123123!";
	$database = "MOCKS20";

	$connection=new PDO("mysql:host=$server;dbname=$database", $username, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	return $connection;
}

?>
