<?php
mysql_connect("localhost","root","M4Buh47k4");
mysql_select_db("pdshis_jrmmc");
date_default_timezone_set('Asia/Hong_Kong');
//Browser Selection
$msie = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') ? true : false;
$firefox = strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? true : false;
$safari = strpos($_SERVER["HTTP_USER_AGENT"], 'Safari') ? true : false;
$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;
?>
