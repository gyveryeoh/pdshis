<?php
$result = mysql_query("SELECT * from in_patient where patients_info_id ='$patient_info_id' order by date_referred DESC");
   $x=1;
    while($row = mysql_fetch_array($result))
    {
    //Explode Consultation Date
    $consultation_date = explode('-',$row['date_referred']);
    $date_of_consultation = $consultation_date[1].'/'.$consultation_date[2].'/'.$consultation_date[0];
    $consult_date[$x] = $date_of_consultation;
    $in_patient_id[$x] = $row['id'];
    $add[$x] = "<a href='in_patient_add_new_diagnosis.php?patients_info_id=$patient_info_id&in_patient_id=$row[id]'>ADD DIAGNOSIS</a> - <a href='in_patient_view_details.php?patients_info_id=$patient_info_id&in_patient_id=$row[id]'>VIEW/UPDATE</a>";
    $x++;
    }
    echo "<div class='scroll' align=center><table align='center' border='1' cellpadding='0' cellspacing='0' bgcolor='#EBEAF2'>
    <thead>
<tr class='head'>
<td align='center'><b>DIAGNOSIS STATUS</b></td>
</tr>
</thead>";
    for($i = 1; $i < $x+1; $i++){
    $result1 = mysql_query("SELECT * from in_patient_details where in_patient_id ='$in_patient_id[$i]'");

     echo "<tr><td align='center'><b>".$consult_date[$i]."</b></td></tr>";
    while($rows = mysql_fetch_array($result1))
    {
        echo "<tr><td align=center class=categ>".$rows['diagnosis'].''.$rows['other_diagnosis']."</td></tr>";
    }
   echo "<tr><td align='center'>".$add[$i]."</td></tr><tr>";
    }
    echo "</table></div>";
    ?>