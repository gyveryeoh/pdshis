<?php session_start(); 
include("connection/connection.php");
include("header/header.php");
$required = '<font color="red"> *</font>';
if (isset($_POST['update']))
if (empty($_POST['lname']) || empty($_POST['fname']) || empty($_POST['minitials']) || empty($_POST['age']) || ($_POST['age'] =="NaN.NaN")){
	$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/attention.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>Please Fill-up all required fields.</font></p>";
	 $required = "<font color='red'>*</font>";
}
else
{	//I exploded Date of Registation
	$date_of_registration = explode("/",$_POST['date_of_registration']);
	$d_o_r = $date_of_registration[2].'-'.$date_of_registration[0].'-'.$date_of_registration[1];
	//Set Birthdate format with validation..
	$b_date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $b_date)){$b_date;}else{ $b_date=null;}
	mysql_query("UPDATE patients_info SET
		    date_of_registration='".$d_o_r."',
		    gender = '".$_POST['gender']."',
		    firstname ='".mysql_real_escape_string(trim(ucwords(strtolower(addslashes($_POST['fname'])))))."',
		    lastname ='".mysql_real_escape_string(trim(ucwords(strtolower(addslashes($_POST['lname'])))))."',
		    middle_initials ='".mysql_real_escape_string(trim(ucwords(strtolower(addslashes($_POST['minitials'])))))."',
		    contact_number ='".mysql_real_escape_string(trim(ucwords(strtolower(addslashes($_POST['contact_number'])))))."',
		    address ='".mysql_real_escape_string(trim(ucwords(strtolower(addslashes($_POST['address'])))))."',
		    birthdate ='$b_date',
		    age ='".$_POST['age']."',
		    province_id ='".$_POST['provinces_id']."',
		    municipality_id ='".$_POST['municipality_id']."'
		    where id='".$_POST['patient_info_id']."'");
		    $msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
			<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
			<font size='5' color='red'>Successfully updated patient information.</font></p>";
}
//Select Information from patient
$patient_info_id = isset($_GET['patient_info_id'])?$_GET['patient_info_id']:$_POST['patient_info_id'];
$query = mysql_query("SELECT * FROM patients_info WHERE id='$patient_info_id'");
$data = mysql_fetch_array($query);
$date_of_registration = explode("-",$data['date_of_registration']);
?>
<script>
	//Datepicker Format
	$(document).ready(function(){
	$('#datepicker-example11').Zebra_DatePicker({
        format: 'm/d/Y'
	});
	//Province and Municipality Dropdown
	$("select#category").change(function(){
			// Post string
			var post_strings = "id=" + $(this).val();
			var fill = $(this).parent("td").parent("tr").next("tr").children("td").find("#sub_category");
			var option = "";
			// Send the request and update sub category dropdown
			$.ajax({
				type: "POST", 
				data: post_strings, 
				dataType: "json", 
				cache: true,
				
				url:'cities_list.php',  
				timeout: 1000, 
				error: function()
				{
					alert("Failed to submit");
				},
				success: function(data)
				{  
			        $.each(data, function(i,j){ 
		                var row = "<option value=\"" + j.value + "\">" + j.text + "</option>"; 
				option += row;
				});
				$(fill).html(option);
				}
				});
			});
		});
	</script>
<form action="update_patient_info.php" method="post" name="birthday" autocomplete="off">
<div align="center">
<table>
<input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patient_info_id">
	<?php echo '<tr><td colspan=2 align="center">'.$msg.'</td></tr>'; ?>
	<tr>
		<td colspan="2" class="header">PATIENT INFORMATION</td>
	</tr>
	</tr>
		<td class="question" width="45%">Date of registration : </td>
		<td class="regis"><input type="text" name="date_of_registration" id="datepicker-example11" value="<?php echo $date_of_registration[1].'/'.$date_of_registration[2].'/'.$date_of_registration[0]; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font><?php echo $required; ?></td>
	
	</tr>
	<tr>
		<td class="question" width="45%">Lastname:</td>
		<td class="regis"><input name="lname" type="text" onKeyPress= "return lettersonly(this, event)" class="a" maxlength="15" value="<?php echo $data['lastname']; ?>" size="25"/> <?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Firstname:</td>
		<td class="regis"><input name="fname" type="text" onKeyPress= "return lettersonly(this, event)" class="a" maxlength="15" value="<?php echo $data['firstname']; ?>"size="25"/> <?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Middle Initial:</td>
		<td class="regis"><input name="minitials" type="text" onKeyPress= "return lettersonly(this, event)" class="a" maxlength="4" value="<?php echo $data['middle_initials']; ?>" size="25" /> <?php echo $required; ?></td>
			
	</tr>
	<tr>
		<td class="question">Gender:</td>
		<?php if ($data['gender']=="M")
	echo '<td class="ans regis"><input type="radio" name="gender" value="M" checked="checked"> Male <input type="radio" name="gender" value="F"> Female</td>';
	else
	echo '<td class="ans regis"><input type="radio" name="gender" value="M"> Male <input type="radio" name="gender" value="F"  checked="checked"> Female</td>
	</tr>';
