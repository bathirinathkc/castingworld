<?php
session_start();
	if(!isset($_SESSION['uusername']) || empty($_SESSION['uusername'])){
  		header("location: login.php");
  		exit; 
	}
?>
<?php
require_once 'database/config.php';

	$fnameErr=$lnameErr=$dobErr=$ageErr=$genErr=$emailErr=$phoneErr=$addressErr=$chkErr=$courseErr=$categoryErr=$experienceErr=$resumeErr=$photoErr=$fname=$lname=$dob=$age=$gen=$email=$phone=$address=$category=$experience=$filetmp1 =$filename1 =$filetype1=$filetmp =$filename =$filetype=$filepath=$filepath1=$fileinfo=$fileinfo1="";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// First Name
		if (empty($_POST["fname"])) {
    		$fnameErr = "* Firsrname is required";
  		} else {
    		$fname = test_input($_POST["fname"]);
    		// check if name only contains letters and whitespace
    		if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
     			$fnameErr = "* Only letters and white space allowed"; 
    		}
  		}

	// Last Name
  		if (empty($_POST["lname"])) {
    		$lnameErr = "* Lastname is required";
  		} else {
    		$lname = test_input($_POST["fname"]);
    		// check if name only contains letters and whitespace
    		if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
     			$lnameErr = "* Only letters and white space allowed"; 
    		}
  		}

	// Date of Birth
  		if (empty($_POST["dob"])) {
    		$dobErr = "* Date Of Birth is required";
  		} else {
    		$dob = test_input($_POST["dob"]);    		
  		}

	// Age
  		$min = 18; $max = 35;
  		$age = test_input($_POST["age"]);
		if ( !(($age >= $min) && ($age <= $max))) {
    		$ageErr = "* Age should be between 18 to 35";
		}
		if (empty($_POST["age"])) {
			$ageErr = "* Age is required";
		}else {
			$age = test_input($_POST["age"]);
		}

	// Radio Button Gender
		if (empty($_POST["gen"])) {
    		$genErr = "* Gender is required";
  		} else {
    		$gen = test_input($_POST["gen"]);
  		}

	// Email 
  		if (empty($_POST["email"])) {
    		$emailErr = "* Email is required";
 		 } else {
    		$email = test_input($_POST["email"]);    
    			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      				$emailErr = "* Invalid email format"; 
    			}
  		}

	// Phone Number
  		if (empty($_POST["phone"])) {
    		$phoneErr = "* Phone Number is required";
  		} else {
    		$phone = test_input($_POST["phone"]);    		
    		if (!preg_match("/^[0-9]{3}[0-9]{3}[0-9]{4}$/",$phone)) {
     			$phoneErr = "* Enter a valid phone number"; 
    		}
  		}

	//Address
  		if (empty($_POST["address"])) {
    		$addressErr = "* Address is required";
  		} else {
    		$address = test_input($_POST["address"]);    		
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

	// Experience
  		if (empty($_POST["experience"])) {
    		$experienceErr = "* experience is required";
  		} else {
    		$experience = test_input($_POST["experience"]);
    		if (!preg_match("/^[0-9]$/",$experience)) {
     			$experienceErr = "* Enter a valid Experience"; 
    		}    		
    	}

	//photoErr
    	
  		$filetmp = $_FILES["photo"]["tmp_name"];
		$filename = $_FILES["photo"]["name"];
		$filetype = $_FILES["photo"]["type"];		
		$filepath = "photo/".$filename;		
		if($filetmp == "")		{
			$photoErr= "* Please select a photo";
		}else{			
			if($filesize > 2097152){
				echo "photo > 2mb";
			}else{
				if($filetype != "image/jpeg" && $filetype != "image/png" && $filetype != "image/gif"){
					echo "Please upload jpg / png / gif";
				}else{
					move_uploaded_file($filetmp,$filepath);						
					if($filetype == "image/jpeg"){
					  $imagecreate = "imagecreatefromjpeg";$imageformat = "imagejpeg";
					}
					if($filetype == "image/png"){						 
					  $imagecreate = "imagecreatefrompng";$imageformat = "imagepng";
					}
					if($filetype == "image/gif"){						 
					  $imagecreate= "imagecreatefromgif";$imageformat = "imagegif";
					}										
				}
				}				
			
		}

	//resume
		
  		$filetmp1 = $_FILES["resume"]["tmp_name"];
		$filename1 = $_FILES["resume"]["name"];
		$filetype1 = $_FILES["resume"]["type"];
		$filepath1 = "resume/".$filename1;		
		if($filetmp1 == "")		{
			$resumeErr= "* Please select a resume";
		}else{
				move_uploaded_file($filetmp1,$filepath1);								
		}
	
		if(empty($fnameErr) && empty($lnameErr) && empty($dobErr) && empty($ageErr) && empty($genErr) && empty($emailErr) && empty($phoneErr) && empty($addressErr) && empty($categoryErr) && empty($experienceErr)){
        // Prepare an insert statement
        $sql = "INSERT INTO userdetail(uusername,fname,lname,dob,age,gen,email,phone,address,category,experience,pname,ppath,ptype,rname,rpath,rtype) VALUES (?,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?)";         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssss",$param_uusername, $param_fname, $param_lname, $param_dob,$param_age,
            	$param_gen, $param_email, $param_phone,$param_address, 
            	$param_category, $param_experience,$param_pname, $param_ppath, 
            	$param_ptype,$param_rname, $param_rpath, $param_type);
            
            // Set parameters
            $param_uusername=$_SESSION['uusername'];$param_fname =$fname ; $param_lname =$lname; $param_dob=$dob ; $param_age=$age;
            $param_gen=$gen ; $param_email=$email ;  $param_phone=$phone ; $param_address=$address ; 
            $param_category=$category ; $param_experience=$experience ;$param_pname=$filename ; $param_ppath=$filepath ; 
            $param_ptype=$filetype ;$param_rname=$filename1 ;$param_rpath=$filepath1 ; $param_type=$filetype1 ;
                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: user.php");
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
<body  style="background-color:hsl(0, 0%, 95%);">
	<div><?php include("include_files/usernavbar.php") ?></div> 	
	<h1 style="margin-top:110px;"><center>Profile</center></h1>	<br>
	<div class="container" style="background-color:white;border:1px solid grey;border-radius:10px;padding:20px;">
	<form name="form" method="post" action="form.php" enctype="multipart/form-data">

		<fieldset>
			<legend><h2>Personal Details</h2></legend>
			<div class="row">				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>First Name <font color="red">*</font></b>  &nbsp;&nbsp; &nbsp;</span>
        				<input  type="text" class="form-control" name="fname" placeholder="Enter Your First Name" value="<?php echo $fname;?>">
   					</div>	
   					<span class="error"> <?php echo $fnameErr;?></span>				
				</div>

				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>Last name <font color="red">*</font></b> &nbsp;&nbsp;&nbsp;</span>
        				<input  type="text" class="form-control" name="lname" placeholder="Enter Your Last Name" value="<?php echo $lname;?>">
   					</div>
   					<span class="error"> <?php echo $lnameErr;?></span>					
				</div>				
			</div><br>

			<div class="row">				
				<div class="col-sm-4">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-leaf"> </i> &nbsp;<b>Date of Birth <font color="red">*</font></b>&nbsp;&nbsp;</span>
						<input  type="date" class="form-control" name="dob" value="<?php echo $dob;?>">
					</div>
					<span class="error"> <?php echo $dobErr;?></span>
				</div>
				<div class="col-sm-2">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i> &nbsp;<b>Age <font color="red">*</font></b> &nbsp; </span>
						<input  type="number" class="form-control" name="age" value="<?php echo $age;?>">
					</div>
					<span class="error"> <?php echo $ageErr;?></span>
				</div>
				
				<div class="col-sm-6" style="font-size:18px">   
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15pxcolor:#00b3b3;"><i class="glyphicon glyphicon-user"></i> &nbsp;<b>Gender <font color="red">*</font></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
        				<div style="border:1px solid lightgrey;border-radius:3px;height:35px;padding: 4px;background-color:white;">&nbsp;
						<input type="radio" name="gen" value="Male" <?php if (isset($gen) && $gen=="Male") echo "checked";?>>&nbsp;Male&nbsp;&nbsp;
					<input type="radio" name="gen" value="Female" <?php if (isset($gen) && $gen=="Female") echo "checked";?>>&nbsp;Female&nbsp;&nbsp;
					<input type="radio" name="gen" value="Others" <?php if (isset($gen) && $gen=="Others") echo "checked";?>>&nbsp;Others&nbsp;&nbsp;
					</div> </div>
					<span class="error" style="font-size:15px;"> <?php echo $genErr;?></span>		
				</div>	
			</div><br>

			<div class="row">				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-envelope"></i> &nbsp; <b>E - mail <font color="red">*</font></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
						<input  type="text" class="form-control" name="email" placeholder="Enter Your email" value="<?php echo $email;?>">
					</div>
					<span class="error"> <?php echo $emailErr;?></span>
				</div>
				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-phone"></i>  &nbsp; <b>Phone No. <font color="red">*</font></b>&nbsp;&nbsp;&nbsp;</span>
						<input  type="text" class="form-control" name="phone" placeholder="Enter Your Mobile Number" value="<?php echo $phone;?>">
					</div>
					<span class="error"> <?php echo $phoneErr;?></span>
				</div>
			</div><br>

			<div class="row">
				<div class="col-sm-12">
				<div class="input-group">
        			<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-road"></i> &nbsp;&nbsp;<b>Address <font color="red">*</font></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        			<input id="msg" type="text" class="form-control" name="address" placeholder="Enter Your Address" value="<?php echo $address;?>">
    			</div>
					<span class="error"> <?php echo $addressErr;?></span>
    				</div>			
			</div>
		</fieldset><br>

		<fieldset>
			<legend><h2>Professional Details</h2></legend>
			<div class="row">				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>Category <font color="red">*</font></b>  &nbsp;&nbsp; &nbsp;</span>
        				<input  type="text" class="form-control" name="category" value="<?php echo $category;?>" placeholder="Actor, Actress,...">
   					</div>	
   					<span class="error"> <?php echo $categoryErr;?></span>				
				</div>

				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>Experience <font color="red">*</font></b> &nbsp;&nbsp;&nbsp;</span>
        				<input  type="text" class="form-control" name="experience" placeholder="Enter Your Last Name" value="<?php echo $experience;?>">
   					</div>
   					<span class="error"> <?php echo $experienceErr;?></span>					
				</div>				
			</div><br>
			<div class="row">				
				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>Photo <font color="red">*</font></b> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
        				<input type="file" name="photo" id="photo" style="border:1px solid lightgrey;border-radius:3px;height:32px;padding: 4px;background-color:white;width:100%" >
   					</div>	
   					<span class="error"> <?php echo $photoErr;?></span>				
				</div>

				<div class="col-sm-6">
					<div class="input-group">
        				<span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>Resume <font color="red">*</font></b> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</span>
        				<input type="file" name="resume" id="resume" style="border:1px solid lightgrey;border-radius:3px;height:32px;padding: 4px;background-color:white;width:100%" >
   					</div>
   					<span class="error"> <?php echo $resumeErr;?></span>					
				</div>				
			</div><br>
			
		</fieldset><br><br>		
		<center><button class="button btn-primary btn-lg" style="width:50%" id="submit" name="submit">Submit</button></center><br>
	</form>	
	</div><br><br>
	<div><?php include('include_files/footer.php'); ?></div>	
</body>
</html>


