<?php 
include("connection/connection.php");
include("header/header.php");
//Province lists
function province_list(){
$result = mysql_query("SELECT * from pdshis_provinces order by name ASC");
echo "<select name='provinces_id' id='category' class='index_input required'>
	<option value=''>Province</option>";
	while($row = mysql_fetch_array($result))
	{
		echo "<option value=\"".$row["id"]."\"";
		/*
              if($_POST['provinces_id'] == $row['id'])
                    echo 'selected';
              */echo ">".$row["name"]."</option>";  
		}
		echo "</SELECT>";
		}
$required = '<font color="red"> *</font>';
if (isset($_POST['save']))
if (empty($_POST['date_of_registration']) || empty($_POST['lname']) || empty($_POST['fname']) || empty($_POST['minitials']) || empty($_POST['age']) || empty($_POST['provinces_id']) || ($_POST['age'] == 'NaN.NaN')){
	$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
	 <img src='images/attention.png' width='30' height='30' style='margin-top:2px;'>
	 <font size='5' color='red'>Please fill-up all required fields.</font></p>";
}
else
	{
		
		//Birthday
		$b_date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $b_date)){$b_date;}else{ $b_date=null;}
		//Registration Date
		$date_of_registration = explode("/",$_POST['date_of_registration']);
		$d_o_f = $date_of_registration[2].'-'.$date_of_registration[0].'-'.$date_of_registration[1];
		//Insert Query in Patient Informationstration_date[2]."-".$registration_date[1]."-".$registration_date[0];
		$query = "INSERT INTO patients_info
		values('',
		'".$_SESSION['u_id']."',
		'".$_SESSION['insti_id']."',
		'".$d_o_f."',
		'".$_POST['registration']."',
		'".$_POST['gender']."',
		'".ucwords(strtolower(trim(addslashes($_POST['fname']))))."',
		'".ucwords(strtolower(trim(addslashes($_POST['minitials']))))."',
		'".ucwords(strtolower(trim($_POST['lname'])))."',
		'".addslashes(trim($_POST['contact_number']))."',
		'".ucwords(strtolower(trim(addslashes($_POST['address']))))."',
		'".$b_date."',
		'".ucwords(strtolower(trim(addslashes($_POST['age']))))."',
		'".ucwords(strtolower(trim(addslashes($_POST['provinces_id']))))."',
		'".$_POST['municipality_id']."')";
		mysql_query($query) or die ("Error Inserting New Records: ".mysql_error());
		$id=mysql_insert_id();
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		<font size='5' color='red'>Sucessfully created new patient record.</font></p>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=flatform_list.php?patients_info_id=$id'>";
		}
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
	<div align="center">
	<form name="birthday" action="add_new_patient.php" method="post">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">PATIENT REGISTRATION</td>
	</tr>
		<td class="question" width="45%">Date of registration : </td>
		<td><input type="text" name="date_of_registration" id="datepicker-example11" value="<?php echo $_POST['date_of_registration']; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font><?php echo $required; ?></td>
	</tr>
	</tr>
		<td class="question">Registration Status : </td>
		<td class="ans"><input type="radio" name="registration" value="N" checked="checked">New Patient <input type="radio" name="registration" value="R">Returning Patient</td>
	</tr>
	<tr>
		<td class="question">Lastname : </td>
		<td><input name="lname" type="text"  class="a" onKeyPress= "return lettersonly(this, event)"  maxlength="25" size="25" value="<?php echo $_POST['lname']; ?>"><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Firstname : </td>
		<td><input name="fname" type="text" class="a" value="<?php echo $_POST['fname']; ?>" onKeyPress= "return lettersonly(this, event)" size="25"  maxlength="20"/><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Middle Initials : </td>
		<td><input name="minitials" type="text" value="<?php echo $_POST['minitials']; ?>" class="a" onKeyPress= "return lettersonly(this, event)" size="25"  maxlength="4" /><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Gender : </td>
		<td class="ans"><input type="radio" name="gender" value="M" checked="checked">Male <input type="radio" name="gender" value="F">Female</td>
	</tr>
	<tr>
		<td class="question">Birthdate : </td>
		<td class="ans">
			<select name="month" size="1" value="<?php echo $_POST['month'] ?>" onChange="calage();">
				<option value="month">Month</option>
				<?php
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
					if ($_POST['month'] == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
			<select name="day" class="a" onChange="calage();">
				<option value="day">Day</option>
				<?php
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
					if ($_POST['day'] == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
			<select name="year" size="1" onChange="calage();">
				<option value="year">Year</option>
				<?php
			for($x=date('Y');$x>=1900;$x--)
			{
				echo "<option value=\"".$x."\"";
				if($_POST['year'] == $x)
				echo 'selected';
				echo ">".$x."</option>";  
			}
				?>
			</select><font color="red" class="question"> = optional</td>
	</tr>
	<tr>
		<td class="question">Age : </td>
		<td><input name="age" onKeyPress="return numbersonly(this, event)" class="a" size="25" value="<?php echo $_POST['age']; ?>"><font color="red" class="question"><b> = required</b></font></td>
	</tr>
	<tr>
		<td class="question">Contact Number : </td>
		<td><input type="text" name="contact_number" class="a" value="<?php echo $_POST['contact_number']; ?>" onKeyPress="return numbersonly(this, event)" maxlength="12" size="25" /></td>
	</tr>
	<tr>
		<td class="question">Address : </td>
		<td><textarea name="address" class="a" cols="23" style="width:220px; height: 110px;"><?php echo $_POST['address']; ?></textarea></td>
	</tr>
	
	<tr>
		<td class="question">Province : </td>
		<td><?php { province_list(); }?><?php echo $required; ?></td>			
	</tr>
        <tr>
		<td class="question">City / Municipality : </td>
		<td><select id="sub_category" name="municipality_id" class="index_input">
			<option value="">-- City / Municipality --</option>
		    </select><?php echo $required; ?>
		</td>
	</tr>
	<tr>
		<td></td><td><br><input name="save" type="submit" class="submit" value="SAVE"></td>
	</tr>
	</table>
	</form>
	</div>
</html>
	<script type="text/javascript" src="javascript/datepicker/zebra_datepicker.js"></script>
