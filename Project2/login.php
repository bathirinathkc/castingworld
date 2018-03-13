<?php
require_once 'database/config.php';

$uusername = $upwd = "";
$uusername_err = $upassword_err = "";

$ausername = $apwd = "";
$ausername_err = $apassword_err = "";  

if(isset($_POST['usersubmit'])){
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Check if username is empty
    if(empty(trim($_POST["uusername"]))){
        $uusername_err = 'Please enter username.';
    } else{
        $uusername = trim($_POST["uusername"]);
    }    
// Check if password is empty
    if(empty(trim($_POST['upwd']))){
        $upassword_err = 'Please enter your password.';
    } else{
        $upwd = trim($_POST['upwd']);
    }    
// Validate credentials
    if(empty($uusername_err) && empty($upassword_err)){
        // Prepare a select statement
        $sql = "SELECT uusername, upwd FROM userlogin WHERE uusername = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $uusername;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $uusername, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($upwd, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['uusername'] = $uusername;                                  
                            header("location: user.php");
                        } 
                        else{
                            // Display an error message if password is not valid
                            $upassword_err = 'The password you entered was not valid.';
                        }
                    }
                } 
                else{
                    // Display an error message if username doesn't exist
                    $uusername_err = 'No account found with that username.';
            	}
        	} 
        	else{
            echo "Oops! Something went wrong. Please try again later.";
        	}
    	}        
        // Close statement
        mysqli_stmt_close($stmt);
    }    
    // Close connection
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
        	<h2> User Login </h2>    
        </div><br><br>
        <div id="Login">                            
            <form role="form" class="form-horizontal" method="post" action="login.php">
                <div class="form-group <?php echo (!empty($uusername_err)) ? 'has-error' : ''; ?>">
                    <label for="email" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="uusername" value="<?php echo $uusername?>">
                        <span class="help-block"><?php echo $uusername_err; ?></span>
                    </div>
                </div>
                 <div class="form-group <?php echo (!empty($upassword_err)) ? 'has-error' : ''; ?>">
                    <label for="exampleInputPassword1" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="upwd" >
                        <span class="help-block"><?php echo $upassword_err; ?></span>     
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-sm" name="usersubmit" id="usersubmit">Submit</button>&nbsp;&nbsp;&nbsp;
                        <a href="register.php"><i>New Registration</i></a>
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


