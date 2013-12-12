<?php session_start();
include("connection/connection.php");
	//New Patient
	$query1 = mysql_query("SELECT COUNT(registration_status) FROM out_patient where registration_status = 'N' and consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'");
	$new_patient = mysql_result($query1,0);
	//Returning Patient
	$query2 = mysql_query("SELECT COUNT(registration_status) FROM out_patient where registration_status = 'R' and consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'");
	$returning_patient = mysql_result($query2,0);
	$encountered = ($new_patient+$returning_patient);
	
$query = mysql_query("SELECT diagnosis,diagnosis_code
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND results='F'
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
$date = date('m_d_y');
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=r6_excel_file_$date.xls");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");

// Make column labels. (at line 4)
xlsWriteLabel(1,0,"Statistical report on the Number of Cases OPD Department");
xlsWriteLabel(2,0,"HIS Form R-6");
xlsWriteLabel(4,0,"PDS Institution");
xlsWriteLabel(5,0,"As of ".$_POST['start_date']." - ".$_POST['end_date']."");
xlsWriteLabel(6,0,"Prepared by: ".$_SESSION['lname'].", ".$_SESSION['fname']." ".$_SESSION['minitials'].".");
xlsWriteLabel(7,0,"Date Submitted:");
xlsWriteLabel(8,0,"TOTAL NO. PATIENT ENCOUNTERS for the month = $encountered");
xlsWriteLabel(9,0,"TOTAL NO. PATIENT for the month= $new_patient");
xlsWriteLabel(8,4,"New Registrants = $new_patient");
xlsWriteLabel(9,4,"Returning Patients = $returning_patient");
xlsWriteLabel(11,3,"NO. OF NEW CASES");
xlsWriteLabel(11,5," TOTAL NO.");
xlsWriteLabel(11,6,"NO. OF");
xlsWriteLabel(11,7,"TOTAL NO.");
xlsWriteLabel(12,0, "HIS CODE");
xlsWriteLabel(12,1, "DIAGNOSIS");
xlsWriteLabel(12,3,"NEW CASE");
xlsWriteLabel(12,4,"NEW CASE");
xlsWriteLabel(12,5,"NEW CASE");
xlsWriteLabel(12,6,"F");
xlsWriteLabel(12,7,"CASES");
xlsWriteLabel(13,1,"in alphabetical order");
xlsWriteLabel(13,3,"First derm consult");
xlsWriteLabel(13,4,"Returning Patient");
xlsWriteLabel(13,6,"cases");

$xlsRow = 15;

$rank=array(1=>"");
	$x=1;
 	while ($row = mysql_fetch_array($query)){
		$rank[$x] = ucwords($row[addslashes('diagnosis')]);
		$his_code[$x] = $row['diagnosis_code'];
		$x++;
	}
    //print_r($rank);
	$x=1;
	$count = count($rank);
	while($x<=$count){

	$diagnosis_new_patient = mysql_query("SELECT count(registration_status)
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND results='F'
	AND problems='N'
	AND registration_status = 'N'
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	and diagnosis = '".$rank[$x]."'");
	//RETURNING
	$diagnosis_returning_patient = mysql_query("SELECT count(registration_status)
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND results='F'
	AND problems='N'
	AND registration_status = 'R'
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	and diagnosis = '".$rank[$x]."'");
	
	$follow_up = mysql_query("SELECT count(problems)
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND results='F'
	AND problems='F'
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	and diagnosis = '".$rank[$x]."'");
	
	$total_new_patient = mysql_fetch_array($diagnosis_new_patient);
	$total_returning_patient = mysql_fetch_array($diagnosis_returning_patient);
	$total_follow_up = mysql_fetch_array($follow_up);


xlsWriteLabel($xlsRow,0,$his_code[$x]);	
xlsWriteLabel($xlsRow,1,$rank[$x]);
xlsWriteNumber($xlsRow,3,($total_new_patient[0]));
xlsWriteNumber($xlsRow,4,($total_returning_patient[0]));
xlsWriteNumber($xlsRow,5,($total_new_patient[0]+$total_returning_patient[0]));
xlsWriteNumber($xlsRow,6,($total_follow_up[0]));
xlsWriteNumber($xlsRow,7,($total_new_patient[0]+$total_returning_patient[0]+$total_follow_up[0]));
$x++;
        
$xlsRow++;
}
xlsEOF();
exit();
?>
