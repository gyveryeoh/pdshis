<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");

$query = mysql_query("SELECT * FROM users where id  ='".$admission_data['users_id']."'");
$derma = mysql_fetch_array($query);
//Satellite Clinic
$query = mysql_query("SELECT * FROM satelitte_clinic where id  ='".$admission_data['satelitte_clinic_id']."'");
$satellite = mysql_fetch_array($query);
//CONSULTANT Name
$query = mysql_query("SELECT * FROM consultants where id  ='".$admission_data['consultant_id']."'");
$consultant_name = mysql_fetch_array($query);

//Submit the form.
if (isset($_POST['save']))
if (empty($_POST['management_plan'])){
$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please fill-up all required fields.</span></font><br>
	</p>";
}
elseif(empty($_POST["derm_diagnosis"]) && empty($_POST["other_diagnosis"])) {
      $msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please fill-up atleast one of the diagnosis field.</span></font><br>
	</p>";
}
elseif(!empty($_POST["derm_diagnosis"]) && !empty($_POST["other_diagnosis"])) {
      $msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>You must fill-up one of the diagnosis field.</span></font><br>
	</p>";
}
else
{
	$query = mysql_query("insert into admission_details values
				     ('',
				     '".$_POST['admission_id']."',
				     '".addslashes(trim($_POST['derm_diagnosis']))."',
				     '".addslashes(trim($_POST['other_diagnosis']))."',
				     '".$_POST['problem']."',
				     '".$_POST['result']."',
				     '".$_POST['outcome']."',
				     '".addslashes(trim($_POST['management_plan']))."',
				     '".addslashes(trim($_POST['procedure']))."',
				     '".addslashes(trim($_POST['comorbidities']))."')");
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		<font size='5' color='red'>Sucessfully created admission information.</font></p>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=admission_add_new_diagnosis.php?patients_info_id=$_POST[patients_info_id]&admission_id=$_POST[admission_id]'>";
		}
if (isset($_POST['back']))
echo "<script>location.href='admission.php?patients_info_id=$patient_info_id'</script>";
?>
<style>
 textarea
 {
  font-size: 16px;
 }
 .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}
