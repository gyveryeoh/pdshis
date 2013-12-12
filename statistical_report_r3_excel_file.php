<?php session_start();
include("connection/connection.php");
  if ($_POST['institutions_id'] == "0")
    {
	$institution = ' ';
    }
    else
    {
	$institution = "and institutions_id = '".$_POST['institutions_id']."'";
    }
    if ($_POST['satellite_clinic_id'] == "0")
    {
	$satellite = ' ';
    }
    else
    {
	$satellite = "and satellite_clinic_id  = '".$_POST['satellite_clinic_id']."'";
    }
	$query_opd_service = mysql_query("SELECT consultation_date,institutions_id FROM out_patient,patients_info where out_patient.patients_info_id = patients_info.id and clinic_type = 'S' AND YEAR(consultation_date) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($query_opd_service)){
      $date  = $row["consultation_date"][5].$row["consultation_date"][6];
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
	$query_opd_private = mysql_query("SELECT consultation_date,institutions_id FROM out_patient,patients_info where out_patient.patients_info_id = patients_info.id and clinic_type = 'P' AND YEAR(consultation_date) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($query_opd_private)){
      $date  = $row["consultation_date"][5].$row["consultation_date"][6];
      if ($date == '01')
      $p_jan++;
      if ($date == '02')
      $p_feb++;
      if ($date == '03')
      $p_mar++;
      if ($date == '04')
      $p_apr++;
      if ($date == '05')
      $p_may++;
      if ($date == '06')
      $p_jun++;
      if ($date == '07')
      $p_jul++;
      if ($date == '08')
      $p_aug++;
      if ($date == '09')
      $p_sep++;
      if ($date == '10')
      $p_oct++;
      if ($date == '11')
      $p_nov++;
      if ($date == '12')
      $p_dec++;
	}
	$query_er_service = mysql_query("SELECT date_referred,institutions_id FROM emergency,patients_info where emergency.patients_info_id = patients_info.id and clinic_type = 'S' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($query_er_service)){
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $er_service_jan++;
      if ($date == '02')
      $er_service_feb++;
      if ($date == '03')
      $er_service_mar++;
      if ($date == '04')
      $er_service_apr++;
      if ($date == '05')
      $er_service_may++;
      if ($date == '06')
      $er_service_jun++;
      if ($date == '07')
      $er_service_jul++;
      if ($date == '08')
      $er_service_aug++;
      if ($date == '09')
      $er_service_sep++;
      if ($date == '10')
      $er_service_oct++;
      if ($date == '11')
      $er_service_nov++;
      if ($date == '12')
      $er_service_dec++;
	}
	$query_er_private = mysql_query("SELECT date_referred,institutions_id FROM emergency,patients_info where emergency.patients_info_id = patients_info.id and clinic_type = 'P' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($query_er_private)){
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $er_private_jan++;
      if ($date == '02')
      $er_private_feb++;
      if ($date == '03')
      $er_private_mar++;
      if ($date == '04')
      $er_private_apr++;
      if ($date == '05')
      $er_private_may++;
      if ($date == '06')
      $er_private_jun++;
      if ($date == '07')
      $er_private_jul++;
      if ($date == '08')
      $er_private_aug++;
      if ($date == '09')
      $er_private_sep++;
      if ($date == '10')
      $er_private_oct++;
      if ($date == '11')
      $er_private_nov++;
      if ($date == '12')
      $er_private_dec++;
	}
	$query_admi_service = mysql_query("SELECT date_admitted FROM admission where clinic_type = 'S' AND YEAR(date_admitted) = '".$_POST['date']."'");
	while($row=mysql_fetch_array($query_admi_service)){
      $date  = $row["date_admitted"][5].$row["date_admitted"][6];
      if ($date == '01')
      $admi_service_jan++;
      if ($date == '02')
      $admi_service_feb++;
      if ($date == '03')
      $admi_service_mar++;
      if ($date == '04')
      $admi_service_apr++;
      if ($date == '05')
      $admi_service_may++;
      if ($date == '06')
      $admi_service_jun++;
      if ($date == '07')
      $admi_service_jul++;
      if ($date == '08')
      $admi_service_aug++;
      if ($date == '09')
      $admi_service_sep++;
      if ($date == '10')
      $admi_service_oct++;
      if ($date == '11')
      $admi_service_nov++;
      if ($date == '12')
      $admi_service_dec++;
	}
	$query_admi_private = mysql_query("SELECT date_admitted FROM admission where clinic_type = 'P' AND YEAR(date_admitted) = '".$_POST['date']."'");
	while($row=mysql_fetch_array($query_admi_private)){
      $date  = $row["date_admitted"][5].$row["date_admitted"][6];
      if ($date == '01')
      $admi_private_jan++;
      if ($date == '02')
      $admi_private_feb++;
      if ($date == '03')
      $admi_private_mar++;
      if ($date == '04')
      $admi_private_apr++;
      if ($date == '05')
      $admi_private_may++;
      if ($date == '06')
      $admi_private_jun++;
      if ($date == '07')
      $admi_private_jul++;
      if ($date == '08')
      $admi_private_aug++;
      if ($date == '09')
      $admi_private_sep++;
      if ($date == '10')
      $admi_private_oct++;
      if ($date == '11')
      $admi_private_nov++;
      if ($date == '12')
      $admi_private_dec++;
	}
	$query_in_service = mysql_query("SELECT date_referred FROM in_patient where clinic_type = 'S' AND YEAR(date_referred) = '".$_POST['date']."'");
	while($row=mysql_fetch_array($query_in_service)){
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $in_service_jan++;
      if ($date == '02')
      $in_service_feb++;
      if ($date == '03')
      $in_service_mar++;
      if ($date == '04')
      $in_service_apr++;
      if ($date == '05')
      $in_service_may++;
      if ($date == '06')
      $in_service_jun++;
      if ($date == '07')
      $in_service_jul++;
      if ($date == '08')
      $in_service_aug++;
      if ($date == '09')
      $in_service_sep++;
      if ($date == '10')
      $in_service_oct++;
      if ($date == '11')
      $in_service_nov++;
      if ($date == '12')
      $in_service_dec++;
	}
	$query_in_private = mysql_query("SELECT date_referred FROM in_patient where clinic_type = 'P' AND YEAR(date_referred) = '".$_POST['date']."'");
	while($row=mysql_fetch_array($query_in_private)){
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $in_private_jan++;
      if ($date == '02')
      $in_private_feb++;
      if ($date == '03')
      $in_private_mar++;
      if ($date == '04')
      $in_private_apr++;
      if ($date == '05')
      $in_private_may++;
      if ($date == '06')
      $in_private_jun++;
      if ($date == '07')
      $in_private_jul++;
      if ($date == '08')
      $in_private_aug++;
      if ($date == '09')
      $in_private_sep++;
      if ($date == '10')
      $in_private_oct++;
      if ($date == '11')
      $in_private_nov++;
      if ($date == '12')
      $in_private_dec++;
	}    
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
header("Content-Disposition: attachment;filename=r3_excel_file_".$_POST['year'].".xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");

// Make column labels. (at line 4)
xlsWriteLabel(1,0,"SUMMARY: NUMBER OF PATIENTS SEEN BY DERMATOLOGY SERVICE, ALL SITE");
xlsWriteLabel(2,0,"HIS Form R3");
xlsWriteLabel(4,0,"PDS Institution: ".$institution_data['institutions']."");
xlsWriteLabel(5,0,"As of ".$_POST['year']."");
xlsWriteLabel(6,0,"Prepared by: ".$_SESSION['lname'].", ".$_SESSION['fname']." ".$_SESSION['minitials'].".");
xlsWriteLabel(7,0,"Date Submitted:");
xlsWriteLabel(9,1,"Out-Patient Clinic");
xlsWriteLabel(9,3,"OPD");
xlsWriteLabel(9,4,"EMERGENCY Rm REFERRALS");
xlsWriteLabel(9,6,"REFERRALS");
xlsWriteLabel(9,7,"Admitted Derm*");
xlsWriteLabel(9,10,"Referrals In patient");
xlsWriteLabel(9,12,"SUB TOTAL");
xlsWriteLabel(9,9,"Sub Total");
xlsWriteLabel(10,0,"MONTH");
xlsWriteLabel(10,1,"SERVICE");
xlsWriteLabel(10,2,"PRIVATE");
xlsWriteLabel(10,3,"SUB TOTAL");
xlsWriteLabel(10,4,"SERVICE");
xlsWriteLabel(10,5,"PRIVATE");
xlsWriteLabel(10,6,"SUB TOTAL");
xlsWriteLabel(10,7,"SERVICE");
xlsWriteLabel(10,8,"PRIVATE");
xlsWriteLabel(10,9,"Admitted");
xlsWriteLabel(10,10,"SERVICE");
xlsWriteLabel(10,11,"PRIVATE");
xlsWriteLabel(10,12,"Referrals");

xlsWriteLabel(12,0,"JAN");
xlsWriteLabel(13,0,"FEB");
xlsWriteLabel(14,0,"MAR");
xlsWriteLabel(15,0,"APR");
xlsWriteLabel(16,0,"MAY");
xlsWriteLabel(17,0,"JUN");
xlsWriteLabel(18,0,"JUL");
xlsWriteLabel(19,0,"AUG");
xlsWriteLabel(20,0,"SEP");
xlsWriteLabel(21,0,"OCT");
xlsWriteLabel(22,0,"NOV");
xlsWriteLabel(23,0,"DEC");
xlsWriteLabel(24,0,"TOTAL");


$xlsRow = 24;
//Out patient  Service
xlsWriteNumber(12,1,$jan);
xlsWriteNumber(13,1,$feb);
xlsWriteNumber(14,1,$mar);
xlsWriteNumber(15,1,$apr);
xlsWriteNumber(16,1,$may);
xlsWriteNumber(17,1,$jun);
xlsWriteNumber(18,1,$jul);
xlsWriteNumber(19,1,$aug);
xlsWriteNumber(20,1,$sep);
xlsWriteNumber(21,1,$oct);
xlsWriteNumber(22,1,$nov);
xlsWriteNumber(23,1,$dec);
xlsWriteNumber(24,1,($jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec));

//Out patient Private
xlsWriteNumber(12,2,$p_jan);
xlsWriteNumber(13,2,$p_feb);
xlsWriteNumber(14,2,$p_mar);
xlsWriteNumber(15,2,$p_apr);
xlsWriteNumber(16,2,$p_may);
xlsWriteNumber(17,2,$p_jun);
xlsWriteNumber(18,2,$p_jul);
xlsWriteNumber(19,2,$p_aug);
xlsWriteNumber(20,2,$p_sep);
xlsWriteNumber(21,2,$p_oct);
xlsWriteNumber(22,2,$p_nov);
xlsWriteNumber(23,2,$p_dec);
xlsWriteNumber(24,2,($p_jan+$p_feb+$p_mar+$p_apr+$p_may+$p_jun+$p_jul+$p_aug+$p_sep+$p_oct+$p_nov+$p_dec));

//Out patient Sub total
xlsWriteNumber(12,3,($jan+$p_jan));
xlsWriteNumber(13,3,($feb+$p_feb));
xlsWriteNumber(14,3,($mar+$p_mar));
xlsWriteNumber(15,3,($apr+$p_apr));
xlsWriteNumber(16,3,($may+$p_may));
xlsWriteNumber(17,3,($jun+$p_jun));
xlsWriteNumber(18,3,($jul+$p_jul));
xlsWriteNumber(19,3,($aug+$p_aug));
xlsWriteNumber(20,3,($sep+$p_sep));
xlsWriteNumber(21,3,($oct+$p_oct));
xlsWriteNumber(22,3,($nov+$p_nov));
xlsWriteNumber(23,3,($dec+$p_dec));
xlsWriteNumber(24,3,($p_jan+$p_feb+$p_mar+$p_apr+$p_may+$p_jun+$p_jul+$p_aug+$p_sep+$p_oct+$p_nov+$p_dec+$jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec));

//EMERGENCY Service
xlsWriteNumber(12,4,$er_service_jan);
xlsWriteNumber(13,4,$er_service_feb);
xlsWriteNumber(14,4,$er_service_mar);
xlsWriteNumber(15,4,$er_service_apr);
xlsWriteNumber(16,4,$er_service_may);
xlsWriteNumber(17,4,$er_service_jun);
xlsWriteNumber(18,4,$er_service_jul);
xlsWriteNumber(19,4,$er_service_aug);
xlsWriteNumber(20,4,$er_service_sep);
xlsWriteNumber(21,4,$er_service_oct);
xlsWriteNumber(22,4,$er_service_nov);
xlsWriteNumber(23,4,$er_service_dec);
xlsWriteNumber(24,4,($er_service_jan+$er_service_feb+$er_service_mar+$er_service_apr+$er_service_may+$er_service_jun+$er_service_jul+$er_service_aug+$er_service_sep+$er_service_oct+$er_service_nov+$er_service_dec));

//EMERGENCY Private
xlsWriteNumber(12,5,$er_private_jan);
xlsWriteNumber(13,5,$er_private_feb);
xlsWriteNumber(14,5,$er_private_mar);
xlsWriteNumber(15,5,$er_private_apr);
xlsWriteNumber(16,5,$er_private_may);
xlsWriteNumber(17,5,$er_private_jun);
xlsWriteNumber(18,5,$er_private_jul);
xlsWriteNumber(19,5,$er_private_aug);
xlsWriteNumber(20,5,$er_private_sep);
xlsWriteNumber(21,5,$er_private_oct);
xlsWriteNumber(22,5,$er_private_nov);
xlsWriteNumber(23,5,$er_private_dec);
xlsWriteNumber(24,5,($er_private_jan+$er_private_feb+$er_private_mar+$er_private_apr+$er_private_may+$er_private_jun+$er_private_jul+$er_private_aug+$er_private_sep+$er_private_oct+$er_private_nov+$er_private_dec));

//Emergency Sub total
xlsWriteNumber(12,6,($er_private_jan+$er_service_jan));
xlsWriteNumber(13,6,($er_private_feb+$er_service_feb));
xlsWriteNumber(14,6,($er_private_mar+$er_service_mar));
xlsWriteNumber(15,6,($er_private_apr+$er_service_apr));
xlsWriteNumber(16,6,($er_private_may+$er_service_may));
xlsWriteNumber(17,6,($er_private_jun+$er_service_jun));
xlsWriteNumber(18,6,($er_private_jul+$er_service_jul));
xlsWriteNumber(19,6,($er_private_aug+$er_service_aug));
xlsWriteNumber(20,6,($er_private_sep+$er_service_sep));
xlsWriteNumber(21,6,($er_private_oct+$er_service_oct));
xlsWriteNumber(22,6,($er_private_nov+$er_service_nov));
xlsWriteNumber(23,6,($er_private_dec+$er_service_dec));
xlsWriteNumber(24,6,($er_private_jan+$er_private_feb+$er_private_mar+$er_private_apr+$er_private_may+$er_private_jun+$er_private_jul+$er_private_aug+$er_private_sep+$er_private_oct+$er_private_nov+$er_private_dec+$er_service_jan+$er_service_feb+$er_service_mar+$er_service_apr+$er_service_may+$er_service_jun+$er_service_jul+$er_service_aug+$er_service_sep+$er_service_oct+$er_service_nov+$er_service_dec));

//ADMISSION Service
xlsWriteNumber(12,7,$admi_service_jan);
xlsWriteNumber(13,7,$admi_service_feb);
xlsWriteNumber(14,7,$admi_service_mar);
xlsWriteNumber(15,7,$admi_service_apr);
xlsWriteNumber(16,7,$admi_service_may);
xlsWriteNumber(17,7,$admi_service_jun);
xlsWriteNumber(18,7,$admi_service_jul);
xlsWriteNumber(19,7,$admi_service_aug);
xlsWriteNumber(20,7,$admi_service_sep);
xlsWriteNumber(21,7,$admi_service_oct);
xlsWriteNumber(22,7,$admi_service_nov);
xlsWriteNumber(23,7,$admi_service_dec);
xlsWriteNumber(24,7,($admi_service_jan+$admi_service_feb+$admi_service_mar+$admi_service_apr+$admi_service_may+$admi_service_jun+$admi_service_jul+$admi_service_aug+$admi_service_sep+$admi_service_oct+$admi_service_nov+$admi_service_dec));

//ADMISSION Private
xlsWriteNumber(12,8,$admi_private_jan);
xlsWriteNumber(13,8,$admi_private_feb);
xlsWriteNumber(14,8,$admi_private_mar);
xlsWriteNumber(15,8,$admi_private_apr);
xlsWriteNumber(16,8,$admi_private_may);
xlsWriteNumber(17,8,$admi_private_jun);
xlsWriteNumber(18,8,$admi_private_jul);
xlsWriteNumber(19,8,$admi_private_aug);
xlsWriteNumber(20,8,$admi_private_sep);
xlsWriteNumber(21,8,$admi_private_oct);
xlsWriteNumber(22,8,$admi_private_nov);
xlsWriteNumber(23,8,$admi_private_dec);
xlsWriteNumber(24,8,($admi_private_jan+$admi_private_feb+$admi_private_mar+$admi_private_apr+$admi_private_may+$admi_private_jun+$admi_private_jul+$admi_private_aug+$admi_private_sep+$admi_private_oct+$admi_private_nov+$admi_private_dec));

//ADMISSION Total
xlsWriteNumber(12,9,$admi_private_jan+$admi_service_jan);
xlsWriteNumber(13,9,$admi_private_feb+$admi_service_feb);
xlsWriteNumber(14,9,$admi_private_mar+$admi_service_mar);
xlsWriteNumber(15,9,$admi_private_apr+$admi_service_apr);
xlsWriteNumber(16,9,$admi_private_may+$admi_service_may);
xlsWriteNumber(17,9,$admi_private_jun+$admi_service_jun);
xlsWriteNumber(18,9,$admi_private_jul+$admi_service_jul);
xlsWriteNumber(19,9,$admi_private_aug+$admi_service_aug);
xlsWriteNumber(20,9,$admi_private_sep+$admi_service_sep);
xlsWriteNumber(21,9,$admi_private_oct+$admi_service_oct);
xlsWriteNumber(22,9,$admi_private_nov+$admi_service_nov);
xlsWriteNumber(23,9,$admi_private_dec+$admi_service_dec);
xlsWriteNumber(24,9,($admi_service_jan+$admi_service_feb+$admi_service_mar+$admi_service_apr+$admi_service_may+$admi_service_jun+$admi_service_jul+$admi_service_aug+$admi_service_sep+$admi_service_oct+$admi_service_nov+$admi_service_dec+$admi_private_jan+$admi_private_feb+$admi_private_mar+$admi_private_apr+$admi_private_may+$admi_private_jun+$admi_private_jul+$admi_private_aug+$admi_private_sep+$admi_private_oct+$admi_private_nov+$admi_private_dec));

//In Patient Service
xlsWriteNumber(12,10,$in_service_jan);
xlsWriteNumber(13,10,$in_service_feb);
xlsWriteNumber(14,10,$in_service_mar);
xlsWriteNumber(15,10,$in_service_apr);
xlsWriteNumber(16,10,$in_service_may);
xlsWriteNumber(17,10,$in_service_jun);
xlsWriteNumber(18,10,$in_service_jul);
xlsWriteNumber(19,10,$in_service_aug);
xlsWriteNumber(20,10,$in_service_sep);
xlsWriteNumber(21,10,$in_service_oct);
xlsWriteNumber(22,10,$in_service_nov);
xlsWriteNumber(23,10,$in_service_dec);
xlsWriteNumber(24,10,($in_service_jan+$in_service_feb+$in_service_mar+$in_service_apr+$in_service_may+$in_service_jun+$in_service_jul+$in_service_aug+$in_service_sep+$in_service_oct+$in_service_nov+$in_service_dec));

//In Patient Private
xlsWriteNumber(12,11,$in_private_jan);
xlsWriteNumber(13,11,$in_private_feb);
xlsWriteNumber(14,11,$in_private_mar);
xlsWriteNumber(15,11,$in_private_apr);
xlsWriteNumber(16,11,$in_private_may);
xlsWriteNumber(17,11,$in_private_jun);
xlsWriteNumber(18,11,$in_private_jul);
xlsWriteNumber(19,11,$in_private_aug);
xlsWriteNumber(20,11,$in_private_sep);
xlsWriteNumber(21,11,$in_private_oct);
xlsWriteNumber(22,11,$in_private_nov);
xlsWriteNumber(23,11,$in_private_dec);
xlsWriteNumber(24,11,($in_private_jan+$in_private_feb+$in_private_mar+$in_private_apr+$in_private_may+$in_private_jun+$in_private_jul+$in_private_aug+$in_private_sep+$in_private_oct+$in_private_nov+$in_private_dec));

//In Patient Total
xlsWriteNumber(12,12,$in_private_jan+$in_service_jan);
xlsWriteNumber(13,12,$in_private_feb+$in_service_feb);
xlsWriteNumber(14,12,$in_private_mar+$in_service_mar);
xlsWriteNumber(15,12,$in_private_apr+$in_service_apr);
xlsWriteNumber(16,12,$in_private_may+$in_service_may);
xlsWriteNumber(17,12,$in_private_jun+$in_service_jun);
xlsWriteNumber(18,12,$in_private_jul+$in_service_jul);
xlsWriteNumber(19,12,$in_private_aug+$in_service_aug);
xlsWriteNumber(20,12,$in_private_sep+$in_service_sep);
xlsWriteNumber(21,12,$in_private_oct+$in_service_oct);
xlsWriteNumber(22,12,$in_private_nov+$in_service_nov);
xlsWriteNumber(23,12,$in_private_dec+$in_service_dec);
xlsWriteNumber(24,12,($in_service_jan+$in_service_feb+$in_service_mar+$in_service_apr+$in_service_may+$in_service_jun+$in_service_jul+$in_service_aug+$in_service_sep+$in_service_oct+$in_service_nov+$in_service_dec+$in_private_jan+$in_private_feb+$in_private_mar+$in_private_apr+$in_private_may+$in_private_jun+$in_private_jul+$in_private_aug+$in_private_sep+$in_private_oct+$in_private_nov+$in_private_dec));


$xlsRow++;
xlsEOF();
exit();
?>