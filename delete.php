<?php

include 'global.php';


connect_to_db();


$table  = get_sql_param("table");
$where  = get_sql_param("where");
$stmt = "DELETE FROM $table WHERE " . stripslashes($where); echo $stmt . "<p>";

$result = mysql_query($stmt) or var_export(error_get_last());

?>
