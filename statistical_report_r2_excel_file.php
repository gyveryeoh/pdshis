<?php session_start();
error_reporting(E_ALL ^ (E_NOTICE) ^ (E_WARNING));
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
$institution_info = mysql_query("select * from institutions where id ='".$_POST['institutions_id']."'");
$institution_data = mysql_fetch_array($institution_info);
$query = mysql_query("SELECT * FROM out_patient,patients_info where out_patient.patients_info_id = patients_info.id and clinic_type ='S' and registration_status ='N' AND YEAR(consultation_date) = '".$_POST['year']."'  $institution $satellite");
	while($row=mysql_fetch_array($query)){
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
	$query1 = mysql_query("SELECT * FROM out_patient,patients_info where out_patient.patients_info_id = patients_info.id and clinic_type ='S' and registration_status ='R' AND YEAR(consultation_date) = '".$_POST['year']."'  $institution $satellite");
	while($row=mysql_fetch_array($query1)){
      $date  = $row["consultation_date"][5].$row["consultation_date"][6];
      if ($date == '01')
      $r_jan++;
      if ($date == '02')
      $r_feb++;
      if ($date == '03')
      $r_mar++;
      if ($date == '04')
      $r_apr++;
      if ($date == '05')
      $r_may++;
      if ($date == '06')
      $r_jun++;
      if ($date == '07')
      $r_jul++;
      if ($date == '08')
      $r_aug++;
      if ($date == '09')
      $r_sep++;
      if ($date == '10')
      $r_oct++;
      if ($date == '11')
      $r_nov++;
      if ($date == '12')
      $r_dec++;
	}
$query3 = mysql_query("SELECT * FROM out_patient,patients_info where out_patient.patients_info_id = patients_info.id and clinic_type ='P' and registration_status ='N' AND YEAR(consultation_date) = '".$_POST['year']."'  $institution $satellite");
	while($row=mysql_fetch_array($query3)){
      $date  = $row["consultation_date"][5].$row["consultation_date"][6];
      if ($date == '01')
      $p_n_jan++;
      if ($date == '02')
      $p_n_feb++;
      if ($date == '03')
      $p_n_mar++;
      if ($date == '04')
      $p_n_apr++;
      if ($date == '05')
      $p_n_may++;
      if ($date == '06')
      $p_n_jun++;
      if ($date == '07')
      $p_n_jul++;
      if ($date == '08')
      $p_n_aug++;
      if ($date == '09')
      $p_n_sep++;
      if ($date == '10')
      $p_n_oct++;
      if ($date == '11')
      $p_n_nov++;
      if ($date == '12')
      $p_n_dec++;
	}
$query4 = mysql_query("SELECT * FROM out_patient,patients_info where out_patient.patients_info_id = patients_info.id and clinic_type ='P' and registration_status ='R' AND YEAR(consultation_date) = '".$_POST['year']."'  $institution $satellite");
	while($row=mysql_fetch_array($query4)){
      $date  = $row["consultation_date"][5].$row["consultation_date"][6];
      if ($date == '01')
      $p_r_jan++;
      if ($date == '02')
      $p_r_feb++;
      if ($date == '03')
      $p_r_mar++;
      if ($date == '04')
      $p_r_apr++;
      if ($date == '05')
      $p_r_may++;
      if ($date == '06')
      $p_r_jun++;
      if ($date == '07')
      $p_r_jul++;
      if ($date == '08')
      $p_r_aug++;
      if ($date == '09')
      $p_r_sep++;
      if ($date == '10')
      $p_r_oct++;
      if ($date == '11')
      $p_r_nov++;
      if ($date == '12')
      $p_r_dec++;
	}
//EMERGENCY REFERRAL DEPARTMENT New Patient..
$emergency_service_new_patient = mysql_query("SELECT * FROM emergency,patients_info where emergency.patients_info_id=patients_info.id and clinic_type ='S' and registration_status ='N' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($emergency_service_new_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $emergency_service_new_patient_jan++;
      if ($date == '02')
      $emergency_service_new_patient_feb++;
      if ($date == '03')
      $emergency_service_new_patient_mar++;
      if ($date == '04')
      $emergency_service_new_patient_apr++;
      if ($date == '05')
      $emergency_service_new_patient_may++;
      if ($date == '06')
      $emergency_service_new_patient_jun++;
      if ($date == '07')
      $emergency_service_new_patient_jul++;
      if ($date == '08')
      $emergency_service_new_patient_aug++;
      if ($date == '09')
      $emergency_service_new_patient_sep++;
      if ($date == '10')
      $emergency_service_new_patient_oct++;
      if ($date == '11')
      $emergency_service_new_patient_nov++;
      if ($date == '12')
      $emergency_service_new_patient_dec++;
	}
	
//EMERGENCY REFERRAL DEPARTMENT Returning Patient..
	$emergency_service_returning_patient = mysql_query("SELECT * FROM emergency,patients_info where emergency.patients_info_id=patients_info.id and clinic_type ='S' and registration_status ='R' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($emergency_service_returning_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $emergency_service_returning_patient_jan++;
      if ($date == '02')
      $emergency_service_returning_patient_feb++;
      if ($date == '03')
      $emergency_service_returning_patient_mar++;
      if ($date == '04')
      $emergency_service_returning_patient_apr++;
      if ($date == '05')
      $emergency_service_returning_patient_may++;
      if ($date == '06')
      $emergency_service_returning_patient_jun++;
      if ($date == '07')
      $emergency_service_returning_patient_jul++;
      if ($date == '08')
      $emergency_service_returning_patient_aug++;
      if ($date == '09')
      $emergency_service_returning_patient_sep++;
      if ($date == '10')
      $emergency_service_returning_patient_oct++;
      if ($date == '11')
      $emergency_service_returning_patient_nov++;
      if ($date == '12')
      $emergency_service_returning_patient_dec++;
	}
	//EMERGENCY REFERRAL DEPARTMENT Private New Patient..
$emergency_private_new_patient = mysql_query("SELECT * FROM emergency,patients_info where emergency.patients_info_id=patients_info.id and clinic_type ='P' and registration_status ='N' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($emergency_private_new_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $emergency_private_new_patient_jan++;
      if ($date == '02')
      $emergency_private_new_patient_feb++;
      if ($date == '03')
      $emergency_private_new_patient_mar++;
      if ($date == '04')
      $emergency_private_new_patient_apr++;
      if ($date == '05')
      $emergency_private_new_patient_may++;
      if ($date == '06')
      $emergency_private_new_patient_jun++;
      if ($date == '07')
      $emergency_private_new_patient_jul++;
      if ($date == '08')
      $emergency_private_new_patient_aug++;
      if ($date == '09')
      $emergency_private_new_patient_sep++;
      if ($date == '10')
      $emergency_private_new_patient_oct++;
      if ($date == '11')
      $emergency_private_new_patient_nov++;
      if ($date == '12')
      $emergency_private_new_patient_dec++;
	}
	
//EMERGENCY REFERRAL DEPARTMENT Returning Patient..
	$emergency_private_returning_patient = mysql_query("SELECT * FROM emergency,patients_info where emergency.patients_info_id=patients_info.id and clinic_type ='P' and registration_status ='R' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($emergency_private_returning_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $emergency_private_returning_patient_jan++;
      if ($date == '02')
      $emergency_private_returning_patient_feb++;
      if ($date == '03')
      $emergency_private_returning_patient_mar++;
      if ($date == '04')
      $emergency_private_returning_patient_apr++;
      if ($date == '05')
      $emergency_private_returning_patient_may++;
      if ($date == '06')
      $emergency_private_returning_patient_jun++;
      if ($date == '07')
      $emergency_private_returning_patient_jul++;
      if ($date == '08')
      $emergency_private_returning_patient_aug++;
      if ($date == '09')
      $emergency_private_returning_patient_sep++;
      if ($date == '10')
      $emergency_private_returning_patient_oct++;
      if ($date == '11')
      $emergency_private_returning_patient_nov++;
      if ($date == '12')
      $emergency_private_returning_patient_dec++;
	}
        //INPATIENT REFERRAL DEPARTMENT New Patient..
$in_patient_service_new_patient = mysql_query("SELECT * FROM in_patient,patients_info where patients_info.id=in_patient.patients_info_id and clinic_type ='S' and registration_status ='N' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($in_patient_service_new_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $in_patient_service_new_patient_jan++;
      if ($date == '02')
      $in_patient_service_new_patient_feb++;
      if ($date == '03')
      $in_patient_service_new_patient_mar++;
      if ($date == '04')
      $in_patient_service_new_patient_apr++;
      if ($date == '05')
      $in_patient_service_new_patient_may++;
      if ($date == '06')
      $in_patient_service_new_patient_jun++;
      if ($date == '07')
      $in_patient_service_new_patient_jul++;
      if ($date == '08')
      $in_patient_service_new_patient_aug++;
      if ($date == '09')
      $in_patient_service_new_patient_sep++;
      if ($date == '10')
      $in_patient_service_new_patient_oct++;
      if ($date == '11')
      $in_patient_service_new_patient_nov++;
      if ($date == '12')
      $in_patient_service_new_patient_dec++;
	}
	
	
	//In patient REFERRAL DEPARTMENT Returning Patient..
	$in_patient_service_returning_patient = mysql_query("SELECT * FROM in_patient,patients_info where patients_info.id=in_patient.patients_info_id and clinic_type ='S' and registration_status ='R' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($in_patient_service_returning_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $in_patient_service_returning_patient_jan++;
      if ($date == '02')
      $in_patient_service_returning_patient_feb++;
      if ($date == '03')
      $in_patient_service_returning_patient_mar++;
      if ($date == '04')
      $in_patient_service_returning_patient_apr++;
      if ($date == '05')
      $in_patient_service_returning_patient_may++;
      if ($date == '06')
      $in_patient_service_returning_patient_jun++;
      if ($date == '07')
      $in_patient_service_returning_patient_jul++;
      if ($date == '08')
      $in_patient_service_returning_patient_aug++;
      if ($date == '09')
      $in_patient_service_returning_patient_sep++;
      if ($date == '10')
      $in_patient_service_returning_patient_oct++;
      if ($date == '11')
      $in_patient_service_returning_patient_nov++;
      if ($date == '12')
      $in_patient_service_returning_patient_dec++;
	}
		//IN PATIENT REFERRAL DEPARTMENT Private New Patient..
$in_patient_private_new_patient = mysql_query("SELECT * FROM in_patient,patients_info where patients_info.id=in_patient.patients_info_id and clinic_type ='P' and registration_status ='N' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($in_patient_private_new_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $in_patient_private_new_patient_jan++;
      if ($date == '02')
      $in_patient_private_new_patient_feb++;
      if ($date == '03')
      $in_patient_private_new_patient_mar++;
      if ($date == '04')
      $in_patient_private_new_patient_apr++;
      if ($date == '05')
      $in_patient_private_new_patient_may++;
      if ($date == '06')
      $in_patient_private_new_patient_jun++;
      if ($date == '07')
      $in_patient_private_new_patient_jul++;
      if ($date == '08')
      $in_patient_private_new_patient_aug++;
      if ($date == '09')
      $in_patient_private_new_patient_sep++;
      if ($date == '10')
      $in_patient_private_new_patient_oct++;
      if ($date == '11')
      $in_patient_private_new_patient_nov++;
      if ($date == '12')
      $in_patient_private_new_patient_dec++;
	}
	
//IN PATIENT REFERRAL DEPARTMENT Returning Patient..
	$in_patient_private_returning_patient = mysql_query("SELECT * FROM in_patient,patients_info where patients_info.id=in_patient.patients_info_id and clinic_type ='P' and registration_status ='R' AND YEAR(date_referred) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($in_patient_private_returning_patient)){
    
      $date  = $row["date_referred"][5].$row["date_referred"][6];
      if ($date == '01')
      $in_patient_private_returning_patient_jan++;
      if ($date == '02')
      $in_patient_private_returning_patient_feb++;
      if ($date == '03')
      $in_patient_private_returning_patient_mar++;
      if ($date == '04')
      $in_patient_private_returning_patient_apr++;
      if ($date == '05')
      $in_patient_private_returning_patient_may++;
      if ($date == '06')
      $in_patient_private_returning_patient_jun++;
      if ($date == '07')
      $in_patient_private_returning_patient_jul++;
      if ($date == '08')
      $in_patient_private_returning_patient_aug++;
      if ($date == '09')
      $in_patient_private_returning_patient_sep++;
      if ($date == '10')
      $in_patient_private_returning_patient_oct++;
      if ($date == '11')
      $in_patient_private_returning_patient_nov++;
      if ($date == '12')
      $in_patient_private_returning_patient_dec++;
	}
			//ADMISSION REFERRAL DEPARTMENT New Patient..
$admission_service_new_patient = mysql_query("SELECT * FROM admission,patients_info where patients_info.id = admission.patients_info_id and clinic_type ='S' and registration_status ='N' AND YEAR(date_admitted) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($admission_service_new_patient)){
    
      $date  = $row["date_admitted"][5].$row["date_admitted"][6];
      if ($date == '01')
      $admission_service_new_patient_jan++;
      if ($date == '02')
      $admission_service_new_patient_feb++;
      if ($date == '03')
      $admission_service_new_patient_mar++;
      if ($date == '04')
      $admission_service_new_patient_apr++;
      if ($date == '05')
      $admission_service_new_patient_may++;
      if ($date == '06')
      $admission_service_new_patient_jun++;
      if ($date == '07')
      $admission_service_new_patient_jul++;
      if ($date == '08')
      $admission_service_new_patient_aug++;
      if ($date == '09')
      $admission_service_new_patient_sep++;
      if ($date == '10')
      $admission_service_new_patient_oct++;
      if ($date == '11')
      $admission_service_new_patient_nov++;
      if ($date == '12')
      $admission_service_new_patient_dec++;
	}
	
	
	//ADMISSION REFERRAL DEPARTMENT Returning Patient..
	$admission_service_returning_patient = mysql_query("SELECT * FROM admission,patients_info where patients_info.id = admission.patients_info_id and clinic_type ='S' and registration_status ='R' AND YEAR(date_admitted) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($admission_service_returning_patient)){
    
      $date  = $row["date_asmitted"][0].$row["date_admitted"][6];
      if ($date == '01')
      $admission_service_returning_patient_jan++;
      if ($date == '02')
      $admission_service_returning_patient_feb++;
      if ($date == '03')
      $admission_service_returning_patient_mar++;
      if ($date == '04')
      $admission_service_returning_patient_apr++;
      if ($date == '05')
      $admission_service_returning_patient_may++;
      if ($date == '06')
      $admission_service_returning_patient_jun++;
      if ($date == '07')
      $admission_service_returning_patient_jul++;
      if ($date == '08')
      $admission_service_returning_patient_aug++;
      if ($date == '09')
      $admission_service_returning_patient_sep++;
      if ($date == '10')
      $admission_service_returning_patient_oct++;
      if ($date == '11')
      $admission_service_returning_patient_nov++;
      if ($date == '12')
      $admission_service_returning_patient_dec++;
	}
		//ADMISSION REFERRAL DEPARTMENT Private New Patient..
$admission_private_new_patient = mysql_query("SELECT * FROM admission,patients_info where patients_info.id = admission.patients_info_id and clinic_type ='P' and registration_status ='N' AND YEAR(date_admitted) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($admission_private_new_patient)){
    
      $date  = $row["date_admitted"][5].$row["date_admitted"][6];
      if ($date == '01')
      $admission_private_new_patient_jan++;
      if ($date == '02')
      $admission_private_new_patient_feb++;
      if ($date == '03')
      $admission_private_new_patient_mar++;
      if ($date == '04')
      $admission_private_new_patient_apr++;
      if ($date == '05')
      $admission_private_new_patient_may++;
      if ($date == '06')
      $admission_private_new_patient_jun++;
      if ($date == '07')
      $admission_private_new_patient_jul++;
      if ($date == '08')
      $admission_private_new_patient_aug++;
      if ($date == '09')
      $admission_private_new_patient_sep++;
      if ($date == '10')
      $admission_private_new_patient_oct++;
      if ($date == '11')
      $admission_private_new_patient_nov++;
      if ($date == '12')
      $admission_private_new_patient_dec++;
	}
	
//ADMISSION REFERRAL DEPARTMENT Returning Patient..
	$admission_private_returning_patient = mysql_query("SELECT * FROM admission,patients_info where patients_info.id = admission.patients_info_id and clinic_type ='P' and registration_status ='R' AND YEAR(date_admitted) = '".$_POST['year']."' $institution $satellite");
	while($row=mysql_fetch_array($admission_private_returning_patient)){
    
      $date  = $row["date_admitted"][5].$row["date_admitted"][6];
      if ($date == '01')
      $admission_private_returning_patient_jan++;
      if ($date == '02')
      $admission_private_returning_patient_feb++;
      if ($date == '03')
      $admission_private_returning_patient_mar++;
      if ($date == '04')
      $admission_private_returning_patient_apr++;
      if ($date == '05')
      $admission_private_returning_patient_may++;
      if ($date == '06')
      $admission_private_returning_patient_jun++;
      if ($date == '07')
      $admission_private_returning_patient_jul++;
      if ($date == '08')
      $admission_private_returning_patient_aug++;
      if ($date == '09')
      $admission_private_returning_patient_sep++;
      if ($date == '10')
      $admission_private_returning_patient_oct++;
      if ($date == '11')
      $admission_private_returning_patient_nov++;
      if ($date == '12')
      $admission_private_returning_patient_dec++;
	}
        
        
//All total of Service new patient	
$total_emergency_service_new_patient = ($emergency_service_new_patient_jan+$emergency_service_new_patient_apr+$emergency_service_new_patient_feb+$emergency_service_new_patient_mar+$emergency_service_new_patient_may+$emergency_service_new_patient_jun+$emergency_service_new_patient_jul+$emergency_service_new_patient_aug+$emergency_service_new_patient_sep+$emergency_service_new_patient_oct+$emergency_service_new_patient_nov+$emergency_service_new_patient_dec);	
//All total of Private new patient	
$total_emergency_private_new_patient = ($emergency_private_new_patient_jan+$emergency_private_new_patient_apr+$emergency_private_new_patient_feb+$emergency_private_new_patient_mar+$emergency_private_new_patient_may+$emergency_private_new_patient_jun+$emergency_private_new_patient_jul+$emergency_private_new_patient_aug+$emergency_private_new_patient_sep+$emergency_private_new_patient_oct+$emergency_private_new_patient_nov+$emergency_private_new_patient_dec);	
//All total of Private returning Patient
$total_emergency_private_returning_patient = ($emergency_private_returning_patient_jan+$emergency_private_returning_patient_apr+$emergency_private_returning_patient_feb+$emergency_private_returning_patient_mar+$emergency_private_returning_patient_may+$emergency_private_returning_patient_jun+$emergency_private_returning_patient_jul+$emergency_private_returning_patient_aug+$emergency_private_returning_patient_sep+$emergency_private_returning_patient_oct+$emergency_private_returning_patient_nov+$emergency_private_returning_patient_dec);	
//All total Returning patient	
$total_emergency_service_returning_patient = ($emergency_service_returning_patient_jan+$emergency_service_returning_patient_apr+$emergency_service_returning_patient_feb+$emergency_service_returning_patient_mar+$emergency_service_returning_patient_may+$emergency_service_returning_patient_jun+$emergency_service_returning_patient_jul+$emergency_service_returning_patient_aug+$emergency_service_returning_patient_sep+$emergency_service_returning_patient_oct+$emergency_service_returning_patient_nov+$emergency_service_returning_patient_dec);	

$grand_total_emergency = substr(($total_emergency_service_new_patient+$total_emergency_service_returning_patient+$total_emergency_private_new_patient+$total_emergency_private_returning_patient),0,4);


//Percentage of emergency Service new patient
$percentage_emergency_service_new_patient_jan =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_jan),0,4);
$percentage_emergency_service_new_patient_feb =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_feb),0,4);
$percentage_emergency_service_new_patient_mar =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_mar),0,4);
$percentage_emergency_service_new_patient_apr =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_apr),0,4);
$percentage_emergency_service_new_patient_may =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_may),0,4);
$percentage_emergency_service_new_patient_jun =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_jun),0,4);
$percentage_emergency_service_new_patient_jul =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_jul),0,4);
$percentage_emergency_service_new_patient_aug =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_aug),0,4);
$percentage_emergency_service_new_patient_sep =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_sep),0,4);
$percentage_emergency_service_new_patient_oct =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_oct),0,4);
$percentage_emergency_service_new_patient_nov =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_nov),0,4);
$percentage_emergency_service_new_patient_dec =substr(($total_emergency_service_new_patient/$emergency_service_new_patient_dec),0,4);

