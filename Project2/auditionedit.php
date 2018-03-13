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


if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $scriptno=$_POST['scriptno'];
    $script=$_POST['script'];
    $auditiondate=$_POST['auditiondate']; 
    $audition=$_POST['audition'];
    $category=$_POST['category'];  
    $age=$_POST['age'];    
       
    
    // checking empty fields
    if(empty($scriptno) || empty($script) || empty($auditiondate) || empty($audition) || empty($category)|| empty($age)) {            
        if (empty($_POST["scriptno"])) {
            $scriptnoErr = "* Script No is required";
        } else {
            $scriptno = $_POST["scriptno"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[0-9]*$/",$scriptno)) {
                $scriptnoErr = "* Only Number is allowed"; 
            }
        }

    if (empty($_POST["script"])) {
            $scriptErr = "* Script is required";
        } else {
            $script =$_POST["script"];
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

        if (empty($_POST["age"])) {
            $ageErr = "* Age is required";
        }else {
            $age = $_POST["age"];
        }

        // Category
        if (empty($_POST["category"])) {
            $categoryErr = "* category is required";
        } else {
            $category = $_POST["category"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$category)) {
                $categoryErr = "* Only letters and white space allowed"; 
            }
        }
        
        // audition
        if (empty($_POST["audition"])) {
            $auditionErr = "* Audition at is required";
        } else {
            $audition = $_POST["audition"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$audition)) {
                $auditionErr = "* Only letters and white space allowed"; 
            }
        }       
    } else {    
        //updating the table
        $result = $conn->query("UPDATE auditiondetails SET scriptno='$scriptno',script='$script',auditiondate='$auditiondate',audition='$audition',category='$category',age='$age' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: auditionindex.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id']; 
//selecting data associated with this particular id
$result = $conn->query("SELECT * FROM auditiondetails WHERE id=$id");
 
while($res = $result->fetch_assoc())
{   
    $scriptno = $res['scriptno'];
    $script = $res['script'];
    $auditiondate = $res['auditiondate'];
    $audition=$res['audition'];     
    $category=$res['category'];
    $age=$res['age'];
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
    <h2 style="margin-top: 130px;"><center>Edit Audition Details</center></h2><br><br>   
    <div class="container" style="border:1px solid grey;background-color:white;border-radius:10px;">
    <form name="form" method="post" action="auditionedit.php" enctype="multipart/form-data"><br><br>

        <fieldset>
          
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
        <center><button class="button btn-primary btn-lg" style="width:50%" id="update" name="update">Update</button></center><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"><br>
    </form> <br>
    </div> <br><br><br>
    <div><?php include("include_files/footer.php") ?></div>  
</body>
</html>

