<?php
include("connection/connection.php");
	$query1 = mysql_query("SELECT COUNT(registration_status),consultation_date FROM out_patient where registration_status='N' and consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'");
	$new = mysql_result($query1,0);
	$query2 = mysql_query("SELECT COUNT(registration_status),consultation_date FROM out_patient where registration_status='R' and consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'");
	$return = mysql_result($query2,0);
	$all = ($new + $return);
	
	$query = mysql_query("SELECT diagnosis,diagnosis_code
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	and diagnosis_code is not NULL
	group by diagnosis
	order by diagnosis ASC");
// Functions for export to excel.
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=r7_excel_file.xls");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");

// Make column labels. (at line 4)
xlsWriteLabel(1,0,"Statistical report on the Number of Cases");
xlsWriteLabel(2,0,"HIS Form R-7");
xlsWriteLabel(4,0,"PDS Institution");
xlsWriteLabel(5,0,"As of ".$_POST['start_date']." - ".$_POST['end_date']."");
xlsWriteLabel(6,0,"Prepared by:");
xlsWriteLabel(7,0,"Date Submitted:");
xlsWriteLabel(8,0,"TOTAL NO. PATIENT ENCOUNTERS for the month= $all");
xlsWriteLabel(8,4,"New Registrants = $new");
xlsWriteLabel(9,4,"Returning Patients = $return");
xlsWriteLabel(11,3,"Final CASES");
xlsWriteLabel(11,5,"Provisional");
xlsWriteLabel(12,5,"CASES");
xlsWriteLabel(11,7,"TOTAL NO. OF");
xlsWriteLabel(12,7,"INDIVIDUALS");
xlsWriteLabel(12,0, "PDS-HIS CODE");
xlsWriteLabel(12,1, "ALL DIAGNOSIS");

$xlsRow = 14;
$rank=array(1=>"");
	$x=1;
 	while ($row = mysql_fetch_array($query)){
		$rank[$x] = addslashes($row['diagnosis']);
		$his_code[$x] = $row['diagnosis_code'];
		$x++;
	}
    //print_r($rank);
	$x=1;
	$count = count($rank);
	while($x<=$count){
        //F diagnosis1
	$final_diagnosis1 = mysql_query("SELECT distinct patients_info_id
	from out_patient,out_patient_details where
	out_patient.id = out_patient_details.out_patient_id
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	AND results='F'
	AND diagnosis = '".addslashes($rank[$x])."'");
        
        //P diagnosis1
	$provisional_diagnosis1 = mysql_query("SELECT distinct patients_info_id
	from out_patient,out_patient_details where
	out_patient.id = out_patient_details.out_patient_id
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	AND results='P'
	AND diagnosis = '".addslashes($rank[$x])."'");
        //F Diagnosis
        $final1 = mysql_num_rows($final_diagnosis1);
        //P Diagnosis
        $provisional1 = mysql_num_rows($provisional_diagnosis1);
xlsWriteLabel($xlsRow,0,$his_code[$x]);	
xlsWriteLabel($xlsRow,1,$rank[$x]);
xlsWriteNumber($xlsRow,3,$final1);
xlsWriteNumber($xlsRow,5,$provisional1);
xlsWriteNumber($xlsRow,7,$provisional1 + $final1);
$x++;  
$xlsRow++;
}
        
xlsEOF();
exit();
?>