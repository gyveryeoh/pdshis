<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
if (isset($_POST['back']))
echo "<script>location.href='out_patient.php?patients_info_id=$patient_info_id'</script>";
?>
	<div align="center">
	<form method="post">
         <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
        <table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">OUT PATIENT DETAILS</td>
	</tr>
		<td class="question" width="50%">Consultation date : </td>
		<td><?php echo $consult_dates[1].'/'.$consult_dates[2].'/'.$consult_dates[0]; ?></td>
        </tr>
	<tr>
		<td class="question">Satelitte Clinic : </td>
		<td><?php echo $satellite['clinic_name'] ?></td>
	</tr>
	<tr>
		<td class="question">Hospital ID Number : </td>
		<td><?php echo $data['hospital_id']; ?></td>
	</tr>
	<tr>
		<td class="question">Out Patient Clinic : </td>
		<td><?php echo $data['clinic_type']; ?></td>
	</tr>
	<tr>
		<td class="question">Dermatology Resident : </td>
		<td ><?php echo $derma['lastname'].', '.$derma['firstname']; ?></td>	
	</tr>
	<tr>
		<td class="question">Consultant : </td>
		<td><?php echo $consultant_name['lastname'].", ".$consultant_name['firstname']." ".$consultant_name['middle_initials']; ?></td>
	</tr>
        <tr>
		 <td class="question">Histopath Record Number : </td>
		 <td><?php echo $data['histopath_number']; ?></td>
       </tr>
       <tr>
		 <td class="question">For Admission : </td>
		 <td><?php echo $data['admission']; ?></td>
       </tr>
       <tr>
		 <td class="question">Notes : </td>
		 <td><?php echo $data['notes']; ?></td>
       </tr>
       <tr>
		 <td></td>
		 <td><b><a href='out_patient_details_update.php?out_patient_id=<?php echo $out_patient_id."&patients_info_id=".$patient_info_id; ?>'>UPDATE</a></b><br><br></td>
       </tr>
       <?php 
       $x=1;
       while($rows=mysql_fetch_array($result)) {
        if ($rows['problems'] == 'N'){$rows['problems'] = 'New Problem';}else{$rows['problems'] = 'Follow-up';}
        if ($rows['results'] == 'F'){$rows['results'] = 'Final';}else{$rows['results'] = 'Provisional';}
        if ($rows['outcomes'] == '1'){
            $rows['outcomes'] = 'Not Applicable';}
        elseif ($rows['outcomes'] == '2'){
            $rows['outcomes'] = 'Resolved';}
        elseif ($rows['outcomes'] == '3'){
            $rows['outcomes'] = 'Improved';}
        elseif ($rows['outcomes'] == '4'){
            $rows['outcomes'] = 'No Improvement';}
        elseif ($rows['outcomes'] == '5'){
            $rows['outcomes'] = 'Deteriorated';}
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
		 <td class="question">Diagnosis Code <?php echo $x ?> : </td>
		 <td><?php echo $rows['diagnosis_code']; ?></td>
	</tr>
	<tr>
		 <td></td>
		 <td><?php echo $rows['problems']; ?></td>
	</tr>
	<tr>
		 <td></td>
		 <td><?php echo $rows['results']; ?></td>
        </tr>
	<tr>
		 <td class="question">Comorbidities <?php echo $x ?> : </td>
		 <td><?php echo $rows['comorbidities']; ?></td>
        </tr>
	<tr>
		 <td class="question">Management Plan <?php echo $x ?> : </td>
                <td><?php echo $rows['management_plans']; ?></td>
        </tr>
	<tr>
		 <td class="question">Procedure/s Done <?php echo $x ?> : </td>
		 <td><?php echo $rows['procedures']; ?></td>
        </tr>
	<tr>
		 <td class="question">Histopath Diagnosis <?php echo $x ?> : </td>
		 <td><?php echo $rows['histopathology']; ?></td>
        </tr>
	<tr>
		 <td class="question">Patient Outcome <?php echo $x ?> : </td>
		 <td><?php echo $rows['outcomes']; ?></td>
       </tr>
	 <tr>
		 <td></td>
		 <td><b><a href='out_patient_update_diagnosis.php?out_patient_id=<?php echo $out_patient_id."&patients_info_id=".$patient_info_id."&out_patient_details_id=$rows[id]"; ?>'>UPDATE</a></b><br><br></td>
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