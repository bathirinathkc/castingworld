<?php
require_once 'database/config.php';

$ausername = $apwd = "";
$ausername_err = $apassword_err = "";  
if(isset($_POST['adminsubmit'])){
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Check if username is empty
    if(empty(trim($_POST["ausername"]))){
        $ausername_err = 'Please enter username.';
    } else{
        $ausername = trim($_POST["ausername"]);
    }    
// Check if password is empty
    if(empty(trim($_POST['apwd']))){
        $apassword_err = 'Please enter your password.';
    } else{
        $apwd = trim($_POST['apwd']);
    }    
// Validate credentials
    if(empty($ausername_err) && empty($apassword_err)){
        // Prepare a select statement
        $sql = "SELECT ausername, apwd FROM adminlogin WHERE ausername = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $ausername;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $ausername, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($apwd, $hashed_password)){
                            session_start();
                            $_SESSION['ausername'] = $ausername;                                  
                            header("location: admin.php");
                        } 
                        else{
                            // Display an error message if password is not valid
                            $apassword_err = 'The password you entered was not valid.';
                        }
                    }
                } 
                else{
                    // Display an error message if username doesn't exist
                    $ausername_err = 'No account found with that username.';
                }
            } 
            else{
            echo "Oops! Something went wrong. Please try again later.";
            }
        }        
        // Close statement
        mysqli_stmt_close($stmt);
    }  
     mysqli_close($conn);   
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Casting World</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">     
        .help-block{
            color:red;
        }       
    </style>
    <script type="text/javascript">
        $(document).ready(function(){     
            $("#myModal").modal({backdrop: "static"});    
            $("#myModal").modal('show');           
        });  
</script>
</head>
    <?php
        include("include_files/header.php")
    ?>
    <?php
        include("include_files/navbar.php")
    ?>
    <body style="background-color:hsl(0, 0%, 98%);">
    <br><br><br>
    <!--background-color:#e6e6e6;-->
    <div class="container">   
   
    <div class="container" style="width:450px;border:1px solid lightgrey;background-color:white;border-radius:15px;"><br>
        <div style="text-align:center;color:#737373;font-weight:bold">    
            <h2> Admin/Agent Login </h2>    
        </div><br><br>
        <div id="Login">                            
            <form role="form" class="form-horizontal" method="post" action="adminlogin.php">
                <div class="form-group <?php echo (!empty($ausername_err)) ? 'has-error' : ''; ?>">
                    <label for="email" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ausername" value="<?php echo $ausername?>">
                        <span class="help-block"><?php echo $ausername_err; ?></span>
                    </div>
                </div>
                <div class="form-group <?php echo (!empty($apassword_err)) ? 'has-error' : ''; ?>">
                    <label for="exampleInputPassword1" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="apwd" >
                        <span class="help-block"><?php echo $apassword_err; ?></span>     
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-sm" name="adminsubmit" id="adminsubmit">Submit</button>&nbsp;&nbsp;&nbsp;                            
                    </div>
                </div>
            </form>                    
        </div><br>
    </div>   
</div>

<br><br><br><br><br>
    <?php
        include("include_files/contact.php")
    ?>
    <?php
        include("include_files/footer.php")
    ?>        
                

</body>
</html>
