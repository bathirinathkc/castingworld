<?php
session_start();
if(!isset($_SESSION['ausername']) || empty($_SESSION['ausername'])){
     header("location: login.php");
    exit;
}
include_once("database/config.php"); 
$result = $conn->query("SELECT * FROM userlogin ORDER BY id ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Casting World</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        
        th{background-color:lightblue;text-align:center}
    </style>
</head>
<body style="background-color:hsl(0, 0%, 95%);">
                 
    <div><?php include("include_files/adminnavbar.php") ?></div>
     
    <br><br>
    <div class="container" align="center" id="userlogin">
        <h2 style="margin-top:80px;">User Details</h2><br><br>
        <div  style="border:1px solid grey;width:80%;background-color:white;border-radius:10px;"><br>
        <div style="font-style:italic;font-size:18px">
        Search : <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Username.." style="font-style:none;font-size:15px;"></div><br><br><br>

        <table style="width:60%;" class="table table-hover" align="center" >
            <tr>
                <th>Id</th>
                <th>username</th>
                <th>Password</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <tbody id="table1"><a href="adminuserdetails.php">
            <?php 
            while($res = $result->fetch_assoc()) {         
                echo "<tr>";
                echo "<td>".$res['id']."</td>";
                echo "<td><a href='adminuserdetails.php'>".$res['uusername']."</a></td>";
                echo "<td>".$res['upwd']."</td>";
                echo "<td>".$res['category']."</td>";     
                echo "<td><a href=\"deleteuserlogin.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button type='button' class='btn btn-danger'>Delete</button></a></td>";        
            }
            ?>
          </tbody>
        </table> 
        </div> <br><br><br><br><br><br><br><br><br><br><br><br>

    </div>


    <div><?php include("include_files/footer.php") ?></div>    
</body>
</html>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table1 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>