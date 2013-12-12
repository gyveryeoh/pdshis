<?php session_start();
include("/connection/connection.php");
include("/header/header.php");
include("/header/statistical_report_header.php");
?>
<script>
	//Datepicker Format
	$(document).ready(function(){
	$('#datepicker-example11').Zebra_DatePicker({
        format: 'Y-m-d'
	});
	$('#datepicker-example12').Zebra_DatePicker({
        format: 'Y-m-d'
	});
	});
</script>
<div align="center">
    <form action="a6_report_excel_file.php" method="post">
<table style="border:gray 1px solid;" cellpadding="5">
	<tr>
		<td colspan="2" class="header">A6 REPORT<BR></td>
	</tr>
	</tr>
		<td width="45%" class="question"><b>MONTH : </b></td>
		<td><input type="text" name="start_date" id="datepicker-example11" value="<?php echo $_POST['start_date']; ?>" class="a"> - <input type="text" name="end_date" id="datepicker-example12" value="<?php echo $_POST['end_date']; ?>" class="a"></td>
	</tr>
	<tr>
		<td class="question"><b>SATELLITE CLINIC : </b></td>
		<td><?php {satellite_clinic_lists();} ?></td>
	</tr>
	<tr>
		<td class="question"><b>INSTITUTIONS : </b></td>
		<td><?php {institutions_list();} ?></td>
	</tr>
	<tr>
	    <td></td><td><input type="submit" name="submit" value="SUBMIT" class="submit"></td>
	</tr>
</table>
    </form>
</div>
<script type="text/javascript" src="../javascript/datepicker/zebra_datepicker.js"></script>