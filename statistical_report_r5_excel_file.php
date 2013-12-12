<?php
include("connection/connection.php");
$query = mysql_query("SELECT procedures,consultation_date
	FROM out_patient_details,out_patient where
	out_patient.id = out_patient_details.out_patient_id
	AND procedures is not NULL
	AND YEAR(consultation_date) = '".$_POST['year']."'
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
header("Content-Disposition: attachment;filename=r5_excel_file_$date.xls");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");

// Make column labels. (at line 4)
xlsWriteLabel(1,0,"Statistical report on the Number of Cases OPD Department");
xlsWriteLabel(2,0,"HIS Form R-5");
xlsWriteLabel(4,0,"PDS Institution");
xlsWriteLabel(5,0,"As of ".$_POST['year']."");
xlsWriteLabel(6,0,"Prepared by:");
xlsWriteLabel(7,0,"Date Submitted:");
xlsWriteLabel(8,1,"Procedures");
xlsWriteLabel(8,2,"Jan");
xlsWriteLabel(8,3,"Feb");
xlsWriteLabel(8,4,"Mar");
xlsWriteLabel(8,5,"Apr");
xlsWriteLabel(8,6,"May");
xlsWriteLabel(8,7,"Jun");
xlsWriteLabel(8,8,"Jul");
xlsWriteLabel(8,9,"Aug");
xlsWriteLabel(8,10,"Sep");
xlsWriteLabel(8,11,"Oct");
xlsWriteLabel(8,12,"Nov");
xlsWriteLabel(8,13,"Dec");
xlsWriteLabel(8,14,"TOTAL");

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
	//diagnosis 1 for new patient with new cases or problem
	$procedures1 = mysql_query("SELECT consultation_date,procedures
	from out_patient,out_patient_details where
	out_patient.id = out_patient_details.out_patient_id
	AND procedures = '".addslashes($rank[$x])."'
	AND YEAR(consultation_date) = '".$_POST['year']."'");
	$jan =0;
	$feb=0;
	$mar=0;
	$apr=0;
	$may=0;
	$jun=0;
	$jul = 0;
	$aug = 0;
	$sep = 0;
	$oct = 0;
	$nov = 0;
	$dec = 0;
	while($rows=mysql_fetch_array($procedures1)){
      $date  = $rows["consultation_date"][5].$rows["consultation_date"][6];
      if ($date == '01')
      $jan++;
      if ($date == '02')
      $feb++;
      if ($date == '03')
      $mar++;
      if ($date == '04')
      $apr++;
      if ($date == '05')
      $may++;
      if ($date == '06')
      $jun++;
      if ($date == '07')
      $jul++;
      if ($date == '08')
      $aug++;
      if ($date == '09')
      $sep++;
      if ($date == '10')
      $oct++;
      if ($date == '11')
      $nov++;
      if ($date == '12')
      $dec++;
	}
xlsWriteLabel($xlsRow,1,$rank[$x]); //check
xlsWriteNumber($xlsRow,2,($jan)); //check
xlsWriteNumber($xlsRow,3,($feb)); //check
xlsWriteNumber($xlsRow,4,($mar)); //check
xlsWriteNumber($xlsRow,5,($apr)); //check
xlsWriteNumber($xlsRow,6,($may)); //check
xlsWriteNumber($xlsRow,7,($jun)); //check
xlsWriteNumber($xlsRow,8,($jul)); //check
xlsWriteNumber($xlsRow,9,($aug)); //check
xlsWriteNumber($xlsRow,10,($sep)); //check
xlsWriteNumber($xlsRow,11,($oct)); //check
xlsWriteNumber($xlsRow,12,($nov)); //check
xlsWriteNumber($xlsRow,13,($dec)); //check
xlsWriteNumber($xlsRow,14,($jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec)); //check
$x++;
        
$xlsRow++;
}
        
xlsEOF();
exit();
?>