//Total Percentage
$total_percentage_emergency_service_new_patient =substr(($percentage_emergency_service_new_patient_jan+$percentage_emergency_service_new_patient_jan+$percentage_emergency_service_new_patient_feb+$percentage_emergency_service_new_patient_mar+$percentage_emergency_service_new_patient_may+$percentage_emergency_service_new_patient_jun+$percentage_emergency_service_new_patient_jul+$percentage_emergency_service_new_patient_aug+$percentage_emergency_service_new_patient_sep+$percentage_emergency_service_new_patient_oct+$percentage_emergency_service_new_patient_nov+$percentage_emergency_service_new_patient_dec),0,4);


//Percentage of emergency Service  of Returning patient
$percentage_emergency_service_returning_patient_jan =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_jan),0,4);
$percentage_emergency_service_returning_patient_feb =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_feb),0,4);
$percentage_emergency_service_returning_patient_mar =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_mar),0,4);
$percentage_emergency_service_returning_patient_apr =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_apr),0,4);
$percentage_emergency_service_returning_patient_may =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_may),0,4);
$percentage_emergency_service_returning_patient_jun =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_jun),0,4);
$percentage_emergency_service_returning_patient_jul =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_jul),0,4);
$percentage_emergency_service_returning_patient_aug =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_aug),0,4);
$percentage_emergency_service_returning_patient_sep =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_sep),0,4);
$percentage_emergency_service_returning_patient_oct =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_oct),0,4);
$percentage_emergency_service_returning_patient_nov =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_nov),0,4);
$percentage_emergency_service_returning_patient_dec =substr(($total_emergency_service_returning_patient/$emergency_service_returning_patient_dec),0,4);

//Total Percentage of returning Service Returning Patient
$total_percentage_emergency_service_returning_patient =substr(($percentage_emergency_service_returning_patient_jan+$percentage_emergency_service_returning_patient_apr+$percentage_emergency_service_returning_patient_feb+$percentage_emergency_service_returning_patient_mar+$percentage_emergency_service_returning_patient_may+$percentage_emergency_service_returning_patient_jun+$percentage_emergency_service_returning_patient_jul+$percentage_emergency_service_returning_patient_aug+$percentage_emergency_service_returning_patient_sep+$percentage_emergency_service_returning_patient_oct+$percentage_emergency_service_returning_patient_nov+$percentage_emergency_service_returning_patient_dec),0,4);

//Percentage of emergency Private new patient
$percentage_emergency_private_new_patient_jan =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_jan),0,4);
$percentage_emergency_private_new_patient_feb =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_feb),0,4);
$percentage_emergency_private_new_patient_mar =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_mar),0,4);
$percentage_emergency_private_new_patient_apr =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_apr),0,4);
$percentage_emergency_private_new_patient_may =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_may),0,4);
$percentage_emergency_private_new_patient_jun =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_jun),0,4);
$percentage_emergency_private_new_patient_jul =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_jul),0,4);
$percentage_emergency_private_new_patient_aug =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_aug),0,4);
$percentage_emergency_private_new_patient_sep =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_sep),0,4);
$percentage_emergency_private_new_patient_oct =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_oct),0,4);
$percentage_emergency_private_new_patient_nov =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_nov),0,4);
$percentage_emergency_private_new_patient_dec =substr(($total_emergency_private_new_patient/$emergency_private_new_patient_dec),0,4);

//Total Percentage of New Private Patient
$total_percentage_emergency_private_new_patient =substr(($percentage_emergency_private_new_patient_jan+$percentage_emergency_private_new_patient_apr+$percentage_emergency_private_new_patient_feb+$percentage_emergency_private_new_patient_mar+$percentage_emergency_private_new_patient_may+$percentage_emergency_private_new_patient_jun+$percentage_emergency_private_new_patient_jul+$percentage_emergency_private_new_patient_aug+$percentage_emergency_private_new_patient_sep+$percentage_emergency_private_new_patient_oct+$percentage_emergency_private_new_patient_nov+$percentage_emergency_private_new_patient_dec),0,4);

//Percentage of emergency Private Returning patient
$percentage_emergency_private_returning_patient_jan =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_jan),0,4);
$percentage_emergency_private_returning_patient_feb =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_feb),0,4);
$percentage_emergency_private_returning_patient_mar =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_mar),0,4);
$percentage_emergency_private_returning_patient_apr =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_apr),0,4);
$percentage_emergency_private_returning_patient_may =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_may),0,4);
$percentage_emergency_private_returning_patient_jun =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_jun),0,4);
$percentage_emergency_private_returning_patient_jul =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_jul),0,4);
$percentage_emergency_private_returning_patient_aug =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_aug),0,4);
$percentage_emergency_private_returning_patient_sep =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_sep),0,4);
$percentage_emergency_private_returning_patient_oct =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_oct),0,4);
$percentage_emergency_private_returning_patient_nov =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_nov),0,4);
$percentage_emergency_private_returning_patient_dec =substr(($total_emergency_private_returning_patient/$emergency_private_returning_patient_dec),0,4);


//Total Percentage of Returning Private Patient
$total_percentage_emergency_private_returning_patient =substr(($percentage_emergency_private_returning_patient_jan+$percentage_emergency_private_returning_patient_apr+$percentage_emergency_private_returning_patient_feb+$percentage_emergency_private_returning_patient_mar+$percentage_emergency_private_returning_patient_may+$percentage_emergency_private_returning_patient_jun+$percentage_emergency_private_returning_patient_jul+$percentage_emergency_private_returning_patient_aug+$percentage_emergency_private_returning_patient_sep+$percentage_emergency_private_returning_patient_oct+$percentage_emergency_private_returning_patient_nov+$percentage_emergency_private_returning_patient_dec),0,4);

//Percentage of Emergency Returning Patient
$total_returning_emergency_patient_jan = substr(($emergency_private_new_patient_jan+$emergency_private_returning_patient_jan),0,4);
$total_returning_emergency_patient_feb = substr(($emergency_private_new_patient_feb+$emergency_private_returning_patient_feb),0,4);
$total_returning_emergency_patient_mar = substr(($emergency_private_new_patient_mar+$emergency_private_returning_patient_mar),0,4);
$total_returning_emergency_patient_apr = substr(($emergency_private_new_patient_apr+$emergency_private_returning_patient_apr),0,4);
$total_returning_emergency_patient_may = substr(($emergency_private_new_patient_may+$emergency_private_returning_patient_may),0,4);
$total_returning_emergency_patient_jun = substr(($emergency_private_new_patient_jun+$emergency_private_returning_patient_jun),0,4);
$total_returning_emergency_patient_jul = substr(($emergency_private_new_patient_jul+$emergency_private_returning_patient_jul),0,4);
$total_returning_emergency_patient_aug = substr(($emergency_private_new_patient_aug+$emergency_private_returning_patient_aug),0,4);
$total_returning_emergency_patient_sep = substr(($emergency_private_new_patient_sep+$emergency_private_returning_patient_sep),0,4);
$total_returning_emergency_patient_oct = substr(($emergency_private_new_patient_oct+$emergency_private_returning_patient_oct),0,4);
$total_returning_emergency_patient_nov = substr(($emergency_private_new_patient_nov+$emergency_private_returning_patient_nov),0,4);
$total_returning_emergency_patient_dec = substr(($emergency_private_new_patient_dec+$emergency_private_returning_patient_dec),0,4);

//Percent of Private Emergency Returning Patient
$percentage_emergency_returning_patient_jan = substr(($grand_total_emergency/$total_returning_emergency_patient_jan),0,4); 
$percentage_emergency_returning_patient_feb = substr(($grand_total_emergency/$total_returning_emergency_patient_feb),0,4); 
$percentage_emergency_returning_patient_mar = substr(($grand_total_emergency/$total_returning_emergency_patient_mar),0,4); 
$percentage_emergency_returning_patient_apr = substr(($grand_total_emergency/$total_returning_emergency_patient_apr),0,4); 
$percentage_emergency_returning_patient_may = substr(($grand_total_emergency/$total_returning_emergency_patient_may),0,4); 
$percentage_emergency_returning_patient_jun = substr(($grand_total_emergency/$total_returning_emergency_patient_jun),0,4); 
$percentage_emergency_returning_patient_jul = substr(($grand_total_emergency/$total_returning_emergency_patient_jul),0,4); 
$percentage_emergency_returning_patient_aug = substr(($grand_total_emergency/$total_returning_emergency_patient_aug),0,4); 
$percentage_emergency_returning_patient_sep = substr(($grand_total_emergency/$total_returning_emergency_patient_sep),0,4); 
$percentage_emergency_returning_patient_oct = substr(($grand_total_emergency/$total_returning_emergency_patient_oct),0,4); 
$percentage_emergency_returning_patient_nov = substr(($grand_total_emergency/$total_returning_emergency_patient_nov),0,4); 
$percentage_emergency_returning_patient_dec = substr(($grand_total_emergency/$total_returning_emergency_patient_dec),0,4); 

//Total Percent of Private Emergency Returning Patient
$total_percentage_emergency_returning_patient= substr(($percentage_emergency_returning_patient_jan+$percentage_emergency_returning_patient_feb+$percentage_emergency_returning_patient_mar+$percentage_emergency_returning_patient_apr+$percentage_emergency_returning_patient_may+$percentage_emergency_returning_patient_jun+$percentage_emergency_returning_patient_jul+$percentage_emergency_returning_patient_aug+$percentage_emergency_returning_patient_sep+$percentage_emergency_returning_patient_oct+$percentage_emergency_returning_patient_nov+$percentage_emergency_returning_patient_dec),0,4);

//Percentage of Emergency  Private New Patient
$total_new_emergency_patient_jan = substr(($emergency_service_new_patient_jan+$emergency_service_returning_patient_jan),0,4);
$total_new_emergency_patient_feb = substr(($emergency_service_new_patient_feb+$emergency_service_returning_patient_feb),0,4);
$total_new_emergency_patient_mar = substr(($emergency_service_new_patient_mar+$emergency_service_returning_patient_mar),0,4);
$total_new_emergency_patient_apr = substr(($emergency_service_new_patient_apr+$emergency_service_returning_patient_apr),0,4);
$total_new_emergency_patient_may = substr(($emergency_service_new_patient_may+$emergency_service_returning_patient_may),0,4);
$total_new_emergency_patient_jun = substr(($emergency_service_new_patient_jun+$emergency_service_returning_patient_jun),0,4);
$total_new_emergency_patient_jul = substr(($emergency_service_new_patient_jul+$emergency_service_returning_patient_jul),0,4);
$total_new_emergency_patient_aug = substr(($emergency_service_new_patient_aug+$emergency_service_returning_patient_aug),0,4);
$total_new_emergency_patient_sep = substr(($emergency_service_new_patient_sep+$emergency_service_returning_patient_sep),0,4);
$total_new_emergency_patient_oct = substr(($emergency_service_new_patient_oct+$emergency_service_returning_patient_oct),0,4);
$total_new_emergency_patient_nov = substr(($emergency_service_new_patient_nov+$emergency_service_returning_patient_nov),0,4);
$total_new_emergency_patient_dec = substr(($emergency_service_new_patient_dec+$emergency_service_returning_patient_dec),0,4);
//Percent of Private Emergency New Patient
$percentage_emergency_new_patient_jan = substr(($grand_total_emergency/$total_new_emergency_patient_jan),0,4); 
$percentage_emergency_new_patient_feb = substr(($grand_total_emergency/$total_new_emergency_patient_feb),0,4); 
$percentage_emergency_new_patient_mar = substr(($grand_total_emergency/$total_new_emergency_patient_mar),0,4); 
$percentage_emergency_new_patient_apr = substr(($grand_total_emergency/$total_new_emergency_patient_apr),0,4); 
$percentage_emergency_new_patient_may = substr(($grand_total_emergency/$total_new_emergency_patient_may),0,4); 
$percentage_emergency_new_patient_jun = substr(($grand_total_emergency/$total_new_emergency_patient_jun),0,4); 
$percentage_emergency_new_patient_jul = substr(($grand_total_emergency/$total_new_emergency_patient_jul),0,4); 
$percentage_emergency_new_patient_aug = substr(($grand_total_emergency/$total_new_emergency_patient_aug),0,4); 
$percentage_emergency_new_patient_sep = substr(($grand_total_emergency/$total_new_emergency_patient_sep),0,4); 
$percentage_emergency_new_patient_oct = substr(($grand_total_emergency/$total_new_emergency_patient_oct),0,4); 
$percentage_emergency_new_patient_nov = substr(($grand_total_emergency/$total_new_emergency_patient_nov),0,4); 
$percentage_emergency_new_patient_dec = substr(($grand_total_emergency/$total_new_emergency_patient_dec),0,4); 

