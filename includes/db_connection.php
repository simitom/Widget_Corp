<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "widget_corp");

//1. create a database connection
$connection=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); 
//test if connection occurred
if(mysqli_connect_errno()){
	die("Database connection failed: ".
		mysqli_connect_error() .
		"(". mysqli_connect_errno() .")"
		);
}

?>