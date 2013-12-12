<?php include ("connection/connection.php");
$result = mysql_query("select radlex_id from radterms");
echo "[";
while ($row=mysql_fetch_array($result))
{
?>
  "<?php echo ucwords(strtolower($row['radlex_id'])); ?>",
<?php
}
echo "]";
?>
