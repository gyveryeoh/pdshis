<?php session_start(); 
include("connection/connection.php");
include("header/header.php");
if(isset($_GET['clinic'])){
$delete = "delete from satelitte_clinic where id = '".$_GET['clinic']."'";
mysql_query($delete);
$msg="<p style='background-color:#EBEAF2; width:99%; text-align:top; border:gray 1px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/delete.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>Satellite Clinic was Successfully Deleted.</font></p>";
}
	 
if (isset($_POST['submit']))
if (empty($_POST['clinic_name'])){
	$msg="<p style='background-color:#EBEAF2;width:99%; text-align:top; border:gray 1px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/attention.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>Please fill-up the field.</font></p>";
}
else 
{
		mysql_query ("insert into satelitte_clinic (clinic_name) values('".$_POST['clinic_name']."')");
		$msg="<p style='background-color:#EBEAF2; width:99%; text-align:top; border:gray 1px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>New Clinic was Successfully Added.</font></p>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=satelitte_clinic.php\">";
}
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<div align="center">
	<table  style="border:gray 1px solid;">
	<form action="satelitte_clinic.php" method="post">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">SATELLITE CLINIC</td>
	</tr>
		<td class="question" width="45%">Satellite Clinic Name: </td>
		<td><input type="text" class="a"  name="clinic_name" maxlength="15" size="25"></td>
	</tr>
	<tr>
		<td></td><td><input name="submit" type="submit" class="submit" value="SUBMIT DATA"></td>
	</tr>
</table>
<table>
<form action="satelitte_clinic.php" method="post">
<tr>
	<td class="header" colspan="2">SATELLITE CLINIC INFORMATION</td>
</tr>
<?php
$sql="SELECT * FROM satelitte_clinic order by clinic_name";
$result=mysql_query($sql);
// Count table rows
$count=mysql_num_rows($result);
?>
<?php
while($rows=mysql_fetch_array($result)){
?>
<tr>
<?php $id[]=$rows['id']; ?>
<td align="right" width="6%"><input name="clinic[]" class="a" type="text" size="30" value="<?php echo $rows['clinic_name']; ?>"></td>
<td align="left" width="6%"><a href="satelitte_clinic.php?clinic=<?php echo $rows['id'].'"';?>" onclick="return confirm('are you sure you want to delete this satellite clinic?')"><img src="images/delete.png" width="30" height="20"></td>
</tr>
<?php
}
?>
<tr>
<td colspan="2" align="center"><br><input type="submit" value="UPDATE" class="submit" name="update"></td></td>
</tr>
<?php
// Check if button name "Submit" is active, do this
if(isset($_POST['update'])){
for($i=0;$i<$count;$i++){
$sql1="UPDATE satelitte_clinic SET clinic_name='".$_POST['clinic'][$i]."' WHERE id ='$id[$i]'";
$result1=mysql_query($sql1);
}
}
if($result1){
		print '<script language="Javascript"> alert("Successfully Updated the Clinic Satellite Information");</script>';
echo "<script>location.href='satellite_clinic.php.php'</script>";
}
mysql_close();
?>

</div>
</table>
</form>
</html>
</html>
</form>