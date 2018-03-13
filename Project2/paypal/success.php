<?php
//including the database connection file
session_start(); 
include_once("D:/xampp/htdocs/bathiri/Project2/database/config.php");
$result = $conn->query("SELECT * FROM userdetail where uusername = '" . $_SESSION['uusername'] . "'"); 

?>
<?php
include("db_connect.php");
$item_number = $_GET['item_number']; 
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];
$name = $_SESSION['uusername'];
//Get product price to store into database

if(!empty($txn_id)){
    //Insert tansaction data into the database
    mysqli_query($conn, "INSERT INTO payments(txn_id,payment_gross,currency_code,payment_status,uusername) 
    	VALUES('".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."','".$name."')");
	$last_insert_id = mysqli_insert_id($conn);    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Casting World</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="container" style="background-color:hsl(0, 0%, 90%);">
	<div style="border:1px solid black;margin-left:200px;margin-right:200px;margin-top:200px;border-radius:10px;background-color:white">
		<br><br><br><br>
		<h2 style="color:green;text-align:center;font-style:italic;">Your payment has been successful.</h2>
		<h3 style="color:black;text-align:center;">Your Payment ID - <?php echo $last_insert_id; ?>.</h3>
	 	<br><br><br><br>
	</div><br><br>
	<a href="/bathiri/Project2/useraudition.php"><button class="btn btn-info" style="margin-left:770px;">Go Back to login page</button></a>	

</body>
</html>
<?php
}else{
?>
	<h1>Your payment has failed.</h1>
<?php
}
?>