<?php session_start(); 
include("connection/connection.php");
include("header/header.php");
$required = '<font color="red"> *</font>';
//Institutions List
function institutions_list(){
$result = mysql_query("SELECT * from institutions order by institutions ASC");
echo "<select name='institutions' class='index_input'>
	<option value=''>Institutions</option>";
	while($row = mysql_fetch_array($result))
	{
		echo"<option value='".$row['id']."'>".$row['institutions']."</option>";
	}
		echo "</SELECT>";
	}
//Function For Submitting the Form
if (isset($_POST['submit']))
if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['uname']) || empty($_POST['institutions']) || empty($_POST['password'])){
	$msg="<p style='background-color:#faadad; width:970; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please complete the fields.</span></font><br>
	</p>";
}
else
{
	if ($_POST['password'] != $_POST['confirm_password'])
	{
		$msg = "<p style='background-color:#faadad; width:970; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
		<img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
		<font size='5' color='red'><span style='padding-top:10px;'>Please confirm your password.</span></font><br></p>";
		}
		else
		{
			$result=mysql_query("SELECT * FROM users where username='".$_POST['uname']."'");
			if(mysql_fetch_array($result))
			{
				$msg = "<p style='background-color:#faadad; width:970; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
				<img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
				<font size='5' color='red'><span style='padding-top:10px;'>Username is already exist.</span></font><br></p>";
			}
			else
			{
				$query = "INSERT INTO users VALUES('','".$_POST['institutions']."','".trim(mysql_escape_string($_POST['uname']))."','".trim(mysql_escape_string(md5($_POST['password'])))."','".trim(mysql_escape_string($_POST['fname']))."','".trim(mysql_escape_string($_POST['middle_initials']))."', '".trim(mysql_escape_string($_POST['lname']))."','".trim(mysql_escape_string($_POST['role']))."')";
				mysql_query($query) or die ("Error Inserting New Records: ".mysql_error());
				$msg="<p style='background-color:#EBEAF2;; width:99%; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
				<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
				<font size='5' color='red'>Successfully created new user.</font></p>";
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=add_user.php\">";
				}
				}
				}
?>
	<head>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<div align="center">
	<table  style="border:gray 1px solid;">
	<form action="add_user.php" method="post" autocomplete="off">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">ADD USER</td>
	</tr>
		<td class="question" width="45%">Firstname: </td>
		<td><input name="fname" class="a" size="25" value="<?php echo $_POST['fname']; ?>"><?php echo $required; ?></td>
	</tr>
	</tr>
		<td class="question" width="45%">Middle Initials: </td>
		<td><input name="minitials" class="a" maxlength="4" size="25" value="<?php echo $_POST['minitials']; ?>"></td>
	</tr>
	</tr>
		<td class="question" width="45%">Lastname: </td>
		<td><input name="lname" class="a" size="25" value="<?php echo $_POST['lname']; ?>"><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Username:</td>
		<td><input name = "uname" type="text" class="a" size="25" maxlength="24" value="<?php echo $_POST['uname']; ?>"><?php echo $required; ?></td>
	</tr>
	</tr>
		<td class="question">Password: </td>
		<td><input name="password" type="password" class="a" maxlength="15" size="25"><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Confirm Password: </td>
		<td><input name="confirm_password" type="password" class="a" maxlength="15" size="25"><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Institutions: </td>
		<td><?php { institutions_list(); }?><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Usertype:</td>
		<td class="ans"><input name="role" type="radio" value="1">Admin <input name="role" type="radio" value="2" checked="checked">User</td>
	</tr>
	<tr>
		<td></td><td><BR><input name="submit" type="submit" class="submit" value="SAVE"></td>
	</tr>
	</form>
	</table>
	</div>
</html>