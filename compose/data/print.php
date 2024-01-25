<head>
<style>
a { color: inherit; 
    text-decoration:none
} 

</style>
</head>


<?php

$db_host=getenv('host');
$db_name=getenv('name');
$db_user=getenv('user');
$db_password=getenv('password');
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);


if (isset($_GET["location"])){
    $id=$_GET["location"];

    
//Executing the multi query
$query = "SELECT * FROM stock WHERE location='$id' ORDER BY if(prioritet = '' or prioritet is null,1,0),prioritet ASC";
    
}else {

    $query = "SELECT * FROM stock ORDER BY if(prioritet = '' or prioritet is null,1,0),prioritet ASC";
}


?>
<table width="100%" border="0">
    
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


    echo "<tr>";
    echo "<td colspan=5><hr></td>";
    echo "</tr>";
        echo "<td class=\"color\">".$row["name"]."</td>";
        echo "<td class=\"color\">".$row["prioritet"]."</td>";
        echo "<td><strong>".$row["stock"]." / ".$row["min"]." ". $row["category"]."</strong></td>";
        echo "<td>".$row["location"]."</td>";
        echo "<td>".$row["exp_date"]."</td>";
        echo "</tr>";
        
        
        
        

        
        
    }
 
}
?>

</tr>
<tr>
<td colspan=5><hr></td>
</tr>
</tbody>
</table>
<table>
</table>