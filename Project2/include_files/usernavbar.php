<div class="navbar navbar-fixed-top">
    <div style="background-color:#666666;height:50px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    <img src="images/logo.PNG" width="100" height="50" style="float:left;">
                </div>
                <div class="col-sm-5">
                    <p style="text-decoration:none;float:left;font-size:30px;color:#ffcc66;font-family:Courier New;margin-top:4px;">&nbsp;Casting World</p>  
                </div>
                <div class="col-sm-5">
                    <h4 style="color:white;float:right;text-transform:capitalize;margin-top:18px;"> Hi, <?php echo $_SESSION['uusername']; ?>&nbsp;&nbsp;&nbsp;</h4> 
                </div>
                <div class="col-sm-1">
                    <a href="logout.php" class="btn btn-danger" style="float:right;margin-top:8px;">Sign Out</a>
                </div>            
            </div>
        </div>   
    </div>    

    <div style="background-color:hsl(0, 0%, 85%);height:50px;">  
    <div class="container">
    <div class="btn-group btn-group-justified" style="margin-top:7px;" >

      	<a href="user.php" class="btn btn-primary" id="btnuserlogin" style="font-size:16px;">Profile &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span></a>

    		<a href="useraudition.php" class="btn btn-primary" style="font-size:16px;">Audition &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-th-list"></span></a>

    		<a href="#" class="btn btn-primary" style="font-size:16px;">Gallery &nbsp;&nbsp;&nbsp;<span class="glyphicon  glyphicon-th"></span></a>
      	
    	</div>
      </div>	
      </div>
  </div>