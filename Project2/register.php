<?php
// Include config file
require_once 'database/config.php';
 
// Define variables and initialize with empty values
$uusername = $upwd = $confirm_password = $category = "";
$username_err = $password_err = $confirm_password_err = $confirm_category_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["uusername"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM userlogin WHERE uusername = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["uusername"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $uusername = trim($_POST["uusername"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['upwd']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['upwd'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $upwd = trim($_POST['upwd']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($upwd != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    

    // category
    if (empty(trim($_POST["category"]))) {        
            $confirm_category_err = 'Category is required.';
            echo "<style>";    
            echo "#div1{border:1px solid brown;}"; 
            echo "</style>";       
        } else {
            $category = trim($_POST["category"]);           
        }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO userlogin (uusername, upwd, category) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_category);
            
            // Set parameters
            $param_username = $uusername;
            $param_password = password_hash($upwd, PASSWORD_DEFAULT); // Creates a password hash
            $param_category = $category;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}


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
        sup{color:red;}
        .help-block{color:black;}
        
        
    </style>
</head>
    <?php
        include("include_files/header.php")
    ?>
    <?php
        include("include_files/navbar.php")
    ?>
<body style="background-color:hsl(0, 0%, 98%);">
    <br><br>
        
    <div class="container" style="width:450px;border:1px solid lightgrey;background-color:white;border-radius:15px;">
        <div style="color:#737373;">
            <br>
        <h2 align="center">Sign Up</h2><br>
        </div>
        <div>
        <p align="center" style="color:blue;font-style:italic;">Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="uusername" class="form-control" value="<?php echo $uusername; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="upwd" class="form-control" value="<?php echo $upwd; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_category_err)) ? 'has-error' : ''; ?>">
                <label>Category:<sup>*</sup></label>
                <div style="border-radius:5px;height:35px;padding:6px;padding-left:20px;font-size:16px;width:200px;" id="div1">
                    <input type="radio" name="category" value="Free" <?php if (isset($category) && $category=="Free") echo "checked";?>>&nbsp;<span data-toggle="tooltip" title="Only 3 Trials are free" data-placement="bottom">Free</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="category" value="Subscribe" <?php if (isset($category) && $category=="Subscribe") echo "checked";?>>&nbsp;Subscribe
                </div>
                    
                <span class="help-block"><?php echo $confirm_category_err; ?></span>
            </div>
            <div class="form-group" align="center">                
                <input type="reset" class="btn btn-danger" value="Reset">&nbsp;&nbsp;
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="login.php"><b>Login here</b></a>.</p>
        </form>
    </div> 
    </div> <br><br><br>
    <?php
        include("include_files/contact.php")
    ?>
    <?php
        include("include_files/footer.php")
    ?>  
</body>
</html>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
