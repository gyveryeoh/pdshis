<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");

$query = mysql_query("SELECT * FROM satelitte_clinic where id  ='".$in_patient_data['satellite_clinic_id']."'");
$satellite = mysql_fetch_array($query);
//CONSULTANT Name
$query = mysql_query("SELECT * FROM consultants where id  ='".$in_patient_data['consultant_id']."'");
$consultant_name = mysql_fetch_array($query);


if (isset($_POST['back']))
echo "<script>location.href='in_patient.php?patients_info_id=$patient_info_id'</script>";
?>
	<div align="center">
	<form method="post">
         <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
        <table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">IN PATIENT DETAILS</td>
	</tr>
		<td class="question" width="50%">Date Referred : </td>
		<td><?php echo $date_referred[1].'/'.$date_referred[2].'/'.$date_referred[0]; ?></td>
        </tr>
	<tr>
		<td class="question">Satelitte Clinic : </td>
		<td><?php echo $satellite['clinic_name'] ?></td>
	</tr>
	<tr>
		<td class="question">Time of Referral : </td>
		<td><?php echo $in_patient_data['time_referral']; ?></td>
	</tr>
	<tr>
		<td class="question">Time Referral Answered : </td>
		<td><?php echo $in_patient_data['time_referral_answered']; ?></td>
	</tr>
	<tr>
		<td class="question">Room No. :&nbsp;</td>
		<td><b><?php echo $in_patient_data['room_number']; ?></b> Bed No. :&nbsp;<b><?php echo $in_patient_data['bed_number']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Hospital ID Number : </td>
		<td><?php echo $in_patient_data['hospital_id']; ?></td>
	</tr>
	<tr>
		<td class="question">Out Patient Clinic : </td>
		<td><?php echo $in_patient_data['clinic_type']; ?></td>
	</tr>
	<tr>
		<td class="question">Dermatology Resident : </td>
		<td ><?php echo $derma_in_patient['lastname'].', '.$derma_in_patient['firstname']; ?></td>	
	</tr>
	<tr>
		<td class="question">Consultant : </td>
		<td><?php echo $consultant_name['lastname'].", ".$consultant_name['firstname']." ".$consultant_name['middle_initials']; ?></td>
	</tr>
	<tr>
		<td class="question">Referring MD : </td>
		<td><?php echo $in_patient_data['referring_md']; ?></td>
	</tr>
	<tr>
		<td class="question">Specialty : </td>
		<td><?php echo $in_patient_data['specialty']; ?></td>
	</tr>
        <tr>
		 <td class="question">Reason for Referral : </td>
		 <td><?php echo $in_patient_data['reason_for_referral']; ?></td>
       </tr>
       <tr>
		 <td class="question">Date Discharged from derm Service : </td>
		 <td><?php echo $date_discharged[1].'/'.$date_discharged[2].'/'.$date_discharged[0]; ?></td>
       </tr>
        <tr>
		 <td class="question">Histopath Record Number : </td>
		 <td><?php echo $in_patient_data['histopath_record_number']; ?></td>
       </tr>
       <tr>
		 <td class="question">Expired : </td>
		 <td><?php echo $in_patient_data['expired']; ?></td>
       </tr>
       <tr>
		 <td class="question">Cause of Death : </td>
		 <td><?php echo $in_patient_data['cause_of_death']; ?></td>
       </tr>
       <tr>
		 <td class="question">Date of Death : </td>
		 <td><?php echo $date_of_death[1].'/'.$date_of_death[2].'/'.$date_of_death[0]; ?></td>
       </tr>
       <tr>
		 <td class="question">Notes : </td>
		 <td><?php echo $in_patient_data['notes']; ?></td>
       </tr>
       <tr>
		 <td></td>
		 <td><b><a href='in_patient_details_update.php?in_patient_id=<?php echo $in_patient_id."&patients_info_id=".$patient_info_id; ?>'>UPDATE</a></b><br><br></td>
       </tr>
       <?php 
       $x=1;
       while($rows=mysql_fetch_array($result_of_in_patient)) {
        if ($rows['problem'] == 'N'){$rows['problem'] = 'New Problem';}else{$rows['problem'] = 'Follow-up';}
        if ($rows['result'] == 'F'){$rows['result'] = 'Final';}else{$rows['result'] = 'Provisional';}
        if ($rows['outcome'] == '1'){
            $rows['outcome'] = 'Not Applicable';}
        elseif ($rows['outcome'] == '2'){
            $rows['outcome'] = 'Resolved';}
        elseif ($rows['outcome'] == '3'){
            $rows['outcome'] = 'Improved';}
        elseif ($rows['outcome'] == '4'){
            $rows['outcome'] = 'No Improvement';}
        elseif ($rows['outcome'] == '5'){
            $rows['outcome'] = 'Deteriorated';}
        if ($rows['procedures'] == 'NULL' || $rows['procedures'] == ''){ $rows['procedures'] = ''; }
        if ($rows['comorbidities'] == 'NULL' || $rows['comorbidities'] == ''){ $rows['comorbidities'] = ''; }
        if ($rows['histopathology'] == 'NULL' || $rows['histopathology'] == ''){ $rows['histopathology'] = ''; }
        ?>
	<tr>
		 <td class="question">Derm Diagnosis <?php echo $x ?> : </td>
		 <td><?php echo $rows['diagnosis']; ?></td>
	</tr>
	<tr>
		 <td class="question">Other Information <?php echo $x ?> : </td>
		 <td><?php echo $rows['other_information']; ?></td>
	</tr>
	<tr>
		 <td></td>
		 <td><?php echo $rows['problem']; ?></td>
	</tr>
	<tr>
		 <td></td>
		 <td><?php echo $rows['result']; ?></td>
        </tr>
	<tr>
		 <td class="question">Comorbidities <?php echo $x ?> : </td>
		 <td><?php echo $rows['comorbidities']; ?></td>
        </tr>
	<tr>
		 <td class="question">Management Plan <?php echo $x ?> : </td>
                <td><?php echo $rows['management_plan']; ?></td>
        </tr>
	<tr>
		 <td class="question">Procedure <?php echo $x ?> : </td>
		 <td><?php echo $rows['procedures']; ?></td>
        </tr>
	<tr>
		 <td class="question">Histopath Diagnosis <?php echo $x ?> : </td>
		 <td><?php echo $rows['histopathology']; ?></td>
        </tr>
	<tr>
		 <td class="question">Patient Outcome <?php echo $x ?> : </td>
		 <td><?php echo $rows['outcome']; ?></td>
       </tr>
	 <tr>
		 <td></td>
		 <td><b><a href='in_patient_update_diagnosis.php?in_patient_id=<?php echo $in_patient_id."&patients_info_id=".$patient_info_id."&in_patient_details_id=$rows[id]"; ?>'>UPDATE</a></b><br><br></td>
       </tr>
       <?php
       $x++;
       }
       ?>
       <tr>
		<td></td><td><input name="back" type="submit" class="submit" value="BACK TO PATIENT INFORMATION"></td>
	</tr>
	</table>
        </form>
</html>