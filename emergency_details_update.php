<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
//Consultant Selected
$consultant_result = mysql_query("SELECT * from consultants where role_id='2' order by lastname ASC");
//Select Satellite Clinic
$query = mysql_query("SELECT * FROM satelitte_clinic where id  ='".$emergency_data['satelitte_clinic_id']."'");
$satellite = mysql_fetch_array($query);
//Satelitte Clinic Selected
$results = mysql_query("SELECT * from satelitte_clinic order by id ASC");
//Submit the form.
$date_dis = explode("/",$_POST['date_dischared_from_derm_service']);
$date_of_d = explode("/",$_POST['date_of_death']);
if (isset($_POST['update']))
if (empty($_POST['date_referred']) || ($_POST['hour'] =='hour') || ($_POST['min']=='min') || ($_POST['hour1'] == 'hour1') || ($_POST['min1'] == 'min1') || empty($_POST['room']) || empty($_POST['bed']) || empty($_POST['referring_md']) || empty($_POST['specialty'])){
$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please fill-up all required fields.</span></font><br>
	</p>";
}
else
{
 //DATE REFERRED
		$date_of_consultation = explode("/",$_POST['date_referred']);
		$d_o_c = $date_of_consultation[2].'-'.$date_of_consultation[0].'-'.$date_of_consultation[1];
//VOID DUPLICATE ENTRIES OF DATE REFERRED PER PATIENTS
		$duplicate=mysql_query("SELECT date_referred, patients_info_id,date_created FROM emergency where date_referred='$d_o_c' and patients_info_id='".$_POST['patients_info_id']."' and date_created !='".$emergency_data['date_created']."'");
	if($data = mysql_fetch_array($duplicate))
	{
		$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Date Referred was already done. Select other date.</span></font><br>
	</p>";
	}
	else
{
      $date_referred = explode("/",$_POST['date_referred']);
      mysql_query("update emergency set
		  date_referred		=	'".$date_referred[2].'-'.$date_referred[0].'-'.$date_referred[1]."',
		  satelitte_clinic_id	=	'".$_POST['satellite_id']."',
		  time_referral		=	'".$_POST['hour'].':'.$_POST['min'].' '.$_POST['time']."',
		  time_referral_answered=	'".$_POST['hour1'].':'.$_POST['min1'].' '.$_POST['time1']."',
		  room_number		=	'".addslashes(trim($_POST['room']))."',
		  bed_number		=	'".addslashes(trim($_POST['bed']))."',
	    	  hospital_id 		=	'".addslashes(trim($_POST['hospital_id']))."',
		  clinic_type 		= 	'".$_POST['clinic_type']."', 	
		  consultant_id 	=	'".$_POST['consultant_id']."',
		  referring_md		=	'".addslashes(trim($_POST['referring_md']))."',
		  specialty		=	'".addslashes(trim($_POST['specialty']))."',
		  reason_for_referral 	=	'".addslashes(trim($_POST['reason_for_referral']))."',
		  date_dischared	=	'".$date_dis[2].'-'.$date_dis[0].'-'.$date_dis[1]."',
		  admission 		= 	'".$_POST['admission']."',
		  expired 		= 	'".$_POST['expired']."',expired 		= 	'".$_POST['expired']."',
		  cause_of_death	=	'".addslashes(trim($_POST['cause_of_death']))."',
		  date_of_death		=	'".$date_of_d[2].'-'.$date_of_d[0].'-'.$date_of_d[1]."',
		  notes 		= 	'".addslashes(trim($_POST['notes']))."'
		  where id='".$_POST['emergency_id']."'");
							       
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		<font size='5' color='red'>Sucessfully Updated Emergency details.</font></p>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=emergency_details_update.php?patients_info_id=$_POST[patients_info_id]&emergency_id=$_POST[emergency_id]'>";
		}
}
if (isset($_POST['back']))
echo "<script>location.href='emergency.php?patients_info_id=$patient_info_id'</script>";
?>

<script>
	//Datepicker Format
	$(document).ready(function(){
	$('#datepicker-example11').Zebra_DatePicker({
        format: 'm/d/Y'
	});
	$('#datepicker-example12').Zebra_DatePicker({
        format: 'm/d/Y'
	});
	$('#datepicker-example13').Zebra_DatePicker({
        format: 'm/d/Y'
	});
	});
</script>
<style>
 textarea
 {
  font-size: 16px;
 }
 .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}
