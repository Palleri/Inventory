<?php

$db_host=getenv('host');
$db_name=getenv('name');
$db_user=getenv('user');
$db_password=getenv('password');


// Create connection

$conn = new mysqli($db_host, $db_user, $db_password);
#$conn = new mysqli("db", "root", "rootpw");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<br>";

// Create database
$sql = "CREATE DATABASE inventory";
if ($conn->query($sql) === TRUE) {

// Create stock table
#$conn = new mysqli("db", "root", "rootpw", "inventory");
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
  $sql_table = "CREATE TABLE stock (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    stock VARCHAR(100) NOT NULL,
    min VARCHAR(100) NOT NULL,
    exp_date VARCHAR(100),
    location VARCHAR(100),
    category VARCHAR(100),
    subcategory VARCHAR(100),
    prioritet VARCHAR(100),
    notify INT(10) DEFAULT (0)
    )";

if ($conn->query($sql_table) === TRUE) {
    echo "Table inventory created successfully";
//    echo "<br>";
} else {
    echo "Error creating table: " . $conn->error;
    echo "<br>";
}


} else {

// WEB CONTENT
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="sidenav">

  <a href="index.php">Home</a>
  <a href="add.php" target="iframe_a">Lägg till</a>
  <hr>
  
<?php


$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
   //Executing the multi query
   $query = "SELECT DISTINCT location FROM stock";
   $res = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
   
  foreach($res as $row){  
          $location=$row["location"];
          echo "<a href=\"location.php?id=".$row["location"]."\" target=\"iframe_a\"><sub>".$row["location"]."</sub></a>";
          $conn2 = new mysqli($db_host, $db_user, $db_password, $db_name);
          $query2 = "SELECT DISTINCT subcategory,location FROM stock WHERE location='$location'";
          $res2 = mysqli_query($conn2, $query2, MYSQLI_USE_RESULT);
  
          foreach($res2 as $row2){  
            echo "<a href=\"subcategory.php?id=".$row2["subcategory"]."&location=".$row2["location"]."\" target=\"iframe_a\"><sub2>".$row2["subcategory"]."</sub2></a>";  
            }
          echo "<hr>";
  }
      
        
      
      #echo "</ul>";
      
   



?>
</div>

<div class="main">
  <h2>Inventory</h2>

  <iframe frameborder="0" src="home.php" name="iframe_a" height="80%" width="100%" title="Iframe Example"></iframe>
  
</div>
   
</body>
</html> 





<?php
}
