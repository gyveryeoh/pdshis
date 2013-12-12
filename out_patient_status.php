<?php
$result = mysql_query("SELECT * from out_patient where patients_info_id ='$patient_info_id' order by consultation_date DESC");
   $x=1;
    while($row = mysql_fetch_array($result))
    {
    //Explode Consultation Date
    $consultation_date = explode('-',$row['consultation_date']);
    $date_of_consultation = $consultation_date[1].'/'.$consultation_date[2].'/'.$consultation_date[0];
    $consult_date[$x] = $date_of_consultation;
    $out_patient_id[$x] = $row['id'];
    $add[$x] = "<a href='out_patient_add_new_diagnosis.php?patients_info_id=$patient_info_id&out_patient_id=$row[id]'>ADD DIAGNOSIS</a> - <a href='out_patient_view_details.php?patients_info_id=$patient_info_id&out_patient_id=$row[id]'>VIEW/UPDATE</a>";
    $x++;
    }
    echo "<div class='scroll' align=center><table align='center' border='1' cellpadding='0' cellspacing='0' bgcolor='#EBEAF2'>
    <thead>
<tr class='head'>
<td align='center'><b>DIAGNOSIS STATUS</b></td>
</tr>
</thead>";
    for($i = 1; $i < $x+1; $i++){
    $result1 = mysql_query("SELECT * from out_patient_details where out_patient_id ='$out_patient_id[$i]'");

     echo "<tr><td align='center'><b>".$consult_date[$i]."</b></td></tr>";
    while($rows = mysql_fetch_array($result1))
    {
        echo "<tr><td align=center class=categ>".$rows['diagnosis']."</td></tr>";
    }
   echo "<tr><td align='center'>".$add[$i]."</td></tr><tr>";
    }
    echo "</table></div>";
    ?>