//Total Percent of Private Emergency New Patient
$total_percentage_emergency_new_patient= substr(($percentage_emergency_new_patient_jan+$percentage_emergency_new_patient_feb+$percentage_emergency_new_patient_mar+$percentage_emergency_new_patient_apr+$percentage_emergency_new_patient_may+$percentage_emergency_new_patient_jun+$percentage_emergency_new_patient_jul+$percentage_emergency_new_patient_aug+$percentage_emergency_new_patient_sep+$percentage_emergency_new_patient_oct+$percentage_emergency_new_patient_nov+$percentage_emergency_new_patient_dec),0,4);

        
// Functions for export to excel.
 function xlsBOF()
{
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF()
{
echo pack("ss", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value)
{
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value )
{
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
header("Content-Disposition: attachment;filename=r2_excel_file.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");

// Make column labels. (at line 4)
xlsWriteLabel(1,0,"Statistical report on the Number of Dermatology patients seen per site");
xlsWriteLabel(2,0,"HIS Form R-2");
xlsWriteLabel(4,0,"PDS Institution: ".$institution_data['institutions']."");
xlsWriteLabel(4,6,"Prepared by: ".$_SESSION['lname'].", ".$_SESSION['fname']." ".$_SESSION['minitials'].".");
xlsWriteLabel(5,0,"YEAR: ".$_POST['year']."");
xlsWriteLabel(5,6,"Date Submitted: ".date('m/d/Y')."");
xlsWriteLabel(7,2,"OUT PATIENT CLINIC -SERVICE/ CHARITY");
xlsWriteLabel(7,8,"OUT PATIENT CLINIC -PRIVATE PATIENTS");
xlsWriteLabel(8,1,"No.New*");
xlsWriteLabel(8,2,"%New");
xlsWriteLabel(8,3,"No.Returning**");
xlsWriteLabel(8,4,"%Returning");
xlsWriteLabel(8,5,"Total NO.");
xlsWriteLabel(8,6,"% Total");
xlsWriteLabel(8,0,"Month");
xlsWriteLabel(9,0,"Jan");
xlsWriteLabel(10,0,"Feb");
xlsWriteLabel(11,0,"March");
xlsWriteLabel(12,0,"April");
xlsWriteLabel(13,0,"May");
xlsWriteLabel(14,0,"June");
xlsWriteLabel(15,0,"July");
xlsWriteLabel(16,0,"August");
xlsWriteLabel(17,0,"Sept");
xlsWriteLabel(18,0,"Oct");
xlsWriteLabel(19,0,"Nov");
xlsWriteLabel(20,0,"Dec");
xlsWriteLabel(21,0,"TOTAL");
xlsWriteLabel(8,7,"No. New*");
xlsWriteLabel(8,8,"% of New*");
xlsWriteLabel(8,9,"No. Returning**");
xlsWriteLabel(8,10,"% of Returning**");
xlsWriteLabel(8,11,"Total No.");
xlsWriteLabel(8,12,"% Total");
xlsWriteLabel(8,13,"No.");

//Emergency Information
xlsWriteLabel(23,2,"EMERGENCY REFERRAL - SERVICE/ CHARITY");
xlsWriteLabel(23,8,"EMERGENCY REFERRAL - PRIVATE PATIENTS");
xlsWriteLabel(24,1,"No.New*");
xlsWriteLabel(24,2,"%New");
xlsWriteLabel(24,3,"No.Returning**");
xlsWriteLabel(24,4,"%Returning");
xlsWriteLabel(24,5,"Total NO.");
xlsWriteLabel(24,6,"% Total");
xlsWriteLabel(24,7,"No.New*");
xlsWriteLabel(24,8,"%New");
xlsWriteLabel(24,9,"No.Returning**");
xlsWriteLabel(24,10,"%Returning");
xlsWriteLabel(24,11,"Total NO.");
xlsWriteLabel(24,12,"% Total");
xlsWriteLabel(24,13,"No.");

xlsWriteLabel(24,0,"Month");
xlsWriteLabel(25,0,"Jan");
xlsWriteLabel(26,0,"Feb");
xlsWriteLabel(27,0,"March");
xlsWriteLabel(28,0,"April");
xlsWriteLabel(29,0,"May");
xlsWriteLabel(30,0,"June");
xlsWriteLabel(31,0,"July");
xlsWriteLabel(32,0,"August");
xlsWriteLabel(33,0,"Sept");
xlsWriteLabel(34,0,"Oct");
xlsWriteLabel(35,0,"Nov");
xlsWriteLabel(36,0,"Dec");
xlsWriteLabel(37,0,"TOTAL");

//In Patient Information
xlsWriteLabel(39,2,"IN PATIENT CLINIC - SERVICE/ CHARITY");
xlsWriteLabel(39,8,"IN-PATIENT CLINIC - PRIVATE PATIENTS");
xlsWriteLabel(40,1,"No.New*");
xlsWriteLabel(40,2,"%New");
xlsWriteLabel(40,3,"No.Returning**");
xlsWriteLabel(40,4,"%Returning");
xlsWriteLabel(40,5,"Total NO.");
xlsWriteLabel(40,6,"% Total");
xlsWriteLabel(40,7,"No.New*");
xlsWriteLabel(40,8,"%New");
xlsWriteLabel(40,9,"No.Returning**");
xlsWriteLabel(40,10,"%Returning");
xlsWriteLabel(40,11,"Total NO.");
xlsWriteLabel(40,12,"% Total");
xlsWriteLabel(40,13,"No.");

xlsWriteLabel(40,0,"Month");
xlsWriteLabel(41,0,"Jan");
xlsWriteLabel(42,0,"Feb");
xlsWriteLabel(43,0,"March");
xlsWriteLabel(44,0,"April");
xlsWriteLabel(45,0,"May");
xlsWriteLabel(46,0,"June");
xlsWriteLabel(47,0,"July");
xlsWriteLabel(48,0,"August");
xlsWriteLabel(49,0,"Sept");
xlsWriteLabel(50,0,"Oct");
xlsWriteLabel(51,0,"Nov");
xlsWriteLabel(52,0,"Dec");
xlsWriteLabel(53,0,"TOTAL");

//In Patient Information
xlsWriteLabel(55,2,"ADMISSION - SERVICE/ CHARITY");
xlsWriteLabel(55,8,"ADMISSION - PRIVATE PATIENTS");
xlsWriteLabel(56,1,"No.New*");
xlsWriteLabel(56,2,"%New");
xlsWriteLabel(56,3,"No.Returning**");
xlsWriteLabel(56,4,"%Returning");
xlsWriteLabel(56,5,"Total NO.");
xlsWriteLabel(56,6,"% Total");
xlsWriteLabel(56,7,"No.New*");
xlsWriteLabel(56,8,"%New");
xlsWriteLabel(56,9,"No.Returning**");
xlsWriteLabel(56,10,"%Returning");
xlsWriteLabel(56,11,"Total NO.");
xlsWriteLabel(56,12,"% Total");
xlsWriteLabel(56,13,"No.");

xlsWriteLabel(56,0,"Month");
xlsWriteLabel(57,0,"Jan");
xlsWriteLabel(58,0,"Feb");
xlsWriteLabel(59,0,"March");
xlsWriteLabel(60,0,"April");
xlsWriteLabel(61,0,"May");
xlsWriteLabel(62,0,"June");
xlsWriteLabel(63,0,"July");
xlsWriteLabel(64,0,"August");
xlsWriteLabel(65,0,"Sept");
xlsWriteLabel(66,0,"Oct");
xlsWriteLabel(67,0,"Nov");
xlsWriteLabel(68,0,"Dec");
xlsWriteLabel(69,0,"TOTAL");


$xlsRow = 69;
$total=($jan+$feb+$mar+$apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec);
$returning_total=($r_jan+$r_feb+$r_mar+$r_apr+$r_may+$r_jun+$r_jul+$r_aug+$r_sep+$r_oct+$r_nov+$r_dec);

$p_new_total=($p_n_jan+$p_n_feb+$p_n_mar+$p_n_apr+$p_n_may+$p_n_jun+$p_n_jul+$p_n_aug+$p_n_sep+$p_n_oct+$p_n_nov+$p_n_dec);
$p_returning_total=($p_r_jan+$p_r_feb+$p_r_mar+$p_r_apr+$p_r_may+$p_r_jun+$p_r_jul+$p_r_aug+$p_r_sep+$p_r_oct+$p_r_nov+$p_r_dec);

//New Patient Charity
        $total_jan=substr(($total/$jan),0,4);
	$total_feb=substr(($total/$feb),0,4);
	$total_mar=substr(($total/$mar),0,4);
	$total_apr=substr(($total/$apr),0,4);
	$total_may=substr(($total/$may),0,4);
	$total_jun=substr(($total/$jun),0,4);
	$total_jul=substr(($total/$jul),0,4);
	$total_aug=substr(($total/$aug),0,4);
	$total_sep=substr(($total/$sep),0,4);
	$total_oct=substr(($total/$oct),0,4);
	$total_nov=substr(($total/$nov),0,4);
	$total_dec=substr(($total/$dec),0,4);
        $percentage_total= substr(($total_jan+$total_feb+$total_mar+$total_apr+$total_may+$total_jun+$total_jul+$total_aug+$total_sep+$total_oct+$total_nov+$total_dec),0,4);
	
//Returning Patient Charity
        $returning_jan=substr(($returning_total/$r_jan),0,4);
	$returning_feb=substr(($returning_total/$r_feb),0,4);
	$returning_mar=substr(($returning_total/$r_mar),0,4);
	$returning_apr=substr(($returning_total/$r_apr),0,4);
	$returning_may=substr(($returning_total/$r_may),0,4);
	$returning_jun=substr(($returning_total/$r_jun),0,4);
	$returning_jul=substr(($returning_total/$r_jul),0,4);
	$returning_aug=substr(($returning_total/$r_aug),0,4);
	$returning_sep=substr(($returning_total/$r_sep),0,4);
	$returning_oct=substr(($returning_total/$r_oct),0,4);
	$returning_nov=substr(($returning_total/$r_nov),0,4);
	$returning_dec=substr(($returning_total/$r_dec),0,4);
	
	$returning_percentage_total= substr(($returning_jan+$returning_feb+$returning_mar+$returning_apr+$returning_may+$returning_jun+$returning_jul+$returning_aug+$returning_sep+$returning_oct+$returning_nov+$returning_dec),0,4);
	//Private New Patient..
	$p_new_total_jan=substr(($p_new_total/$p_n_jan),0,4);
	$p_new_total_feb=substr(($p_new_total/$p_n_feb),0,4);
	$p_new_total_mar=substr(($p_new_total/$p_n_mar),0,4);
	$p_new_total_apr=substr(($p_new_total/$p_n_apr),0,4);
	$p_new_total_may=substr(($p_new_total/$p_n_may),0,4);
	$p_new_total_jun=substr(($p_new_total/$p_n_jun),0,4);
	$p_new_total_jul=substr(($p_new_total/$p_n_jul),0,4);
	$p_new_total_aug=substr(($p_new_total/$p_n_aug),0,4);
	$p_new_total_sep=substr(($p_new_total/$p_n_sep),0,4);
	$p_new_total_oct=substr(($p_new_total/$p_n_oct),0,4);
	$p_new_total_nov=substr(($p_new_total/$p_n_nov),0,4);
	$p_new_total_dec=substr(($p_new_total/$p_n_dec),0,4);
        
                	
	$percentage_p_new_total= substr(($p_new_total_jan+$p_new_total_feb+$p_new_total_mar+$p_new_total_apr+$p_new_total_may+$p_new_total_jun+$p_new_total_jul+$p_new_total_aug+$p_new_total_sep+$p_new_total_oct+$p_new_total_nov+$$p_new_total_dec),0,4);
        //Private Returning Patient
	$p_returning_jan=substr(($p_returning_total/$p_r_jan),0,4);
	$p_returning_feb=substr(($p_returning_total/$p_r_feb),0,4);
	$p_returning_mar=substr(($p_returning_total/$p_r_mar),0,4);
	$p_returning_apr=substr(($p_returning_total/$p_r_apr),0,4);
	$p_returning_may=substr(($p_returning_total/$p_r_may),0,4);
	$p_returning_jun=substr(($p_returning_total/$p_r_jun),0,4);
	$p_returning_jul=substr(($p_returning_total/$p_r_jul),0,4);
	$p_returning_aug=substr(($p_returning_total/$p_r_aug),0,4);
	$p_returning_sep=substr(($p_returning_total/$p_r_sep),0,4);
	$p_returning_oct=substr(($p_returning_total/$p_r_oct),0,4);
	$p_returning_nov=substr(($p_returning_total/$p_r_nov),0,4);
        $p_returning_dec=substr(($p_returning_total/$p_r_dec),0,4);
	
        
        $percentage_p_returning_total= substr(($p_returning_jan+$p_returning_feb+$p_returning_mar+$p_returning_apr+$p_returning_may+$p_returning_jun+$p_returning_jul+$p_returning_aug+$p_returning_sep+$p_returning_oct+$p_returning_nov+$$p_returning_dec),0,4);
        
        
        //January
	$s_L_jan = ($jan+$r_jan);
	$s_N_jan = ($jan+$r_jan+$p_n_jan+$p_r_jan);
	$s_L_N_jan = substr(($s_L_jan/$s_N_jan),0,4);
	//February
	$s_L_feb = ($feb+$r_feb);
	$s_N_feb = ($feb+$r_feb+$p_n_feb+$p_r_feb);
	$s_L_N_feb = substr(($s_L_feb/$s_N_feb),0,4);
	//March
	$s_L_mar = ($mar+$r_mar);
	$s_N_mar = ($mar+$r_mar+$p_n_mar+$p_r_mar);
	$s_L_N_mar = substr(($s_L_mar/$s_N_mar),0,4);
	//April
	$s_L_apr = ($apr+$r_apr);
	$s_N_apr = ($apr+$r_apr+$p_n_apr+$p_r_apr);
	$s_L_N_apr = substr(($s_L_apr/$s_N_apr),0,4);
	//May
	$s_L_may = ($may+$r_may);
	$s_N_may = ($may+$r_may+$p_n_may+$p_r_may);
	$s_L_N_may = substr(($s_L_may/$s_N_may),0,4);
	//June
	$s_L_jun = ($jun+$r_jun);
	$s_N_jun = ($jun+$r_jun+$p_n_jun+$p_r_jun);
	$s_L_N_jun = substr(($s_L_jun/$s_N_jun),0,4);
	//July
	$s_L_jul = ($jul+$r_jul);
	$s_N_jul = ($jul+$r_jul+$p_n_jul+$p_r_jul);
	$s_L_N_jul = substr(($s_L_jul/$s_N_jul),0,4);
	//August
	$s_L_aug = ($aug+$r_aug);
	$s_N_aug = ($aug+$r_aug+$p_n_aug+$p_r_aug);
	$s_L_N_aug = substr(($s_L_aug/$s_N_aug),0,4);
	//September
	$s_L_sep = ($sep+$r_sep);
	$s_N_sep = ($sep+$r_sep+$p_n_sep+$p_r_sep);
	$s_L_N_sep = substr(($s_L_sep/$s_N_sep),0,4);
	//October
	$s_L_oct = ($oct+$r_oct);
	$s_N_oct = ($oct+$r_oct+$p_n_oct+$p_r_oct);
	$s_L_N_oct = substr(($s_L_oct/$s_N_oct),0,4);
	//November
	$s_L_nov = ($nov+$r_nov);
	$s_N_nov = ($nov+$r_nov+$p_n_nov+$p_r_nov);
	$s_L_N_nov = substr(($s_L_nov/$s_N_nov),0,4);
	//December
	$s_L_dec = ($dec+$r_dec);
	$s_N_dec = ($dec+$r_dec+$p_n_dec+$p_r_dec);
	$s_L_N_dec = substr(($s_L_dec/$s_N_dec),0,4);
	
	//January
	$p_L_jan = ($p_n_jan+$p_r_jan);
	$p_N_jan = ($jan+$r_jan+$p_n_jan+$p_r_jan);
	$p_L_N_jan = substr(($p_L_jan/$p_N_jan),0,4);
	//February
	$p_L_feb = ($p_n_feb+$p_r_feb);
	$p_N_feb = ($feb+$r_feb+$p_n_feb+$p_r_feb);
	$p_L_N_feb = substr(($p_L_feb/$p_N_feb),0,4);
	//March
	$p_L_mar = ($p_n_mar+$p_r_mar);
	$p_N_mar = ($mar+$r_mar+$p_n_mar+$p_r_mar);
	$p_L_N_mar = substr(($p_L_mar/$p_N_mar),0,4);
	//April
	$p_L_apr = ($p_n_apr+$p_r_apr);
	$p_N_apr = ($apr+$r_apr+$p_n_apr+$p_r_apr);
	$p_L_N_apr = substr(($p_L_apr/$p_N_apr),0,4);
	//May
	$p_L_may = ($p_n_may+$p_r_may);
	$p_N_may = ($may+$r_may+$p_n_may+$p_r_may);
	$p_L_N_may = substr(($p_L_may/$p_N_may),0,4);
	//June
	$p_L_jun = ($p_n_jun+$p_r_jun);
	$p_N_jun = ($jun+$r_jun+$p_n_jun+$p_r_jun);
	$p_L_N_jun = substr(($p_L_jun/$p_N_jun),0,4);
	//July
	$p_L_jul = ($p_n_jul+$p_r_jul);
	$p_N_jul = ($jul+$r_jul+$p_n_jul+$p_r_jul);
	$p_L_N_jul = substr(($p_L_jul/$p_N_jul),0,4);
	//August
	$p_L_aug = ($p_n_aug+$p_r_aug);
	$p_N_aug = ($aug+$r_aug+$p_n_aug+$p_r_aug);
	$p_L_N_aug = substr(($p_L_aug/$p_N_aug),0,4);
	//September
	$p_L_sep = ($p_n_sep+$p_r_sep);
	$p_N_sep = ($sep+$r_sep+$p_n_sep+$p_r_sep);
	$p_L_N_sep = substr(($p_L_sep/$p_N_sep),0,4);
	//October
	$p_L_oct = ($p_n_oct+$p_r_oct);
	$p_N_oct = ($oct+$r_oct+$p_n_oct+$p_r_oct);
	$p_L_N_oct = substr(($p_L_oct/$p_N_oct),0,4);
	//November
	$p_L_nov = ($p_n_nov+$p_r_nov);
	$p_N_nov = ($nov+$r_nov+$p_n_nov+$p_r_nov);
	$p_L_N_nov = substr(($p_L_nov/$p_N_nov),0,4);
	//December
	$p_L_dec = ($p_n_dec+$p_r_dec);
	$p_N_dec = ($dec+$r_dec+$p_n_dec+$p_r_dec);
	$p_L_N_dec = substr(($p_L_dec/$p_N_dec),0,4);
	
	$total_s_L_N=substr(($s_L_N_jan+$s_L_N_feb+$s_L_N_mar+$s_L_N_apr+$s_L_N_may+$s_L_N_jun+$s_L_N_jul+$s_L_N_aug+$s_L_N_sep+$s_L_N_oct+$s_L_N_nov+$s_L_N_dec),0,4);
	$total_p_L_N=substr(($p_L_jan+$p_L_feb+$p_L_mar+$p_L_apr+$p_L_may+$p_L_jun+$p_L_jul+$p_L_aug+$p_L_sep+$p_L_oct+$p_L_nov+$p_L_dec),0,4);
	$total_p_L=substr(($p_L_N_jan+$p_L_N_feb+$p_L_N_mar+$p_L_N_apr+$p_L_N_may+$p_L_N_jun+$p_L_N_jul+$p_L_N_aug+$p_L_N_sep+$p_L_N_oct+$p_L_N_nov+$p_L_N_dec),0,4);

//INPATIENT DETAILS

//All total of Service new patient	
$total_in_patient_service_new_patient = ($in_patient_service_new_patient_jan+$in_patient_service_new_patient_apr+$in_patient_service_new_patient_feb+$in_patient_service_new_patient_mar+$in_patient_service_new_patient_may+$in_patient_service_new_patient_jun+$in_patient_service_new_patient_jul+$in_patient_service_new_patient_aug+$in_patient_service_new_patient_sep+$in_patient_service_new_patient_oct+$in_patient_service_new_patient_nov+$in_patient_service_new_patient_dec);	
//All total of Private new patient	
$total_in_patient_private_new_patient = ($in_patient_private_new_patient_jan+$in_patient_private_new_patient_apr+$in_patient_private_new_patient_feb+$in_patient_private_new_patient_mar+$in_patient_private_new_patient_may+$in_patient_private_new_patient_jun+$in_patient_private_new_patient_jul+$in_patient_private_new_patient_aug+$in_patient_private_new_patient_sep+$in_patient_private_new_patient_oct+$in_patient_private_new_patient_nov+$in_patient_private_new_patient_dec);	
//All total of Private returning Patient
$total_in_patient_private_returning_patient = ($in_patient_private_returning_patient_jan+$in_patient_private_returning_patient_apr+$in_patient_private_returning_patient_feb+$in_patient_private_returning_patient_mar+$in_patient_private_returning_patient_may+$in_patient_private_returning_patient_jun+$in_patient_private_returning_patient_jul+$in_patient_private_returning_patient_aug+$in_patient_private_returning_patient_sep+$in_patient_private_returning_patient_oct+$in_patient_private_returning_patient_nov+$in_patient_private_returning_patient_dec);	
//All total Returning patient	
$total_in_patient_service_returning_patient = ($in_patient_service_returning_patient_jan+$in_patient_service_returning_patient_apr+$in_patient_service_returning_patient_feb+$in_patient_service_returning_patient_mar+$in_patient_service_returning_patient_may+$in_patient_service_returning_patient_jun+$in_patient_service_returning_patient_jul+$in_patient_service_returning_patient_aug+$in_patient_service_returning_patient_sep+$in_patient_service_returning_patient_oct+$in_patient_service_returning_patient_nov+$in_patient_service_returning_patient_dec);	

$grand_total_in_patient = substr(($total_in_patient_service_new_patient+$total_in_patient_service_returning_patient+$total_in_patient_private_new_patient+$total_in_patient_private_returning_patient),0,4);

//Percentage of in_patient Service new patient
$percentage_in_patient_service_new_patient_jan =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_jan),0,4);
$percentage_in_patient_service_new_patient_feb =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_feb),0,4);
$percentage_in_patient_service_new_patient_mar =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_mar),0,4);
$percentage_in_patient_service_new_patient_apr =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_apr),0,4);
$percentage_in_patient_service_new_patient_may =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_may),0,4);
$percentage_in_patient_service_new_patient_jun =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_jun),0,4);
$percentage_in_patient_service_new_patient_jul =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_jul),0,4);
$percentage_in_patient_service_new_patient_aug =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_aug),0,4);
$percentage_in_patient_service_new_patient_sep =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_sep),0,4);
$percentage_in_patient_service_new_patient_oct =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_oct),0,4);
$percentage_in_patient_service_new_patient_nov =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_nov),0,4);
$percentage_in_patient_service_new_patient_dec =substr(($total_in_patient_service_new_patient/$in_patient_service_new_patient_dec),0,4);

