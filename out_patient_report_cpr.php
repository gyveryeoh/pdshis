<?php
include("connection/connection.php");
$result = "SELECT patients_info.id as pi_id,
		      out_patient.id as out_id,
		      out_patient.users_id,
		      hospital_id,
		      consultation_date,
		      registration_status,
		      histopath_number,
		      admission,
		      notes,
		      patients_info.lastname as pi_lname,
		      patients_info.firstname as pi_fname,
		      patients_info.middle_initials as pi_mi,
		      age,gender,contact_number,address,municipality_id,province_id,
		      users.id as u_id,
		      users.lastname as u_lname,
		      users.firstname as u_fname,
		      users.middle_initials as u_mi,
		      consultants.lastname as cons_lname,
		      consultants.firstname as cons_fname,
		      consultants.middle_initials as cons_mi
		      from patients_info,out_patient,users,consultants where
		      patients_info.id = out_patient.patients_info_id
		      and out_patient.users_id = users.id
		      and out_patient.consultant_id = consultants.id
		      and consultation_date between '2001-12-07' and '2010-06-04'";
		      $results = mysql_query($result);

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
header("Content-Disposition: attachment;filename=out_patient_cpr_$date.xls");
header("Content-Transfer-Encoding: binary ");

xlsBOF();
xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");
xlsWriteLabel(1,0,"RESIDENT'S LOGBOOK - OUT PATIENT CLINIC(MAIN)");
xlsWriteLabel(0,0,"PHILIPPINE DERMATOLOGICAL SOCIETY");

// Make column labels. (at line 4)
xlsWriteLabel(1,0,"RESIDENT'S LOGBOOK - OUT PATIENT CLINIC(MAIN)");
xlsWriteLabel(2,0,"HIS Form IA");
xlsWriteLabel(4,0,"PDS Institution");
xlsWriteLabel(5,0,"inclusive dates : ".$_GET['datestart']."-".$_GET['enddate'],"");
xlsWriteLabel(7,0, "Derm Registry No.");
xlsWriteLabel(7,1, "Consultation Date");
xlsWriteLabel(7,2, "Hospital / Clinic OPD ID No.");
xlsWriteLabel(7,3, "Derm Resident");
xlsWriteLabel(7,4, "Consultant");
xlsWriteLabel(7,5, "Registration Status");
xlsWriteLabel(7,6, "Lastname");
xlsWriteLabel(7,7, "Firstname");
xlsWriteLabel(7,8, "Middle Initials");
xlsWriteLabel(7,9, "Age");
xlsWriteLabel(7,10, "Gender");
xlsWriteLabel(7,11, "Telephone");
xlsWriteLabel(7,12, "Address");
xlsWriteLabel(7,13, "Municipality");
xlsWriteLabel(7,14, "Province");


