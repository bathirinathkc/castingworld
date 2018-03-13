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
  		li a:hover{background-color:yellow;}
  	</style>
</head>

<body>	
	<?php include("include_files/header.php") ?>

	<?php include("include_files/navbar.php") ?>

	<a href="login.php" style="text-decoration:none;color:black;"><div style="background-image:url(images/back1.jpg);background-size: 100% 560px;opacity:0.8">
		<br><br><br><center><h1 style="font-size:55px;font-style:italic;font-family:Lucida Console;">Audition is Open</h1><center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>		
	</div></a>

	<div class="container" style="padding:50px;">
		<div class="row">
			<div class="col-sm-3" style="padding: 10px;">
				<img src="images/back2.jpg" width="100%" height="350">
			</div>
			<div class="col-sm-9">
				<p style="font-size:15px;line-height:2;text-align:justify;padding:20px;background-color:hsl(0, 0%, 95%); ">Entertainment is a form of activity that holds the attention and interest of an audience, or gives pleasure and delight. It can be an idea or a task, but is more likely to be one of the activities or events that have developed over thousands of years specifically for the purpose of keeping an audience's attention.Although people's attention is held by different things, because individuals have different preferences in entertainment, most forms are recognisable and familiar. Storytelling, music, drama, dance, and different kinds of performance exist in all cultures, were supported in royal courts, developed into sophisticated forms and over time became available to all citizens. The process has been accelerated in modern times by an entertainment industry that records and sells entertainment products. Entertainment evolves and can be adapted to suit any scale, ranging from an individual who chooses a private entertainment from a now enormous array of pre-recorded products; to a banquet adapted for two; to any size or type of party, with appropriate music and dance; to performances intended for thousands; and even for a global audience.</p>
			</div>
		 </div>	
	</div>

	

	<div style="padding:50px;background-color:hsl(0, 0%, 92%);" id="div2">
		<div class="container">
			<h1 align="center">About US</h1>
			<div class="row">
			<div class="col-sm-8" style="font-size:15px;line-height:1.5;text-align:justify;padding:20px;">
				<p><b>Castingworld.com</b> India's first online portal is a talent bank of talented actors. Some who have proved their mettle and some who are on the way to becoming the talk of the town.</p>

				<p>The majority of the actors of our talent bank are graduates from premier institutes like FTII, NSD, Rang Mandal, etc while others are from theater or are those who are known for their body of work.</p>

				<p>Simply, Log on to the portal to have a look at the talent's profiles, availability and other vital details. Live Chats can also be arranged for!</p>

				<p>Production houses and filmmakers can post their requirements and get multiple options for a role, be it lead or cameo. It's absolutely free. No Joining Fees! No Registration Charges! No Hidden Cost of any kind either for the talent or for Production Houses, Film-makers, Event Managers.</p>

				<p>Talent wishing to be a part of the talent bank needs to submit pictures, profiles and work links. Our selection committee will examine the applications and shortlist the talent. Only the short-listed ones will gain entry to the portal after signing up for an exclusive contract with us.</p>

				<p>Bombaycasting.com is just a bridge between talent and talent seekers. It does not wish to control the choice nor the price of the talent.</p>

				<p>If you are not based in Mumbai then also you are not at the disadvantage, <b>Castingworld.com</b> will conduct auditions at your doorstep (T&C applicable) by sending in the test script for an audition under the supervision of in-house professional directors and DOPs.</p>

				<p>If you have talent, then <b>Castingworld.com</b> is your platform.</p>
			</div>
			<div class="col-sm-4" style="padding: 20px;">
				<img src="images/back2.jpg" width="100%" height="460">
			</div>
			</div>
		 </div>			
	</div>

	<div>
		<br><br><br><?php include("include_files/carosel.html") ?><br><br><br>
	</div>

	<div style="padding:50px;background-color:hsl(0, 0%, 92%);" id="div3">
		<h1 align="center">FIND TALENTS</h1><br><br>
		<div class="row" align="center">
			<div class="col-sm-4"><a href="login.php" style="text-decoration:none;">
				<img src="images/menactor.jpg" width="300" height="300">
				<div style="background-color:hsl(0, 0%, 30%);color:white;width:300px;font-size: 25px;padding:20px;">Actors<br></div></a>
			</div>
			<div class="col-sm-4"><a href="login.php" style="text-decoration:none;">
				<img src="images/women.jpg" width="300" height="300">
				<div style="background-color:hsl(0, 0%, 30%);color:white;width:300px;font-size: 25px;padding:20px;">Actresses<br></div></a>
			</div>
			<div class="col-sm-4"><a href="login.php" style="text-decoration:none;">
				<img src="images/child.jpg" width="300" height="300">
				<div style="background-color:hsl(0, 0%, 30%);color:white;width:300px;font-size: 25px;padding:20px;">Child Actors<br></div></a>
			</div>
		</div>
	</div>
	
	<div id="contactus"> 
	<?php
		include("include_files/contact.php")
	?>
	</div>
	<?php
		include("include_files/footer.php")
	?>	
</body>
</html>

<?php
	$conn = new mysqli('localhost','root','','castingworld');

	if (isset($_POST['submit'])) {
	
	$name=$_POST["name"];$email=$_POST["email"];$phone=$_POST["phone"];$comment=$_POST["comment"];
	$sql = "INSERT INTO comment (name, email, phoneno, comment) VALUES ('$name', '$email', '$phone', '$comment')";
	if(mysqli_query($conn, $sql)){
    	echo '<script language="javascript">';
  		echo 'alert("Message sent successfully")';
  		echo '</script>';
	} else{
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	mysqli_close($conn);
	}
?>
