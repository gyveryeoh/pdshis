<?php
//Select Patient Information
$patient_info_id = isset($_GET['patients_info_id'])?$_GET['patients_info_id']:$_POST['patients_info_id'];
$query = mysql_query("SELECT * FROM patients_info WHERE id='$patient_info_id'");
$data = mysql_fetch_array($query);
//Lists of Consultant
function consultant_lists(){
$result = mysql_query("SELECT * from consultants where role_id='2' order by lastname ASC");
echo '<select name="consultant" class="index_input">';
echo "<option value=0>CONSULTANT</option>";
while($row = mysql_fetch_array($result))
{
	echo "<option value='".$row['id']."'";
	if ($_POST['consultant'] == $row['id'])
	{
		echo "selected='selected'";
	}
		echo ">".$row['lastname'].", ".(substr($row['firstname'],0,1)).". ".$row['middle_initials'].".</option>";  
	}
echo "</SELECT>";
}
function satellite_clinic_lists(){
$sattelite = mysql_query("SELECT * from satelitte_clinic order by id ASC");
echo '<SELECT NAME="satellite_id" class="index_input">';
while($data = mysql_fetch_array($sattelite))
{
 echo"<OPTION VALUE='".$data['id']."'>".$data['clinic_name']."</option>";
 }
 echo "</SELECT>";
 }
?>
<div align="center">
<table  style="border-top:gray 0px solid;">
	<tr>
		<td colspan="4" class="header">PATIENT INFORMATION<br><br></td>
	</tr>
	<tr> 
		<td class="info" width="25%">Patient Name: </td> <td class="info"><?php echo ucwords(strtolower($data['lastname'])); ?>, <?php echo ucwords(strtolower($data['firstname'])); ?> <?php echo ucwords($data['middle_initials']); ?>.</td>
		<td class="info">Age / Gender:</td>
		<td class="info"><?php echo $data['age']; ?>Y / <?php echo $data['gender']; ?></td>
	</tr>
<tr>
		<td class="info">Derm Registry Number: </td>
		<td class="info"> <?php echo ucwords($data['id']); ?></td>
		<td class="info">Date of Registration:</td>
		<?php
		$date_of_registration = explode('-',$data['date_of_registration'])
		?>
		<td class="info"><?php echo $date_of_registration[1]."/".$date_of_registration[2]."/".$date_of_registration[0]; ?></td>
</tr>
</table>
<?php
//OUT PATIENT HEADER
//-------------------->>>
//Get and or Set a Session for Out Patient Id
$out_patient_id = isset($_GET['out_patient_id'])?$_GET['out_patient_id']:$_POST['out_patient_id'];
//Select from patient Information
$query = mysql_query("select * from out_patient where id = '$out_patient_id'");
$data = mysql_fetch_array($query);
if ($data['clinic_type'] == 'S'){ $data['clinic_type'] = 'SERVICE'; }else { $data['clinic_type'] = 'PRIVATE'; }
if ($data['admission'] == 'N'){ $data['admission'] = 'NO'; }else { $data['admission'] = 'YES'; }
if ($data['hospital_id'] == 'NULL' || $data['hospital_id'] == '') { $data['hospital_id'] =''; }
if ($data['histopath_number'] == 'NULL' || $data['histopath_number'] == '') { $data['histopath_number'] =''; }
if ($data['notes'] == 'NULL' || $data['notes'] == '') { $data['notes'] =''; }
$consult_dates = explode("-",$data['consultation_date']);
//<<<---------------------
$result = mysql_query("select * from out_patient_details where out_patient_id = '$out_patient_id'");
//Derma Resident in Charge
$query = mysql_query("SELECT * FROM users where id  ='".$data['users_id']."'");
$derma = mysql_fetch_array($query);
//Satellite Clinic
$query = mysql_query("SELECT * FROM satelitte_clinic where id  ='".$data['satellite_clinic_id']."'");
$satellite = mysql_fetch_array($query);
//CONSULTANT Name
$query = mysql_query("SELECT * FROM consultants where id  ='".$data['consultant_id']."'");
$consultant_name = mysql_fetch_array($query);
//<-----------------------

