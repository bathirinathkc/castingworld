<html>
	<head>		
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
	<div id="main">		
		<div id="container">
			<h2>Casting World Subscription</h2>
			<hr/>
			<div id="book_container">
				<center><img src="../images/logologin.png"></center><br>
				
				<form action="process.php" method="POST">
					<div class="fgrow">
						<span>Select a Plan :-</span>
						<select id="select_plan" name="select_plan">
							<option value="Daily">Daily</option>
							<option value="Weekly">Weekly</option>
							<option value="Monthly">Monthly</option>
							<option value="Yearly">Yearly</option>
						</select>
					</div>
					<div class="fgrow">
						<span>After How Many Cycles Should Billing Stop ?</span>
						<select id="select_cycles" name="select_cycles">
							<option value="">Never</option>
							<?php for ($i = 2; $i <= 30; $i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
					<input type="submit" value="Subscribe" name="submit" id="subscribe">
				</form>
			</div>
			<div id="book_container">
				<center> <h3 style="color:#ff2288">Casting World Subscription Details</h3></center>				
				<ul>
					<li><b>Daily</b></li>
					<P class="mrtpbt">If you pay daily - <b>$5/Day.</b></P>
					<li><b>Weekly</b></li>
					<P class="mrtpbt">If you pay Weekly - <b>$30/Week.</b></P>
					<li><b>Monthly</b></li>
					<P class="mrtpbt">If you pay Monthly -  <b>$120/Month.</b></P>
					<li><b>Yearly</b></li>
					<P class="mrtpbt">If you pay Yearly - <b>$1400/Year.</b></P>
				</ul>
				<br>
				<i> Note : Amount will take 1st day of every Month/Year/Week</i>
			</div>
		</div>
		
	</div>	
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		$('#select_plan').on('change', function() {
			if (this.value === 'Daily') {
				$('input#subscribe').val('Subscrive ($5/Day)');
			} else if (this.value === 'Weekly') {
				$('input#subscribe').val('Subscrive ($30/Week)');
			} else if (this.value === 'Monthly') {
				$('input#subscribe').val('Subscrive ($120/Month)');
			} else if (this.value === 'Yearly') {
				$('input#subscribe').val('Subscrive ($1400/Year)');
			}
		});
	});
</script>