//Total Percentage
$total_percentage_in_patient_service_new_patient =substr(($percentage_in_patient_service_new_patient_jan+$percentage_in_patient_service_new_patient_apr+$percentage_in_patient_service_new_patient_feb+$percentage_in_patient_service_new_patient_mar+$percentage_in_patient_service_new_patient_may+$percentage_in_patient_service_new_patient_jun+$percentage_in_patient_service_new_patient_jul+$percentage_in_patient_service_new_patient_aug+$percentage_in_patient_service_new_patient_sep+$percentage_in_patient_service_new_patient_oct+$percentage_in_patient_service_new_patient_nov+$percentage_in_patient_service_new_patient_dec),0,4);

//Percentage of in_patient Service  of Returning patient
$percentage_in_patient_service_returning_patient_jan =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_jan),0,4);
$percentage_in_patient_service_returning_patient_feb =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_feb),0,4);
$percentage_in_patient_service_returning_patient_mar =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_mar),0,4);
$percentage_in_patient_service_returning_patient_apr =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_apr),0,4);
$percentage_in_patient_service_returning_patient_may =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_may),0,4);
$percentage_in_patient_service_returning_patient_jun =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_jun),0,4);
$percentage_in_patient_service_returning_patient_jul =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_jul),0,4);
$percentage_in_patient_service_returning_patient_aug =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_aug),0,4);
$percentage_in_patient_service_returning_patient_sep =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_sep),0,4);
$percentage_in_patient_service_returning_patient_oct =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_oct),0,4);
$percentage_in_patient_service_returning_patient_nov =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_nov),0,4);
$percentage_in_patient_service_returning_patient_dec =substr(($total_in_patient_service_returning_patient/$in_patient_service_returning_patient_dec),0,4);

//Total Percentage of returning Service Returning Patient
$total_percentage_in_patient_service_returning_patient =substr(($percentage_in_patient_service_returning_patient_jan+$percentage_in_patient_service_returning_patient_apr+$percentage_in_patient_service_returning_patient_feb+$percentage_in_patient_service_returning_patient_mar+$percentage_in_patient_service_returning_patient_may+$percentage_in_patient_service_returning_patient_jun+$percentage_in_patient_service_returning_patient_jul+$percentage_in_patient_service_returning_patient_aug+$percentage_in_patient_service_returning_patient_sep+$percentage_in_patient_service_returning_patient_oct+$percentage_in_patient_service_returning_patient_nov+$percentage_in_patient_service_returning_patient_dec),0,4);

//Percentage of Emergency Returning Patient
$total_returning_in_patient_patient_jan = substr(($in_patient_private_new_patient_jan+$in_patient_private_returning_patient_jan),0,4);
$total_returning_in_patient_patient_feb = substr(($in_patient_private_new_patient_feb+$in_patient_private_returning_patient_feb),0,4);
$total_returning_in_patient_patient_mar = substr(($in_patient_private_new_patient_mar+$in_patient_private_returning_patient_mar),0,4);
$total_returning_in_patient_patient_apr = substr(($in_patient_private_new_patient_apr+$in_patient_private_returning_patient_apr),0,4);
$total_returning_in_patient_patient_may = substr(($in_patient_private_new_patient_may+$in_patient_private_returning_patient_may),0,4);
$total_returning_in_patient_patient_jun = substr(($in_patient_private_new_patient_jun+$in_patient_private_returning_patient_jun),0,4);
$total_returning_in_patient_patient_jul = substr(($in_patient_private_new_patient_jul+$in_patient_private_returning_patient_jul),0,4);
$total_returning_in_patient_patient_aug = substr(($in_patient_private_new_patient_aug+$in_patient_private_returning_patient_aug),0,4);
$total_returning_in_patient_patient_sep = substr(($in_patient_private_new_patient_sep+$in_patient_private_returning_patient_sep),0,4);
$total_returning_in_patient_patient_oct = substr(($in_patient_private_new_patient_oct+$in_patient_private_returning_patient_oct),0,4);
$total_returning_in_patient_patient_nov = substr(($in_patient_private_new_patient_nov+$in_patient_private_returning_patient_nov),0,4);
$total_returning_in_patient_patient_dec = substr(($in_patient_private_new_patient_dec+$in_patient_private_returning_patient_dec),0,4);

//Percent of Private Emergency Returning Patient
$percentage_in_patient_returning_patient_jan = substr(($grand_total_in_patient/$total_returning_in_patient_patient_jan),0,4); 
$percentage_in_patient_returning_patient_feb = substr(($grand_total_in_patient/$total_returning_in_patient_patient_feb),0,4); 
$percentage_in_patient_returning_patient_mar = substr(($grand_total_in_patient/$total_returning_in_patient_patient_mar),0,4); 
$percentage_in_patient_returning_patient_apr = substr(($grand_total_in_patient/$total_returning_in_patient_patient_apr),0,4); 
$percentage_in_patient_returning_patient_may = substr(($grand_total_in_patient/$total_returning_in_patient_patient_may),0,4); 
$percentage_in_patient_returning_patient_jun = substr(($grand_total_in_patient/$total_returning_in_patient_patient_jun),0,4); 
$percentage_in_patient_returning_patient_jul = substr(($grand_total_in_patient/$total_returning_in_patient_patient_jul),0,4); 
$percentage_in_patient_returning_patient_aug = substr(($grand_total_in_patient/$total_returning_in_patient_patient_aug),0,4); 
$percentage_in_patient_returning_patient_sep = substr(($grand_total_in_patient/$total_returning_in_patient_patient_sep),0,4); 
$percentage_in_patient_returning_patient_oct = substr(($grand_total_in_patient/$total_returning_in_patient_patient_oct),0,4); 
$percentage_in_patient_returning_patient_nov = substr(($grand_total_in_patient/$total_returning_in_patient_patient_nov),0,4); 
$percentage_in_patient_returning_patient_dec = substr(($grand_total_in_patient/$total_returning_in_patient_patient_dec),0,4); 

//Total Percent of Private Emergency Returning Patient
$total_percentage_in_patient_returning_patient= substr(($percentage_in_patient_returning_patient_jan+$percentage_in_patient_returning_patient_feb+$percentage_in_patient_returning_patient_mar+$percentage_in_patient_returning_patient_apr+$percentage_in_patient_returning_patient_may+$percentage_in_patient_returning_patient_jun+$percentage_in_patient_returning_patient_jul+$percentage_in_patient_returning_patient_aug+$percentage_in_patient_returning_patient_sep+$percentage_in_patient_returning_patient_oct+$percentage_in_patient_returning_patient_nov+$percentage_in_patient_returning_patient_dec),0,4);

//Percentage of In patient  Private New Patient
$total_new_in_patient_patient_jan = substr(($in_patient_service_new_patient_jan+$in_patient_service_returning_patient_jan),0,4);
$total_new_in_patient_patient_feb = substr(($in_patient_service_new_patient_feb+$in_patient_service_returning_patient_feb),0,4);
$total_new_in_patient_patient_mar = substr(($in_patient_service_new_patient_mar+$in_patient_service_returning_patient_mar),0,4);
$total_new_in_patient_patient_apr = substr(($in_patient_service_new_patient_apr+$in_patient_service_returning_patient_apr),0,4);
$total_new_in_patient_patient_may = substr(($in_patient_service_new_patient_may+$in_patient_service_returning_patient_may),0,4);
$total_new_in_patient_patient_jun = substr(($in_patient_service_new_patient_jun+$in_patient_service_returning_patient_jun),0,4);
$total_new_in_patient_patient_jul = substr(($in_patient_service_new_patient_jul+$in_patient_service_returning_patient_jul),0,4);
$total_new_in_patient_patient_aug = substr(($in_patient_service_new_patient_aug+$in_patient_service_returning_patient_aug),0,4);
$total_new_in_patient_patient_sep = substr(($in_patient_service_new_patient_sep+$in_patient_service_returning_patient_sep),0,4);
$total_new_in_patient_patient_oct = substr(($in_patient_service_new_patient_oct+$in_patient_service_returning_patient_oct),0,4);
$total_new_in_patient_patient_nov = substr(($in_patient_service_new_patient_nov+$in_patient_service_returning_patient_nov),0,4);
$total_new_in_patient_patient_dec = substr(($in_patient_service_new_patient_dec+$in_patient_service_returning_patient_dec),0,4);

//Percent of Private Emergency New Patient
$percentage_in_patient_new_patient_jan = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_jan),0,4); 
$percentage_in_patient_new_patient_feb = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_feb),0,4); 
$percentage_in_patient_new_patient_mar = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_mar),0,4); 
$percentage_in_patient_new_patient_apr = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_apr),0,4); 
$percentage_in_patient_new_patient_may = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_may),0,4); 
$percentage_in_patient_new_patient_jun = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_jun),0,4); 
$percentage_in_patient_new_patient_jul = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_jul),0,4); 
$percentage_in_patient_new_patient_aug = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_aug),0,4); 
$percentage_in_patient_new_patient_sep = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_sep),0,4); 
$percentage_in_patient_new_patient_oct = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_oct),0,4); 
$percentage_in_patient_new_patient_nov = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_nov),0,4); 
$percentage_in_patient_new_patient_dec = substr(($total_in_patient_private_new_patient/$total_new_in_patient_patient_dec),0,4); 

//Total Percent of Private Emergency New Patient
$total_percentage_in_patient_new_patient= substr(($percentage_in_patient_new_patient_jan+$percentage_in_patient_new_patient_feb+$percentage_in_patient_new_patient_mar+$percentage_in_patient_new_patient_apr+$percentage_in_patient_new_patient_may+$percentage_in_patient_new_patient_jun+$percentage_in_patient_new_patient_jul+$percentage_in_patient_new_patient_aug+$percentage_in_patient_new_patient_sep+$percentage_in_patient_new_patient_oct+$percentage_in_patient_new_patient_nov+$percentage_in_patient_new_patient_dec),0,4);

//Percent of Private Emergency New Patient
$percentage_in_patient_private_new_patient_jan = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_jan),0,4); 
$percentage_in_patient_private_new_patient_feb = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_feb),0,4); 
$percentage_in_patient_private_new_patient_mar = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_mar),0,4); 
$percentage_in_patient_private_new_patient_apr = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_apr),0,4); 
$percentage_in_patient_private_new_patient_may = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_may),0,4); 
$percentage_in_patient_private_new_patient_jun = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_jun),0,4); 
$percentage_in_patient_private_new_patient_jul = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_jul),0,4); 
$percentage_in_patient_private_new_patient_aug = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_aug),0,4); 
$percentage_in_patient_private_new_patient_sep = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_sep),0,4); 
$percentage_in_patient_private_new_patient_oct = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_oct),0,4); 
$percentage_in_patient_private_new_patient_nov = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_nov),0,4); 
$percentage_in_patient_private_new_patient_dec = substr(($total_in_patient_private_new_patient/$in_patient_private_new_patient_dec),0,4); 

//Total Percent of Private Emergency New Patient
$total_percentage_in_patient_private_new_patient= substr(($percentage_in_patient_private_new_patient_jan+$percentage_in_patient_private_new_patient_feb+$percentage_in_patient_private_new_patient_mar+$percentage_in_patient_private_new_patient_apr+$percentage_in_patient_private_new_patient_may+$percentage_in_patient_private_new_patient_jun+$percentage_in_patient_private_new_patient_jul+$percentage_in_patient_private_new_patient_aug+$percentage_in_patient_private_new_patient_sep+$percentage_in_patient_private_new_patient_oct+$percentage_in_patient_private_new_patient_nov+$percentage_in_patient_private_new_patient_dec),0,4);

//Percent of Private In Patient Returning 
$percentage_in_patient_private_returning_patient_jan = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_jan),0,4); 
$percentage_in_patient_private_returning_patient_feb = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_feb),0,4); 
$percentage_in_patient_private_returning_patient_mar = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_mar),0,4); 
$percentage_in_patient_private_returning_patient_apr = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_apr),0,4); 
$percentage_in_patient_private_returning_patient_may = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_may),0,4); 
$percentage_in_patient_private_returning_patient_jun = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_jun),0,4); 
$percentage_in_patient_private_returning_patient_jul = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_jul),0,4); 
$percentage_in_patient_private_returning_patient_aug = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_aug),0,4); 
$percentage_in_patient_private_returning_patient_sep = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_sep),0,4); 
$percentage_in_patient_private_returning_patient_oct = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_oct),0,4); 
$percentage_in_patient_private_returning_patient_nov = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_nov),0,4); 
$percentage_in_patient_private_returning_patient_dec = substr(($total_in_patient_private_returning_patient/$in_patient_private_returning_patient_dec),0,4); 

//Total Percent of Private In Patient Returning
$total_percentage_in_patient_private_returning_patient= substr(($percentage_in_patient_private_returning_patient_jan+$percentage_in_patient_private_returning_patient_feb+$percentage_in_patient_private_returning_patient_mar+$percentage_in_patient_private_returning_patient_apr+$percentage_in_patient_private_returning_patient_may+$percentage_in_patient_private_returning_patient_jun+$percentage_in_patient_private_returning_patient_jul+$percentage_in_patient_private_returning_patient_aug+$percentage_in_patient_private_returning_patient_sep+$percentage_in_patient_private_returning_patient_oct+$percentage_in_patient_private_returning_patient_nov+$percentage_in_patient_private_returning_patient_dec),0,4);

//IADMISSION DETAILS
//All total of Service new patient	
$total_admission_service_new_patient = ($admission_service_new_patient_jan+$admission_service_new_patient_apr+$admission_service_new_patient_feb+$admission_service_new_patient_mar+$admission_service_new_patient_may+$admission_service_new_patient_jun+$admission_service_new_patient_jul+$admission_service_new_patient_aug+$admission_service_new_patient_sep+$admission_service_new_patient_oct+$admission_service_new_patient_nov+$admission_service_new_patient_dec);	
//All total of Private new patient	
$total_admission_private_new_patient = ($admission_private_new_patient_jan+$admission_private_new_patient_apr+$admission_private_new_patient_feb+$admission_private_new_patient_mar+$admission_private_new_patient_may+$admission_private_new_patient_jun+$admission_private_new_patient_jul+$admission_private_new_patient_aug+$admission_private_new_patient_sep+$admission_private_new_patient_oct+$admission_private_new_patient_nov+$admission_private_new_patient_dec);	
//All total of Private returning Patient
$total_admission_private_returning_patient = ($admission_private_returning_patient_jan+$admission_private_returning_patient_apr+$admission_private_returning_patient_feb+$admission_private_returning_patient_mar+$admission_private_returning_patient_may+$admission_private_returning_patient_jun+$admission_private_returning_patient_jul+$admission_private_returning_patient_aug+$admission_private_returning_patient_sep+$admission_private_returning_patient_oct+$admission_private_returning_patient_nov+$admission_private_returning_patient_dec);	
//All total Returning patient	
$total_admission_service_returning_patient = ($admission_service_returning_patient_jan+$admission_service_returning_patient_apr+$admission_service_returning_patient_feb+$admission_service_returning_patient_mar+$admission_service_returning_patient_may+$admission_service_returning_patient_jun+$admission_service_returning_patient_jul+$admission_service_returning_patient_aug+$admission_service_returning_patient_sep+$admission_service_returning_patient_oct+$admission_service_returning_patient_nov+$admission_service_returning_patient_dec);	

$grand_total_admission = substr(($total_admission_service_new_patient+$total_admission_service_returning_patient+$total_admission_private_new_patient+$total_admission_private_returning_patient),0,4);