</style>
	<div align="center">
	<form action="emergency_details_update.php" method="post" autocomplete="off">
	 <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
	 <input type="hidden" value="<?php echo $emergency_id; ?>"  name="emergency_id">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">EMERGENCY DETAILS</td>
	</tr>
		<td class="question" width="43%">Date Referred : </td>
		<td><input type="text" name="date_referred" id="datepicker-example11" value="<?php echo  $date_referred_er[1].'/'.$date_referred_er[2].'/'.$date_referred_er[0]; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Satelitte Clinic:</td>
                <td><select name="satellite_id" class="index_input">';
                <?php
                while($rows = mysql_fetch_array($results))
                {
                    echo "<option value='".$rows['id']."'";
                    if ($emergency_data['satelitte_clinic_id'] == $rows['id'])
                    {
                        echo "selected='selected'";
                    }
                    echo ">".$rows['clinic_name']."</option>";
                }
                echo "</SELECT></td></tr>";
                ?>
	<tr>
	    <td class="question">Time of Referral :</td>
	    <td><select name="hour" size="1" value="<?php echo $time_referral_er[0]; ?>" class="index_input">
	    <option value="hour">HOUR</option>
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
					if ($time_referral_er[0] == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select> :
			<select name="min" size="1" value="<?php echo $time_referral_er[1]; ?>" class="index_input">
			<option value="min">MIN</option>
			<option value="00"  <?php if ($time_referral_er[1] == '00 PM' || $time_referral_er[1] == '00 AM' ) { echo 'selected'; } ?>>00</option>
				<?php
				for ($i = 01; $i <= 59; $i++)
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
					if ($time_referral_er[1] == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
			<select name="time" size="1" value="<?php echo $_POST['time'] ?>" class="index_input">
			<option value="AM" <?php if ($pm_am_er[1] == 'AM') { echo  'selected' ; } ?>>AM</option>
			<option value="PM" <?php if ($pm_am_er[1] == 'PM') { echo  'selected' ; } ?>>PM</option>
			</select><?php echo $required; ?>
	    </td>
	</tr>
	<tr>
	    <td class="question">Time Referral Answered : </td>
	    <td><select name="hour1" size="1" value="<?php echo $time_referral_answered_er; ?>" class="index_input">
	    <option value="hour1">HOUR</option>
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
					if ($time_referral_answered_er[0] == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select> :
			<select name="min1" size="1" value="<?php echo $time_referral_answered_er[1]; ?>" class="index_input">
			<option value="min1">MIN</option>
			<option value="00"  <?php if ($time_referral_answered_er[1] == '00 PM' || $time_referral_answered_er[1] == '00 AM' ) { echo 'selected'; } ?>>00</option>
				<?php
				for ($i = 01; $i <= 59; $i++)
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
					if ($time_referral_answered_er[1] == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
			<select name="time1" size="1" value="<?php echo $_POST['time'] ?>" class="index_input">
			<option value="AM" <?php if ($pm_am1_er[1] == 'AM') { echo  'selected' ; } ?>>AM</option>
			<option value="PM" <?php if ($pm_am1_er[1] == 'PM') { echo  'selected' ; } ?>>PM</option>
			</select><?php echo $required; ?>
	    </td>
	</tr>
	<tr>
    <td class="question">Room No. : </td><td><input type="text" name="room" class="a  required" size="5" value="<?php echo $emergency_data['room_number']; ?>"><span class="question"> Bed No. : </span><input type="text" name="bed" class="a  required" size="5" value="<?php echo $emergency_data['bed_number']; ?>"> <?php echo $required; ?></td>
</tr>
	<tr>
	<tr>
		<td class="question">Hospital ID Number:</td>
		<td><input type="text" name="hospital_id" class="a" size="25" value="<?php echo $emergency_data['hospital_id']; ?>"></td>
	</tr>
	<tr>
		<td class="question">Out Patient Clinic:</td>
		<td class="ans regis"><input type="radio" name="clinic_type" value="S" <?php if ($emergency_data['clinic_type'] == 'SERVICE') { echo 'checked';}?>> Service <input type="radio" value="P" name="clinic_type" <?php if ($emergency_data['clinic_type'] == 'PRIVATE') {echo 'checked';}?>> Private </td>
	</tr>
	<tr>
		<td class="question">Dermatology Resident:</td>
		<td class="ans"><?php echo $derma_emergency['lastname'].', '.$derma_emergency['firstname']; ?></td>	
	</tr>
        <tr>
		<td class="question">Consultant:</td>
                <td><select name="consultant_id" class="index_input">';
                <?php
                while($c_row = mysql_fetch_array($consultant_result))
                {
                    
                    echo "<option value='".$c_row['id']."'";
                    if ($emergency_data['consultant_id'] == $c_row['id'])
                    {
                        echo "selected='selected'";
                    }
                    echo ">".$c_row['lastname'].", ".(substr($c_row['firstname'],0,1)).". ".$c_row['middle_initials'].".</option>"; 
                }
                echo "</SELECT></td></tr>";
                ?>
	<tr>
        <tr>
		 <td class="question">Referring MD: </td>
		 <td><input type="text" class="a" name="referring_md" size="30" value="<?php echo $emergency_data['referring_md']; ?>"><?php echo $required; ?></td>
        </tr>
        <tr>
		 <td class="question">Specialty: </td>
		 <td><input type="text" class="a" name="specialty" size="30" value="<?php echo $emergency_data['specialty']; ?>"><?php echo $required; ?></td>
        </tr>
        <tr>
		 <td class="question">Reason for Referral: </td>
		 <td><textarea name="reason_for_referral" cols="43"><?php echo $emergency_data['reason_for_referral']; ?></textarea></td>
        </tr>
	<tr>
		 <td class="question">Date Discharged from derm Service : </td>
		 <td><input type="text" name="date_dischared_from_derm_service" id="datepicker-example12" value="<?php echo $date_discharged_er[1].'/'.$date_discharged_er[2].'/'.$date_discharged_er[0]; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font></td>
      </tr>
        <tr>
		<td class="question">For Admission:</td>
		<td class="ans regis"><input type="radio" name="admission" value="N" <?php if ($emergency_data['admission'] == 'NO') { echo 'checked';}?>> No <input type="radio" value="Y" name="admission" <?php if ($emergency_data['admission'] == 'YES') {echo 'checked';}?>> Yes </td>
	</tr>
        	<tr>
		<td class="question">Expired:</td>
		<td class="ans regis"><input type="radio" name="expired" value="N" <?php if ($emergency_data['expired'] == 'NO') { echo 'checked';}?>> No <input type="radio" value="Y" name="expired" <?php if ($emergency_data['expired'] == 'YES') {echo 'checked';}?>> Yes </td>
	</tr>
         <tr>
		 <td class="question">Cause of Death: </td>
		 <td><input type="text" name="cause_of_death" size="50" class="a" value="<?php echo $emergency_data['cause_of_death'];?>"></td>
	</tr>
       <tr>
		 <td class="question">Date of Death : </td>
		 <td><input type="text" name="date_of_death" id="datepicker-example13" value="<?php echo $date_of_death_er[1].'/'.$date_of_death_er[2].'/'.$date_of_death_er[0]; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font></td>
      </tr>
        <tr>
		 <td class="question">Notes: </td>
		 <td><textarea name="notes" cols="43"><?php echo $emergency_data['notes']; ?></textarea></td>
        </tr>
	<tr>
		<td></td><td><input name="update" type="submit" class="submit" value="UPDATE"> <input name="back" type="submit" class="submit" value="BACK TO PATIENT INFORMATION"></td>
	</tr>
	</table>
	</form>
	</div>
</html>
	<script type="text/javascript" src="javascript/datepicker/zebra_datepicker.js"></script>
  