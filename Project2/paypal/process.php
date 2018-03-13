<?php
if (isset($_POST['submit'])) {

	$total_cycle = $_POST['select_cycles'];
	$product_name = 'Casting World';
	$product_currency = 'USD';

	if ($_POST['select_plan'] == 'Daily') {
		$cycle_amount = 5;
		$cycle = 'D';
	} else if ($_POST['select_plan'] == 'Weekly') {
		$cycle_amount = 30;
		$cycle = 'W';
	} else if ($_POST['select_plan'] == 'Monthly') {
		$cycle_amount = 150;
		$cycle = 'M';
	} else if ($_POST['select_plan'] == 'Yearly') {
		$cycle_amount = 1400;
		$cycle = 'Y';
	}
	//Here we can use PayPal URL or sandbox URL.
	$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	//Here we can used seller email id.
	$merchant_email = 'bathirikc@castingworld.com';
	//here we can put cancel URL when payment is not completed.
	$cancel_return = 'http://localhost/bathiri/Project2/paypal/cancel.php';
	//here we can put cancel URL when payment is Successful.
	$success_return = 'http://localhost/bathiri/Project2/paypal/success.php';
?>
<form name = "myform" action = "<?php echo $paypal_url; ?>" method = "post" target = "_top">
	<div align="center"><br><br><br><br><br><br><img src="../images/processing.gif"/></div>

	<input type="hidden" name="cmd" value="_xclick-subscriptions">
	<input type = "hidden" name = "business" value = "<?php echo $merchant_email; ?>">
	<input type="hidden" name="lc" value="IN">
	<input type = "hidden" name = "item_name" value = "<?php echo $product_name; ?>">
	<input type="hidden" name="no_note" value="1">
	<input type="hidden" name="src" value="1">
	<?php if (!empty($total_cycle)) { ?>
	<input type="hidden" name="srt" value="<?php echo $total_cycle; ?>">
	<?php } ?>
	<input type="hidden" name="a3" value="<?php echo $cycle_amount; ?>">
	<input type="hidden" name="p3" value="1">
	<input type="hidden" name="t3" value="<?php echo $cycle; ?>">
	<input type="hidden" name="currency_code" value="<?php echo $product_currency; ?>">
	<input type = "hidden" name = "cancel_return" value = "<?php echo $cancel_return ?>">
	<input type = "hidden" name = "return" value = "<?php echo $success_return; ?>">
	<input type="hidden" name="bn" value="PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHostedGuest">
	
</form>
<script type="text/javascript">
document.myform.submit();
</script>
<?php }
?>