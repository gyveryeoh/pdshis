<?php session_start();
if (empty($_SESSION['roles_id'])){
echo "<script language='JavaScript'>location.href='index.php';</script>";
}
$required = '<font color="red"> *</font>';
?>
<!doctype html>
<html>
<head>
<title>Philippine Dermatological Society</title>
<link rel="stylesheet" href="css/style.css">
	<script src="javascript/number/number.js"></script>
	<script src="javascript/letters/letter.js"></script>
	<script src="javascript/age/age.js"></script>
	<link rel="stylesheet" href="css/datepicker/style.css">
	<link rel="stylesheet" href="css/datepicker/default.css">
	<link rel="stylesheet" href="css/datepicker/style_date.css">
	<link type="text/css" rel="stylesheet" href="css/datepicker/shCoreDefault.css">
	<script type="text/javascript" src="javascript/datepicker/XRegExp.js"></script>
        <script type="text/javascript" src="javascript/datepicker/shCore.js"></script>
        <script type="text/javascript" src="javascript/datepicker/shLegacy.js"></script>
        <script type="text/javascript" src="javascript/datepicker/shBrushJScript.js"></script>
	 <script type="text/javascript">
            //Datepicker
	    SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();     
        </script>
        <script type="text/javascript" src="javascript/jquery.js"></script>
	<link rel="stylesheet" href="css/autocomplete.css">
		<script src="javascript/dictionary/jquery-1.9.1.js"></script>
		<script src="javascript/dictionary/jquery-ui.js"></script>
</head>
	<div align="center">
	<table width="100%" cellspacing="8" class="ans">
	<body style="background:#EBEAF2;">
		<tr>
			<td colspan="4"><center><img src="images/logo.jpg" width="100%" height="200" style="border:gray 0px solid; border-bottom:0px;" ></center></td>
		</tr>
		<tr>
			<td class="headers"> You are logged in as: <?php echo ucwords($_SESSION['lname']);?>, <?php echo ucwords($_SESSION['fname']); ?> <?php echo ucwords($_SESSION['minitials']); ?>.</td>
			<td align="center" width="5%"><a href="patients_search.php"><img src="images/home.png" width="30" height="30"><br>HOME</a></td>
			<td align="center" width="5%"><a href="profile.php"><img src="images/update.png" width="30" height="30"><br>PROFILE</a></td>
			<td align="center" width="5%"><a href='index.php?id=logout'><img src="images/logout.png" width="30" height="30"><br>LOGOUT</a></td>
		</tr>
	</table>
	</div>
			<?php
			if ($_SESSION['roles_id'] == '1')
			echo
			'<div align="center">
			<table class="ans">
			<tr>
			<td align="center" width="6%"><a href="pds_cpr_report/his_form_IA.php"><img src="images/report.png" width="30" height="30"><br>PDS CPR Reports LVL</a></td>
			<td align="center" width="6%"><a href="cpr_report/his_form_IA.php"><img src="images/report.png" width="30" height="30"><br>INSTI CPR Reports LVL</a></td>
			<td align="center" width="6%"><a href="a_form_report/a4_report.php"><img src="images/report.png" width="30" height="30"><br>A Form Report</a></td>
			<td align="center" width="6%"><a href="statistical_report_r2.php"><img src="images/report.png" width="30" height="30"><br>Statistical Report</a></td>
			<td align="center" width="6%"><a href="user_lists.php"><img src="images/button_this.png" width="30" height="30"><br>Update User</a></td>
			<td align="center" width="6%"><a href="satelitte_clinic.php"><img src="images/add_user.png" width="30" height="30"><br>Satellite Clinic</a></td>
			<td align="center" width="6%"><a href="add_consultant.php"><img src="images/add_user.png" width="30" height="30"><br>Add Consultant</a></td>
			<td align="center" width="6%"><a href="consultant_lists.php"><img src="images/add_user.png" width="30" height="30"><br>Consultant lists</a></td>
			<td align="center" width="6%"><a href="add_user.php"><img src="images/add_user.png" width="30" height="30"><br>Add User</a></td>
			</tr>
			</table>
			</div>';
			?>
</html>
