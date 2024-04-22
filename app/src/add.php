<?php
if ($_POST){

if ($_POST['finns'] == ''){
  $_POST['finns'] = "O-org";
}

$db_host=getenv('host');
$db_name=getenv('name');
$db_user=getenv('user');
$db_password=getenv('password');

$_POST['produkt'] = ucfirst($_POST['produkt']);
$_POST['finns'] = ucfirst($_POST['finns']);
$_POST['typ'] = ucfirst($_POST['typ']);
$_POST['subkategori'] = ucfirst($_POST['subkategori']);



$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
//Executing the multi query
    $sql = "INSERT INTO stock (name, stock, min, exp_date, location, category, subcategory, prioritet, notify)
VALUES ('$_POST[produkt]', '$_POST[antal]', '$_POST[behov]', '$_POST[expdate]', '$_POST[finns]', '$_POST[typ]', '$_POST[subkategori]', '$_POST[prioritet]', '0')";


if (mysqli_query($conn, $sql)) {
    echo "Tillagt ";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);
}
?>

<head>
<link rel="stylesheet" href="styles.css">
</head>
<hr>
<form action="<?php $_PHP_SELF ?>" method="POST" id="form">

  


<table border=0>
<tbody>
<tr>
<td><label for="fname">Produkt:</label><br></td>
<td><input type="text" id="produkt" name="produkt"><br></td>
</tr>
<tr>
<td><label for="fname">Typ:</label><br></td>
<td><input type="text" id="typ" name="typ"><br></td>
</tr>
<tr>
<td><label for="lname">Antal:</label><br></td>
<td><input type="text" id="antal" name="antal"><br></td>
</tr>
<tr>
<td><label for="fname">Behov:</label><br></td>
<td><input type="text" id="behov" name="behov"><br></td>
</tr>
<tr>
<td><label for="fname">Exp.date:</label><br></td>
<td><input type="text" id="expdate" name="expdate"><br></td>
</tr>
<tr>
<td><label for="fname">Finns:</label><br></td>
<td><input type="text" id="finns" name="finns"><br></td>
</tr>
<tr>
<td><label for="fname">Subkategori:</label><br></td>
<td><input type="text" id="subkategori" name="subkategori"><br></td>
</tr>
<tr>
<td><label for="fname">Prioritet:</label><br></td>
<td><input type="text" id="prioritet" name="prioritet"><br></td>
</tr>
<tr>
<td></td>
<td><button type="submit" form="form" value="Submit">Lägg till</button></td>
</tr>
</tbody>
</table>

</form>