<?php include ("connection/connection.php");
$result = mysql_query("select * from pdshis_dictionary where searchable = 'Y' order by name ASC");
echo "var projects = [";
while ($row=mysql_fetch_array($result))
{
?>
  { value: "<?php echo $row['pdshis_code']; ?>",
    label: "<?php echo ucwords(strtolower($row['name'])); ?>"
  },
<?php
}
echo "];";
?>
