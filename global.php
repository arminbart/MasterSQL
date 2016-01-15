<?php

function get_sql_param($name)
{
	$value = trim($_POST[$name]);


//	echo "$name = '$value'<br>";

//	if (strpos($value, "'") !== false)
//		die("The parameter '$name' contains the illegal character ' !");

	if (strpos($value, ";") !== false)
		die("The parameter '$name' contains the illegal character ';' !");
		
	return $value;
}

function connect_to_db()
{
	$host   = $_POST["host"];
	$user   = $_POST["user"];
	$pwd    = $_POST["pwd"];
	$db     = $_POST["db"];

	$con = mysql_connect($host, $user, $pwd) or die("Connection to host $host as $user failed!");

	mysql_select_db($db) or die("Connection to database $db failed!");
}

?>
