<?php session_start();
include("connection/connection.php");

$query = mysql_query("SELECT COUNT(LastName),Date_of_Consult FROM patient where YEAR(Date_of_Consult) = '".$_POST['date']."'");
$case_load = mysql_result($query,0);

$query = "SELECT diagnosis,diagnosis_code
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
	group by diagnosis
	order by diagnosis ASC";
	$result = mysql_query($query);
	
$resident_query = "select * from users where roles_id='2'";
$results = mysql_query($resident_query);

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
header("Content-Disposition: attachment;filename=a6_form_excel_file.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");
// Make column labels. (at line 4)
xlsWriteLabel(1,0,"HEALTH INFORMATION SYSTEM");
xlsWriteLabel(2,0,"HIS Form A 6");
xlsWriteLabel(3,0,"Annual Case Load per resident: $case_load ");
xlsWriteLabel(4,0,"For the Year : ".$_POST['date']."");
xlsWriteLabel(5,0,"Name of PDS Institution : ");
xlsWriteLabel(7,0,"Prepaired By : Cris Guerrero");
$xlsRow = 10;
$x=2;
while($row = mysql_fetch_array($results))
{
	$u_id[$x] = $row['id'];
	$resident[$x] = $row['lastname'].", ".$row['firstname'];

xlsWriteLabel(8,0,"PDS-HIS Code");//check
xlsWriteLabel(8,1,"Encoded Diagnosis");//check
xlsWriteLabel(8,$x,"".$resident[$x]."");//check
    $x++;
}
$x=1;
while ($row = mysql_fetch_array($result))
{
	$rank[$x] = $row['diagnosis'];
	$his_code[$x] = $row['diagnosis_code'];
	$x++;
}
$x=1;
while($x<=count($rank))
{
	for ($i=1;$i<=count($u_id)+1;$i++)
	{
		$diagnosis = mysql_query(" SELECT count(users_id)
		FROM out_patient,out_patient_details
		WHERE out_patient_details.out_patient_id = out_patient.id
		AND consultation_date between '".$_POST['start_date']."' and '".$_POST['end_date']."'
		AND diagnosis = '".$rank[$x]."'
		AND users_id = '".$u_id[$i]."'");
		$data[$i] = mysql_fetch_array($diagnosis);
	}
		xlsWriteLabel($xlsRow,0,$his_code[$x]); //check
		xlsWriteLabel($xlsRow,1,$rank[$x]); //check
	$x++;
	for($i=2;$i<=count($u_id)+1;$i++)
	    {
xlsWriteNumber($xlsRow,$i,"".$data[$i][0]."");//check
	    }
$xlsRow++;
	}
xlsEOF();
exit();
?>