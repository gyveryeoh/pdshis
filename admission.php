<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
include("admission_status.php");

//Registration Status and Hospital ID
$query = mysql_query("SELECT registration_status,hospital_id FROM admission where patients_info_id  ='$patient_info_id'");
$r_status = mysql_fetch_array($query);
if ($r_status['registration_status'] == null){
$registration_status = "N"; }
else{ $registration_status = "R";}

//Submit the form.HIN
if (isset($_POST['save']))
if (empty($_POST['date_admitted']) || ($_POST['consultant'] == "0") || empty($_POST['management_plan']) || empty($_POST['room']) || empty($_POST['bed'])){
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
 //DATE REFERRED
		$date_of_consultation = explode("/",$_POST['date_admitted']);
		$d_o_c = $date_of_consultation[2].'-'.$date_of_consultation[0].'-'.$date_of_consultation[1];
//DATE DISCHARED
		  $date_dischared = explode("/",$_POST['date_dischared_from_derm_service']);
		  $date_of_dischared = $date_dischared[2].'-'.$date_dischared[0].'-'.$date_dischared[1];
//DATE OF DEATH
		  $date_death = explode("/",$_POST['date_of_death']);
		  $date_of_death = $date_death[2].'-'.$date_death[0].'-'.$date_death[1];
//VOID DUPLICATE ENTRIES OF DATE REFERRED PER PATIENTS
		$duplicate=mysql_query("SELECT date_admitted, patients_info_id FROM admission where date_admitted='$d_o_c' and patients_info_id='".$_POST['patients_info_id']."'");
	if($data = mysql_fetch_array($duplicate))
	{
		$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Admission date was already done. Select other date.</span></font><br>
	</p>";
	}
	else
	{
		//Insert Query in Out Patient Table;
		$query = "INSERT INTO admission
		values('',
		'".$_POST['patients_info_id']."',
		'".$_SESSION['u_id']."',
		'".$_POST['consultant']."',
		'$registration_status',
		'".$_POST['satellite_id']."',
		'".addslashes(trim($_POST['hospital_id']))."',
		'$d_o_c',
		'".$_POST['clinic']."',
		'".addslashes(trim($_POST['room']))."',
		'".addslashes(trim($_POST['bed']))."',
		'".addslashes(trim($_POST['reason_for_admission']))."',
		'".addslashes(trim($_POST['histopath_diagnosis']))."',
		'".addslashes(trim($_POST['histopath_record_number']))."',
		'".$_POST['expired']."',
		'$date_of_dischared',
		'$date_of_death',
		'".addslashes(trim($_POST['cause_of_death']))."',
		'".addslashes(trim($_POST['notes']))."',
		'".date('Y-m-d h:i:s')."')";
		mysql_query($query) or die ("Error Inserting New Records: ".mysql_error());
		$admission_id=mysql_insert_id();
		//Insert data in in patient details
		$query1 = mysql_query("insert into admission_details values
				     ('',
				     '$admission_id',
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
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=admission.php?patients_info_id=$_POST[patients_info_id]'>";
		}
}
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
	<form autocomplete="off" action="admission.php" method="post">
	 <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">ADMISSION REGISTRATION</td>
	</tr>
		<td class="question" width="25%">Date Admitted : </td>
		<td><input type="text" name="date_admitted" id="datepicker-example11" value="<?php echo $_POST['date_admitted']; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Satelitte Clinic : </td>
		<td><?php {satellite_clinic_lists();} ?></td>
	</tr>
	<tr>
		<td class="question">Hospital ID Number : </td>
		<td><input type="text" name="hospital_id" class="a" size="25" value="<?php echo $r_status['hospital_id']; ?>"></td>
	</tr>
	<tr>
		<td class="question">Out Patient Clinic : </td>
		<td class="ans regis"><input type="radio" name="clinic" value="S" checked="checked"> Service <input type="radio" value="P" name="clinic"> Private </td>
	</tr>
	<tr>
    <td class="question">Room No. : </td><td><input type="text" name="room" class="a  required" size="5" value="<?php echo $_POST['room']; ?>"><span class="question"> Bed No. : </span><input type="text" name="bed" class="a  required" size="5" value="<?php echo $_POST['bed']; ?>"> <?php echo $required; ?></td>
</tr>
	<tr>
		<td class="question">Dermatology Resident : </td>
		<td class="ans"><?php echo $_SESSION['lname'].', '.$_SESSION['fname']; ?></td>	
	</tr>
	<tr>
		<td class="question">Consultant : </td>
		<td><?php {consultant_lists();} echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Reason for Admission : </td>
		  <td><textarea name="reason_for_admission" cols="43"><?php echo $_POST['reason_for_admission']; ?></textarea></td>
	</tr>
	<tr>
		 <td class="question">Derm Diagnosis : </td>
		 <td><input type="text" name="derm_diagnosis" id="diagnosis" size="50" class="a" value="<?php echo $_POST['derm_diagnosis'];?>"><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Other Information : </td>
		 <td><input type="text" name="other_diagnosis" size="50" class="a" value="<?php echo $_POST['other_diagnosis'];?>"></td>
	</tr>
	<tr>
		 <td></td>
		 <td class="ans regis" colspan="2"><input type="radio" name="problem" value="N" checked="checked" <?php if ($_POST['problem'] == 'N') { echo 'checked'; } ?>> New Problem <img src="images/question_mark.jpg" width="20" height="20" title="First&nbsp;time&nbsp;to&nbsp;consult&nbsp;for&nbsp;the&nbsp;derm&nbsp;problem&nbsp;in&nbsp;your&nbsp;Derm&nbsp;Service"><input type="radio" name="problem" value="F" <?php if ($_POST['problem'] == 'F') { echo 'checked'; } ?>>Follow-up to Previous Problem<img src="images/question_mark.jpg" width="20" height="20" title="Follow-up&nbsp;consultation&nbsp;for&nbsp;a&nbsp;derm&nbsp;problem&nbsp;previously&nbsp;seen&nbsp;by&nbsp;your&nbsp;Derm&nbsp;Service"></td>
	</tr>
	<tr>
		 <td></td>
		 <td class="ans regis"><input type="radio" name="result" value="F" <?php if ($_POST['result'] == 'F') { echo 'checked'; } ?>> Final <img src="images/question_mark.jpg" width="20" height="20" title="patient's&nbsp;diagnosis&nbsp;is&nbsp;established&nbsp;clinically&nbsp;or&nbsp;through&nbsp;test">
		 <input checked="checked" type="radio" name="result" value="P" <?php if ($_POST['result'] == 'P') { echo 'checked'; } ?>>Provisional <img src="images/question_mark.jpg" width="20" height="20" title="patient&nbsp;not&nbsp;a&nbsp;confirmed&nbsp;case(ex.&nbsp;if&nbsp;CTCL&nbsp;is&nbsp;the&nbsp;present&nbsp;working&nbsp;impression&nbsp;but&nbsp;it&nbsp;is&nbsp;not&nbsp;a&nbsp;confirmed&nbsp;case"></td>
	</tr>
	<tr>
		 <td class="question">Comorbidities : </td>
		 <td><input type="text" name="comorbidities" size="30" value="<?php echo $_POST['comorbidities']; ?>" class="a"></td>
	</tr>
	<tr>
		 <td class="question">Management Plan : </td>
		 <td><textarea name="management_plan" cols="43"><?php echo $_POST['management_plan'];ch ?></textarea><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Procedure : </td>
		 <td><input name="procedure" thistopath_diagnosisype="text" class="a" size="30" value="<?php echo $_POST['procedure']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Patient Outcome : </td>
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
		 <td class="question">Date Discharged from derm Service : </td>
		 <td><input type="text" name="date_dischared_from_derm_service" id="datepicker-example12" value="<?php echo $_POST['date_dischared_from_derm_service']; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font></td>
       </tr>
       <tr>
		 <td class="question">Histopath Diagnosis : </td>
		 <td><input type="text" name="histopath_diagnosis" class="a" size="30" value="<?php echo $_POST['histopath_diagnosis']; ?>"></td>
	</tr>
       <tr>
		 <td class="question">Histopath Record Number : </td>
		 <td><input type="text" name="histopath_record_number" class="a" size="30" value="<?php echo $_POST['histopath_record_number']; ?>"></td>
	</tr>       
       <tr>
		 <td class="question">Expired : </td>
		 <td class="regis ans"><input type="radio" name="expired" value="N" <?php if ($_POST['expired'] == 'N') { echo 'checked'; } ?> checked>No <input type="radio" name="expired" value="Y" <?php if ($_POST['expired'] == 'Y') { echo 'checked'; } ?>> Yes </td>
       </tr>
       <tr>
		 <td class="question">Cause of Death: </td>
		 <td><input type="text" name="cause_of_death" size="50" class="a" value="<?php echo $_POST['cause_of_death'];?>"></td>
	</tr>
       <tr>
		 <td class="question">Date of Death : </td>
		 <td><input type="text" name="date_of_death" id="datepicker-example13" value="<?php echo $_POST['date_of_death']; ?>" class="a"></td>
      </tr>
       <tr>
		 <td class="question">Notes : </td>
		 <td><textarea name="notes" cols="43"><?php echo $_POST['notes']; ?></textarea></td>
       </tr>
	<tr>
		<td></td><td><input name="save" type="submit" class="submit" value="SAVE"></td>
	</tr>
	</table>
	</form>
	</div>
</html>
<script>
 $(function () {
    $("#diagnosis").autocomplete({
        source:<?php include ("source.php"); ?>,
	minLength: 2,
	delay:500,
        change: function (event, ui) {
            if (!ui.item) {
                this.value = '';
            }
        }
    });
});
</script>
	<script type="text/javascript" src="javascript/datepicker/zebra_datepicker.js"></script>