<?php
session_start();
    if(!isset($_SESSION['uusername']) || empty($_SESSION['uusername'])){
        header("location: login.php");
        exit; 
    }
?>
<?php
include_once("database/config.php");

$fnameErr=$lnameErr=$dobErr=$ageErr=$genErr=$emailErr=$phoneErr=$addressErr=$categoryErr=$experienceErr=$resumeErr=$photoErr=$resumeErr="";
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];    
    $dob=$_POST['dob'];
    $age=$_POST['age'];
    $gen=$_POST['gen'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $category=$_POST['category'];    
    $experience=$_POST['experience'];
    //$photo=$_POST['pname'];

    // $filetmp = $_FILES["photo"]["tmp_name"];
    // $filename = $_FILES["photo"]["name"];
    // $filetype = $_FILES["photo"]["type"];    
    // $filepath = "photo/".$filename; 
    //     if($filetmp == "")      {
    //     $photoErr= "* Please select a photo";
    //     }else{
    //     move_uploaded_file($filetmp,$filepath);                     
    //     }      
       
    
    // checking empty fields
    if(empty($fname) || empty($lname) || empty($dob) || empty($age) || empty($phone) || empty($address) || empty($category) || empty($experience) ) {            
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
        
    } else {    
        //updating the table
        
        $result = $conn->query("UPDATE userdetail SET fname='$fname',lname='$lname',dob='$dob',age='$age',gen='$gen',email='$email',phone='$phone',address='$address',category='$category',experience='$experience' WHERE id=$id");
        //,ppath='$filepath',ptype='$filetype',pname='$filename'
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: user.php");
    }
}
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php
//getting id from url
$id = $_GET['id'];
//selecting data associated with this particular id
$result = $conn->query("SELECT * FROM userdetail WHERE id=$id");
 
while($res = $result->fetch_assoc())
{
    $fname = $res['fname'];
    $lname = $res['lname'];
    $email = $res['email'];
    $dob=$res['dob'];
    $age=$res['age'];
    $gen=$res['gen'];
    $email=$res['email'];  
    $phone=$res['phone'];
    $address=$res['address']; 
    $category=$res['category'];
    $experience=$res['experience'];
    $photo=$res['pname'];
    
    
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
    <div><?php include("include_files/usernavbar.php") ?></div> 
    <h2 style="margin-top:120px;"><center>Profile</center></h2><br>   
    <div class="container" style="border:1px solid grey;padding:30px;background-color:white;border-radius:20px;">
    <form name="form" method="post" action="userdetailedit.php" enctype="multipart/form-data">

        <fieldset>
            <legend><h2>Personal Details</h2></legend>
            <div class="row">               
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>First Name <font color="red">*</font></b>  &nbsp;&nbsp; &nbsp;</span>
                        <input  type="text" class="form-control" name="fname"  value="<?php echo $fname;?>">
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
<!--             <div class="row">               
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-addon" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>  &nbsp;<b>Photo <font color="red">*</font></b> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                        <input type="file" name="photo" id="photo" style="border:1px solid lightgrey;border-radius:3px;height:32px;padding: 4px;background-color:white;width:100%" value="<?php echo $photo;?>">
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
            </div><br> -->
            
        </fieldset><br><br>     
        <center><button class="button btn-primary btn-lg" style="width:50%" id="update" name="update">Update</button></center><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"><br>
    </form> 
    </div><br><br>
    <div><?php include("include_files/footer.php") ?></div>  
</body>
</html>