//SELECT FROM IN PATIENT
$in_patient_id = isset($_GET['in_patient_id'])?$_GET['in_patient_id']:$_POST['in_patient_id'];
//Select from in_patient table
$query = mysql_query("SELECT * FROM in_patient where id  ='$in_patient_id'");
$in_patient_data = mysql_fetch_array($query);
if($in_patient_data['clinic_type'] == 'S') {$in_patient_data['clinic_type'] = 'SERVICE'; }else{$in_patient_data['clinic_type'] = 'PRIVATE'; }
$date_referred = explode("-",$in_patient_data['date_referred']);
$date_discharged = explode("-",$in_patient_data['date_dischared']);
$date_of_death = explode("-",$in_patient_data['date_of_death']);
if ($in_patient_data['expired'] == 'N'){ $in_patient_data['expired'] = 'NO'; }else { $in_patient_data['expired'] = 'YES'; }
$time_referral = explode(":", $in_patient_data['time_referral']);
$pm_am = explode(" ", $in_patient_data['time_referral_answered']);
$time_referral_answered = explode(":", $in_patient_data['time_referral_answered']);
$pm_am1 = explode(" ", $in_patient_data['time_referral']);
$result_of_in_patient = mysql_query("select * from in_patient_details where in_patient_id = '$in_patient_id'");
//Derma Resident in Charge
$query = mysql_query("SELECT * FROM users where id  ='".$in_patient_data['users_id']."'");
$derma_in_patient = mysql_fetch_array($query);


//SELECT FROM EMERGENCY
$emergency_id = isset($_GET['emergency_id'])?$_GET['emergency_id']:$_POST['emergency_id'];
//Select from out_patient table
$query = mysql_query("SELECT * FROM emergency where id  ='$emergency_id'");
$emergency_data = mysql_fetch_array($query);
$date_referred_er = explode("-",$emergency_data['date_referred']);
$date_discharged_er = explode("-",$emergency_data['date_dischared']);
$date_of_death_er = explode("-",$emergency_data['date_of_death']);
if ($emergency_data['expired'] == 'N'){ $emergency_data['expired'] = 'NO'; }else { $emergency_data['expired'] = 'YES'; }
if ($emergency_data['admission'] == 'N'){ $emergency_data['admission'] = 'NO'; }else { $emergency_data['admission'] = 'YES'; }
if($emergency_data['clinic_type'] == 'S') {$emergency_data['clinic_type'] = 'SERVICE'; }else{$emergency_data['clinic_type'] = 'PRIVATE'; }
$time_referral_er = explode(":", $emergency_data['time_referral']);
$pm_am_er = explode(" ", $emergency_data['time_referral_answered']);
$time_referral_answered_er = explode(":", $emergency_data['time_referral_answered']);
$pm_am1_er = explode(" ", $emergency_data['time_referral']);
$result_of_emergency = mysql_query("select * from emergency_details where emergency_id = '$emergency_id'");
//Derma Resident in Charge
$query = mysql_query("SELECT * FROM users where id  ='".$emergency_data['users_id']."'");
$derma_emergency = mysql_fetch_array($query);

//SELECT FROM ADMISSION INFORMATION
$admission_id = isset($_GET['admission_id'])?$_GET['admission_id']:$_POST['admission_id'];
//Select from Admission table
$query = mysql_query("SELECT * FROM admission where id  ='$admission_id'");
$admission_data = mysql_fetch_array($query);
//ADMISSION DATE
$date_admitted = explode("-",$admission_data['date_admitted']);
$date_discharged_admission = explode("-",$admission_data['date_discharged']);
$date_of_death_admission = explode("-",$admission_data['date_of_death']);
//CLINIC TYPE
if($admission_data['clinic_type'] == 'S') {$admission_data['clinic_type'] = 'SERVICE'; }else{$admission_data['clinic_type'] = 'PRIVATE'; }
//EXPIRED INFO
if ($admission_data['expired'] == 'N'){ $admission_data['expired'] = 'NO'; }else { $admission_data['expired'] = 'YES'; }
//Derma Resident in Charge
$query = mysql_query("SELECT * FROM users where id  ='".$admission_data['users_id']."'");
$derma_admission= mysql_fetch_array($query);
//RESULT OF ADMISSION DETAILS
$result_of_admission = mysql_query("select * from admission_details where admission_id = '$admission_id'");
?>