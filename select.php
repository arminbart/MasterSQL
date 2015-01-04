<?php

include 'global.php';


connect_to_db();


header('Content-Type: text/xml');


$table  = get_sql_param("table");
$fields = explode(",", get_sql_param("fields"));
$where  = get_sql_param("where");
$stmt = "SELECT";


for ($i = 0; $i < count($fields); $i++)
{
	$fields[$i] = trim($fields[$i]);

	if ($i == 0)
		$stmt .= " " . $fields[$i];
	else
		$stmt .= ", " . $fields[$i];
}


$stmt .= " FROM $table"; //echo $stmt . "<p>";

if ($where != "")
	$stmt .= " WHERE " . stripslashes($where);

echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>";
echo "<xml>\n";
echo "\t<query>$stmt</query>\n";
echo "\t<data>\n";

$result = mysql_query($stmt) or var_export(error_get_last());
$count = 0;

while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	echo "\t\t<row ";
	foreach ($fields as $field)
	{
		echo $field . "='" . $row[$field] . "' ";
	}
	echo "/>\n";
	$count++;
}

echo "\t</data>\n";
echo "\t<info count='$count'/>\n";
echo "</xml>\n";

?>
