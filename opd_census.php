<?php session_start();
include("../connection/connection.php");
include("../header/report_design.php");
?>
<?php
$query = mysql_query("select count(usertype) from user where usertype='user'");
$user = mysql_result($query,0);
?>
	<?php
	  //generate day list
	  $ctr=1;
	  $current_day = $_POST['startdate'];		  
	  $daysnumber = array();		  
	  $daystext = array();
	  do
	  {
	  $daynumber = $current_day;
	  $daytext = date('l', strtotime($current_day));
	  $current_day = strtotime ('+1 day' , strtotime ($current_day));
	  $current_day = date ('m/d/Y', $current_day);
	  $daysnumber[$ctr]=$daynumber;
	  $daystext[$ctr]=$daytext;
	  $ctr++;
	  }
	  while($ctr<=5);
	?>
<?php
if(isset($_POST['submit']))
{
	
	$query1 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='R' and out_patient.consult_date = '".$daysnumber[1]."'");
	$returning = mysql_result($query1,0);
	
	$query = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='R' and out_patient.consult_date = '".$daysnumber[2]."'");
	$returning1 = mysql_result($query,0);
	
	$query2 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='R' and out_patient.consult_date = '".$daysnumber[3]."'");
	$returning2 = mysql_result($query2,0);
	
	$query3 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='R' and out_patient.consult_date = '".$daysnumber[4]."'");
	$returning3 = mysql_result($query3,0);
	
	$query4 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='R' and out_patient.consult_date = '".$daysnumber[5]."'");
	$returning4 = mysql_result($query4,0);
	
	$query5 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='N' and out_patient.consult_date = '".$daysnumber[1]."'");
	$new5 = mysql_result($query5,0);
	
	$query6 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='N' and out_patient.consult_date = '".$daysnumber[2]."'");
	$new6 = mysql_result($query6,0);
	
	$query7 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='N' and out_patient.consult_date = '".$daysnumber[3]."'");
	$new7 = mysql_result($query7,0);
	
	$query8 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='N' and out_patient.consult_date = '".$daysnumber[4]."'");
	$new8 = mysql_result($query8,0);
	
	$query9 = mysql_query("SELECT COUNT(registration_status),consult_date FROM out_patient,out_patient_diagnosis where out_patient.id = out_patient_diagnosis.out_patient_id and out_patient_diagnosis.registration_status='N' and out_patient.consult_date = '".$daysnumber[5]."'");
	$new9 = mysql_result($query9,0);
    }
?>
<head>
	<script src="../javascript/dateformat.js"></script>
	<script language="JavaScript" src="../calendar/calendar_us.js"></script>
	<link rel="stylesheet" href="../calendar/calendar.css">
	<link rel="stylesheet" href="../css/style.css">
</head>

<div align="center">
<table style="border:gray 1px solid;" border="1" class="search">
    <form name="monthlyreport" action="opd_census.php" method="post">
	<tr>
	    <td valign="middle" colspan="7"><H2><center> As of <?php echo $_POST['startdate']; ?> - <? echo $daysnumber[5]; ?></h2></td>
	</tr>
	<tr>
	    <td align="center" colspan="5"><input type="text"  name="startdate">
    <script>
		new tcal ({
			// form name
			'formname': 'monthlyreport',
			// input name
			'controlname': 'startdate'});
		</script>&nbsp;<font size="1px">mm/dd/yyyy</font>
		</td><td> <input type="image" src="../image/submit.png" width="120" height="30" border="1" name="submit" value="Submit"></td><td><a href="excel file/opd_census_excel_file.php?startdate=<?php echo $daysnumber[1]; ?>"><img src="../image/export.gif" width="120" height="30" border="1"></a></td>
    </tr>
<tr>
    <td align="left" colspan="7">Prepared By : <?php echo $_SESSION['r_lname']; ?> , <? echo $_SESSION['r_fname']; ?></td>
</tr>
</table>
<div align="center">
<table style="border:gray 1px solid;"  class="search">
<tr style="font-size:12px; color:royalblue;">
	<td>DATE</td>
	<td>RETURNING</td>
	<td>NEW</td>
	<td>TOTAL</td>
	<td>RATIO</td>
</tr>

<?php
$users1 = substr((($new5+$returning)/$user),0,1);
$users2 = substr((($new6+$returning1)/$user),0,1);
$users3 = substr((($new7+$returning2)/$user),0,1);
$users4 = substr((($new8+$returning3)/$user),0,1);
$users5 = substr((($new9+$returning4)/$user),0,1);
	  echo '<tr><td>'.$daystext[1].'</td><td>'.$returning.'</td><td>'.$new5.'</td><td>'.($new5+$returning).'</td><td>'.substr((($new5+$returning)/$user),0,1).'</td></tr>
	  <tr><td>'.$daystext[2].'</td><td>'.$returning1.'</td><td>'.$new6.'</td><td>'.($new6+$returning1).'</td><td>'.substr((($new6+$returning1)/$user),0,1).'</td></tr>
	  <tr><td>'.$daystext[3].'</td><td>'.$returning2.'</td><td>'.$new7.'</td><td>'.($new7+$returning2).'</td><td>'.substr((($new7+$returning2)/$user),0,1).'</td></tr>
	  <tr><td>'.$daystext[4].'</td><td>'.$returning3.'</td><td>'.$new8.'</td><td>'.($new8+$returning3).'</td><td>'.substr((($new8+$returning3)/$user),0,1).'</td></tr>
	  <tr><td>'.$daystext[5].'</td><td>'.$returning4.'</td><td>'.$new9.'</td><td>'.($new9+$returning4).'</td><td>'.substr((($new9+$returning4)/$user),0,1).'</td></tr>
	  <tr><td style="font-size:12px; color:red;">TOTAL</td><td style="font-size:12px; color:red;">'.($returning+$returning1+$returning2+$returning3+$returning4).'</td><td style="font-size:12px; color:red;">'.($new5+$new6+$new7+$new8+$new9).'</td><td style="font-size:12px; color:red;">'.($new5+$new6+$new7+$new8+$new9+$returning+$returning1+$returning2+$returning3+$returning4 ).'</td><td style="font-size:12px; color:red;">'.substr((($users1+$users2+$users3+$users4+$users5)/5),0,3).'</td></tr>';
?>