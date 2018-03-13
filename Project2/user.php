<?php
// Initialize the session
session_start(); 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['uusername']) || empty($_SESSION['uusername'])){
  header("location: login.php");
  exit;
 
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Casting World</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body  style="background-color:hsl(0, 0%, 95%);">
    <div><?php include("include_files/usernavbar.php") ?></div><br><br>
    <div></div>
    
    <div id="indexdiv"><?php include("userindex.php") ?></div><br><br>
    <div>
    <?php 
    error_reporting(E_ERROR | E_PARSE);  	 
    	$query ="SELECT * FROM userdetail where uusername = '" . $_SESSION['uusername'] . "'"; 
    	$result = mysqli_query($conn, $query);    	
    	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    	if(!$row){
			header("location: form.php");
		} else {
			header("location: user.php");
		}
	?>


    <div><?php include("include_files/footer.php") ?></div>     
</body>
</html>
