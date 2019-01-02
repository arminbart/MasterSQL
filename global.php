<?php

ini_set("auto_detect_line_endings", true);

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

function get_php_param($name)
{
	$value = trim($_POST[$name]);

	if ($value == "")
	{

		$file = fopen("params.txt", "r");

		while ($value == "" and !feof($file))
		{
			$line = fgets($file);
echo $line . "<br>";
			$values = explode("=", $line);
			if (trim($values[0]) == $name)
				$value = $values[1];
		}

		fclose($file);
	}

	echo "return $name=$value<br>";
	return $value;
}

function connect_to_db()
{
	$host   = get_php_param($_POST["host"]);
	$user   = get_php_param($_POST["user"]);
	$pwd    = get_php_param($_POST["pwd"]);
	$db     = get_php_param($_POST["db"]);

	$con = mysql_connect($host, $user, $pwd) or die("Connection to host $host as $user failed!");

	mysql_select_db($db) or die("Connection to database $db failed!");
}

?>