$header=mysql_query("SELECT consultation_date,out_patient_id,count(*) as count from out_patient_details,out_patient
		    where out_patient.id = out_patient_details.out_patient_id
		    and consultation_date between '2003-06-03' and '2010-06-04' group by out_patient_id order by count DESC Limit 1");
$data = mysql_fetch_array($header);
    $total =  $data['count'];
 if ($total == "11"){$comor = "32"; 	$m_plan = "42"; 	$proc = "38"; $histo = "41";	$o = "44";	$histo_num = "68"; $admission = "69";$n = "70";}
 if ($total == "10"){$comor = "29"; 	$m_plan = "38"; 	$proc = "35"; $histo = "38"; 	$o = "41";	$histo_num = "65"; $admission = "66";$n = "67";}
 if ($total == "9"){$comor = "26"; 	$m_plan = "34"; 	$proc = "32"; $histo = "35"; 	$o = "38";	$histo_num = "62"; $admission = "63";$n = "64";}
 if ($total == "8"){$comor = "23"; 	$m_plan = "30"; 	$proc = "29"; $histo = "32"; 	$o= "35";	$histo_num = "59"; $admission = "60";$n = "61";}
 if ($total == "7"){$comor = "20"; 	$m_plan = "26"; 	$proc = "32"; $histo = "38"; 	$o = "44";	$histo_num = "56"; $admission = "57";$n = "58";}
 if ($total == "6"){$comor = "17"; 	$m_plan = "22"; 	$proc = "28"; $histo = "33"; 	$o = "38";	$histo_num = "53"; $admission = "54";$n = "55";}
 if ($total == "5"){$comor = "14"; 	$m_plan = "18"; 	$proc = "22"; $histo = "26"; 	$o = "30";	$histo_num = "55"; $admission = "56";$n = "57";}
 if ($total == "4"){$comor = "11"; 	$m_plan = "14"; 	$proc = "17"; $histo = "20";	$o = "23";	$histo_num = "47"; $admission = "48";$n = "49";}
 if ($total == "3"){$comor = "8"; 	$m_plan = "10"; 	$proc = "12"; $histo = "14"; 	$o = "16";	$histo_num = "44"; $admission = "45";$n = "48";}
 if ($total == "2"){$comor = "5"; 	$m_plan = "4"; 		$proc = "11"; $histo = "14"; 	$o = "17";	$histo_num = "41"; $admission = "42";$n = "43";}
 if ($total == "1"){$comor = "2"; 	$m_plan = "3"; 		$proc = "8";  $histo = "11";	$o = "14";	$histo_num = "38"; $admission = "39";$n = "40";}
    for ($c=1;$c<=$total;$c++)
    {
	xlsWriteLabel(7,(12+$c*3), "Diagnosis $c");
	xlsWriteLabel(7,(13+$c*3), "Problem $c");
	xlsWriteLabel(7,(14+$c*3), "Result $c");
	xlsWriteLabel(7,(15+$c+$comor), "Comorbidities $c");
	xlsWriteLabel(7,(16+$c+$m_plan), "Management Plan $c");
	xlsWriteLabel(7,(17+$c+$proc), "Procedure $c");
	xlsWriteLabel(7,(18+$c+$histo), "Histopathology $c");
	xlsWriteLabel(7,(19+$c+$o), "Outcome $c");
    }
   xlsWriteLabel(7,$histo_num, "Histopathology Number"); //chech
   xlsWriteLabel(7,$admission, "Admission"); //chech
   xlsWriteLabel(7,$n, "Notes"); //chech
$xlsRow = 8;
 $x=0;
    while($row = mysql_fetch_array($results))
    {
    //Explode Consultation Date
    $consultation_date = explode('-',$row['consultation_date']);
    $date_of_consultation = $consultation_date[1].'/'.$consultation_date[2].'/'.$consultation_date[0];
    $consult_date[$x] = $date_of_consultation;
    $id[$x] = $row['out_id'];
    $patient_id[$x] = $row['pi_id'];
    $resident[$x] = $row['u_lname'].', '.$row['u_fname'].' '.$row['u_mi']. '.';
    $consultant[$x] = $row['cons_lname'].', '.$row['cons_fname'].' '.$row['cons_mi']. '.';
    $registration_status[$x] = $row['registration_status'];
    $hospital_id[$x] = $row['hospital_id'];
    $lname[$x] = $row['pi_lname'];
    $fname[$x] = $row['pi_fname'];
    $minitials[$x] = $row['pi_mi'];
    $age[$x] = $row['age'];
    $gender[$x] = $row['gender'];
    $contact[$x] = $row['contact_number'];
    $address[$x] = $row['address'];
    $municipality[$x] = $row['municipality_id'];
    $province[$x] = $row['province_id'];
    $histopath_number[$x] = $row['histopath_number'];
    $admi[$x] = $row['admission'];
    $notes[$x] = $row['notes'];
  
   xlsWriteLabel($xlsRow,0,$id[$x]); //chech
   xlsWriteLabel($xlsRow,1,$consult_date[$x]); //chech
   xlsWriteLabel($xlsRow,2,$hospital_id[$x]); //chech
   xlsWriteLabel($xlsRow,3,$resident[$x]); //chech
   xlsWriteLabel($xlsRow,4,$consultant[$x]); //chech
   xlsWriteLabel($xlsRow,5,$registration_status[$x]); //chech
   xlsWriteLabel($xlsRow,6,$lname[$x]); //chech
   xlsWriteLabel($xlsRow,7,$fname[$x]); //chech
   xlsWriteLabel($xlsRow,8,$minitials[$x]); //chech
   xlsWriteLabel($xlsRow,9,$age[$x]); //chech
   xlsWriteLabel($xlsRow,10,$gender[$x]); //chech
   xlsWriteLabel($xlsRow,11,$contact[$x]); //chech
   xlsWriteLabel($xlsRow,12,$address[$x]); //chech
   xlsWriteLabel($xlsRow,13,$municipality[$x]); //chech
   xlsWriteLabel($xlsRow,14,$province[$x]); //chech
   xlsWriteLabel($xlsRow,$histo_num,$histopath_number[$x]); //chech
   xlsWriteLabel($xlsRow,$admission,$admi[$x]); //chech
   xlsWriteLabel($xlsRow,$n,$notes[$x]); //chech
 
$queryss = "SELECT * FROM out_patient_details WHERE out_patient_id='".$id[$x]."'";
$resultss = mysql_query($queryss);
while($rows = mysql_fetch_array($resultss))
{
       
   xlsWriteLabel($xlsRow,(12+$rows['diagnosis_count']*3),$rows['diagnosis']); //chech
   xlsWriteLabel($xlsRow,(13+$rows['diagnosis_count']*3),$rows['problems']); //chech
   xlsWriteLabel($xlsRow,(14+$rows['diagnosis_count']*3),$rows['results']); //chech
   xlsWriteLabel($xlsRow,(15+$rows['diagnosis_count']+$comor),$rows['comorbidities']); //chech
   xlsWriteLabel($xlsRow,(16+$rows['diagnosis_count']+$m_plan),$rows['management_plans']); //chech
   xlsWriteLabel($xlsRow,(17+$rows['diagnosis_count']+$proc),$rows['procedures']); //chech
   xlsWriteLabel($xlsRow,(18+$rows['diagnosis_count']+$histo),$rows['histhopatology']); //chech
   xlsWriteLabel($xlsRow,(19+$rows['diagnosis_count']+$o),$rows['outcomes']); //chech
}
 $x++;
$xlsRow++;
    }
xlsEOF();
exit();
?>