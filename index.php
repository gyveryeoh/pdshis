<?php session_start();
include("connection/connection.php");
if (isset($_POST['login']))
if(empty($_POST['username']) || empty($_POST['password'])){
$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please complete the fields.</span></font><br>
	</p>";
}
else 
{
$query = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."' and password ='".md5($_POST['password'])."'");
$data = mysql_fetch_array($query);
if($data['password'] != md5($_POST['password'])) {
$msg1="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Username and Password did not match.</span></font><br>
	</p>";
}
else
{
if($data['roles_id'] == '3'){
$msg2="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>This username is block.</span></font><br>
	</p>";
}
else
{
	$_SESSION['lname'] = $data['lastname'];
	$_SESSION['fname'] = $data['firstname'];
	$_SESSION['minitials'] = $data["middle_initials"];
	$_SESSION['roles_id'] = $data['roles_id'];
	$_SESSION['u_id'] = $data['id'];
	$_SESSION['insti_id'] = $data['institutions_id'];
	header("Location: patients_search.php");

}
}
}
$id=$_GET['id'];
if ($id =="logout")
{
	session_destroy();
	header("Location: index.php");
}
?>
<html>
<head>
	<title>Philippine Dermatological Society</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<div align="center">
    <table width="100%" bordercolor="#5494FF" cellpadding="5" style="border-spacing:inherit; border:gray 1px solid;">
	<form action="index.php" method="post" name="index" autocomplete="off">
		<body onload="setFocus();" style="background: #EBEAF2;">
        <tr>
		<td><img src="images/logo.jpg" width="100%" height="200" style=" border:gray 0px solid; border-bottom:0px;"></td>
	</tr>
	<tr>
            <td width="100%" align="right" class="index_label">Username: <input name="username" type="text" size="20" class="index_input"> Password: <input name="password" type="password" size="20" class="index_input">
	    <input type='submit' name="login" value="LOGIN" class="submit"></td>
        </tr>
</form>
</table>
    <br><br>
<?php echo $msg;?>
<?php echo $msg1;?>
<?php echo $msg2;?>
</html>
<div style="left:38%;top: 80%; position:absolute; font-weight:bold; font-family:arial,sans-serif,tahoma;">
	<p>Copyright &copy; 2009 UP Manila - MIU</p>
<p>Version 3.1</p></div>