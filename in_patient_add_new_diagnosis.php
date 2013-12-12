<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
//Get and or Set a Session for in Patient Id
$in_patient_id = isset($_GET['in_patient_id'])?$_GET['in_patient_id']:$_POST['in_patient_id'];
//Select from out_patient table.
$query = mysql_query("SELECT * FROM in_patient where id  ='$in_patient_id'");
$data = mysql_fetch_array($query);
if ($data['clinic_type'] == 'S'){ $data['clinic_type'] = 'SERVICE'; }else { $data['clinic_type'] = 'PRIVATE'; }
if ($data['expired'] == 'N'){ $data['expired'] = 'NO'; }else { $data['expired'] = 'YES'; }
if($data['date_of_death'] == '0000-00-00') {$data['date_of_death']='';}
if($data['date_dischared'] == '0000-00-00') {$data['date_dischared']='';}

$query = mysql_query("SELECT * FROM users where id  ='".$data['users_id']."'");
$derma = mysql_fetch_array($query);
//Satellite Clinic
$query = mysql_query("SELECT * FROM satelitte_clinic where id  ='".$data['satellite_clinic_id']."'");
$satellite = mysql_fetch_array($query);
//CONSULTANT Name
$query = mysql_query("SELECT * FROM consultants where id  ='".$data['consultant_id']."'");
$consultant_name = mysql_fetch_array($query);

$dc = 1;
while ($dc_in_patient = mysql_fetch_array($result_of_in_patient))
{
	 $dc_in_patient['diagnosis_count'];
$dc++;
}
//Submit the form.
if (isset($_POST['save']))
if (empty($_POST['management_plan'])){
$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please fill-up all required fields.</span></font><br>
	</p>";
}
elseif(empty($_POST["derm_diagnosis"]) && empty($_POST["suggested_diagnosis"])) {
      $msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please fill-up atleast one of the diagnosis field.</span></font><br>
	</p>";
}
elseif(!empty($_POST["derm_diagnosis"]) && !empty($_POST["suggested_diagnosis"])) {
      $msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>You must fill-up one of the diagnosis field.</span></font><br>
	</p>";
}
else
{
	$query = "insert into in_patient_details values
				     ('',
				     '".$_POST['in_patient_id']."',
				     '$dc',
				     '".addslashes(trim($_POST['derm_diagnosis']))."".addslashes(trim($_POST['suggested_diagnosis']))."',
				     '".addslashes(trim($_POST['other_information']))."',
				     '".addslashes(trim($_POST['diagnosis_code']))."',
				     '".$_POST['problem']."',
				     '".$_POST['result']."',
				     '".$_POST['outcome']."',
				     '".addslashes(trim($_POST['management_plan']))."',
				     '".addslashes(trim($_POST['procedure']))."',
				     '".addslashes(trim($_POST['comorbidities']))."',
				     '".addslashes(trim($_POST['histopath_diagnosis']))."')";
	mysql_query($query) or die ("Error Inserting New Records: ".mysql_error());
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		<font size='5' color='red'>Sucessfully created In patient information.</font></p>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=in_patient_add_new_diagnosis.php?patients_info_id=$_POST[patients_info_id]&in_patient_id=$_POST[in_patient_id]'>";
		}
