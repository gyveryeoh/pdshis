<?php 
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
//Consultant Selected
$consultant_result = mysql_query("SELECT * from consultants where role_id='2' order by lastname ASC");
//Select Satellite Clinic
$query = mysql_query("SELECT * FROM satelitte_clinic where id  ='".$data['satelitte_clinic_id']."'");
$satellite = mysql_fetch_array($query);
//Satelitte Clinic Selected
$results = mysql_query("SELECT * from satelitte_clinic order by id ASC");
//Submit the form.
if (isset($_POST['update'])){
      $cons_date = explode("/",$_POST['consultation_date']);
      mysql_query("update out_patient set
		  consultation_date = '".$cons_date[2].'-'.$cons_date[0].'-'.$cons_date[1]."',
		  clinic_type = '".$_POST['clinic']."', 	
		  satellite_clinic_id = '".$_POST['satellite_id']."',
		  hospital_id ='".addslashes(trim($_POST['hospital_id']))."',
		  consultant_id ='".$_POST['consultant_id']."',
		  histopath_number = '".addslashes(trim($_POST['histopath_record_number']))."',
		  admission = '".$_POST['for_admission']."',
		  notes = '".addslashes(trim($_POST['notes']))."'
		  where id='".$_POST['out_patient_id']."'");
			     
		$msg="<p style='background-color:#EBEAF2;; width:996; text-align:top; border:gray 0px solid; padding:1px 1px 1px 2px; color:#EBEAF2; font-family:tahoma; margin:1;'>
		<img src='images/check.png' width='30' height='30' style='margin-top:2px;'>
		<font size='5' color='red'>Sucessfully Updated Out patient information.</font></p>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='1; URL=out_patient_details_update.php?patients_info_id=$_POST[patients_info_id]&out_patient_id=$_POST[out_patient_id]'>";
		}
if (isset($_POST['back']))
echo "<script>location.href='out_patient.php?patients_info_id=$patient_info_id'</script>";
?>

<script>
	//Datepicker Format
	$(document).ready(function(){
	$('#datepicker-example11').Zebra_DatePicker({
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
	<form action="out_patient_details_update.php" method="post" autocomplete="off">
	 <input type="hidden" value="<?php echo $patient_info_id; ?>"  name="patients_info_id">
	 <input type="hidden" value="<?php echo $out_patient_id; ?>"  name="out_patient_id">
	<table  style="border:gray 1px solid;">
	<?php echo "<tr><td colspan=2 align=center>$msg</td></tr>"; ?>
	<tr>
		<td colspan="2" class="header">OUT PATIENT DETAILS</td>
	</tr>
		<td class="question" width="43%">Consultation date : </td>
		<td><input type="text" name="consultation_date" id="datepicker-example11" value="<?php echo  $consult_dates[1].'/'.$consult_dates[2].'/'.$consult_dates[0]; ?>" class="a">&nbsp;<font size="1px"><b>mm/dd/yyyy</b></font><?php echo $required; ?></td>
	</tr>
	<tr>
		<td class="question">Satelitte Clinic:</td>
                <td><select name="satellite_id" class="index_input">';
                <?php
                while($rows = mysql_fetch_array($results))
                {
                    echo "<option value='".$rows['id']."'";
                    if ($data['satelitte_clinic_id'] == $rows['id'])
                    {
                        echo "selected='selected'";
                    }
                    echo ">".$rows['clinic_name']."</option>";
                }
                echo "</SELECT></td></tr>";
                ?>
	<tr>
		<td class="question">Hospital ID Number:</td>
		<td><input type="text" name="hospital_id" class="a" size="25" value="<?php echo $data['hospital_id']; ?>"></td>
	</tr>
	<tr>
		<td class="question">Out Patient Clinic:</td>
		<td class="ans regis"><input type="radio" name="clinic" value="S" <?php if ($data['clinic_type'] == 'SERVICE') { echo 'checked';}?>> Service <input type="radio" value="P" name="clinic" <?php if ($data['clinic_type'] == 'PRIVATE') {echo 'checked';}?>> Private </td>
	</tr>
	<tr>
		<td class="question">Dermatology Resident:</td>
		<td class="ans"><?php echo $_SESSION['lname'].', '.$_SESSION['fname']; ?></td>	
	</tr>
        <tr>
		<td class="question">Consultant:</td>
                <td><select name="consultant_id" class="index_input">';
                <?php
                while($c_row = mysql_fetch_array($consultant_result))
                {
                    
                    echo "<option value='".$c_row['id']."'";
                    if ($data['consultant_id'] == $c_row['id'])
                    {
                        echo "selected='selected'";
                    }
                    echo ">".$c_row['lastname'].", ".(substr($c_row['firstname'],0,1)).". ".$c_row['middle_initials'].".</option>"; 
                }
                echo "</SELECT></td></tr>";
                ?>
	<tr>
        <tr>
		 <td class="question">Histopath Record Number: </td>
		 <td><input type="text" class="a" name="histopath_record_number" size="30" value="<?php echo $data['histopath_number']; ?>"></td>
        </tr>
        	<tr>
		<td class="question">For Admission:</td>
		<td class="ans regis"><input type="radio" name="for_admission" value="N" <?php if ($data['admission'] == 'NO') { echo 'checked';}?>> No <input type="radio" value="Y" name="for_admission" <?php if ($data['admission'] == 'YES') {echo 'checked';}?>> Yes </td>
	</tr>
        <tr>
		 <td class="question">Notes: </td>
		 <td><textarea name="notes" cols="43"><?php echo $data['notes']; ?></textarea></td>
        </tr>
	<tr>
		<td></td><td><input name="update" type="submit" class="submit" value="UPDATE"> <input name="back" type="submit" class="submit" value="BACK TO PATIENT INFORMATION"></td>
	</tr>
	</table>
	</form>
	</div>
</html>
	<script type="text/javascript" src="javascript/datepicker/zebra_datepicker.js"></script>
  