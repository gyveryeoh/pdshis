<?php session_start(); 
include("connection/connection.php");
$required = '<font color="red"> *</font>';
if (isset($_POST['update']))
if (empty($_POST['uname']) || empty($_POST['lname']) || empty($_POST['fname'])){
	$msg="<p><img src='images/error.png' width='15' height='15' style='margin-top:2px;'>
			<font size='2' color='red'>Please Fill up Required fields.</font></p>";
}
elseif (empty($_POST['user_id'])){
	$msg="<p><img src='images/error.png' width='15' height='15' style='margin-top:2px;'>
			<font size='2' color='red'>Please select user.</font></p>";
}
else
{
	$result=mysql_query("SELECT username,id FROM users where username='".$_POST['uname']."' and id != '".$_POST['user_id']."'");
			if(mysql_fetch_array($result))
			{
				$msg="<p><img src='images/error.png' width='15' height='15' style='margin-top:2px;'>
			<font size='2' color='red'>Username is already exist.</font></p>";
			}
			else
			{
				mysql_query("UPDATE users SET
					    firstname='".$_POST['fname']."',
					    middle_initials = '".$_POST['minitials']."',
					    username = '".$_POST['uname']."',
					    lastname = '".$_POST['lname']."',
					    roles_id = '".$_POST['roles']."'
					    where id='".$_POST['user_id']."'");
				echo '<script type="text/javascript">';
				echo 'parent.closeIframes()';
				echo '</script>';
}
}
//Select Information from Consultants
$user_id = isset($_GET['user_id'])?$_GET['user_id']:$_POST['user_id'];
$query = mysql_query("SELECT * FROM users WHERE id='$user_id'");
$data = mysql_fetch_array($query);
?>

<link rel="stylesheet" href="css/style.css">
<form action="update_users.php" method="post" autocomplete="off">
<div align="center">
<table style="border: hidden;">
<input type="hidden" value="<?php echo $user_id; ?>"  name="user_id">
	<tr>
		<td colspan="2" class="header">USERS INFORMATION</td>
	</tr>
	<?php echo '<tr><td colspan=2 align="center">'.$msg.'</td></tr>'; ?>
	<tr>
		<td class="question">Username:</td>
		<td class="regis"><input name="uname" type="text" onKeyPress= "return lettersonly(this, event)" class="a" maxlength="15" value="<?php echo $data['username']; ?>" size="25"/> <?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Lastname:</td>
		<td class="regis"><input name="lname" type="text" onKeyPress= "return lettersonly(this, event)" class="a" maxlength="15" value="<?php echo $data['lastname']; ?>" size="25"/> <?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Firstname:</td>
		<td class="regis"><input name="fname" type="text" onKeyPress= "return lettersonly(this, event)" class="a" maxlength="15" value="<?php echo $data['firstname']; ?>"size="25"/> <?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Middle Initial:</td>
		<td class="regis"><input name="minitials" type="text" onKeyPress= "return lettersonly(this, event)" class="a" maxlength="4" value="<?php echo $data['middle_initials']; ?>" size="25" /></td>
			
	</tr>
	<tr>
		<td class="question">Roles:</td>
		<td>
			<select name="roles" class="index_input">
				 <option value="1" <?php if ($data['roles_id'] == '1') { echo 'selected'; } ?>>admin</option>
				 <option value="2" <?php if ($data['roles_id'] == '2') { echo 'selected'; } ?>>user</option>
				 <option value="3" <?php if ($data['roles_id'] == '3') { echo 'selected'; } ?>>block</option>
			</select>
		</td>
	</tr>
	</tr>
	<tr>
		<td></td><td class="regis"><br><input name="update" type="submit" class="submit" value="UPDATE INFO"><br><br></td>
	</tr>
</table>
</form>
</html>