if (isset($_POST['back']))
echo "<script>location.href='in_patient.php?patients_info_id=$patient_info_id'</script>";
?>
<script>
$(function() {
<?php include("source.php"); ?>
$("#diagnosis").autocomplete({
minLength: 2,
delay:500,
source: projects,
 focus: function( event, ui ) {
$( "#diagnosis" ).val( ui.item.label );
return false;
},
select: function( event, ui ) {
$( "#diagnosis" ).val( ui.item.label);
$( "#diagnosis_code" ).val( ui.item.value);
return false;
},
change:function (event, ui) {
            if (!ui.item) {
                this.value = '';
                document.getElementById("diagnosis_code").value = "";
            }
        },

})
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
	<form action="in_patient_add_new_diagnosis.php" method="post" autocomplete="off">
	 <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
	 <input type="hidden" value="<?php echo $in_patient_id; ?>"  name="in_patient_id">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">IN PATIENT DETAILS</td>
	</tr>
		<td width="40%" class="question">Date Referred :&nbsp;</td>
		<td><b><?php echo $date_referred[1].'/'.$date_referred[2].'/'.$date_referred[0]; ?></b></td>
	</tr>
	<tr>
		<td class="question">Satelitte Clinic :&nbsp;</td>
		<td><b><?php echo $satellite['clinic_name']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Time of Referral :&nbsp;</td>
		<td><b><?php echo $data['time_referral']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Time Referral Answered :&nbsp;</td>
		<td><b><?php echo $data['time_referral_answered']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Hospital ID Number :&nbsp;</td>
		<td><b><?php echo $data['hospital_id']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Out Patient Clinic :&nbsp;</td>
		<td><b><?php echo $data['clinic_type']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Room No. :&nbsp;</td>
		<td><b><?php echo $data['room_number']; ?></b> Bed No. :&nbsp;<b><?php echo $data['bed_number']; ?></b></td>
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
		<td class="question">Referring MD :&nbsp;</td>
		<td><b><?php echo $data['referring_md']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Specialty / Dept. :&nbsp;</td>
		<td><b><?php echo $data['specialty']; ?></b></td>
	</tr>
	<tr>
		<td class="question">Reason for Referral :&nbsp;</td>
		<td><b><?php echo $data['reason_for_referral']; ?></b></td>
	</tr>
	<tr>
		 <td class="question" width="40%">Derm Diagnosis :&nbsp;</td>
		 <td><input type="text" name="derm_diagnosis" id="diagnosis" size="50" class="a" value="<?php echo $_POST['derm_diagnosis'];?>"><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Suggested Diagnosis: </td>
		 <td><input type="text" name="suggested_diagnosis" size="50" class="a" value="<?php echo $_POST['suggested_diagnosis'];?>"></td>
	</tr>
	<tr>
		 <td class="question">Other Information : </td>
		 <td><input type="text" name="other_information" size="50" class="a" value="<?php echo $_POST['other_information']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Diagnosis code: </td>
		 <td><input type="text" name="diagnosis_code" readonly="readonly" size="30" class="a" id="diagnosis_code" value="<?php echo $_POST['diagnosis_code'];?>"><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td></td>
		 <td class="ans regis" colspan="2"><input type="radio" name="problem" value="N" checked="checked"> New Problem <img src="images/question_mark.jpg" width="20" height="20" title="First&nbsp;time&nbsp;to&nbsp;consult&nbsp;for&nbsp;the&nbsp;derm&nbsp;problem&nbsp;in&nbsp;your&nbsp;Derm&nbsp;Service"><input type="radio" name="problem" value="F">Follow-up to Previous Problem<img src="images/question_mark.jpg" width="20" height="20" title="Follow-up&nbsp;consultation&nbsp;for&nbsp;a&nbsp;derm&nbsp;problem&nbsp;previously&nbsp;seen&nbsp;by&nbsp;your&nbsp;Derm&nbsp;Service"></td>
	</tr>
	<tr>
		 <td></td>
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
		 <td class="question">Histopath Diagnosis :&nbsp;</td>
		 <td><input type="text" name="histopath_diagnosis" class="a" size="30" value="<?php echo $_POST['histopath_diagnosis']; ?>"></td>
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
		 <td><b><?php echo $date_discharged[1].'/'.$date_discharged[2].'/'.$date_discharged[0]; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Histopath Record Number :&nbsp;</td>
		 <td><b><?php echo $data['histopath_record_number']; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Expired :&nbsp;</td>
		 <td><b><?php echo $data['expired']; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Cause of Death :&nbsp;</td>
		 <td><b><?php echo $data['cause_of_death']; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Date of Death :&nbsp;</td>
		 <td><b><?php echo $date_of_death[1].'/'.$date_of_death[2].'/'.$date_of_death[0]; ?></b></td>
       </tr>
       <tr>
		 <td class="question">Notes :&nbsp;</td>
		 <td><b><?php echo $data['notes']; ?></b></td>
       </tr>
	<tr>
		<td></td><td><input name="save" type="submit" class="submit" value="SAVE"> <input name="back" type="submit" class="submit" value="BACK TO PATIENT INFORMATION"></td>
	</tr>
	</table>
	</form>
	</div>
</html>