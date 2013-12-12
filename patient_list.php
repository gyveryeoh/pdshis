<?php
$q = strtolower($_GET["q"]);
if (!$q) return;
include("connection/connection.php");
$items = array();
$r = mysql_query("SELECT * FROM patients_info");
while($row = mysql_fetch_array($r))
   $items[ucwords(strtolower($row['firstname']." ".$row['lastname']))] = $row['firstname'].$row['lastname'];
foreach ($items as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	}
}
?>
