<?php
include("connection/connection.php");
$province_list = array();
$result = mysql_query("SELECT * FROM pdshis_cities where province_id = '".$_POST['id']."'");
while($row = mysql_fetch_array($result))
  {
 $province_list[] = array(
    'value'=>$row['id'],
    'text'=>$row['name']
 );
  }
echo json_encode ($province_list);
?>
