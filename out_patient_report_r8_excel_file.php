<?php session_start();
include("connection/connection.php");
	//New Patient
	$query1 = mysql_query("SELECT COUNT(registration_status) FROM out_patient where registration_status = 'N' and consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'");
	$new_patient = mysql_result($query1,0);
	
$query = mysql_query("SELECT diagnosis as derm_diagnosis,diagnosis_code
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND results='F'
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	and diagnosis_code is not null
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
$date = date('m_d_y');
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=r8_excel_file_$date.xls");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/
xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");

// Make column labels. (at line 4)
xlsWriteLabel(1,0,"DERMATOLOGY DISEASE CENSUS (BY RANK)");
xlsWriteLabel(2,0,"HIS Form R-8");
xlsWriteLabel(4,0,"PDS Institution");
xlsWriteLabel(5,0,"As of ".$_POST['year']."");
xlsWriteLabel(6,0,"Prepared by: ".$_SESSION['lname'].", ".$_SESSION['fname']." ".$_SESSION['minitials'].".");
xlsWriteLabel(7,0,"Date Submitted:");
xlsWriteLabel(8,0,"TOTAL NO. PATIENT = $new_patient");
xlsWriteLabel(11,2,"NEW");
xlsWriteLabel(11,3,"Follow-Up");
xlsWriteLabel(11,4,"TOTAL");
xlsWriteLabel(11,6,"% CASES");
xlsWriteLabel(11,1, "ALL DIAGNOSIS");
xlsWriteLabel(11,0, "RANK");

$xlsRow = 15;

$rank=array(1=>"");
	$x=1;
 	while ($row = mysql_fetch_array($query)){
		$rank[$x] = ucwords(addslashes($row['derm_diagnosis']));
		$his_code[$x] = $row['diagnosis_code'];
		$x++;
	}
    //print_r($rank);
	$x=1;
	$count = count($rank);
	while($x<=$count){

	$diagnosis_new_patient = mysql_query("SELECT count(problems)
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND results='F'
	AND problems='N'
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	and diagnosis = '".$rank[$x]."'");
	//FOLLOW-UP
	$diagnosis_follow_up_patient = mysql_query("SELECT count(problems)
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND results='F'
	AND problems='F'
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	and diagnosis = '".$rank[$x]."'");
	
	$total_new_patient = mysql_fetch_array($diagnosis_new_patient);
	$total_follow_up = mysql_fetch_array($diagnosis_follow_up_patient);


xlsWriteLabel($xlsRow,0,$his_code[$x]);	
xlsWriteLabel($xlsRow,1,$rank[$x]);
xlsWriteNumber($xlsRow,2,($total_new_patient[0]));
xlsWriteNumber($xlsRow,3,($total_follow_up[0]));
xlsWriteNumber($xlsRow,4,($total_follow_up[0]+$total_new_patient[0]));
$x++;
        
$xlsRow++;
}
xlsEOF();
exit();
?>
