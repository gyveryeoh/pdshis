<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
//Out Patient_details_id
$in_patient_details_id = isset($_GET['in_patient_details_id'])?$_GET['in_patient_details_id']:$_POST['in_patient_details_id'];
$query = mysql_query("select * from in_patient_details where id = '$in_patient_details_id'");
$datas= mysql_fetch_array($query);
//SATELLITE CLINIC
$query = mysql_query("SELECT * FROM satelitte_clinic where id  ='".$in_patient_data['satellite_clinic_id']."'");
$satellite = mysql_fetch_array($query);
//CONSULTANT
$query = mysql_query("SELECT * FROM consultants where id  ='".$in_patient_data['consultant_id']."'");
$consultant_name = mysql_fetch_array($query);

 if ($datas['procedures'] == 'NULL' || $datas['procedures'] == ''){ $datas['procedures'] = ''; }
        if ($datas['comorbidities'] == 'NULL' || $datas['comorbidities'] == ''){ $datas['comorbidities'] = ''; }
        if ($datas['histopathology'] == 'NULL' || $datas['histopathology'] == ''){ $datas['histopathology'] = ''; }
        
//Select from out_patient table.

//Submit the form.
if (isset($_POST['update']))
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
	mysql_query("update in_patient_details set
				     diagnosis='".addslashes(trim($_POST['derm_diagnosis']))."".addslashes(trim($_POST['suggested_diagnosis']))."',
				     other_information='".addslashes(trim($_POST['other_information']))."',
				     diagnosis_code='".addslashes(trim($_POST['diagnosis_code']))."',
				     problem='".$_POST['problem']."',
				     result='".$_POST['result']."',
				     outcome='".$_POST['outcome']."',
				     management_plan='".addslashes(trim($_POST['management_plan']))."',
				     procedures='".addslashes(trim($_POST['procedure']))."',
				     comorbidities='".addslashes(trim($_POST['comorbidities']))."',
				     histopathology='".addslashes(trim($_POST['histopath_diagnosis']))."'
				     where id ='".$_POST['in_patient_details_id']."'");
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		<font size='5' color='red'>Sucessfully updated in patient diagnosis.</font></p>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=in_patient_update_diagnosis.php?in_patient_id=$_POST[in_patient_id]&patients_info_id=$_POST[patients_info_id]&in_patient_details_id=$_POST[in_patient_details_id]'>";
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
	<form action="in_patient_update_diagnosis.php" method="post" autocomplete="off">
	 <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
	 <input type="hidden" value="<?php echo $in_patient_id; ?>"  name="in_patient_id">
	 <input type="hidden" value="<?php echo $in_patient_details_id; ?>"  name="in_patient_details_id">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">IN PATIENT DETAILS</td>
	</tr>
		<td class="question" width="40%">Consultation date : </td>
		<td><?php echo $date_referred[1].'/'.$date_referred[2].'/'.$date_referred[0]; ?></td>
	</tr>
	<tr>
		<td class="question">Satelitte Clinic:</td>
		<td><?php echo $satellite['clinic_name']; ?></td>
	</tr>
	<tr>
		<td class="question">Hospital ID Number:</td>
		<td><?php echo $in_patient_data['hospital_id']; ?></td>
	</tr>
	<tr>
		<td class="question">In Patient Clinic:</td>
		<td><?php echo $in_patient_data['clinic_type']; ?></td>
	</tr>
	<tr>
		<td class="question">Dermatology Resident:</td>
		<td><?php echo $derma_in_patient['lastname'].', '.$derma_in_patient['firstname']; ?></td>	
	</tr>
	<tr>
		<td class="question">Consultant:</td>
		<td><?php echo $consultant_name['lastname'].", ".$consultant_name['firstname']." ".$consultant_name['middle_initials']; ?></td>
	</tr>
	<tr>
		 <td class="question">Derm Diagnosis: </td>
		 <td><input type="text" name="derm_diagnosis" id="diagnosis" size="50" class="a" value="<?php echo $datas['diagnosis']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Suggested Diagnosis: </td>
		 <td><input type="text" name="suggested_diagnosis" size="50" class="a" value="<?php echo $datas['suggested_diagnosis']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Other Information: </td>
		 <td><input type="text" name="other_information" size="50" class="a" value="<?php echo $datas['other_information']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Diagnosis Code: </td>
		 <td><input type="text" name="diagnosis_code" id="diagnosis_code" size="50" readonly="readonly" class="a" value="<?php echo $datas['diagnosis_code']; ?>"></td>
	</tr>
	<tr>
		 <td></td>
		 <td class="ans regis" colspan="2"><input type="radio" name="problem" value="N" <?php if ($datas['problem'] == 'N') { echo 'checked';}?>> New Problem <img src="images/question_mark.jpg" width="20" height="20" title="First&nbsp;time&nbsp;to&nbsp;consult&nbsp;for&nbsp;the&nbsp;derm&nbsp;problem&nbsp;in&nbsp;your&nbsp;Derm&nbsp;Service"><input type="radio" name="problem" value="F" <?php if ($datas['problem'] == 'F') { echo 'checked';}?>>Follow-up to Previous Problem<img src="images/question_mark.jpg" width="20" height="20" title="Follow-up&nbsp;consultation&nbsp;for&nbsp;a&nbsp;derm&nbsp;problem&nbsp;previously&nbsp;seen&nbsp;by&nbsp;your&nbsp;Derm&nbsp;Service"></td>
	</tr>
	<tr>
		 <td></td>
		 <td class="ans regis"><input type="radio" name="result" value="F" <?php if ($datas['result'] == 'F') { echo 'checked';}?>> Final <img src="images/question_mark.jpg" width="20" height="20" title="patient's&nbsp;diagnosis&nbsp;is&nbsp;established&nbsp;clinically&nbsp;or&nbsp;through&nbsp;test">
		 <input type="radio" name="result" value="P" <?php if ($datas['result'] == 'P') { echo 'checked';}?>>Provisional <img src="images/question_mark.jpg" width="20" height="20" title="patient&nbsp;not&nbsp;a&nbsp;confirmed&nbsp;case(ex.&nbsp;if&nbsp;CTCL&nbsp;is&nbsp;the&nbsp;present&nbsp;working&nbsp;impression&nbsp;but&nbsp;it&nbsp;is&nbsp;not&nbsp;a&nbsp;confirmed&nbsp;case"></td>
	</tr>
	<tr>
		 <td class="question">Comorbidities: </td>
		 <td><input type="text" name="comorbidities" size="30" value="<?php echo $datas['comorbidities']; ?>" class="a"></td>
	</tr>
	<tr>
		 <td class="question">Management Plan: </td>
		 <td><textarea name="management_plan" cols="43" class="required"><?php echo $datas['management_plan']; ?></textarea><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Procedure: </td>
		 <td><input name="procedure" type="text" class="a" size="30" value="<?php echo $datas['procedures']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Histopath Diagnosis: </td>
		 <td><input type="text" name="histopath_diagnosis" class="a" size="30" value="<?php echo $datas['histopathology']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Patient Outcome: </td>
		 <td><select name="outcome" class="index_input">
			<option value="1" <?php if ($datas['outcome'] == '1') { echo 'selected';}?>>Not Applicable</option>
			<option value="2" <?php if ($datas['outcome'] == '2') { echo 'selected';}?>>Resolved</option>
			<option value="3" <?php if ($datas['outcome'] == '3') { echo 'selected';}?>>Improved</option>
			<option value="4" <?php if ($datas['outcome'] == '4') { echo 'selected';}?>>No Improvement</option>
			<option value="5" <?php if ($datas['outcome'] == '5') { echo 'selected';}?>>Deteriorated</option>
		     </select>
		 </td>
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
		 <td class="question">Notes : </td>
		 <td><?php echo $in_patient_data['notes']; ?></td>
       </tr>
	<tr>
		<td></td><td><input name="update" type="submit" class="submit" value="UPDATE"> <input name="back" type="submit" class="submit" value="BACK TO PATIENT INFORMATION"></td>
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
