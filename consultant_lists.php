<?php session_start(); 
include("connection/connection.php");
include("header/header.php");
if ($firefox) {
	$bottom="0px;";
	}
	else
	{
	$bottom="50px;";
	}
//Update Consultant User role.
if(isset($_GET['id'])){
if ($_GET['role_id'] == "activated")
{
	$role = "3";
	}
	else
	{
		$role = "2";
	}
	mysql_query("UPDATE consultants SET
		    role_id='".$role."'
		    where id='".$_GET['id']."'");
		    $msg="<p><img src='images/check.png' width='15' height='15' style='margin-top:2px;'>
			<font size='4.5' color='red'>Successfully updated consultant role.</font></p>";
			echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=consultant_lists.php'>";
}
?>
<style>
iframe
{
overflow: hidden;
position:absolute;
right:250px;
bottom:<?php echo $bottom; ?>
border: hidden;
}
</style>
<script>	
function closeIframe() {
var iframes = parent.document.getElementById("myiframe");
iframes.parentNode.removeChild(iframes);
document.getElementById("hiddendiv").style.display="";
parent.window.location.reload(true);
}
</script>
<div align="center">
<table>
<form action="add_consultant.php" method="post">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
<tr class="header">
	<td align="left" width="25%">CONSULTANT NAME</td>
	<td align="center" width="10%">STATUS</td>
	<td align="center" width="10%">UPDATE</td>
	<td align="center"></td>
</tr>
<?php
//Select data from consultant
$query=mysql_query("SELECT * FROM consultants order by lastname ASC");
$x=0;
while ($data = mysql_fetch_array($query))
{
if ($data['role_id'] == '2'){
	$data['role_id'] = 'activated';
	$update = 'inactivate';
	$popup = 'activate';
	}
else
{
	$data['role_id'] = 'inactive';
	$update = 'activate';
	$popup = 'inactivate';
}
$x++;
?>
<tr>
	<td>
	<a href="update_consultant.php?consultant_id=<?php echo $data['id']; ?>" target="iframe"><?php echo $data['lastname'].', '.$data['firstname'].' '.$data['middle_initials'].'.'; ?></a>
	</td>
	<td align="center"><?php echo $data['role_id']; ?></td>
	<td align="center"><a href="consultant_lists.php?id=<?php echo $data['id'];?>&role_id=<?php echo $data['role_id']; ?>" onclick=" return confirm('are you sure you want to <?php echo $popup ;?> this consultant');"><?php echo $update; ?></a></td
</tr>
<?php
}
?>
</TABLE>
<div id="hiddendiv" style="display:none;">
    some text
    </div>
	<iframe id="myiframe" name="iframe" src="update_consultant.php" width="400" height="300"  frameborder="yes" scrolling="no"></iframe>
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
?>z