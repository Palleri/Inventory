<head>
<link rel="stylesheet" href="styles.css">
</head>

<?php

$db_host=getenv('host');
$db_name=getenv('name');
$db_user=getenv('user');
$db_password=getenv('password');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
if (isset($_GET["id"])){
    $id=$_GET["id"];

}

if (isset($_POST)) {
    $sql = "UPDATE stock SET notify='0' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if ($_GET["delete"]){
    $delete=$_GET["delete"];
    $sql = "DELETE from stock WHERE id='$delete'";
        if (mysqli_query($conn, $sql)) {
        
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
    }


if ($_POST['min']){
    $min=$_POST['min'];
    $sql = "UPDATE stock SET min='$min' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

    if ($_POST['stock'] != ""){
        $stock=$_POST['stock'];
        
        $sql = "UPDATE stock SET stock='$stock' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        }


        
if ($_POST['location']){
    $location=ucfirst($_POST['location']);
    $sql = "UPDATE stock SET location='$location' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) { 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}




            if ($_POST['name']){
                $name=ucfirst($_POST['name']);
                $sql = "UPDATE stock SET name='$name' WHERE id='$id'";
                if (mysqli_query($conn, $sql)) {
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }      
                }

    if(isset($_POST['send'])) {
      if (empty($_POST['expdate'])) {
        $sql = "UPDATE stock SET exp_date=NULL WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }  
    }
    }


if ($_POST['expdate']){
    $expdate=$_POST['expdate'];
   
    
    $sql = "UPDATE stock SET exp_date='$expdate' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }      
    }

    if ($_POST['prioritet']){
        $prioritet=$_POST['prioritet'];
        $sql = "UPDATE stock SET prioritet='$prioritet' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }      
        }

        if ($_POST['subcategory']){
            $subcategory=ucfirst($_POST['subcategory']);
            $sql = "UPDATE stock SET subcategory='$subcategory' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }      
            }

            if ($_POST['category']){
              $category=ucfirst($_POST['category']);
              $sql = "UPDATE stock SET category='$category' WHERE id='$id'";
              if (mysqli_query($conn, $sql)) {
              } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }      
              }
  

    header("edit.php?id='$id'");


//Executing the multi query

$query = "SELECT * FROM stock WHERE id='$id'";

?>
<hr></hr>
<table width="100%" border="0">
<tbody>
<td><h3>Namn</h3></td>
<td><h3>Prioritet</h3></td>
<td><h3>Antal</h3></td>
<td><h3>Lokation</h3></td>
<td><h3>Subcategory</h3></td>
<td><h3>Exp.date</h3></td>
<tr>

<form action="<?php $_PHP_SELF ?>" method="POST" id="form">

<?php
//Retrieving the records
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
$res = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
if ($res) {
    while ($row = mysqli_fetch_array($res)) {

        if ($row["stock"] >= $row["min"]){
            $stockcolor="#00FF0F";
        }else {
            $stockcolor="red";
        }
    
        echo "<td class=\"color\"><input type=\"text\" id=\"name\" size=\"20\" name=\"name\" value=\"".$row["name"]."\"></td>";
        echo "<td class=\"color\"><input type=\"text\" id=\"prioritet\" size=\"5\" name=\"prioritet\" value=\"".$row["prioritet"]."\"></td>";
        echo "<td style=\"color:$stockcolor\" class=\"color\"><strong><input type=\"text\" id=\"stock\" size=\"5\" name=\"stock\" value=\"".$row["stock"]."\"> / <input type=\"text\" id=\"min\" size=\"5\" name=\"min\" value=\"".$row["min"]."\"> <input type=\"text\" id=\"category\" size=\"5\" name=\"category\" value=\"".$row["category"]."\"> </td>";
        echo "<td class=\"color\"><input type=\"text\" id=\"location\" size=\"20\" name=\"location\" value=\"".$row["location"]."\"></td>";
        echo "<td class=\"color\"><input type=\"text\" id=\"subcategory\" size=\"20\" name=\"subcategory\" value=\"".$row["subcategory"]."\"></td>";
        echo "<td class=\"color\"><input type=\"text\" id=\"expdate\" size=\"20\" name=\"expdate\" value=\"".$row["exp_date"]."\"></td>";
        echo "<td><a href=edit.php?delete=$id>Ta bort</a></td>";
        echo "<tr>";
        echo "<td><button type=\"submit\" form=\"form\" name=\"send\" value=\"Submit\">Ändra</button></td>";
        echo "</tr>";
        
         
         
       }
}
?>
</form>
</tr>
</tbody>
</table>


