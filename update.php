<?php

include 'global.php';


connect_to_db();


$table  = get_sql_param("table");
$where  = get_sql_param("where");
$fields = "";
$values = "";
$maxfields = 20;
$fieldcnt = get_sql_param("fieldcnt");

if ($fieldcnt == 0)
	$fieldcnt = $maxfields;

for ($i = 0; $i < $fieldcnt; $i++)
{
	$field = get_sql_param("field$i");
	$value = get_sql_param("value$i");

	if ($field != "")
	{
		if ($i > 0)
			$fields .= ", ";

		$fields .= "$field = '$value'";
	}
}


$stmt = "UPDATE $table SET $fields WHERE " . stripslashes($where); echo $stmt . "<p>";

$result = mysql_query($stmt) or var_export(error_get_last());

?>
