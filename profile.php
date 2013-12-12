<?php 
include("connection/connection.php");
include("header/header.php");
//Select Information of Users
$query = mysql_query("SELECT * FROM users WHERE id = '".$_SESSION['u_id']."'");
$data = mysql_fetch_array($query);
//Update Profile Information
if (isset($_POST['Update']))
if (empty($_POST['password']) || empty($_POST['new_password']) || empty($_POST['confirm_password']) || empty($_POST['fname'])|| empty($_POST['lname'])){
	$msg="<p style='background-color:#EBEAF2;; width:99%; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/attention.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>Please fill-up all fields.</font></p>";
}
else 
{
$query = mysql_query("SELECT * FROM users WHERE id = '".$_SESSION['u_id']."'");
$data = mysql_fetch_array($query);
if($data['password'] != md5($_POST['password'])){
	$msg="<p style='background-color:#EBEAF2;; width:99%; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/attention.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>Please insert your corresponding password.</font></p>";
}
else
{
if ($_POST['new_password'] != $_POST['confirm_password']){
	$msg="<p style='background-color:#EBEAF2;; width:99%; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/error.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>New password and confirmation password do not matched.</font></p>";
}
else
{
	mysql_query("UPDATE users SET firstname='".$_POST['fname']."',middle_initials='".$_POST['minitials']."',lastname='".$_POST['lname']."',password='".md5($_POST['new_password'])."' WHERE id='".$_SESSION['u_id']."'");
	$msg="<p style='background-color:#EBEAF2;; width:99%; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	<img src='images/check.png' width='30' height='30' style='margin-top:2px;'><font size='5' color='red'>Your profile was successfully updated.</font></p>";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=profile.php\">";
}
}
}
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<div align="center">
	<table  style="border:gray 1px solid;">
	<form action="profile.php" method="post" autocomplete="off">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">MY PROFILE</td>
	</tr>
		<td class="question" width="45%">Firstname: </td>
		<td><input name="fname" class="a" size="25" value="<?php echo $data['firstname']; ?>"></td>
	</tr>
	</tr>
		<td class="question" width="45%">Middle Initials: </td>
		<td><input name="minitials" class="a" maxlength="4" size="25" value="<?php echo $data['middle_initials']; ?>"></td>
	</tr>
	</tr>
		<td class="question" width="45%">Lastname: </td>
		<td><input name="lname" class="a" size="25" value="<?php echo $data['lastname']; ?>"></td>
	</tr>
	</tr>
		<td class="question">Current Password: </td>
		<td><input name="password" type="password" class="a" maxlength="15" size="25"></td>
	</tr>
	<tr>
		<td class="question">New Password: </td>
		<td><input name="new_password" type="password" class="a" maxlength="15" size="25"></td>
	</tr>
	<tr>
		<td class="question">Confirm Password: </td>
		<td><input name="confirm_password" type="password" class="a" maxlength="15" size="25"></td>
	</tr>
	<tr>
		<td></td><td><input name="Update" type="submit"class="submit" value="UPDATE"></td>
	</tr>
	</form>
	</table>
	</div>
</html>
