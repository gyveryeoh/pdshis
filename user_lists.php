<?php session_start(); 
include("connection/connection.php");
include("header/header.php");
$msg="<div id='hiddendiv' style='display:none;'><p><img src='images/check.png' width='15' height='15' style='margin-top:2px;'>
				<font size='4' color='red'>Successfully updated user information.</font></p></div>";
				
if ($firefox) {
	$bottom="0px;";
	}
	else
	{
	$bottom="50px;";
	}
?>
<style>
iframe
{
overflow: hidden;
position:absolute;
right:350px;
bottom:<?php echo $bottom; ?>
border: hidden;
}
</style>
<script>	
function closeIframes() {
var iframe = parent.document.getElementById("myiframes");
iframe.parentNode.removeChild(iframe);
document.getElementById("hiddendiv").style.display="";
parent.window.setTimeout(function(){location.reload()},2000)
}
</script>
<div align="center">
<table>
<form action="users_lists.php" method="post">

<tr><td colspan=2 align=center><?php echo $msg; ?></td></tr>
<tr>
	<td class="header" colspan=3>ALL USER'S</td>
</tr>
<tr class="header">
	<td align="left" width="25%">RESIDENT'S NAME</td>
	<td align="center" width="10%">USERNAME</td>
	<td align="center" width="10%">ROLE</td>
	<td align="center"></td>
</tr>
<?php
//Select data from users
$query=mysql_query("SELECT * FROM users order by lastname ASC");
$x=0;
while ($data = mysql_fetch_array($query))
{
if ($data['roles_id'] == '2'){
	$data['roles_id'] = 'user';
	}
elseif ($data['roles_id'] == '1')
{
	$data['roles_id'] = 'admin';
}
elseif ($data['roles_id'] == '3'){
{
	$data['roles_id'] = 'block';
}
}
$x++;
?>
<tr>
	<td>
	<a href="update_users.php?user_id=<?php echo $data['id']; ?>" target="iframes"><?php echo $data['lastname'].', '.$data['firstname'].' '.$data['middle_initials'].'.'; ?></a>
	</td>
	<td align="center"><?php echo $data['username']; ?></td>
	<td align="center"><?php echo $data['roles_id']; ?></a></td
</tr>
<?php
}
?>
</TABLE>
<iframe id="myiframes" name="iframes" src="update_users.php" width="400" height="300"  frameborder="yes" scrolling="no"></iframe>