?>
	<tr>
	<td class="question" align="right">Birthdate:</td>
	<td class="regis"><select name="month" id="month" size="1" onChange="calage();">
	<option>month</option>
	<?php
		$month = explode("-",$data['birthdate']);
		for ($i = 01; $i <= 12; $i++)
		{
			$value = strlen($i);
			if($value==1)
			{
				$k = "0".$i;
			}
			else
			{
				$k=$i;
			}
				echo "<option value='$k'";
				if ($month[1] == $i)
			{
				echo "selected='selected'";
			}
				echo ">$k</option>";
			}
	?>
</select>
<select name="day" size="1" onChange="calage();">
	<option>day</option>
	<?php
		$day = explode("-",$data['birthdate']);
		for ($i = 01; $i <= 31; $i++)
		{
			$value = strlen($i);
			if($value==1)
			{
				$k = "0".$i;
			}
			else
			{
				$k=$i;
			}
				echo "<option value='$k'";
				if ($day[2] == $i)
			{
				echo "selected='selected'";
			}
				echo ">$k</option>";
			}
	?>
</select> 

<select name="year" size="1" onChange="calage();">
	<option>year</option>
		<?php
			$year = explode("-",$data['birthdate']);
			for($x=date('Y');$x>=1900;$x--)
			{
				echo "<option value=\"".$x."\"";
				if($year[0] == $x)
				echo 'selected';
				echo ">".$x."</option>";  
			}
				?>
</select> <font color="red" class="question"> = optional</td>
    </tr>
    <tr>
	<td class="question" align="right">Age:</td>
	<td class="regis"><input name="age" size="25" class="a" value="<?php echo $data['age']; ?>" onkeypress="return numbersonly(this,event)"><font color="red" class="question"> = required</td>
</td>
</tr>
	<tr>
		<td class="question">Contact Number:</td>
		<td class="regis"><input type="text" name="contact_number" class="a" size="17"  onKeyPress="return numbersonly(this, event)" maxlength="12" value="<?php echo $data['contact_number']; ?>" size="25" />
	</tr>
	<tr>
		<td class="question">Address : </td>
		<td class="regis"><textarea name="address" class="a" cols="23" style="width:220px; height: 110px;"><?php echo $data['address']; ?></textarea></td>
	</tr>
	<tr>
		<td class="question">Province : </td>
		<?php
		$result = mysql_query("SELECT * from pdshis_provinces order by name ASC");
echo "<td class='regis'><select name='provinces_id' id='category' class='index_input required'>";
while($row = mysql_fetch_array($result))
	{
		echo "<option value=\"".$row["id"]."\"";
		if($row['id'] == $data['province_id'])
		echo 'selected';
		echo ">".$row["name"]."</option>";  
		}
		echo "</SELECT></td>";

?>
	</tr>
	<tr>
		<td class="question">City / Municipality : </td>
		<?php
		$result = mysql_query("SELECT * from pdshis_cities where province_id = '".$data['province_id']."' order by name ASC");
echo "<td class='regis'><select name='municipality_id' id='sub_category' class='index_input required'>";
while($row = mysql_fetch_array($result))
	{
		echo "<option value=\"".$row["id"]."\"";
		if($row['id'] == $data['municipality_id'])
		echo 'selected';
		echo ">".$row["name"]."</option>";  
		}
		echo "</SELECT></td>";

?>
	</tr>
	<tr>
		<td></td><td class="regis"><br><input name="update" type="submit" class="submit" value="UPDATE INFO"><br><br></td>
	</tr>
</table>
</form>
</html>
<script type="text/javascript" src="javascript/datepicker/zebra_datepicker.js"></script>
