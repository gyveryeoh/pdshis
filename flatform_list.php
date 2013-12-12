<?php session_start();
include("connection/connection.php");
include("header/header.php");
include("header/patient_information.php");
?>
<html>
    <head>
	<link rel="stylesheet" href="css/style.css">
    </head>
<table>
    <tr class="info" align="center">
        <td>OUT PATIENT DEPARTMENT</td>
        <td>IN PATIENT REFERRALS</td>
        <td>EMERGENCY ROOM REFERRALS</td>
        <td>ADMISSIONS</td>
    </tr>
    <tr align="center" class="a">
        <td><a href="out_patient.php?patients_info_id=<?php echo $_GET['patients_info_id']; ?>">
        <img src=images/out.png width=100 height=100 border=1 title='OUT&nbsp;PATIENT&nbsp;DEPARTMENT'></a></td>
        <td><a href="in_patient.php?patients_info_id=<?php echo $_GET['patients_info_id']; ?>">
        <img src=images/inpatient.png width=100 height=100 border=1 title='IN&nbsp;PATIENT&nbsp;DEPARTMENT'></td>
        <td><a href="emergency.php?patients_info_id=<?php echo $_GET['patients_info_id']; ?>">
        <img src=images/emergency.png width=100 height=100 border=1 title='EMERGENCY&nbsp;ROOM&nbsp;DEPARTMENT'></td>
        <td><a href="admission.php?patients_info_id=<?php echo $_GET['patients_info_id']; ?>">
        <img src=images/consult.png width=100 height=100 border=1 title='ADMISSION'></td>
    </tr>
</table>