</style>
	<div align="center">
	<form action="admission_add_new_diagnosis.php" method="post" autocomplete="off">
	 <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
	 <input type="hidden" value="<?php echo $admission_id; ?>"  name="admission_id">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">ADMISSION DETAILS</td>
	</tr>
		<td width="40%" class="question">Date Admitted :&nbsp;</td>
		<td><b><?php echo $date_admitted[1].'/'.$date_admitted[2].'/'.$date_admitted[0]; ?></b></td>
	</tr>
	<tr>
		<td class="question">Satelitte Clinic :&nbsp;</td>
		<td><b><?php echo $satellite['clinic_name']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Hospital ID Number :&nbsp;</td>
		<td><b><?php echo $admission_data['hospital_id']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Admission Clinic :&nbsp;</td>
		<td><b><?php echo $admission_data['clinic_type']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Room No. :&nbsp;</td>
		<td><b><?php echo $admission_data['room_number']; ?></b> Bed No. :&nbsp;<b><?php echo $admission_data['bed_number']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Dermatology Resident :&nbsp;</td>
		<td><b><?php echo $derma['lastname'].', '.$derma['firstname'].' '.$derma['middle_initials']; ?>.</b></td>	
	</tr>
	<tr>
		<td class="question">Consultant :&nbsp;</td>
		<td><b><?php echo $consultant_name['lastname'].", ".$consultant_name['firstname']." ".$consultant_name['middle_initials']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Reason for Admission :&nbsp;</td>
		<td><b><?php echo $admission_data['reason_for_admission']; ?></b></td>
	</tr>
	<tr>
		 <td class="question" width="40%">Derm Diagnosis :&nbsp;</td>
		 <td><input type="text" name="derm_diagnosis" id="diagnosis" size="50" class="a"><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Other Information :&nbsp;</td>
		 <td><input type="text" name="other_diagnosis" size="50" class="a"></td>
	</tr>
	<tr>
		 <td>&nbsp;</td>
		 <td class="ans regis" colspan="2"><input type="radio" name="problem" value="N" checked="checked"> New Problem <img src="images/question_mark.jpg" width="20" height="20" title="First&nbsp;time&nbsp;to&nbsp;consult&nbsp;for&nbsp;the&nbsp;derm&nbsp;problem&nbsp;in&nbsp;your&nbsp;Derm&nbsp;Service"><input type="radio" name="problem" value="F">Follow-up to Previous Problem<img src="images/question_mark.jpg" width="20" height="20" title="Follow-up&nbsp;consultation&nbsp;for&nbsp;a&nbsp;derm&nbsp;problem&nbsp;previously&nbsp;seen&nbsp;by&nbsp;your&nbsp;Derm&nbsp;Service"></td>
	</tr>
	<tr>
		 <td>&nbsp;</td>
		 <td class="ans regis"><input type="radio" name="result" value="F"> Final <img src="images/question_mark.jpg" width="20" height="20" title="patient's&nbsp;diagnosis&nbsp;is&nbsp;established&nbsp;clinically&nbsp;or&nbsp;through&nbsp;test">
		 <input type="radio" name="result" value="P" checked="checked">Provisional <img src="images/question_mark.jpg" width="20" height="20" title="patient&nbsp;not&nbsp;a&nbsp;confirmed&nbsp;case(ex.&nbsp;if&nbsp;CTCL&nbsp;is&nbsp;the&nbsp;present&nbsp;working&nbsp;impression&nbsp;but&nbsp;it&nbsp;is&nbsp;not&nbsp;a&nbsp;confirmed&nbsp;case"></td>
	</tr>
	<tr>
		 <td class="question">Comorbidities :&nbsp;</td>
		 <td><input type="text" name="comorbidities" size="30" value="<?php echo $_POST['comor']; ?>" class="a"></td>
	</tr>
	<tr>
		 <td class="question">Management Plan :&nbsp;</td>
		 <td><textarea name="management_plan" cols="43" class="required"><?php echo $_POST['management_plan']; ?></textarea><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Procedure :&nbsp;</td>
		 <td><input name="procedure" type="text" class="a" size="30" value="<?php echo $_POST['procedure']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Patient Outcome :&nbsp;</td>
		 <td><select name="outcome" class="index_input">
			<option value="1">Not Applicable</option>
			<option value="2">Resolved</option>
			<option value="3">Improved</option>
			<option value="4">No Improvement</option>
			<option value="5">Deteriorated</option>
		     </select>
		 </td>
       </tr>
       <tr>
		 <td class="question">Date Discharged from derm Service :&nbsp;</td>
		 <td><b><?php echo $date_discharged_admission[1].'/'.$date_discharged_admission[2].'/'.$date_discharged_admission[0]; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Histopath Diagnosis :&nbsp;</td>
		 <td><b><?php echo $admission_data['histopath_diagnosis']; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Histopath Record Number :&nbsp;</td>
		 <td><b><?php echo $admission_data['histopath_number']; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Expired :&nbsp;</td>
		 <td><b><?php echo $admission_data['expired']; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Cause of Death :&nbsp;</td>
		 <td><b><?php echo $admission_data['cause_of_death']; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Date of Death :&nbsp;</td>
		 <td><b><?php echo $date_of_death_admission[1].'/'.$date_of_death_admission[2].'/'.$date_of_death_admission[0]; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Notes :&nbsp;</td>
		 <td><b><?php echo $admission_data['notes']; ?></b></td>
       </tr>
	<tr>
		<td></td><td><input name="save" type="submit" class="submit" value="SAVE"> <input name="back" type="submit" class="submit" value="BACK TO PATIENT INFORMATION"></td>
	</tr>
	</table>
	</form>
	</div>
</html>
<script>
 $(function () {
    $("#diagnosis").autocomplete({
        source:<?php include ("source.php"); ?>,
	minLength: 3,
	delay:500,
        change: function (event, ui) {
            if (!ui.item) {
                this.value = '';
            }
        }
    });
});
</script>