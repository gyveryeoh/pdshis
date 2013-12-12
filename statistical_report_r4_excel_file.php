<?php session_start();
include("connection/connection.php");

$query = mysql_query("SELECT procedures
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND procedures is not NULL
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	group by procedures
	order by procedures ASC");

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
xlsWriteLabel(2,0,"HIS Form R-4");
xlsWriteLabel(4,0,"PDS Institution");
xlsWriteLabel(5,0,"As of ".$_POST['start_date']." - ".$_POST['end_date']."");
xlsWriteLabel(6,0,"Prepared by: ".$_SESSION['lname'].", ".$_SESSION['fname']." ".$_SESSION['minitials'].".");
xlsWriteLabel(7,0,"Date Submitted:");
xlsWriteLabel(9,1,"PROCEDURES");
xlsWriteLabel(9,2,"TOTAL");

$xlsRow = 10;

$rank=array(1=>"");
	$x=1;
 	while ($row = mysql_fetch_array($query)){
		$rank[$x] = ucwords($row[addslashes('procedures')]);
		$x++;
	}
    //print_r($rank);
	$x=1;
	$count = count($rank);
	while($x<=$count){

	$procedures_result = mysql_query("SELECT count(procedures)
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	AND procedures is not NULL
	and procedures = '".$rank[$x]."'");
	
	$total_procedures = mysql_fetch_array($procedures_result);


xlsWriteLabel($xlsRow,1,$rank[$x]);
xlsWriteNumber($xlsRow,2,($total_procedures[0]));
$x++;
        
$xlsRow++;
}
xlsEOF();
exit();
?>
