<?php
//including the database connection file
include("database/config.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = $conn->query("DELETE FROM auditiondetails WHERE id=$id");
 
//redirecting to the display page (index.php in our case)
header("Location:auditionindex.php");
?>