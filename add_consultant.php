<?php session_start(); 
include("connection/connection.php");
include("header/header.php");
?>
<?php
if (isset($_POST['submit']))
if (empty($_POST['fname']) || empty($_POST['lname'])){
	$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/attention.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>Please Fill-up all required fields.</font></p>";
	 $required = "<font color='red'>*</font>";
	 }
	 else
	 {
	$duplicate=mysql_query("SELECT * FROM consultants where firstname='".$_POST['fname']."' and lastname='".$_POST['lname']."'");
	if($data = mysql_fetch_array($duplicate))
	{
		$msg = "<p style='background-color:#faadad; width:970; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
			<img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
			<font size='5' color='red'><span style='padding-top:10px;'>Consultant is already exist with id number ".$data['id'].".</span></font><br></p>";
	}
	 else
	 {
		$query = "INSERT INTO consultants
		VALUES ('','2','".$_POST['fname']."', '".$_POST['minitials']."','".$_POST['lname']."')";
		mysql_query($query) or die ("Error Inserting New Records: ".mysql_error());
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		 <font size='5' color='red'>Successfully created new consultant.</font></p>";
	}
	 }
?>
<script type="text/javascript">
<!--
function deleteconsultant(page) {
	var answer = confirm("Are you sure you want to delete this Consultant Information?")
	if (answer){
		alert("Consultant Information deleted")
		window.location = (page)
	}
}
//-->
</script>
<div align="center">
<table>
<form action="add_consultant.php" method="post">	
<tr>
	<td class="header" colspan="2">ADD NEW CONSULTANT</td>
</tr>
<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
<tr>
	<td class="question" width="46%">Lastname:</td>
	<td><input name="lname" type="text" class="a" maxlength="24" onKeyPress= "return lettersonly(this, event)"> <?php echo $required; ?></td>
</tr>
<tr>
	<td class="question">Firstname:</td>
	<td><input name="fname" type="text" class="a" maxlength="24" onKeyPress= "return lettersonly(this, event)"> <?php echo $required; ?></td>
</tr>
<tr>
	<td class="question">Middle Initials:</td>
	<td><input name="minitials" type="text" class="a" maxlength="25" onKeyPress= "return lettersonly(this, event)"></td>
</tr>
<tr>
	<td></td><td><br><input type="submit" class="submit" name="submit" value="SAVE"></td>
</tr>
</table>
</html>
<?php
/*
$sql="SELECT * FROM consultant order by lastname";
$result=mysql_query($sql);

// Count table rows
$count=mysql_num_rows($result);
?>
<div align=center>
<table cellspacing="1" cellpadding="0">
<form name="form1" method="post" action="">
<tr>
<td>
<table border="0" cellspacing="1" cellpadding="0">
<tr>
<td align="center"><strong>Firstname</strong></td>
<td align="center"><strong>Lastname</strong></td>
<td align="center"><strong>Middlename</strong></td>
</tr>
<?php
while($rows=mysql_fetch_array($result)){

?>
<tr>
<?php $id[]=$rows['id']; ?>

<td align="center"><input name="firstname[]" class="a" type="text" value="<?php echo $rows['firstname']; ?>"></td>
<td align="center"><input name="lastname[]" class="a" type="text" value="<?php echo $rows['lastname']; ?>"></td>
<td align="center"><input name="middlename[]" class="a" size="5" type="text" value="<?php echo $rows['middlename']; ?>"></td>
</tr>
<?php
}
?>
<tr>
<td colspan="4" align="center"><br><br><input type="submit" value="UPDATE" class="submit" name="update"></td>
</tr>
</table>
</td>
</tr>
</form>
</table>
<?php
/*
// Check if button name "Submit" is active, do this
if(isset($_POST['update'])){
for($i=0;$i<$count;$i++){
$sql1="UPDATE consultant SET firstname='".$_POST['firstname'][$i]."', lastname='".$_POST['lastname'][$i]."', middlename='".$_POST['middlename'][$i]."' WHERE id ='$id[$i]'";
$result1=mysql_query($sql1);
}
}
if($result1){
	
		print '<script language="Javascript"> alert("Successfully Updated the Consultant Information");</script>';
echo "<script>location.href='add_consultant.php'</script>";
}
mysql_close();
?>