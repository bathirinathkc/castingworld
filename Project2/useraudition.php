<?php
session_start();
if(!isset($_SESSION['uusername']) || empty($_SESSION['uusername'])){
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
        .col-sm-3 {color:#ff4da6;}
        
    </style>
    
</head>
 
<body style="background-color:hsl(0, 0%, 95%);">
                 
    <div><?php include("include_files/usernavbar.php") ?></div>  

    <center><h2 style="margin-top:120px;">Audition Details</h2></center><br>
    <center><div id="output" style="color:black">0</div></center>    
    <br>
        
        <div style="padding:10px;background-color:white;border:1px solid grey;padding:25px;width:1200px;margin-left:75px;margin-right:75px;border-radius:10px;">
            <div class="row">
        <?php
            $result1 = $conn->query("SELECT * FROM userlogin where uusername = '" . $_SESSION['uusername'] . "' && category='Free'");
            $res1 = $result1->fetch_assoc();
            $result3 = $conn->query("SELECT * FROM userlogin where uusername = '" . $_SESSION['uusername'] . "' && category='subcribe'");
            $res3 = $result3->fetch_assoc();
            $result2 = $conn->query("SELECT * FROM payments where uusername = '" . $_SESSION['uusername'] . "' && payment_status='Completed'");
            $res2 = $result2->fetch_assoc();

            if ($res2) { 
            echo "<script>$('#output').hide();</script>";                       
        
                while($res = $result->fetch_assoc()) {
                    echo "<div>";
                    echo '<div class="col-sm-4" style="border:1px solid lightgrey;width:370px;border-radius:10px;margin:10px;background-color:hsl(0, 0%, 98%);" class="div">'; 

                    echo "<div class='row' style='background-color:#666666;border-top-left-radius:10px;
            border-top-right-radius:10px;font-size:18px;'><br><div class='col-sm-5' style='color:#ffcc66;'>Script</div><div class='col-sm-7' style='color:white;'>".$res['scriptno']."</div><br><br></div>";

                    echo '<div style="padding:10px;font-size:16px;background-color:hsl(0, 0%, 98%);">';
                    echo "<div class='row'><div class='col-sm-3'>Script</div><div class='col-sm-9'><p>".$res['script']."</p></div></div><br>";
                    echo "<div class='row'><div class='col-sm-3'>Date</div><div class='col-sm-9'>".$res['auditiondate']."</div></div><br>";
                    echo "<div class='row'><div class='col-sm-3'>Place</div><div class='col-sm-9'>".$res['audition']."</div></div><br>";            
                    echo "<div class='row'><div class='col-sm-3'>Role</div><div class='col-sm-9'>".$res['category']."</div></div><br>";
                    echo "<div class='row'><div class='col-sm-3'>Age</div><div class='col-sm-9'>".$res['age']."</div></div><br>";            
                    echo "<div align='center'><button type='button' class='btn btn-success btn1' style='width:50%'>Take Audition</button></div>";
                    echo "</div></div></div>";
                    
                }
                echo "<br>";                
            }

            elseif ($res1) {               
        
                while($res = $result->fetch_assoc()) {
                    echo "<div>";
                    echo '<div class="col-sm-4" style="border:1px solid lightgrey;width:370px;border-radius:10px;margin:10px;background-color:hsl(0, 0%, 98%);" class="div">'; 

                    echo "<div class='row' style='background-color:#666666;border-top-left-radius:10px;
            border-top-right-radius:10px;font-size:18px;'><br><div class='col-sm-5' style='color:#ffcc66;'>Script</div><div class='col-sm-7' style='color:white;'>".$res['scriptno']."</div><br><br></div>";

                    echo '<div style="padding:10px;font-size:16px;background-color:hsl(0, 0%, 98%);">';
                    echo "<div class='row'><div class='col-sm-3'>Script</div><div class='col-sm-9'><p>".$res['script']."</p></div></div><br>";
                    echo "<div class='row'><div class='col-sm-3'>Date</div><div class='col-sm-9'>".$res['auditiondate']."</div></div><br>";
                    echo "<div class='row'><div class='col-sm-3'>Place</div><div class='col-sm-9'>".$res['audition']."</div></div><br>";            
                    echo "<div class='row'><div class='col-sm-3'>Role</div><div class='col-sm-9'>".$res['category']."</div></div><br>";
                    echo "<div class='row'><div class='col-sm-3'>Age</div><div class='col-sm-9'>".$res['age']."</div></div><br>";            
                    echo "<div align='center'><button type='button' class='btn btn-success target' style='width:50%' name='button' id='target'>Take Audition</button></div>";
                    echo "</div></div></div>";
                    
                }
                echo "<br>";

        
                # code...
            }
            else{

                 while($res = $result->fetch_assoc()) {
            echo "<div >";
            echo '<div class="col-sm-4" style="border:1px solid lightgrey;width:370px;border-radius:10px;margin:10px;background-color:hsl(0, 0%, 98%);" class="div">'; 

            echo "<div class='row' style='background-color:#666666;border-top-left-radius:10px;
    border-top-right-radius:10px;font-size:18px;'><br><div class='col-sm-5' style='color:#ffcc66;'>Script</div><div class='col-sm-7' style='color:white;'>".$res['scriptno']."</div><br><br></div>";

            echo '<div style="padding:10px;font-size:16px;background-color:hsl(0, 0%, 98%);">';
            echo "<div class='row'><div class='col-sm-3'>Script</div><div class='col-sm-9'><p>".$res['script']."</p></div></div><br>";
            echo "<div class='row'><div class='col-sm-3'>Date</div><div class='col-sm-9'>".$res['auditiondate']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-3'>Place</div><div class='col-sm-9'>".$res['audition']."</div></div><br>";            
            echo "<div class='row'><div class='col-sm-3'>Role</div><div class='col-sm-9'>".$res['category']."</div></div><br>";
            echo "<div class='row'><div class='col-sm-3'>Age</div><div class='col-sm-9'>".$res['age']."</div></div><br>";  
            echo "<div align='center'><a href=\"paypal/subcribe.php?id=$res[id]\"><button type='button' class='btn btn-success target' id='target' style='width:50%' name='button'>Take Audition</button></a></div>";
            echo "</div></div></div>";
        }
        echo "<br>";
            }            
        ?>
            
        
        
        </div>
        </div><br><br>
        <div><?php include("include_files/footer.php") ?></div>         
</body>
</html>
<script type='text/javascript'>
    var x=0;
    $('.target').click(function() {        
        x++;     
        $('#output').text(x);
         
        if (x>3) {
            window.location = "/bathiri/Project2/paypal/subcribe.php";
        }
        $('.div').hide(); 
    });
</script>


