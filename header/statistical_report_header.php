<?php
function satellite_clinic_lists(){
$sattelite = mysql_query("SELECT * from satelitte_clinic order by id ASC");
echo '<SELECT NAME="satellite_clinic_id" class="index_input">
      <option value="0">ALL SATELLITE</option>';
while($data = mysql_fetch_array($sattelite))
{
 echo"<OPTION VALUE='".$data['id']."'>".$data['clinic_name']."</option>";
 }
 echo "</SELECT>";
 }
function institutions_list(){
$sattelite = mysql_query("SELECT * from institutions order by id ASC");
echo '<SELECT NAME="institutions_id" class="index_input">
      <option value="0">ALL INSTITUTIONS</option>';
while($data = mysql_fetch_array($sattelite))
{
 echo"<OPTION VALUE='".$data['id']."'>".$data['institutions']."</option>";
 }
 echo "</SELECT>";
 }
 ?>
<div align="center">
<table  class="search">
	<tr>
	    
			<td align="center" width="6%"><a href="statistical_report_r2.php"><img src="images/report.png" width="30" height="30"><br>R2 Report</a></td>
			<td align="center" width="6%"><a href="statistical_report_r3.php"><img src="images/report.png" width="30" height="30"><br>R3 Report</a></td>
			<td align="center" width="6%"><a href="statistical_report_r4.php"><img src="images/report.png" width="30" height="30"><br>R4 Report</a></td>
			<td align="center" width="6%"><a href="statistical_report_r5.php"><img src="images/report.png" width="30" height="30"><br>R5 Report</a></td>
			<td align="center" width="6%"><a href="out_patient_report_r6.php"><img src="images/report.png" width="30" height="30"><br>R6 Report</a></td>
			<td align="center" width="6%"><a href="out_patient_report_r7.php"><img src="images/report.png" width="30" height="30"><br>R7 Report</a></td>
			<td align="center" width="6%"><a href="out_patient_report_r8.php"><img src="images/report.png" width="30" height="30"><br>R8 Report</a></td>
	</tr>
    </table>
</div>