<head>
<link rel="stylesheet" href="styles.css">
</head>


<?php

$db_host=getenv('host');
$db_name=getenv('name');
$db_user=getenv('user');
$db_password=getenv('password');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
//Executing the multi query
$query = "SELECT * FROM stock ORDER BY if(prioritet = '' or prioritet is null,1,0),prioritet ASC";

?>
<hr></hr>
<table width="100%" border="0">
    <a target=blank href="print.php">Skriv ut</a>
<tbody>
<td><h3>Namn</h3></td>
<td><h3>Prioritet</h3></td>
<td><h3>Antal</h3></td>
<td><h3>Finns</h3></td>
<td><h3>Exp.date</h3></td>
<tr>



<?php
$dateexpire=date('Y-m-d', strtotime($Date. ' + 90 days'));


//Retrieving the records
$res = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
if ($res) {
   while ($row = mysqli_fetch_array($res)) {

    if ($row["stock"] == $row["min"]){
        $stockcolor="#00FF0F";
    }else {
        $stockcolor="red";
    }

    if ($row["exp_date"] > $dateexpire){
        $datecolor="00FF0F";
    }else {
        $datecolor="red";
    }

    
        echo "<td class=\"color\">".$row["name"]."</td>";
        echo "<td class=\"color\">".$row["prioritet"]."</td>";
        echo "<td style=\"color:$stockcolor\" class=\"color\"><strong><a href=\"edit.php?id=".$row["id"]."\">".$row["stock"]." / ".$row["min"]." ". $row["category"]."</strong></a></td>";
        echo "<td class=\"color\">".$row["location"]."</td>";
        echo "<td style=\"color:$datecolor\" class=\"color\">".$row["exp_date"]."</td>";
        echo "</tr>";    
        
    }
 
}
?>
</tr>
</tbody>
</table>
<table>
    <td>Tryck i columnen Antal för att ändra</td>
</table>