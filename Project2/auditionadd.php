<?php
session_start();
if(!isset($_SESSION['ausername']) || empty($_SESSION['ausername'])){
     header("location: login.php");
    exit;
}
?>
<?php
require_once 'database/config.php';

	$scriptnoErr=$scriptErr=$auditiondateErr=$auditionErr=$categoryErr=$ageErr="";
	$scriptno=$script=$auditiondate=$audition=$category=$age="";


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Script Number
		if (empty($_POST["scriptno"])) {
    		$scriptnoErr = "* Script Number is required";
  		} else {
    		$scriptno = test_input($_POST["scriptno"]);
    		// check if name only contains letters and whitespace
    		if (!preg_match("/^[0-9 ]*$/",$scriptno)) {
     			$scriptnoErr = "* Only Number are allowed"; 
    		}
  		}

	// Script
  		if (empty($_POST["script"])) {
    		$scriptErr = "* Script is required";
  		} else {
    		$script = test_input($_POST["script"]);
    		// check if name only contains letters and whitespace
    		if (!preg_match("/^[a-zA-Z ]*$/",$script)) {
     			$scriptErr = "* Only letters and white space allowed"; 
    		}
  		}

	// auditiondate
  		if (empty($_POST["auditiondate"])) {
    		$auditiondateErr = "* Audition date is required";
  		} else {
    		$auditiondate = test_input($_POST["auditiondate"]);    		
  		}

  	// audition
  		if (empty($_POST["audition"])) {
    		$auditionErr = "* Audition at is required";
  		} else {
    		$audition = test_input($_POST["audition"]);    		
  		}

	// Age
  		if (empty($_POST["age"])) {
			$ageErr = "* Age is required";
		}else {
			$age = test_input($_POST["age"]);
		}	

	// Category
		if (empty($_POST["category"])) {
    		$categoryErr = "* category is required";
  		} else {
    		$category = test_input($_POST["category"]);
    		// check if name only contains letters and whitespace
    		if (!preg_match("/^[a-zA-Z ]*$/",$category)) {
     			$categoryErr = "* Only letters and white space allowed"; 
    		}
  		}	
		
		if(empty($scriptnoErr) && empty($scriptErr) && empty($auditiondateErr) && empty($auditionErr) && empty($categoryErr) && empty($ageErr)){
        // Prepare an insert statement
        $sql = "INSERT INTO auditiondetails(scriptno,script,auditiondate,audition,category,age) VALUES (?,?,?,?,?,?)";         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_scriptno, $param_script, $param_auditiondate,$param_audition,$param_category, $param_age);
            
            // Set parameters
            $param_scriptno =$scriptno ; 
            $param_script =$script; 
            $param_auditiondate=$auditiondate ; 
            $param_audition=$audition;
            $param_category=$category ;
             $param_age=$age ;  
                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: auditionindex.php");
                exit();
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
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<!DOCTYPE html>
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
	</style>	
</head>
<body style="background-color:hsl(0, 0%, 95%);">                 
    <div><?php include("include_files/adminnavbar.php") ?></div>   
	<h2 style="margin-top:130px;"><center>Add Audition Details</center></h2> <br>
  <div style="background-color:white;border-radius: 10px;border:1px solid grey;width:1200px;" class="container">	
	<div class="container" ><br>
	<form name="form" method="post" action="auditionadd.php">
    
		<fieldset><br>			
			<div class="row">				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><b>Script No<font color="red">*</font></b>  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</span>
        				<input  type="text" class="form-control" name="scriptno" value="<?php echo $scriptno;?>">
   					</div>	
   					<span class="error"> <?php echo $scriptnoErr;?></span>				
				</div>

				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><b>Script <font color="red">*</font></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span>
        				<input  type="text" class="form-control" name="script"  value="<?php echo $script;?>">
   					</div>
   					<span class="error"> <?php echo $scriptErr;?></span>					
				</div>				
			</div><br>

			<div class="row">				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><b>Audition Date<font color="red">*</font></b>&nbsp;&nbsp;</span>
						<input  type="date" class="form-control" name="auditiondate" value="<?php echo $auditiondate;?>">
					</div>
					<span class="error"> <?php echo $auditiondateErr;?></span>
				</div>
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><b>Audition At <font color="red">*</font></b> &nbsp; </span>
						<input  type="text" class="form-control" name="audition" value="<?php echo $audition;?>">
					</div>
					<span class="error"> <?php echo $auditionErr;?></span>
				</div>							
			</div><br>
			
			<div class="row">				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><b>Role <font color="red">*</font></b>  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</span>
        				<input  type="text" class="form-control" name="category" value="<?php echo $category;?>" placeholder="Actor, Actress,...">
   					</div>	
   					<span class="error"> <?php echo $categoryErr;?></span>				
				</div>

				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><b>Age <font color="red">*</font></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span>
        				<input  type="text" class="form-control" name="age" value="<?php echo $age;?>">
   					</div>
   					<span class="error"> <?php echo $ageErr;?></span>					
				</div>				
			</div><br>
			
			
		</fieldset><br><br>		
		<center><button class="button btn-primary btn-lg" style="width:50%" id="submit" name="submit">Submit</button></center><br><br>
	</form>
  </div>
	</div><br><br><br><br>	
  <div><?php include("include_files/footer.php") ?></div>

</body>
</html>
