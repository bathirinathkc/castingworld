<?php
session_start();
if(!isset($_SESSION['ausername']) || empty($_SESSION['ausername'])){
     header("location: login.php");
    exit;
}
?>
<?php
//including the database connection file
require_once 'database/config.php';
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = $conn->query("SELECT * FROM auditiondetails ORDER BY id ASC"); // using mysqli_query instead
?>
<html>
<head>    
    <title>Casting World</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
  
        .error{color:red;}
        .col-sm-3{color:#ff4da6;}
        
    </style>
    
</head>
 
<body style="background-color:hsl(0, 0%, 95%);">
                 
    <div><?php include("include_files/adminnavbar.php") ?></div>  

    <center><h2 style="margin-top:120px;">Audition Details</h2></center>
    <br>
        
        <div style="padding:10px;background-color:white;border:1px solid grey;padding:25px;width:1200px;margin-left:75px;margin-right:75px;border-radius:10px;">
            <div class="row">
        <?php 
        
        while($res = $result->fetch_assoc()) {
            echo "<div>";
            echo '<div class="col-sm-4" style="border:1px solid lightgrey;width:370px;border-radius:10px;margin:10px;background-color:hsl(0, 0%, 98%);">'; 

            echo "<div class='row' style='background-color:#666666;border-top-left-radius:10px;
    border-top-right-radius:10px;font-size:18px;'><br><div class='col-sm-5' style='color:#ffcc66;'>Script</div><div class='col-sm-7' style='color:white;'>".$res['scriptno']."</div><br><br></div>";

            echo '<div style="padding:10px;font-size:16px;background-color:hsl(0, 0%, 98%);">';
            echo "<div class='row'><div class='col-sm-3'>Script</div><div class='col-sm-9'>".$res['script']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-3'>Date</div><div class='col-sm-9'>".date('jS \of F Y',strtotime(str_replace('-','/', $res['auditiondate'])))."</div></div><br>";
            echo "<div class='row'><div class='col-sm-3'>Place</div><div class='col-sm-9'>".$res['audition']."</div></div><br>";            
            echo "<div class='row'><div class='col-sm-3'>Role</div><div class='col-sm-9'>".$res['category']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-3'>Age</div><div class='col-sm-9'>".$res['age']."</div></div><br>";            
            echo "<div align='center'><a href=\"auditionedit.php?id=$res[id]\"><button type='button' class='btn btn-primary'>Edit</button></a>&nbsp;&nbsp;&nbsp;<a href=\"auditiondelete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button type='button' class='btn btn-danger'>Delete</button></a></div>";
            echo "</div></div></div>";
        }
        echo "<br>";
        ?>
        </div>
        </div><br><br>
        <div><?php include("include_files/footer.php") ?></div>         
</body>
</html>