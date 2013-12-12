<?php
include("connection/connection.php");
include("header/header.php");
?>
<html>
    <head>
	<link rel="stylesheet" href="css/jquery.autocomplete.css" />
	<script src="javascript/dictionary/jquery.js"></script>
	<link rel="stylesheet" href="css/pagination.css"/>
        <script type="text/javascript" src="javascript/jquery.pagination.js"></script>
        <!-- Load data to paginate -->
        <script type="text/javascript">
	  <?php
	    $result = mysql_query("SELECT * FROM patients_info WHERE CONCAT(firstname, ' ', lastname) like '%".$_POST['lastname']."%' or CONCAT(lastname, ' ', firstname) like '%".$_POST['lastname']."%' order by firstname ASC");
	    echo "var members = [";
	    while($row = mysql_fetch_array($result))
	    {
		$id = $row["id"];
		$p_lname = ucwords(strtolower($row["lastname"]));
		$p_fname = ucwords(strtolower($row["firstname"]));
		$p_mname = $row["middle_initials"];
		$age = str_replace("y ", ".",$row['age']);
		$gender = substr($row["gender"],0,1);
		echo "['$id', '$p_lname', '$p_fname', '$p_mname', '$age', '$gender'],";
	    }
	    echo "];";
	    ?>   
	</script>
        <script type="text/javascript">
	function pageselectCallback(page_index, jq)
	{
	    // Get number of elements per pagionation page from form
            var items_per_page = $('#items_per_page').val();
	    var max_elem = Math.min((page_index+1) * items_per_page, members.length);
	    var results = '';
	    var title = '';
           // Iterate through a selection of the content and build an HTML string
	    for(var i=page_index*items_per_page;i<max_elem;i++)
	    {
		title = '<tr align=center>'
		+'<td>Derm Reg. Number</td>'
		+'<td>LASTNAME</td>'
		+'<td>FIRSTNAME</td>'
		+'<td>M.I</td>'
		+'<td>AGE</td>'
		+'<td>GENDER</td>'
		+'<td>INFO</td>'
		+'<td>OUT PATIENT</td>'
		+'<td>IN PATIENT</td>'
		+'<td>EMERGENCY</td>'
		+'<td>ADMISSION</td></tr>';
		results += '<tr><td>' + members[i][0]  + '<td>' + members[i][1] + '</td><td>' + members[i][2] + '</td><td>' + members[i][3] + '</td><td>' + members[i][4] + '</td><td>' + members[i][5] + '</td><td><a href=update_patient_info.php?patient_info_id='+members[i][0]+'><img src=images/pencil.gif width=25 height=30 border=1 title=update&nbsp;patient&nbsp;information></a></td><td><a href=out_patient.php?patients_info_id='+members[i][0]+'><img src=images/out.png width=25 height=30 border=1 title=out&nbsp;patient&nbsp;information></a></td><td><a href=in_patient.php?patients_info_id='+members[i][0]+'><img src=images/inpatient.png width=25 height=30 border=1 title=in&nbsp;patient&nbsp;information></a></td><td><a href=emergency.php?patients_info_id='+members[i][0]+'><img src=images/emergency.png width=25 height=30 border=1 title=emergency&nbsp;information></a></td><td><a href=admission.php?patients_info_id='+members[i][0]+'><img src=images/consult.png width=25 height=30 border=1 title=admission&nbsp;patient&nbsp;information></a></td></tr>';}
                // Replace old content with new content
                $('#Searchresult').html(title+results);
                // Prevent click event propagation
                return false;
            } 
            function getOptionsFromForm()
	    {
		var opt = {callback: pageselectCallback};
                // Collect options from the text fields - the fields are named like their option counterparts
                $("input:text").each(function()
				     {
					opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
                });
                // Avoid html injections in this demo
                var htmlspecialchars ={ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;"}
                $.each(htmlspecialchars, function(k,v){
                })
                return opt;
            }	
            // When document has loaded, initialize pagination and form 
            $(document).ready(function(){
		// Create pagination element with options from form
                var optInit = getOptionsFromForm();
                $("#Pagination").pagination(members.length, optInit);
	    // Event Handler for for button
	    $("#setoptions").click(function(){
            var opt = getOptionsFromForm();
            // Re-create pagination content with new parameters
            $("#Pagination").pagination(members.length, opt);
});
	    });
	    </script>
	<script src='javascript/dictionary/jquery.autocomplete.js'></script>
	<script src='javascript/dictionary/dictionary.js'></script>
    </head>
	<div align="center">
	    <table style="border-top:0px;">
		<form name="form" action="patients_search.php" method="post" >
	<tr>
	    <td class="ans" align="right" width="55%" style="font-size:15px;"> Name of Patient : <input name="lastname" type="text" size="30" class="a" ondblclick= "this.form.submit();" id="dictionary4"></td>
	    <td width="90" align="left"><input name="Search" class="submit" type="submit" value="SEARCH" title="Search"></td>
	<td>

<?php
if (isset($_POST['add'])){
echo "<script>location.href='add_new_patient.php'</script>";
}
if (isset($_POST['Search']))
if (empty($_POST['lastname']) && empty($_POST['firstname']))
{
    $msg1="<p style='background-color:#faadad; width:750; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma; position:absolute; left:11%;'>
	 <img src='images/error.png' width='20' height='20' sty le='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>LASTNAME OR FIRSTNAME IS REQUIRED.</span></font><br>
	</p>";
}
	else
{
echo
'<td><input name="add" type="submit" class="submit" value="ADD NEW PATIENT" title="Add New Patient">
</td></tr>
</table>
</div>';
$query = "SELECT * FROM patients_info WHERE CONCAT(firstname, ' ', lastname) like '%".$_POST['lastname']."%' or CONCAT(lastname, ' ', firstname) like '%".$_POST['lastname']."%' order by firstname ASC";
$result = mysql_query($query);
	if (mysql_num_rows($result)<> false)
	{

echo   '<div align="center">
	<table>
	    <tr>
		<td colspan="14" align="center" valign="middle">
		    <h2>Result for:<font color="red"> '.ucwords($_POST["lastname"]).'  '.ucwords($_POST["firstname"]).'</font> </h2>
		</td>
	    </tr>
		<tr>
		    <td colspan=14 id="Pagination" align="center"></td>
		    </tr>
</table>
<table id="Searchresult" class="search" style="border:gray 1px solid; border-top:0px;" border=1></table>
		<form name="paginationoptions">
			<p><input type="text" value="10" name="items_per_page" id="items_per_page" class="numeric" style="display:none;"/></p>
			<p><label for="num_display_entries"></label><input type="text" value="10" name="num_display_entries" style="display:none;" id="num_display_entries" class="numeric"/></p>
			<p><label for="num"></label><input type="text" value="2" name="num_edge_entries" id="num_edge_entries" style="display:none;" class="numeric"/></p>
			</form>
    </body>
</html>';
}
else
echo "<br><br><p style='background-color:#faadad; width:55%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma; position:absolute; left:19%;'>
	 <img src='images/error.png' width='20' height='20' sty le='margin-top:2px;'>
	 <font size='5' color='red'><span style='padding-top:10px;'>NO RESULT WAS FOUND.</span></font>
	</p>";
	}
?>