<?php
//including the database connection file
include_once("database/config.php");
$id = $_GET['id'];  
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = $conn->query("SELECT * FROM userdetail where uusername = '" . $_SESSION['uusername'] . "'"); // using mysqli_query instead
?>
<html>
<head>    
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">  
        .error{color:red;}
        .col-sm-4{color:#1a75ff;}        
    </style>    
</head>
 
<body  style="background-color:hsl(0, 0%, 95%);">
    <center><h2 style="margin-top:40px;">Profile</h2></center><br>    
    <div class="container" style="border:1px solid black;padding:50px;width:1050px;font-size:18px;background-color:white;border-radius:30px;">
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = $result->fetch_assoc()) {
            echo "<div class='row'><div class='col-sm-5'>";
            echo "<img style='height:250px; width:250px;border-radius: 50%;opacity:0.7;' src='photo/".$res['pname']."' >";
            echo "</div>";    
            echo "<div class='col-sm-7'>";
            echo "<div class='row'><div class='col-sm-4'>First Name</div><div class='col-sm-8'>".$res['fname']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Last Name</div><div class='col-sm-8'>".$res['lname']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Date Of Birth</div><div class='col-sm-8'>".date('jS F Y',strtotime(str_replace('-','/', $res['dob'])))."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>AGE</div><div class='col-sm-8'>".$res['age']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Gender</div><div class='col-sm-8'>".$res['gen']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Email</div><div class='col-sm-8'>".$res['email']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Phone</div><div class='col-sm-8'>".$res['phone']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Address</div><div class='col-sm-8'>".$res['address']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Category</div><div class='col-sm-8'>".$res['category']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-4'>Experience</div><div class='col-sm-8'>".$res['experience']."</div></div><br>"; 
            echo "</div>";           
            echo "<div align='center'><a href=\"userdetailedit.php?id=$res[id]\"><button type='button' class='btn btn-primary' style='width:200px;font-size:18px;'>Edit</button></a></div>";
            
        }
        ?>
   
    </div>
         
</body>
</html>