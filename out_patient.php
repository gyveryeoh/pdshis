<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
include("out_patient_status.php");
//Registration Status and Hospital ID
$query = mysql_query("SELECT registration_status,hospital_id FROM out_patient where patients_info_id  ='$patient_info_id'");
$r_status = mysql_fetch_array($query);
if ($r_status['registration_status'] == null){
$registration_status = "N"; }
else{ $registration_status = "R";}
//Submit the form.
if (isset($_POST['save']))
if (empty($_POST['consultation_date']) || ($_POST['consultant'] == "0") || empty($_POST['management_plan'])){
$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please fill-up all required fields.</span></font><br>
	</p>";
}
elseif(empty($_POST["derm_diagnosis"]) && empty($_POST["suggested_diagnosis"])) {
      $msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Please fill-up atleast one diagnosis field.</span></font><br>
	</p>";
}
elseif(!empty($_POST["derm_diagnosis"]) && !empty($_POST["suggested_diagnosis"])) {
      $msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>You must fill-up one diagnosis field.</span></font><br>
	</p>";
}
else
{
 //Consultation Dates
		$date_of_consultation = explode("/",$_POST['consultation_date']);
		$d_o_c = $date_of_consultation[2].'-'.$date_of_consultation[0].'-'.$date_of_consultation[1];
 $duplicate=mysql_query("SELECT consultation_date, patients_info_id FROM out_patient where consultation_date='$d_o_c' and patients_info_id='".$_POST['patients_info_id']."'");
	if($data = mysql_fetch_array($duplicate))
	{
		$msg="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'>
	 <img src='images/error.png' width='20' height='20' style='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>Consultation date was already done. Select other date.</span></font><br>
	</p>";
	}
	else
	{
		//Insert Query in Out Patient Table;
		$query = "INSERT INTO out_patient
		values('',
		'".$_POST['patients_info_id']."',
		'".$_SESSION['u_id']."',
		'".$_POST['consultant']."',
		'$registration_status',
		'".$_POST['satellite_id']."',
		'".addslashes(trim($_POST['hospital_id']))."',
		'$d_o_c',
		'".$_POST['clinic']."',
		'".$_POST['for_admission']."',
		'".addslashes(trim($_POST['histopath_record_number']))."',
		'".addslashes(trim($_POST['notes']))."')";
		mysql_query($query) or die ("Error Inserting New Records: ".mysql_error());
		$out_patient_id=mysql_insert_id();
		//Insert data in out patient details
		if (empty($_POST['derm_diagnosis'])){ $_POST['diagnosis_code'] =='NULL'; }
		$query1 ="insert into out_patient_details values
				     ('',
				     '$out_patient_id',
				     '1',
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
				     mysql_query($query1) or die ("Error Inserting New Records: ".mysql_error());
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		<font size='5' color='red'>Sucessfully created Out patient information.</font></p>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=out_patient.php?patients_info_id=$_POST[patients_info_id]'>";
		}
}
?>
<script>
	//Datepicker Format
	$(document).ready(function(){
	$('#datepicker-example11').Zebra_DatePicker({
        format: 'm/d/Y'
	});
	});
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
</head>
<style>
 textarea
 {
  font-size: 16px;
 }
 .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}
</style>
	<div align="center">
	<form autocomplete="off" action="out_patient.php" method="post">
	 <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">OUT PATIENT REGISTRATION</td>
	</tr>
		<td class="question" width="25%">Consultation date : </td>
		<td><input type="text" name="consultation_date" id="datepicker-example11" value="<?php echo $_POST['consultation_date']; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Satelitte Clinic:</td>
		<td><?php {satellite_clinic_lists();} ?></td>
	</tr>
	<tr>
		<td class="question">Hospital ID Number:</td>
		<td><input type="text" name="hospital_id" class="a" size="25" value="<?php echo $r_status['hospital_id']; ?>"></td>
	</tr>
	<tr>
		<td class="question">Out Patient Clinic:</td>
		<td class="ans regis"><input type="radio" name="clinic" value="S" checked="checked"> Service <input type="radio" value="P" name="clinic"> Private </td>
	</tr>
	<tr>
		<td class="question">Dermatology Resident:</td>
		<td class="ans"><?php echo $_SESSION['lname'].', '.$_SESSION['fname']; ?></td>	
	</tr>
	<tr>
		<td class="question">Consultant:</td>
		<td><?php {consultant_lists();} echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Diagnosis: </td>
		 <td><input type="text" name="derm_diagnosis" id="diagnosis" size="50" class="a" value="<?php echo $_POST['derm_diagnosis'];?>"></td>
	</tr>
	<tr>
		 <td class="question">Suggested Diagnosis: </td>
		 <td><input type="text" name="suggested_diagnosis" size="50" class="a" value="<?php echo $_POST['suggested_diagnosis'];?>"></td>
	</tr>
	<tr>
		 <td class="question">Other Information: </td>
		 <td><input type="text" name="other_information" size="50" class="a" value="<?php echo $_POST['other_information'];?>"></td>
	</tr>
	<tr>
		 <td class="question">Diagnosis code: </td>
		 <td><input type="text" name="diagnosis_code" readonly="readonly" id="diagnosis_code" size="30" class="a" value="<?php echo $_POST['diagnosis_code'];?>"><?php echo $required; ?></td>
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
		 <td class="question">Comorbidities: </td>
		 <td><input type="text" name="comorbidities" size="30" value="<?php echo $_POST['comor']; ?>" class="a"></td>
	</tr>
	<tr>
		 <td class="question">Management Plan: </td>
		 <td><textarea name="management_plan" cols="43" class="required"><?php echo $_POST['management_plan']; ?></textarea><?php echo $required; ?></td>
	</tr>
	<tr>
		 <td class="question">Procedure/s Done: </td>
		 <td><input name="procedure" type="text" class="a" size="30" value="<?php echo $_POST['procedure']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Histopath Diagnosis: </td>
		 <td><input type="text" name="histopath_diagnosis" class="a" size="30" value="<?php echo $_POST['histopath_diagnosis']; ?>"></td>
	</tr>
	<tr>
		 <td class="question">Patient Outcome: </td>
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
		 <td class="question">Histopath Record Number: </td>
		 <td><input type="text" class="a" name="histopath_record_number" size="30" value="<?php echo $_POST['histopath_record_number']; ?>"></td>
       </tr>
       <tr>
		 <td class="question">For Admission: </td>
		 <td class="regis ans"><input type="radio" name="for_admission" value="N" checked="checked">No <input type="radio" name="for_admission" value="Y"> Yes </td>
       </tr>
       <tr>
		 <td class="question">Notes: </td>
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
 
 /*Using a custom source callback to match only the beginning of terms
 $(function () {
    $("#diagnosis_code").autocomplete({
        source:<?php include ("radlex_id.php"); ?>,
	minLength: 3,
	delay:500,
        change: function (event, ui) {
            if (!ui.item) {
                this.value = '';
            }
        }
    });
});



 /*Using a custom source callback to match only the beginning of terms
  *
  *$(function () {
  var tags = [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
    $("#autocomplete").autocomplete({
         source: function( request, response ) {
var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
response( $.grep( tags, function( item ){
return matcher.test( item );
}) );
},
	minLength: 2,
	delay:500,
        change: function (event, ui) {
            if (!ui.item) {
                this.value = '';
            }
        }
    });
}); */
 
 
</script>
	<script type="text/javascript" src="javascript/datepicker/zebra_datepicker.js"></script>