//Percentage of admission Service new patient
$percentage_admission_service_new_patient_jan =substr(($total_admission_service_new_patient/$admission_service_new_patient_jan),0,4);
$percentage_admission_service_new_patient_feb =substr(($total_admission_service_new_patient/$admission_service_new_patient_feb),0,4);
$percentage_admission_service_new_patient_mar =substr(($total_admission_service_new_patient/$admission_service_new_patient_mar),0,4);
$percentage_admission_service_new_patient_apr =substr(($total_admission_service_new_patient/$admission_service_new_patient_apr),0,4);
$percentage_admission_service_new_patient_may =substr(($total_admission_service_new_patient/$admission_service_new_patient_may),0,4);
$percentage_admission_service_new_patient_jun =substr(($total_admission_service_new_patient/$admission_service_new_patient_jun),0,4);
$percentage_admission_service_new_patient_jul =substr(($total_admission_service_new_patient/$admission_service_new_patient_jul),0,4);
$percentage_admission_service_new_patient_aug =substr(($total_admission_service_new_patient/$admission_service_new_patient_aug),0,4);
$percentage_admission_service_new_patient_sep =substr(($total_admission_service_new_patient/$admission_service_new_patient_sep),0,4);
$percentage_admission_service_new_patient_oct =substr(($total_admission_service_new_patient/$admission_service_new_patient_oct),0,4);
$percentage_admission_service_new_patient_nov =substr(($total_admission_service_new_patient/$admission_service_new_patient_nov),0,4);
$percentage_admission_service_new_patient_dec =substr(($total_admission_service_new_patient/$admission_service_new_patient_dec),0,4);

//Total Percentage
$total_percentage_admission_service_new_patient =substr(($percentage_admission_service_new_patient_jan+$percentage_admission_service_new_patient_apr+$percentage_admission_service_new_patient_feb+$percentage_admission_service_new_patient_mar+$percentage_admission_service_new_patient_may+$percentage_admission_service_new_patient_jun+$percentage_admission_service_new_patient_jul+$percentage_admission_service_new_patient_aug+$percentage_admission_service_new_patient_sep+$percentage_admission_service_new_patient_oct+$percentage_admission_service_new_patient_nov+$percentage_admission_service_new_patient_dec),0,4);

//Percentage of admission Service  of Returning patient
$percentage_admission_service_returning_patient_jan =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_jan),0,4);
$percentage_admission_service_returning_patient_feb =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_feb),0,4);
$percentage_admission_service_returning_patient_mar =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_mar),0,4);
$percentage_admission_service_returning_patient_apr =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_apr),0,4);
$percentage_admission_service_returning_patient_may =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_may),0,4);
$percentage_admission_service_returning_patient_jun =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_jun),0,4);
$percentage_admission_service_returning_patient_jul =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_jul),0,4);
$percentage_admission_service_returning_patient_aug =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_aug),0,4);
$percentage_admission_service_returning_patient_sep =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_sep),0,4);
$percentage_admission_service_returning_patient_oct =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_oct),0,4);
$percentage_admission_service_returning_patient_nov =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_nov),0,4);
$percentage_admission_service_returning_patient_dec =substr(($total_admission_service_returning_patient/$admission_service_returning_patient_dec),0,4);

//Total Percentage of returning Service Returning Patient
$total_percentage_admission_service_returning_patient =substr(($percentage_admission_service_returning_patient_jan+$percentage_admission_service_returning_patient_apr+$percentage_admission_service_returning_patient_feb+$percentage_admission_service_returning_patient_mar+$percentage_admission_service_returning_patient_may+$percentage_admission_service_returning_patient_jun+$percentage_admission_service_returning_patient_jul+$percentage_admission_service_returning_patient_aug+$percentage_admission_service_returning_patient_sep+$percentage_admission_service_returning_patient_oct+$percentage_admission_service_returning_patient_nov+$percentage_admission_service_returning_patient_dec),0,4);

//Percentage of Emergency Returning Patient
$total_returning_admission_patient_jan = substr(($admission_private_new_patient_jan+$admission_private_returning_patient_jan),0,4);
$total_returning_admission_patient_feb = substr(($admission_private_new_patient_feb+$admission_private_returning_patient_feb),0,4);
$total_returning_admission_patient_mar = substr(($admission_private_new_patient_mar+$admission_private_returning_patient_mar),0,4);
$total_returning_admission_patient_apr = substr(($admission_private_new_patient_apr+$admission_private_returning_patient_apr),0,4);
$total_returning_admission_patient_may = substr(($admission_private_new_patient_may+$admission_private_returning_patient_may),0,4);
$total_returning_admission_patient_jun = substr(($admission_private_new_patient_jun+$admission_private_returning_patient_jun),0,4);
$total_returning_admission_patient_jul = substr(($admission_private_new_patient_jul+$admission_private_returning_patient_jul),0,4);
$total_returning_admission_patient_aug = substr(($admission_private_new_patient_aug+$admission_private_returning_patient_aug),0,4);
$total_returning_admission_patient_sep = substr(($admission_private_new_patient_sep+$admission_private_returning_patient_sep),0,4);
$total_returning_admission_patient_oct = substr(($admission_private_new_patient_oct+$admission_private_returning_patient_oct),0,4);
$total_returning_admission_patient_nov = substr(($admission_private_new_patient_nov+$admission_private_returning_patient_nov),0,4);
$total_returning_admission_patient_dec = substr(($admission_private_new_patient_dec+$admission_private_returning_patient_dec),0,4);

//Percent of Private Emergency Returning Patient
$percentage_admission_returning_patient_jan = substr(($grand_total_admission/$total_returning_admission_patient_jan),0,4); 
$percentage_admission_returning_patient_feb = substr(($grand_total_admission/$total_returning_admission_patient_feb),0,4); 
$percentage_admission_returning_patient_mar = substr(($grand_total_admission/$total_returning_admission_patient_mar),0,4); 
$percentage_admission_returning_patient_apr = substr(($grand_total_admission/$total_returning_admission_patient_apr),0,4); 
$percentage_admission_returning_patient_may = substr(($grand_total_admission/$total_returning_admission_patient_may),0,4); 
$percentage_admission_returning_patient_jun = substr(($grand_total_admission/$total_returning_admission_patient_jun),0,4); 
$percentage_admission_returning_patient_jul = substr(($grand_total_admission/$total_returning_admission_patient_jul),0,4); 
$percentage_admission_returning_patient_aug = substr(($grand_total_admission/$total_returning_admission_patient_aug),0,4); 
$percentage_admission_returning_patient_sep = substr(($grand_total_admission/$total_returning_admission_patient_sep),0,4); 
$percentage_admission_returning_patient_oct = substr(($grand_total_admission/$total_returning_admission_patient_oct),0,4); 
$percentage_admission_returning_patient_nov = substr(($grand_total_admission/$total_returning_admission_patient_nov),0,4); 
$percentage_admission_returning_patient_dec = substr(($grand_total_admission/$total_returning_admission_patient_dec),0,4); 

//Total Percent of Private Emergency Returning Patient
$total_percentage_admission_returning_patient= substr(($percentage_admission_returning_patient_jan+$percentage_admission_returning_patient_feb+$percentage_admission_returning_patient_mar+$percentage_admission_returning_patient_apr+$percentage_admission_returning_patient_may+$percentage_admission_returning_patient_jun+$percentage_admission_returning_patient_jul+$percentage_admission_returning_patient_aug+$percentage_admission_returning_patient_sep+$percentage_admission_returning_patient_oct+$percentage_admission_returning_patient_nov+$percentage_admission_returning_patient_dec),0,4);

//Percentage of In patient  Private New Patient
$total_new_admission_patient_jan = substr(($admission_service_new_patient_jan+$admission_service_returning_patient_jan),0,4);
$total_new_admission_patient_feb = substr(($admission_service_new_patient_feb+$admission_service_returning_patient_feb),0,4);
$total_new_admission_patient_mar = substr(($admission_service_new_patient_mar+$admission_service_returning_patient_mar),0,4);
$total_new_admission_patient_apr = substr(($admission_service_new_patient_apr+$admission_service_returning_patient_apr),0,4);
$total_new_admission_patient_may = substr(($admission_service_new_patient_may+$admission_service_returning_patient_may),0,4);
$total_new_admission_patient_jun = substr(($admission_service_new_patient_jun+$admission_service_returning_patient_jun),0,4);
$total_new_admission_patient_jul = substr(($admission_service_new_patient_jul+$admission_service_returning_patient_jul),0,4);
$total_new_admission_patient_aug = substr(($admission_service_new_patient_aug+$admission_service_returning_patient_aug),0,4);
$total_new_admission_patient_sep = substr(($admission_service_new_patient_sep+$admission_service_returning_patient_sep),0,4);
$total_new_admission_patient_oct = substr(($admission_service_new_patient_oct+$admission_service_returning_patient_oct),0,4);
$total_new_admission_patient_nov = substr(($admission_service_new_patient_nov+$admission_service_returning_patient_nov),0,4);
$total_new_admission_patient_dec = substr(($admission_service_new_patient_dec+$admission_service_returning_patient_dec),0,4);

//Percent of Private Emergency New Patient
$percentage_admission_new_patient_jan = substr(($total_admission_private_new_patient/$total_new_admission_patient_jan),0,4); 
$percentage_admission_new_patient_feb = substr(($total_admission_private_new_patient/$total_new_admission_patient_feb),0,4); 
$percentage_admission_new_patient_mar = substr(($total_admission_private_new_patient/$total_new_admission_patient_mar),0,4); 
$percentage_admission_new_patient_apr = substr(($total_admission_private_new_patient/$total_new_admission_patient_apr),0,4); 
$percentage_admission_new_patient_may = substr(($total_admission_private_new_patient/$total_new_admission_patient_may),0,4); 
$percentage_admission_new_patient_jun = substr(($total_admission_private_new_patient/$total_new_admission_patient_jun),0,4); 
$percentage_admission_new_patient_jul = substr(($total_admission_private_new_patient/$total_new_admission_patient_jul),0,4); 
$percentage_admission_new_patient_aug = substr(($total_admission_private_new_patient/$total_new_admission_patient_aug),0,4); 
$percentage_admission_new_patient_sep = substr(($total_admission_private_new_patient/$total_new_admission_patient_sep),0,4); 
$percentage_admission_new_patient_oct = substr(($total_admission_private_new_patient/$total_new_admission_patient_oct),0,4); 
$percentage_admission_new_patient_nov = substr(($total_admission_private_new_patient/$total_new_admission_patient_nov),0,4); 
$percentage_admission_new_patient_dec = substr(($total_admission_private_new_patient/$total_new_admission_patient_dec),0,4); 

//Total Percent of Private Emergency New Patient
$total_percentage_admission_new_patient= substr(($percentage_admission_new_patient_jan+$percentage_admission_new_patient_feb+$percentage_admission_new_patient_mar+$percentage_admission_new_patient_apr+$percentage_admission_new_patient_may+$percentage_admission_new_patient_jun+$percentage_admission_new_patient_jul+$percentage_admission_new_patient_aug+$percentage_admission_new_patient_sep+$percentage_admission_new_patient_oct+$percentage_admission_new_patient_nov+$percentage_admission_new_patient_dec),0,4);

//Percent of Private Emergency New Patient
$percentage_admission_private_new_patient_jan = substr(($total_admission_private_new_patient/$admission_private_new_patient_jan),0,4); 
$percentage_admission_private_new_patient_feb = substr(($total_admission_private_new_patient/$admission_private_new_patient_feb),0,4); 
$percentage_admission_private_new_patient_mar = substr(($total_admission_private_new_patient/$admission_private_new_patient_mar),0,4); 
$percentage_admission_private_new_patient_apr = substr(($total_admission_private_new_patient/$admission_private_new_patient_apr),0,4); 
$percentage_admission_private_new_patient_may = substr(($total_admission_private_new_patient/$admission_private_new_patient_may),0,4); 
$percentage_admission_private_new_patient_jun = substr(($total_admission_private_new_patient/$admission_private_new_patient_jun),0,4); 
$percentage_admission_private_new_patient_jul = substr(($total_admission_private_new_patient/$admission_private_new_patient_jul),0,4); 
$percentage_admission_private_new_patient_aug = substr(($total_admission_private_new_patient/$admission_private_new_patient_aug),0,4); 
$percentage_admission_private_new_patient_sep = substr(($total_admission_private_new_patient/$admission_private_new_patient_sep),0,4); 
$percentage_admission_private_new_patient_oct = substr(($total_admission_private_new_patient/$admission_private_new_patient_oct),0,4); 
$percentage_admission_private_new_patient_nov = substr(($total_admission_private_new_patient/$admission_private_new_patient_nov),0,4); 
$percentage_admission_private_new_patient_dec = substr(($total_admission_private_new_patient/$admission_private_new_patient_dec),0,4); 

//Total Percent of Private Emergency New Patient
$total_percentage_admission_private_new_patient= substr(($percentage_admission_private_new_patient_jan+$percentage_admission_private_new_patient_feb+$percentage_admission_private_new_patient_mar+$percentage_admission_private_new_patient_apr+$percentage_admission_private_new_patient_may+$percentage_admission_private_new_patient_jun+$percentage_admission_private_new_patient_jul+$percentage_admission_private_new_patient_aug+$percentage_admission_private_new_patient_sep+$percentage_admission_private_new_patient_oct+$percentage_admission_private_new_patient_nov+$percentage_admission_private_new_patient_dec),0,4);

//Percent of Private In Patient Returning 
$percentage_admission_private_returning_patient_jan = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_jan),0,4); 
$percentage_admission_private_returning_patient_feb = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_feb),0,4); 
$percentage_admission_private_returning_patient_mar = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_mar),0,4); 
$percentage_admission_private_returning_patient_apr = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_apr),0,4); 
$percentage_admission_private_returning_patient_may = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_may),0,4); 
$percentage_admission_private_returning_patient_jun = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_jun),0,4); 
$percentage_admission_private_returning_patient_jul = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_jul),0,4); 
$percentage_admission_private_returning_patient_aug = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_aug),0,4); 
$percentage_admission_private_returning_patient_sep = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_sep),0,4); 
$percentage_admission_private_returning_patient_oct = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_oct),0,4); 
$percentage_admission_private_returning_patient_nov = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_nov),0,4); 
$percentage_admission_private_returning_patient_dec = substr(($total_admission_private_returning_patient/$admission_private_returning_patient_dec),0,4); 

//Total Percent of Private In Patient Returning
$total_percentage_admission_private_returning_patient= substr(($percentage_admission_private_returning_patient_jan+$percentage_admission_private_returning_patient_feb+$percentage_admission_private_returning_patient_mar+$percentage_admission_private_returning_patient_apr+$percentage_admission_private_returning_patient_may+$percentage_admission_private_returning_patient_jun+$percentage_admission_private_returning_patient_jul+$percentage_admission_private_returning_patient_aug+$percentage_admission_private_returning_patient_sep+$percentage_admission_private_returning_patient_oct+$percentage_admission_private_returning_patient_nov+$percentage_admission_private_returning_patient_dec),0,4);



xlsWriteNumber(9,1,$jan);
xlsWriteNumber(9,2,$total_jan);
xlsWriteNumber(9,4,$returning_jan);

xlsWriteNumber(10,1,$feb);
xlsWriteNumber(10,2,$total_feb);
xlsWriteNumber(10,4,$returning_feb);

xlsWriteNumber(11,1,$mar);
xlsWriteNumber(11,2,$total_mar);
xlsWriteNumber(11,4,$returning_mar);

xlsWriteNumber(12,1,$apr);
xlsWriteNumber(12,2,$total_apr);
xlsWriteNumber(12,4,$returning_apr);

xlsWriteNumber(13,1,$may);
xlsWriteNumber(13,2,$total_may);
xlsWriteNumber(13,4,$returning_may);

xlsWriteNumber(14,1,$jun);
xlsWriteNumber(14,2,$total_jun);
xlsWriteNumber(14,4,$returning_jun);

xlsWriteNumber(15,1,$jul);
xlsWriteNumber(15,2,$total_jul);
xlsWriteNumber(15,4,$returning_jul);

xlsWriteNumber(16,1,$aug);
xlsWriteNumber(16,2,$total_aug);
xlsWriteNumber(16,4,$returning_aug);

xlsWriteNumber(17,1,$sep);
xlsWriteNumber(17,2,$total_sep);
xlsWriteNumber(17,4,$returning_sep);

xlsWriteNumber(18,1,$oct);
xlsWriteNumber(18,2,$total_oct);
xlsWriteNumber(18,4,$returning_oct);

xlsWriteNumber(19,1,$nov);
xlsWriteNumber(19,2,$total_nov);
xlsWriteNumber(19,4,$returning_nov);

xlsWriteNumber(20,1,$dec);
xlsWriteNumber(20,2,$total_dec);
xlsWriteNumber(20,4,$returning_dec);

xlsWriteNumber(21,1,$total);
xlsWriteNumber(21,2,$percentage_total);
xlsWriteNumber(21,4,$returning_percentage_total);

xlsWriteNumber(9,3,$r_jan);
xlsWriteNumber(10,3,$r_feb);
xlsWriteNumber(11,3,$r_mar);
xlsWriteNumber(12,3,$r_apr);
xlsWriteNumber(13,3,$r_may);
xlsWriteNumber(14,3,$r_jun);
xlsWriteNumber(15,3,$r_jul);
xlsWriteNumber(16,3,$r_aug);
xlsWriteNumber(17,3,$r_sep);
xlsWriteNumber(18,3,$r_oct);
xlsWriteNumber(19,3,$r_nov);
xlsWriteNumber(20,3,$r_dec);
xlsWriteNumber(21,3,$returning_total);

xlsWriteNumber(9,5,$jan+$r_jan);
xlsWriteNumber(10,5,$feb+$r_feb);
xlsWriteNumber(11,5,$mar+$r_mar);
xlsWriteNumber(12,5,$apr+$r_apr);
xlsWriteNumber(13,5,$may+$r_may);
xlsWriteNumber(14,5,$jun+$r_jun);
xlsWriteNumber(15,5,$jul+$r_jul);
xlsWriteNumber(16,5,$aug+$r_aug);
xlsWriteNumber(17,5,$sep+$r_sep);
xlsWriteNumber(18,5,$oct+$r_oct);
xlsWriteNumber(19,5,$nov+$r_nov);
xlsWriteNumber(20,5,$dec+$r_dec);
xlsWriteNumber(21,5,$total+$returning_total);

xlsWriteNumber(9,6,$s_L_N_jan);
xlsWriteNumber(10,6,$s_L_N_feb);
xlsWriteNumber(11,6,$s_L_N_mar);
xlsWriteNumber(12,6,$s_L_N_apr);
xlsWriteNumber(13,6,$s_L_N_may);
xlsWriteNumber(14,6,$s_L_N_jun);
xlsWriteNumber(15,6,$s_L_N_jul);
xlsWriteNumber(16,6,$s_L_N_aug);
xlsWriteNumber(17,6,$s_L_N_sep);
xlsWriteNumber(18,6,$s_L_N_oct);
xlsWriteNumber(19,6,$s_L_N_nov);
xlsWriteNumber(20,6,$s_L_N_dec);
xlsWriteNumber(21,6,$total_s_L_N);

