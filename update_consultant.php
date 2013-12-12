<?php session_start(); 
include("connection/connection.php");
$required = '<font color="red"> *</font>';
if (isset($_POST['update']))
if (empty($_POST['lname']) || empty($_POST['fname'])){
	$msg="<p><img src='images/error.png' width='15' height='15' style='margin-top:2px;'>
			<font size='2' color='red'>Please Fill up Required fields.</font></p>";
	 $required = "<font color='red'>*</font>";
}
elseif (empty($_POST['consultant_id'])){
	$msg="<p><img src='images/error.png' width='15' height='15' style='margin-top:2px;'>
			<font size='2' color='red'>Please select consultant.</font></p>";
}
else
{	mysql_query("UPDATE consultants SET
		    firstname='".$_POST['fname']."',
		    middle_initials = '".$_POST['minitials']."',
		    lastname = '".$_POST['lname']."'
		    where id='".$_POST['consultant_id']."'");
		    $msg="<p><img src='images/check.png' width='15' height='15' style='margin-top:2px;'>
			<font size='2' color='red'>Successfully updated consultant information.</font></p>";
			echo '<script type="text/javascript">';
echo 'parent.closeIframe()';
echo '</script>';
}
//Select Information from Consultants
$consultant_id = isset($_GET['consultant_id'])?$_GET['consultant_id']:$_POST['consultant_id'];
$query = mysql_query("SELECT * FROM consultants WHERE id='$consultant_id'");
$data = mysql_fetch_array($query);
?>

<link rel="stylesheet" href="css/style.css">
<form action="update_consultant.php" method="post" autocomplete="off">
<div align="center">
<table style="border: hidden;">
<input type="hidden" value="<?php echo $consultant_id; ?>"  name="consultant_id">
	<tr>
		<td colspan="2" class="header">CONSULTANT INFORMATION</td>
	</tr>
	<?php echo '<tr><td colspan=2 align="center">'.$msg.'</td></tr>'; ?>
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
		<td></td><td class="regis"><br><input name="update" type="submit" class="submit" value="UPDATE INFO"><br><br></td>
	</tr>
</table>
</form>
</html>