xlsWriteNumber(9,7,$p_n_jan);
xlsWriteNumber(10,7,$p_n_feb);
xlsWriteNumber(11,7,$p_n_mar);
xlsWriteNumber(12,7,$p_n_apr);
xlsWriteNumber(13,7,$p_n_may);
xlsWriteNumber(14,7,$p_n_jun);
xlsWriteNumber(15,7,$p_n_jul);
xlsWriteNumber(16,7,$p_n_aug);
xlsWriteNumber(17,7,$p_n_sep);
xlsWriteNumber(18,7,$p_n_oct);
xlsWriteNumber(19,7,$p_n_nov);
xlsWriteNumber(20,7,$p_n_dec);
xlsWriteNumber(21,7,$p_new_total);

xlsWriteNumber(9,8,$p_new_total_jan);
xlsWriteNumber(10,8,$p_new_total_feb);
xlsWriteNumber(11,8,$p_new_total_mar);
xlsWriteNumber(12,8,$p_new_total_apr);
xlsWriteNumber(13,8,$p_new_total_may);
xlsWriteNumber(14,8,$p_new_total_jun);
xlsWriteNumber(15,8,$p_new_total_jul);
xlsWriteNumber(16,8,$p_new_total_aug);
xlsWriteNumber(17,8,$p_new_total_sep);
xlsWriteNumber(18,8,$p_new_total_oct);
xlsWriteNumber(19,8,$p_new_total_nov);
xlsWriteNumber(20,8,$p_new_total_dec);
xlsWriteNumber(21,8,$percentage_p_new_total);

xlsWriteNumber(9,9,$p_r_jan);
xlsWriteNumber(10,9,$p_r_feb);
xlsWriteNumber(11,9,$p_r_mar);
xlsWriteNumber(12,9,$p_r_apr);
xlsWriteNumber(13,9,$p_r_may);
xlsWriteNumber(14,9,$p_r_jun);
xlsWriteNumber(15,9,$p_r_jul);
xlsWriteNumber(16,9,$p_r_aug);
xlsWriteNumber(17,9,$p_r_sep);
xlsWriteNumber(18,9,$p_r_oct);
xlsWriteNumber(19,9,$p_r_nov);
xlsWriteNumber(20,9,$p_r_dec);
xlsWriteNumber(21,9,$p_returning_total);

//percentage of returing patient
xlsWriteNumber(9,10,$p_returning_jan);
xlsWriteNumber(10,10,$p_returning_feb);
xlsWriteNumber(11,10,$p_returning_mar);
xlsWriteNumber(12,10,$p_returning_apr);
xlsWriteNumber(13,10,$p_returning_may);
xlsWriteNumber(14,10,$p_returning_jun);
xlsWriteNumber(15,10,$p_returning_jul);
xlsWriteNumber(16,10,$p_returning_aug);
xlsWriteNumber(17,10,$p_returning_sep);
xlsWriteNumber(18,10,$p_returning_oct);
xlsWriteNumber(19,10,$p_returning_nov);
xlsWriteNumber(20,10,$p_returning_dec);
xlsWriteNumber(21,10,$percentage_p_returning_total);

//Total Number of Private Patients

xlsWriteNumber(9,11,$p_L_jan);
xlsWriteNumber(10,11,$p_L_feb);
xlsWriteNumber(11,11,$p_L_mar);
xlsWriteNumber(12,11,$p_L_apr);
xlsWriteNumber(13,11,$p_L_may);
xlsWriteNumber(14,11,$p_L_jun);
xlsWriteNumber(15,11,$p_L_jul);
xlsWriteNumber(16,11,$p_L_aug);
xlsWriteNumber(17,11,$p_L_sep);
xlsWriteNumber(18,11,$p_L_oct);
xlsWriteNumber(19,11,$p_L_nov);
xlsWriteNumber(20,11,$p_L_dec);
xlsWriteNumber(21,11,$total_p_L_N);

//Private Percentage Total
xlsWriteNumber(9,12,$p_L_N_jan);
xlsWriteNumber(10,12,$p_L_N_feb);
xlsWriteNumber(11,12,$p_L_N_mar);
xlsWriteNumber(12,12,$p_L_N_apr);
xlsWriteNumber(13,12,$p_L_N_may);
xlsWriteNumber(14,12,$p_L_N_jun);
xlsWriteNumber(15,12,$p_L_N_jul);
xlsWriteNumber(16,12,$p_L_N_aug);
xlsWriteNumber(17,12,$p_L_N_sep);
xlsWriteNumber(18,12,$p_L_N_oct);
xlsWriteNumber(19,12,$p_L_N_nov);
xlsWriteNumber(20,12,$p_L_N_dec);
xlsWriteNumber(21,12,$total_p_L);

//Grand Total Number
xlsWriteNumber(9,13,$jan+$r_jan+$p_n_jan+$p_r_jan);
xlsWriteNumber(10,13,$feb+$r_feb+$p_n_feb+$p_r_feb);
xlsWriteNumber(11,13,$mar+$r_mar+$p_n_mar+$p_r_mar);
xlsWriteNumber(12,13,$apr+$r_apr+$p_n_apr+$p_r_apr);
xlsWriteNumber(13,13,$may+$r_may+$p_n_may+$p_r_may);
xlsWriteNumber(14,13,$jun+$r_jun+$p_n_jun+$p_r_jun);
xlsWriteNumber(15,13,$jul+$r_jul+$p_n_jul+$p_r_jul);
xlsWriteNumber(16,13,$aug+$r_aug+$p_n_aug+$p_r_aug);
xlsWriteNumber(17,13,$sep+$r_sep+$p_n_sep+$p_r_sep);
xlsWriteNumber(18,13,$oct+$r_oct+$p_n_oct+$p_r_oct);
xlsWriteNumber(19,13,$nov+$r_nov+$p_n_nov+$p_r_nov);
xlsWriteNumber(20,13,$$dec+$r_dec+$p_n_dec+$p_r_dec);
xlsWriteNumber(21,13,$p_returning_total+$p_new_total+$total+$returning_total);

//Emergency Output of New Patient
xlsWriteNumber(25,1,"$emergency_service_new_patient_jan");
xlsWriteNumber(26,1,"$emergency_service_new_patient_feb");
xlsWriteNumber(27,1,"$emergency_service_new_patient_mar");
xlsWriteNumber(28,1,"$emergency_service_new_patient_apr");
xlsWriteNumber(29,1,"$emergency_service_new_patient_may");
xlsWriteNumber(30,1,"$emergency_service_new_patient_jun");
xlsWriteNumber(31,1,"$emergency_service_new_patient_jul");
xlsWriteNumber(32,1,"$emergency_service_new_patient_aug");
xlsWriteNumber(33,1,"$emergency_service_new_patient_sep");
xlsWriteNumber(34,1,"$emergency_service_new_patient_oct");
xlsWriteNumber(35,1,"$emergency_service_new_patient_nov");
xlsWriteNumber(36,1,"$emergency_service_new_patient_dec");
xlsWriteNumber(37,1,"$total_emergency_service_new_patient");

//Emergency output of Percentage New Patient
xlsWriteNumber(25,2,"$percentage_emergency_service_new_patient_jan");
xlsWriteNumber(26,2,"$percentage_emergency_service_new_patient_feb");
xlsWriteNumber(27,2,"$percentage_emergency_service_new_patient_mar");
xlsWriteNumber(28,2,"$percentage_emergency_service_new_patient_apr");
xlsWriteNumber(29,2,"$percentage_emergency_service_new_patient_may");
xlsWriteNumber(30,2,"$percentage_emergency_service_new_patient_jun");
xlsWriteNumber(31,2,"$percentage_emergency_service_new_patient_jul");
xlsWriteNumber(32,2,"$percentage_emergency_service_new_patient_aug");
xlsWriteNumber(33,2,"$percentage_emergency_service_new_patient_sep");
xlsWriteNumber(34,2,"$percentage_emergency_service_new_patient_oct");
xlsWriteNumber(35,2,"$percentage_emergency_service_new_patient_nov");
xlsWriteNumber(36,2,"$percentage_emergency_service_new_patient_dec");
xlsWriteNumber(37,2,"$total_percentage_emergency_service_new_patient");

//Emergency output of Service Returning Patient
xlsWriteNumber(25,3,"$emergency_service_returning_patient_jan");
xlsWriteNumber(26,3,"$emergency_service_returning_patient_feb");
xlsWriteNumber(27,3,"$emergency_service_returning_patient_mar");
xlsWriteNumber(28,3,"$emergency_service_returning_patient_apr");
xlsWriteNumber(29,3,"$emergency_service_returning_patient_may");
xlsWriteNumber(30,3,"$emergency_service_returning_patient_jun");
xlsWriteNumber(31,3,"$emergency_service_returning_patient_jul");
xlsWriteNumber(32,3,"$emergency_service_returning_patient_aug");
xlsWriteNumber(33,3,"$emergency_service_returning_patient_sep");
xlsWriteNumber(34,3,"$emergency_service_returning_patient_oct");
xlsWriteNumber(35,3,"$emergency_service_returning_patient_nov");
xlsWriteNumber(36,3,"$emergency_service_returning_patient_dec");
xlsWriteNumber(37,3,"$total_emergency_service_returning_patient");

//Emergency output of Service Returning Patient
xlsWriteNumber(25,4,"$percentage_emergency_service_returning_patient_jan");
xlsWriteNumber(26,4,"$percentage_emergency_service_returning_patient_feb");
xlsWriteNumber(27,4,"$percentage_emergency_service_returning_patient_mar");
xlsWriteNumber(28,4,"$percentage_emergency_service_returning_patient_apr");
xlsWriteNumber(29,4,"$percentage_emergency_service_returning_patient_may");
xlsWriteNumber(30,4,"$percentage_emergency_service_returning_patient_jun");
xlsWriteNumber(31,4,"$percentage_emergency_service_returning_patient_jul");
xlsWriteNumber(32,4,"$percentage_emergency_service_returning_patient_aug");
xlsWriteNumber(33,4,"$percentage_emergency_service_returning_patient_sep");
xlsWriteNumber(34,4,"$percentage_emergency_service_returning_patient_oct");
xlsWriteNumber(35,4,"$percentage_emergency_service_returning_patient_nov");
xlsWriteNumber(36,4,"$percentage_emergency_service_returning_patient_dec");
xlsWriteNumber(37,4,"$total_percentage_emergency_service_returning_patient");


//Emergency output of Service New Patient
xlsWriteNumber(25,5,"$total_new_emergency_patient_jan");
xlsWriteNumber(26,5,"$total_new_emergency_patient_feb");
xlsWriteNumber(27,5,"$total_new_emergency_patient_mar");
xlsWriteNumber(28,5,"$total_new_emergency_patient_apr");
xlsWriteNumber(29,5,"$total_new_emergency_patient_may");
xlsWriteNumber(30,5,"$total_new_emergency_patient_jun");
xlsWriteNumber(31,5,"$total_new_emergency_patient_jul");
xlsWriteNumber(32,5,"$total_new_emergency_patient_aug");
xlsWriteNumber(33,5,"$total_new_emergency_patient_sep");
xlsWriteNumber(34,5,"$total_new_emergency_patient_oct");
xlsWriteNumber(35,5,"$total_new_emergency_patient_nov");
xlsWriteNumber(36,5,"$total_new_emergency_patient_dec");
xlsWriteNumber(37,5,"$total_emergency_service_new_patient"+"$total_emergency_service_returning_patient");

//Emergency output of Percentage New Service Patient
xlsWriteNumber(25,6,"$percentage_emergency_new_patient_jan");
xlsWriteNumber(26,6,"$percentage_emergency_new_patient_feb");
xlsWriteNumber(27,6,"$percentage_emergency_new_patient_mar");
xlsWriteNumber(28,6,"$percentage_emergency_new_patient_apr");
xlsWriteNumber(29,6,"$percentage_emergency_new_patient_may");
xlsWriteNumber(30,6,"$percentage_emergency_new_patient_jun");
xlsWriteNumber(31,6,"$percentage_emergency_new_patient_jul");
xlsWriteNumber(32,6,"$percentage_emergency_new_patient_aug");
xlsWriteNumber(33,6,"$percentage_emergency_new_patient_sep");
xlsWriteNumber(34,6,"$percentage_emergency_new_patient_oct");
xlsWriteNumber(35,6,"$percentage_emergency_new_patient_nov");
xlsWriteNumber(36,6,"$percentage_emergency_new_patient_dec");
xlsWriteNumber(37,6,"$total_percentage_emergency_new_patient");

//Emergency output of  New Private Patient
xlsWriteNumber(25,7,"$emergency_private_new_patient_jan");
xlsWriteNumber(26,7,"$emergency_private_new_patient_feb");
xlsWriteNumber(27,7,"$emergency_private_new_patient_mar");
xlsWriteNumber(28,7,"$emergency_private_new_patient_apr");
xlsWriteNumber(29,7,"$emergency_private_new_patient_may");
xlsWriteNumber(30,7,"$emergency_private_new_patient_jun");
xlsWriteNumber(31,7,"$emergency_private_new_patient_jul");
xlsWriteNumber(32,7,"$emergency_private_new_patient_aug");
xlsWriteNumber(33,7,"$emergency_private_new_patient_sep");
xlsWriteNumber(34,7,"$emergency_private_new_patient_oct");
xlsWriteNumber(35,7,"$emergency_private_new_patient_nov");
xlsWriteNumber(36,7,"$emergency_private_new_patient_dec");
xlsWriteNumber(37,7,"$total_emergency_private_new_patient");

//Emergency output of Percent of New Private Patient
xlsWriteNumber(25,8,"$percentage_emergency_private_new_patient_jan");
xlsWriteNumber(26,8,"$percentage_emergency_private_new_patient_feb");
xlsWriteNumber(27,8,"$percentage_emergency_private_new_patient_mar");
xlsWriteNumber(28,8,"$percentage_emergency_private_new_patient_apr");
xlsWriteNumber(29,8,"$percentage_emergency_private_new_patient_may");
xlsWriteNumber(30,8,"$percentage_emergency_private_new_patient_jun");
xlsWriteNumber(31,8,"$percentage_emergency_private_new_patient_jul");
xlsWriteNumber(32,8,"$percentage_emergency_private_new_patient_aug");
xlsWriteNumber(33,8,"$percentage_emergency_private_new_patient_sep");
xlsWriteNumber(34,8,"$percentage_emergency_private_new_patient_oct");
xlsWriteNumber(35,8,"$percentage_emergency_private_new_patient_nov");
xlsWriteNumber(36,8,"$percentage_emergency_private_new_patient_dec");
xlsWriteNumber(37,8,"$total_percentage_emergency_private_new_patient");

//Emergency output of  Returning Private Patient
xlsWriteNumber(25,9,"$emergency_private_returning_patient_jan");
xlsWriteNumber(26,9,"$emergency_private_returning_patient_feb");
xlsWriteNumber(27,9,"$emergency_private_returning_patient_mar");
xlsWriteNumber(28,9,"$emergency_private_returning_patient_apr");
xlsWriteNumber(29,9,"$emergency_private_returning_patient_may");
xlsWriteNumber(30,9,"$emergency_private_returning_patient_jun");
xlsWriteNumber(31,9,"$emergency_private_returning_patient_jul");
xlsWriteNumber(32,9,"$emergency_private_returning_patient_aug");
xlsWriteNumber(33,9,"$emergency_private_returning_patient_sep");
xlsWriteNumber(34,9,"$emergency_private_returning_patient_oct");
xlsWriteNumber(35,9,"$emergency_private_returning_patient_nov");
xlsWriteNumber(36,9,"$emergency_private_returning_patient_dec");
xlsWriteNumber(37,9,"$total_emergency_private_returning_patient");

//Emergency output of  Returning Private Patient
xlsWriteNumber(25,10,"$percentage_emergency_private_returning_patient_jan");
xlsWriteNumber(26,10,"$percentage_emergency_private_returning_patient_feb");
xlsWriteNumber(27,10,"$percentage_emergency_private_returning_patient_mar");
xlsWriteNumber(28,10,"$percentage_emergency_private_returning_patient_apr");
xlsWriteNumber(29,10,"$percentage_emergency_private_returning_patient_may");
xlsWriteNumber(30,10,"$percentage_emergency_private_returning_patient_jun");
xlsWriteNumber(31,10,"$percentage_emergency_private_returning_patient_jul");
xlsWriteNumber(32,10,"$percentage_emergency_private_returning_patient_aug");
xlsWriteNumber(33,10,"$percentage_emergency_private_returning_patient_sep");
xlsWriteNumber(34,10,"$percentage_emergency_private_returning_patient_oct");
xlsWriteNumber(35,10,"$percentage_emergency_private_returning_patient_nov");
xlsWriteNumber(36,10,"$percentage_emergency_private_returning_patient_dec");
xlsWriteNumber(37,10,"$total_percentage_emergency_private_returning_patient");

//Emergency output of  Returning Private Patient
xlsWriteNumber(25,11,"$total_returning_emergency_patient_jan");
xlsWriteNumber(26,11,"$total_returning_emergency_patient_feb");
xlsWriteNumber(27,11,"$total_returning_emergency_patient_mar");
xlsWriteNumber(28,11,"$total_returning_emergency_patient_apr");
xlsWriteNumber(29,11,"$total_returning_emergency_patient_may");
xlsWriteNumber(30,11,"$total_returning_emergency_patient_jun");
xlsWriteNumber(31,11,"$total_returning_emergency_patient_jul");
xlsWriteNumber(32,11,"$total_returning_emergency_patient_aug");
xlsWriteNumber(33,11,"$total_returning_emergency_patient_sep");
xlsWriteNumber(34,11,"$total_returning_emergency_patient_oct");
xlsWriteNumber(35,11,"$total_returning_emergency_patient_nov");
xlsWriteNumber(36,11,"$total_returning_emergency_patient_dec");
xlsWriteNumber(37,11,"$total_emergency_private_returning_patient");

//Emergency Percentage of Private Patients

xlsWriteNumber(25,12,"$percentage_emergency_returning_patient_jan");
xlsWriteNumber(26,12,"$percentage_emergency_returning_patient_feb");
xlsWriteNumber(27,12,"$percentage_emergency_returning_patient_mar");
xlsWriteNumber(28,12,"$percentage_emergency_returning_patient_apr");
xlsWriteNumber(29,12,"$percentage_emergency_returning_patient_may");
xlsWriteNumber(30,12,"$percentage_emergency_returning_patient_jun");
xlsWriteNumber(31,12,"$percentage_emergency_returning_patient_jul");
xlsWriteNumber(32,12,"$percentage_emergency_returning_patient_aug");
xlsWriteNumber(33,12,"$percentage_emergency_returning_patient_sep");
xlsWriteNumber(34,12,"$percentage_emergency_returning_patient_oct");
xlsWriteNumber(35,12,"$percentage_emergency_returning_patient_nov");
xlsWriteNumber(36,12,"$percentage_emergency_returning_patient_dec");
xlsWriteNumber(37,12,"$total_percentage_emergency_returning_patient");


//Emergency Grand Total
xlsWriteNumber(25,13,"$emergency_private_new_patient_jan"+"$emergency_private_returning_patient_jan"+"$emergency_service_new_patient_jan"+"$emergency_service_returning_patient_jan");
xlsWriteNumber(26,13,"$emergency_private_new_patient_feb"+"$emergency_private_returning_patient_feb"+"$emergency_service_new_patient_feb"+"$emergency_service_returning_patient_feb");
xlsWriteNumber(27,13,"$emergency_private_new_patient_mar"+"$emergency_private_returning_patient_mar"+"$emergency_service_new_patient_mar"+"$emergency_service_returning_patient_mar");
xlsWriteNumber(28,13,"$emergency_private_new_patient_apr"+"$emergency_private_returning_patient_apr"+"$emergency_service_new_patient_apr"+"$emergency_service_returning_patient_apr");
xlsWriteNumber(29,13,"$emergency_private_new_patient_may"+"$emergency_private_returning_patient_may"+"$emergency_service_new_patient_may"+"$emergency_service_returning_patient_may");
xlsWriteNumber(30,13,"$emergency_private_new_patient_jun"+"$emergency_private_returning_patient_jun"+"$emergency_service_new_patient_jun"+"$emergency_service_returning_patient_jun");
xlsWriteNumber(31,13,"$emergency_private_new_patient_jul"+"$emergency_private_returning_patient_jul"+"$emergency_service_new_patient_jul"+"$emergency_service_returning_patient_jul");
xlsWriteNumber(32,13,"$emergency_private_new_patient_aug"+"$emergency_private_returning_patient_aug"+"$emergency_service_new_patient_aug"+"$emergency_service_returning_patient_aug");
xlsWriteNumber(33,13,"$emergency_private_new_patient_sep"+"$emergency_private_returning_patient_sep"+"$emergency_service_new_patient_sep"+"$emergency_service_returning_patient_sep");
xlsWriteNumber(34,13,"$emergency_private_new_patient_oct"+"$emergency_private_returning_patient_oct"+"$emergency_service_new_patient_oct"+"$emergency_service_returning_patient_oct");
xlsWriteNumber(35,13,"$emergency_private_new_patient_nov"+"$emergency_private_returning_patient_nov"+"$emergency_service_new_patient_nov"+"$emergency_service_returning_patient_nov");
xlsWriteNumber(36,13,"$emergency_private_new_patient_dec"+"$emergency_private_returning_patient_dec"+"$emergency_service_new_patient_dec"+"$emergency_service_returning_patient_dec");
xlsWriteNumber(37,13,"$grand_total_emergency");

//In patient Output
xlsWriteNumber(41,1,"$in_patient_service_new_patient_jan");
xlsWriteNumber(42,1,"$in_patient_service_new_patient_feb");
xlsWriteNumber(43,1,"$in_patient_service_new_patient_mar");
xlsWriteNumber(44,1,"$in_patient_service_new_patient_apr");
xlsWriteNumber(45,1,"$in_patient_service_new_patient_may");
xlsWriteNumber(46,1,"$in_patient_service_new_patient_jun");
xlsWriteNumber(47,1,"$in_patient_service_new_patient_jul");
xlsWriteNumber(48,1,"$in_patient_service_new_patient_aug");
xlsWriteNumber(49,1,"$in_patient_service_new_patient_sep");
xlsWriteNumber(50,1,"$in_patient_service_new_patient_oct");
xlsWriteNumber(51,1,"$in_patient_service_new_patient_nov");
xlsWriteNumber(52,1,"$in_patient_service_new_patient_dec");
xlsWriteNumber(53,1,"$total_in_patient_service_new_patient");

xlsWriteNumber(41,2,"$percentage_in_patient_service_new_patient_jan");
xlsWriteNumber(42,2,"$percentage_in_patient_service_new_patient_feb");
xlsWriteNumber(43,2,"$percentage_in_patient_service_new_patient_mar");
xlsWriteNumber(44,2,"$percentage_in_patient_service_new_patient_apr");
xlsWriteNumber(45,2,"$percentage_in_patient_service_new_patient_may");
xlsWriteNumber(46,2,"$percentage_in_patient_service_new_patient_jun");
xlsWriteNumber(47,2,"$percentage_in_patient_service_new_patient_jul");
xlsWriteNumber(48,2,"$percentage_in_patient_service_new_patient_aug");
xlsWriteNumber(49,2,"$percentage_in_patient_service_new_patient_sep");
xlsWriteNumber(50,2,"$percentage_in_patient_service_new_patient_oct");
xlsWriteNumber(51,2,"$percentage_in_patient_service_new_patient_nov");
xlsWriteNumber(52,2,"$percentage_in_patient_service_new_patient_dec");
xlsWriteNumber(53,2,"$total_percentage_in_patient_service_new_patient");

xlsWriteNumber(41,3,"$in_patient_service_returning_patient_jan");
xlsWriteNumber(42,3,"$in_patient_service_returning_patient_feb");
xlsWriteNumber(43,3,"$in_patient_service_returning_patient_mar");
xlsWriteNumber(44,3,"$in_patient_service_returning_patient_apr");
xlsWriteNumber(45,3,"$in_patient_service_returning_patient_may");
xlsWriteNumber(46,3,"$in_patient_service_returning_patient_jun");
xlsWriteNumber(47,3,"$in_patient_service_returning_patient_jul");
xlsWriteNumber(48,3,"$in_patient_service_returning_patient_aug");
xlsWriteNumber(49,3,"$in_patient_service_returning_patient_sep");
xlsWriteNumber(50,3,"$in_patient_service_returning_patient_oct");
xlsWriteNumber(51,3,"$in_patient_service_returning_patient_nov");
xlsWriteNumber(52,3,"$in_patient_service_returning_patient_dec");
xlsWriteNumber(53,3,"$total_in_patient_service_returning_patient");

xlsWriteNumber(41,4,"$percentage_in_patient_service_returning_patient_jan");
xlsWriteNumber(42,4,"$percentage_in_patient_service_returning_patient_feb");
xlsWriteNumber(43,4,"$percentage_in_patient_service_returning_patient_mar");
xlsWriteNumber(44,4,"$percentage_in_patient_service_returning_patient_apr");
xlsWriteNumber(45,4,"$percentage_in_patient_service_returning_patient_may");
xlsWriteNumber(46,4,"$percentage_in_patient_service_returning_patient_jun");
xlsWriteNumber(47,4,"$percentage_in_patient_service_returning_patient_jul");
xlsWriteNumber(48,4,"$percentage_in_patient_service_returning_patient_aug");
xlsWriteNumber(49,4,"$percentage_in_patient_service_returning_patient_sep");
xlsWriteNumber(50,4,"$percentage_in_patient_service_returning_patient_oct");
xlsWriteNumber(51,4,"$percentage_in_patient_service_returning_patient_nov");
xlsWriteNumber(52,4,"$percentage_in_patient_service_returning_patient_dec");
xlsWriteNumber(53,4,"$total_percentage_in_patient_service_returning_patient");

xlsWriteNumber(41,5,"$in_patient_service_new_patient_jan"+"$in_patient_service_returning_patient_jan");
xlsWriteNumber(42,5,"$in_patient_service_new_patient_feb"+"$in_patient_service_returning_patient_feb");
xlsWriteNumber(43,5,"$in_patient_service_new_patient_mar"+"$in_patient_service_returning_patient_mar");
xlsWriteNumber(44,5,"$in_patient_service_new_patient_apr"+"$in_patient_service_returning_patient_apr");
xlsWriteNumber(45,5,"$in_patient_service_new_patient_may"+"$in_patient_service_returning_patient_may");
xlsWriteNumber(46,5,"$in_patient_service_new_patient_jun"+"$in_patient_service_returning_patient_jun");
xlsWriteNumber(47,5,"$in_patient_service_new_patient_jul"+"$in_patient_service_returning_patient_jul");
xlsWriteNumber(48,5,"$in_patient_service_new_patient_aug"+"$in_patient_service_returning_patient_aug");
xlsWriteNumber(49,5,"$in_patient_service_new_patient_sep"+"$in_patient_service_returning_patient_sep");
xlsWriteNumber(50,5,"$in_patient_service_new_patient_oct"+"$in_patient_service_returning_patient_oct");
xlsWriteNumber(51,5,"$in_patient_service_new_patient_nov"+"$in_patient_service_returning_patient_nov");
xlsWriteNumber(52,5,"$in_patient_service_new_patient_dec"+"$in_patient_service_returning_patient_dec");
xlsWriteNumber(53,5,"$total_in_patient_service_new_patient"+"$total_in_patient_service_returning_patient");

xlsWriteNumber(41,6,"$percentage_in_patient_returning_patient_jan");
xlsWriteNumber(42,6,"$percentage_in_patient_returning_patient_feb");
xlsWriteNumber(43,6,"$percentage_in_patient_returning_patient_mar");
xlsWriteNumber(44,6,"$percentage_in_patient_returning_patient_apr");
xlsWriteNumber(45,6,"$percentage_in_patient_returning_patient_may");
xlsWriteNumber(46,6,"$percentage_in_patient_returning_patient_jun");
xlsWriteNumber(47,6,"$percentage_in_patient_returning_patient_jul");
xlsWriteNumber(48,6,"$percentage_in_patient_returning_patient_aug");
xlsWriteNumber(49,6,"$percentage_in_patient_returning_patient_sep");
xlsWriteNumber(50,6,"$percentage_in_patient_returning_patient_oct");
xlsWriteNumber(51,6,"$percentage_in_patient_returning_patient_nov");
xlsWriteNumber(52,6,"$percentage_in_patient_returning_patient_dec");
xlsWriteNumber(53,6,"$total_percentage_in_patient_new_patient");

xlsWriteNumber(41,7,"$in_patient_private_new_patient_jan");
xlsWriteNumber(42,7,"$in_patient_private_new_patient_feb");
xlsWriteNumber(43,7,"$in_patient_private_new_patient_mar");
xlsWriteNumber(44,7,"$in_patient_private_new_patient_apr");
xlsWriteNumber(45,7,"$in_patient_private_new_patient_may");
xlsWriteNumber(46,7,"$in_patient_private_new_patient_jun");
xlsWriteNumber(47,7,"$in_patient_private_new_patient_jul");
xlsWriteNumber(48,7,"$in_patient_private_new_patient_aug");
xlsWriteNumber(49,7,"$in_patient_private_new_patient_sep");
xlsWriteNumber(50,7,"$in_patient_private_new_patient_oct");
xlsWriteNumber(51,7,"$in_patient_private_new_patient_nov");
xlsWriteNumber(52,7,"$in_patient_private_new_patient_dec");
xlsWriteNumber(53,7,"$total_in_patient_private_new_patient");

xlsWriteNumber(41,8,"$percentage_in_patient_private_new_patient_jan");
xlsWriteNumber(42,8,"$percentage_in_patient_private_new_patient_feb");
xlsWriteNumber(43,8,"$percentage_in_patient_private_new_patient_mar");
xlsWriteNumber(44,8,"$percentage_in_patient_private_new_patient_apr");
xlsWriteNumber(45,8,"$percentage_in_patient_private_new_patient_may");
xlsWriteNumber(46,8,"$percentage_in_patient_private_new_patient_jun");
xlsWriteNumber(47,8,"$percentage_in_patient_private_new_patient_jul");
xlsWriteNumber(48,8,"$percentage_in_patient_private_new_patient_aug");
xlsWriteNumber(49,8,"$percentage_in_patient_private_new_patient_sep");
xlsWriteNumber(50,8,"$percentage_in_patient_private_new_patient_oct");
xlsWriteNumber(51,8,"$percentage_in_patient_private_new_patient_nov");
xlsWriteNumber(52,8,"$percentage_in_patient_private_new_patient_dec");
xlsWriteNumber(53,8,"$total_percentage_in_patient_private_new_patient");

xlsWriteNumber(41,9,"$in_patient_private_returning_patient_jan");
xlsWriteNumber(42,9,"$in_patient_private_returning_patient_feb");
xlsWriteNumber(43,9,"$in_patient_private_returning_patient_mar");
xlsWriteNumber(44,9,"$in_patient_private_returning_patient_apr");
xlsWriteNumber(45,9,"$in_patient_private_returning_patient_may");
xlsWriteNumber(46,9,"$in_patient_private_returning_patient_jun");
xlsWriteNumber(47,9,"$in_patient_private_returning_patient_jul");
xlsWriteNumber(48,9,"$in_patient_private_returning_patient_aug");
xlsWriteNumber(49,9,"$in_patient_private_returning_patient_sep");
xlsWriteNumber(50,9,"$in_patient_private_returning_patient_oct");
xlsWriteNumber(51,9,"$in_patient_private_returning_patient_nov");
xlsWriteNumber(52,9,"$in_patient_private_returning_patient_dec");
xlsWriteNumber(53,9,"$total_in_patient_private_returning_patient");

xlsWriteNumber(41,10,"$percentage_in_patient_private_returning_patient_jan");
xlsWriteNumber(42,10,"$percentage_in_patient_private_returning_patient_feb");
xlsWriteNumber(43,10,"$percentage_in_patient_private_returning_patient_mar");
xlsWriteNumber(44,10,"$percentage_in_patient_private_returning_patient_apr");
xlsWriteNumber(45,10,"$percentage_in_patient_private_returning_patient_may");
xlsWriteNumber(46,10,"$percentage_in_patient_private_returning_patient_jun");
xlsWriteNumber(47,10,"$percentage_in_patient_private_returning_patient_jul");
xlsWriteNumber(48,10,"$percentage_in_patient_private_returning_patient_aug");
xlsWriteNumber(49,10,"$percentage_in_patient_private_returning_patient_sep");
xlsWriteNumber(50,10,"$percentage_in_patient_private_returning_patient_oct");
xlsWriteNumber(51,10,"$percentage_in_patient_private_returning_patient_nov");
xlsWriteNumber(52,10,"$percentage_in_patient_private_returning_patient_dec");
xlsWriteNumber(53,10,"$total_percentage_in_patient_private_returning_patient");

xlsWriteNumber(41,11,"$in_patient_private_new_patient_jan"+"$in_patient_private_returning_patient_jan");
xlsWriteNumber(42,11,"$in_patient_private_new_patient_feb"+"$in_patient_private_returning_patient_feb");
xlsWriteNumber(43,11,"$in_patient_private_new_patient_mar"+"$in_patient_private_returning_patient_mar");
xlsWriteNumber(44,11,"$in_patient_private_new_patient_apr"+"$in_patient_private_returning_patient_apr");
xlsWriteNumber(45,11,"$in_patient_private_new_patient_may"+"$in_patient_private_returning_patient_may");
xlsWriteNumber(46,11,"$in_patient_private_new_patient_jun"+"$in_patient_private_returning_patient_jun");
xlsWriteNumber(47,11,"$in_patient_private_new_patient_jul"+"$in_patient_private_returning_patient_jul");
xlsWriteNumber(48,11,"$in_patient_private_new_patient_aug"+"$in_patient_private_returning_patient_aug");
xlsWriteNumber(49,11,"$in_patient_private_new_patient_sep"+"$in_patient_private_returning_patient_sep");
xlsWriteNumber(50,11,"$in_patient_private_new_patient_oct"+"$in_patient_private_returning_patient_oct");
xlsWriteNumber(51,11,"$in_patient_private_new_patient_nov"+"$in_patient_private_returning_patient_nov");
xlsWriteNumber(52,11,"$in_patient_private_new_patient_dec"+"$in_patient_private_returning_patient_dec");
xlsWriteNumber(53,11,"$total_in_patient_private_returning_patient"+"$total_in_patient_private_new_patient");

xlsWriteNumber(41,12,"$percentage_in_patient_returning_patient_jan");
xlsWriteNumber(42,12,"$percentage_in_patient_returning_patient_feb");
xlsWriteNumber(43,12,"$percentage_in_patient_returning_patient_mar");
xlsWriteNumber(44,12,"$percentage_in_patient_returning_patient_apr");
xlsWriteNumber(45,12,"$percentage_in_patient_returning_patient_may");
xlsWriteNumber(46,12,"$percentage_in_patient_returning_patient_jun");
xlsWriteNumber(47,12,"$percentage_in_patient_returning_patient_jul");
xlsWriteNumber(48,12,"$percentage_in_patient_returning_patient_aug");
xlsWriteNumber(49,12,"$percentage_in_patient_returning_patient_sep");
xlsWriteNumber(50,12,"$percentage_in_patient_returning_patient_oct");
xlsWriteNumber(51,12,"$percentage_in_patient_returning_patient_nov");
xlsWriteNumber(52,12,"$percentage_in_patient_returning_patient_dec");
xlsWriteNumber(53,12,"$total_percentage_in_patient_returning_patient");

xlsWriteNumber(41,13,"$in_patient_private_new_patient_jan"+"$in_patient_private_returning_patient_jan"+"$in_patient_service_new_patient_jan"+"$in_patient_service_returning_patient_jan");
xlsWriteNumber(42,13,"$in_patient_private_new_patient_feb"+"$in_patient_private_returning_patient_feb"+"$in_patient_service_new_patient_feb"+"$in_patient_service_returning_patient_feb");
xlsWriteNumber(43,13,"$in_patient_private_new_patient_mar"+"$in_patient_private_returning_patient_mar"+"$in_patient_service_new_patient_mar"+"$in_patient_service_returning_patient_mar");
xlsWriteNumber(44,13,"$in_patient_private_new_patient_apr"+"$in_patient_private_returning_patient_apr"+"$in_patient_service_new_patient_apr"+"$in_patient_service_returning_patient_apr");
xlsWriteNumber(45,13,"$in_patient_private_new_patient_may"+"$in_patient_private_returning_patient_may"+"$in_patient_service_new_patient_may"+"$in_patient_service_returning_patient_may");
xlsWriteNumber(46,13,"$in_patient_private_new_patient_jun"+"$in_patient_private_returning_patient_jun"+"$in_patient_service_new_patient_jun"+"$in_patient_service_returning_patient_jun");
xlsWriteNumber(47,13,"$in_patient_private_new_patient_jul"+"$in_patient_private_returning_patient_jul"+"$in_patient_service_new_patient_jul"+"$in_patient_service_returning_patient_jul");
xlsWriteNumber(48,13,"$in_patient_private_new_patient_aug"+"$in_patient_private_returning_patient_aug"+"$in_patient_service_new_patient_aug"+"$in_patient_service_returning_patient_aug");
xlsWriteNumber(49,13,"$in_patient_private_new_patient_sep"+"$in_patient_private_returning_patient_sep"+"$in_patient_service_new_patient_sep"+"$in_patient_service_returning_patient_sep");
xlsWriteNumber(50,13,"$in_patient_private_new_patient_oct"+"$in_patient_private_returning_patient_oct"+"$in_patient_service_new_patient_oct"+"$in_patient_service_returning_patient_oct");
xlsWriteNumber(51,13,"$in_patient_private_new_patient_nov"+"$in_patient_private_returning_patient_nov"+"$in_patient_service_new_patient_nov"+"$in_patient_service_returning_patient_nov");
xlsWriteNumber(52,13,"$in_patient_private_new_patient_dec"+"$in_patient_private_returning_patient_dec"+"$in_patient_service_new_patient_dec"+"$in_patient_service_returning_patient_dec");
xlsWriteNumber(53,13,"$grand_total_in_patient");

// admission Output
xlsWriteNumber(57,1,"$admission_service_new_patient_jan");
xlsWriteNumber(58,1,"$admission_service_new_patient_feb");
xlsWriteNumber(59,1,"$admission_service_new_patient_mar");
xlsWriteNumber(60,1,"$admission_service_new_patient_apr");
xlsWriteNumber(61,1,"$admission_service_new_patient_may");
xlsWriteNumber(62,1,"$admission_service_new_patient_jun");
xlsWriteNumber(63,1,"$admission_service_new_patient_jul");
xlsWriteNumber(64,1,"$admission_service_new_patient_aug");
xlsWriteNumber(65,1,"$admission_service_new_patient_sep");
xlsWriteNumber(66,1,"$admission_service_new_patient_oct");
xlsWriteNumber(67,1,"$admission_service_new_patient_nov");
xlsWriteNumber(68,1,"$admission_service_new_patient_dec");
xlsWriteNumber(69,1,"$total_admission_service_new_patient");

xlsWriteNumber(57,2,"$percentage_admission_service_new_patient_jan");
xlsWriteNumber(58,2,"$percentage_admission_service_new_patient_feb");
xlsWriteNumber(59,2,"$percentage_admission_service_new_patient_mar");
xlsWriteNumber(60,2,"$percentage_admission_service_new_patient_apr");
xlsWriteNumber(61,2,"$percentage_admission_service_new_patient_may");
xlsWriteNumber(62,2,"$percentage_admission_service_new_patient_jun");
xlsWriteNumber(63,2,"$percentage_admission_service_new_patient_jul");
xlsWriteNumber(64,2,"$percentage_admission_service_new_patient_aug");
xlsWriteNumber(65,2,"$percentage_admission_service_new_patient_sep");
xlsWriteNumber(66,2,"$percentage_admission_service_new_patient_oct");
xlsWriteNumber(67,2,"$percentage_admission_service_new_patient_nov");
xlsWriteNumber(68,2,"$percentage_admission_service_new_patient_dec");
xlsWriteNumber(69,2,"$total_percentage_admission_service_new_patient");

xlsWriteNumber(57,3,"$admission_service_returning_patient_jan");
xlsWriteNumber(58,3,"$admission_service_returning_patient_feb");
xlsWriteNumber(59,3,"$admission_service_returning_patient_mar");
xlsWriteNumber(60,3,"$admission_service_returning_patient_apr");
xlsWriteNumber(61,3,"$admission_service_returning_patient_may");
xlsWriteNumber(62,3,"$admission_service_returning_patient_jun");
xlsWriteNumber(63,3,"$admission_service_returning_patient_jul");
xlsWriteNumber(64,3,"$admission_service_returning_patient_aug");
xlsWriteNumber(65,3,"$admission_service_returning_patient_sep");
xlsWriteNumber(66,3,"$admission_service_returning_patient_oct");
xlsWriteNumber(67,3,"$admission_service_returning_patient_nov");
xlsWriteNumber(68,3,"$admission_service_returning_patient_dec");
xlsWriteNumber(69,3,"$total_admission_service_returning_patient");

xlsWriteNumber(57,4,"$percentage_admission_service_returning_patient_jan");
xlsWriteNumber(58,4,"$percentage_admission_service_returning_patient_feb");
xlsWriteNumber(59,4,"$percentage_admission_service_returning_patient_mar");
xlsWriteNumber(60,4,"$percentage_admission_service_returning_patient_apr");
xlsWriteNumber(61,4,"$percentage_admission_service_returning_patient_may");
xlsWriteNumber(62,4,"$percentage_admission_service_returning_patient_jun");
xlsWriteNumber(63,4,"$percentage_admission_service_returning_patient_jul");
xlsWriteNumber(64,4,"$percentage_admission_service_returning_patient_aug");
xlsWriteNumber(65,4,"$percentage_admission_service_returning_patient_sep");
xlsWriteNumber(66,4,"$percentage_admission_service_returning_patient_oct");
xlsWriteNumber(67,4,"$percentage_admission_service_returning_patient_nov");
xlsWriteNumber(68,4,"$percentage_admission_service_returning_patient_dec");
xlsWriteNumber(69,4,"$total_percentage_admission_service_returning_patient");

xlsWriteNumber(57,5,"$admission_service_new_patient_jan"+"$admission_service_returning_patient_jan");
xlsWriteNumber(58,5,"$admission_service_new_patient_feb"+"$admission_service_returning_patient_feb");
xlsWriteNumber(59,5,"$admission_service_new_patient_mar"+"$admission_service_returning_patient_mar");
xlsWriteNumber(60,5,"$admission_service_new_patient_apr"+"$admission_service_returning_patient_apr");
xlsWriteNumber(61,5,"$admission_service_new_patient_may"+"$admission_service_returning_patient_may");
xlsWriteNumber(62,5,"$admission_service_new_patient_jun"+"$admission_service_returning_patient_jun");
xlsWriteNumber(63,5,"$admission_service_new_patient_jul"+"$admission_service_returning_patient_jul");
xlsWriteNumber(64,5,"$admission_service_new_patient_aug"+"$admission_service_returning_patient_aug");
xlsWriteNumber(65,5,"$admission_service_new_patient_sep"+"$admission_service_returning_patient_sep");
xlsWriteNumber(66,5,"$admission_service_new_patient_oct"+"$admission_service_returning_patient_oct");
xlsWriteNumber(67,5,"$admission_service_new_patient_nov"+"$admission_service_returning_patient_nov");
xlsWriteNumber(68,5,"$admission_service_new_patient_dec"+"$admission_service_returning_patient_dec");
xlsWriteNumber(69,5,"$total_admission_service_new_patient"+"$total_admission_service_returning_patient");

xlsWriteNumber(57,6,"$percentage_admission_returning_patient_jan");
xlsWriteNumber(58,6,"$percentage_admission_returning_patient_feb");
xlsWriteNumber(59,6,"$percentage_admission_returning_patient_mar");
xlsWriteNumber(60,6,"$percentage_admission_returning_patient_apr");
xlsWriteNumber(61,6,"$percentage_admission_returning_patient_may");
xlsWriteNumber(62,6,"$percentage_admission_returning_patient_jun");
xlsWriteNumber(63,6,"$percentage_admission_returning_patient_jul");
xlsWriteNumber(64,6,"$percentage_admission_returning_patient_aug");
xlsWriteNumber(65,6,"$percentage_admission_returning_patient_sep");
xlsWriteNumber(66,6,"$percentage_admission_returning_patient_oct");
xlsWriteNumber(67,6,"$percentage_admission_returning_patient_nov");
xlsWriteNumber(68,6,"$percentage_admission_returning_patient_dec");
xlsWriteNumber(69,6,"$total_percentage_admission_new_patient");

xlsWriteNumber(57,7,"$admission_private_new_patient_jan");
xlsWriteNumber(58,7,"$admission_private_new_patient_feb");
xlsWriteNumber(59,7,"$admission_private_new_patient_mar");
xlsWriteNumber(60,7,"$admission_private_new_patient_apr");
xlsWriteNumber(61,7,"$admission_private_new_patient_may");
xlsWriteNumber(62,7,"$admission_private_new_patient_jun");
xlsWriteNumber(63,7,"$admission_private_new_patient_jul");
xlsWriteNumber(64,7,"$admission_private_new_patient_aug");
xlsWriteNumber(65,7,"$admission_private_new_patient_sep");
xlsWriteNumber(66,7,"$admission_private_new_patient_oct");
xlsWriteNumber(67,7,"$admission_private_new_patient_nov");
xlsWriteNumber(68,7,"$admission_private_new_patient_dec");
xlsWriteNumber(69,7,"$total_admission_private_new_patient");

xlsWriteNumber(57,8,"$percentage_admission_private_new_patient_jan");
xlsWriteNumber(58,8,"$percentage_admission_private_new_patient_feb");
xlsWriteNumber(59,8,"$percentage_admission_private_new_patient_mar");
xlsWriteNumber(60,8,"$percentage_admission_private_new_patient_apr");
xlsWriteNumber(61,8,"$percentage_admission_private_new_patient_may");
xlsWriteNumber(62,8,"$percentage_admission_private_new_patient_jun");
xlsWriteNumber(63,8,"$percentage_admission_private_new_patient_jul");
xlsWriteNumber(64,8,"$percentage_admission_private_new_patient_aug");
xlsWriteNumber(65,8,"$percentage_admission_private_new_patient_sep");
xlsWriteNumber(66,8,"$percentage_admission_private_new_patient_oct");
xlsWriteNumber(67,8,"$percentage_admission_private_new_patient_nov");
xlsWriteNumber(68,8,"$percentage_admission_private_new_patient_dec");
xlsWriteNumber(69,8,"$total_percentage_admission_private_new_patient");

xlsWriteNumber(57,9,"$admission_private_returning_patient_jan");
xlsWriteNumber(58,9,"$admission_private_returning_patient_feb");
xlsWriteNumber(59,9,"$admission_private_returning_patient_mar");
xlsWriteNumber(60,9,"$admission_private_returning_patient_apr");
xlsWriteNumber(61,9,"$admission_private_returning_patient_may");
xlsWriteNumber(62,9,"$admission_private_returning_patient_jun");
xlsWriteNumber(63,9,"$admission_private_returning_patient_jul");
xlsWriteNumber(64,9,"$admission_private_returning_patient_aug");
xlsWriteNumber(65,9,"$admission_private_returning_patient_sep");
xlsWriteNumber(66,9,"$admission_private_returning_patient_oct");
xlsWriteNumber(67,9,"$admission_private_returning_patient_nov");
xlsWriteNumber(68,9,"$admission_private_returning_patient_dec");
xlsWriteNumber(69,9,"$total_admission_private_returning_patient");

xlsWriteNumber(57,10,"$percentage_admission_private_returning_patient_jan");
xlsWriteNumber(58,10,"$percentage_admission_private_returning_patient_feb");
xlsWriteNumber(59,10,"$percentage_admission_private_returning_patient_mar");
xlsWriteNumber(60,10,"$percentage_admission_private_returning_patient_apr");
xlsWriteNumber(61,10,"$percentage_admission_private_returning_patient_may");
xlsWriteNumber(62,10,"$percentage_admission_private_returning_patient_jun");
xlsWriteNumber(63,10,"$percentage_admission_private_returning_patient_jul");
xlsWriteNumber(64,10,"$percentage_admission_private_returning_patient_aug");
xlsWriteNumber(65,10,"$percentage_admission_private_returning_patient_sep");
xlsWriteNumber(66,10,"$percentage_admission_private_returning_patient_oct");
xlsWriteNumber(67,10,"$percentage_admission_private_returning_patient_nov");
xlsWriteNumber(68,10,"$percentage_admission_private_returning_patient_dec");
xlsWriteNumber(69,10,"$total_percentage_admission_private_returning_patient");

xlsWriteNumber(57,11,"$admission_private_new_patient_jan"+"$admission_private_returning_patient_jan");
xlsWriteNumber(58,11,"$admission_private_new_patient_feb"+"$admission_private_returning_patient_feb");
xlsWriteNumber(59,11,"$admission_private_new_patient_mar"+"$admission_private_returning_patient_mar");
xlsWriteNumber(60,11,"$admission_private_new_patient_apr"+"$admission_private_returning_patient_apr");
xlsWriteNumber(61,11,"$admission_private_new_patient_may"+"$admission_private_returning_patient_may");
xlsWriteNumber(62,11,"$admission_private_new_patient_jun"+"$admission_private_returning_patient_jun");
xlsWriteNumber(63,11,"$admission_private_new_patient_jul"+"$admission_private_returning_patient_jul");
xlsWriteNumber(64,11,"$admission_private_new_patient_aug"+"$admission_private_returning_patient_aug");
xlsWriteNumber(65,11,"$admission_private_new_patient_sep"+"$admission_private_returning_patient_sep");
xlsWriteNumber(66,11,"$admission_private_new_patient_oct"+"$admission_private_returning_patient_oct");
xlsWriteNumber(67,11,"$admission_private_new_patient_nov"+"$admission_private_returning_patient_nov");
xlsWriteNumber(68,11,"$admission_private_new_patient_dec"+"$admission_private_returning_patient_dec");
xlsWriteNumber(69,11,"$total_admission_private_returning_patient"+"$total_admission_private_new_patient");

xlsWriteNumber(57,12,"$percentage_admission_returning_patient_jan");
xlsWriteNumber(58,12,"$percentage_admission_returning_patient_feb");
xlsWriteNumber(59,12,"$percentage_admission_returning_patient_mar");
xlsWriteNumber(60,12,"$percentage_admission_returning_patient_apr");
xlsWriteNumber(61,12,"$percentage_admission_returning_patient_may");
xlsWriteNumber(62,12,"$percentage_admission_returning_patient_jun");
xlsWriteNumber(63,12,"$percentage_admission_returning_patient_jul");
xlsWriteNumber(64,12,"$percentage_admission_returning_patient_aug");
xlsWriteNumber(65,12,"$percentage_admission_returning_patient_sep");
xlsWriteNumber(66,12,"$percentage_admission_returning_patient_oct");
xlsWriteNumber(67,12,"$percentage_admission_returning_patient_nov");
xlsWriteNumber(68,12,"$percentage_admission_returning_patient_dec");
xlsWriteNumber(69,12,"$total_percentage_admission_returning_patient");

xlsWriteNumber(57,13,"$admission_private_new_patient_jan"+"$admission_private_returning_patient_jan"+"$admission_service_new_patient_jan"+"$admission_service_returning_patient_jan");
xlsWriteNumber(58,13,"$admission_private_new_patient_feb"+"$admission_private_returning_patient_feb"+"$admission_service_new_patient_feb"+"$admission_service_returning_patient_feb");
xlsWriteNumber(59,13,"$admission_private_new_patient_mar"+"$admission_private_returning_patient_mar"+"$admission_service_new_patient_mar"+"$admission_service_returning_patient_mar");
xlsWriteNumber(60,13,"$admission_private_new_patient_apr"+"$admission_private_returning_patient_apr"+"$admission_service_new_patient_apr"+"$admission_service_returning_patient_apr");
xlsWriteNumber(61,13,"$admission_private_new_patient_may"+"$admission_private_returning_patient_may"+"$admission_service_new_patient_may"+"$admission_service_returning_patient_may");
xlsWriteNumber(62,13,"$admission_private_new_patient_jun"+"$admission_private_returning_patient_jun"+"$admission_service_new_patient_jun"+"$admission_service_returning_patient_jun");
xlsWriteNumber(63,13,"$admission_private_new_patient_jul"+"$admission_private_returning_patient_jul"+"$admission_service_new_patient_jul"+"$admission_service_returning_patient_jul");
xlsWriteNumber(64,13,"$admission_private_new_patient_aug"+"$admission_private_returning_patient_aug"+"$admission_service_new_patient_aug"+"$admission_service_returning_patient_aug");
xlsWriteNumber(65,13,"$admission_private_new_patient_sep"+"$admission_private_returning_patient_sep"+"$admission_service_new_patient_sep"+"$admission_service_returning_patient_sep");
xlsWriteNumber(66,13,"$admission_private_new_patient_oct"+"$admission_private_returning_patient_oct"+"$admission_service_new_patient_oct"+"$admission_service_returning_patient_oct");
xlsWriteNumber(67,13,"$admission_private_new_patient_nov"+"$admission_private_returning_patient_nov"+"$admission_service_new_patient_nov"+"$admission_service_returning_patient_nov");
xlsWriteNumber(68,13,"$admission_private_new_patient_dec"+"$admission_private_returning_patient_dec"+"$admission_service_new_patient_dec"+"$admission_service_returning_patient_dec");
xlsWriteNumber(69,13,"$grand_total_admission");

$xlsRow++;
xlsEOF();
exit();
?>