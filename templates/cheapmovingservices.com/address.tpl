<?php

$phone = preg_replace( "/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $_SESSION['phone1'] );

?>

<section class="page-banner">
	<div class="container">
		<h1><?php echo $_SESSION['firstname']; ?>, You're Almost Done!</h1>
	</div>
</section>

<section class="page-content">
	<div class="container">
		<h3>Enter your <u>current</u> street address (<u>no city/state/zip</u>)!</h3>
		<br />
		<h4>This verifies your identity and ensures an accurate quote.</h4>

		<br />

	
		<?php

		if ($_SESSION['zip1'] == $_SESSION['zip2']){

		?>

		<form method="post" action="/LO-thankyou.php">

			<div class="row">
				<div class="col-sm-12">
					<span>Your Current Street Address</span>
					<input type="text" name="address" id="address" placeholder="current street address (no city/state/zip)" required/>
				</div>
			</div>

			<input type="submit" name="submit" value="I'D LIKE MY QUOTE!">
		</form>
		
		
		<?php }else{ ?>
		
		
			<form method="post" action="/LD-thankyou.php">

			<div class="row">
				<div class="col-sm-12">
					<span>Your Current Street Address</span>
					<input type="text" name="address" id="address" placeholder="current street address (no city/state/zip)">
				</div>
			</div>

			<input type="submit" name="submit" value="I'D LIKE MY QUOTE!">
		</form>
		
		
	<?php } ?>
		
	</div>
</section>

<!-- PIXELS -->

<?php if ( $_SESSION['traffic_source_id'] != '' ) { ?>
<img src="https://ier3.com/ping/4f4467794d51/<?php echo $_SESSION['sub2']; ?>/<?php echo $_SESSION['lead_id']; ?>/" width="1" height="1">
<?php } ?>

<!-- Event snippet for Moving Lead conversion page -->
<?php if ( $_SESSION['gclid'] != '' ) { ?>
<script>
  gtag('event', 'conversion', {'send_to': 'AW-869690515/W900CNaJsmsQk9nZngM'});
</script>
<?php } ?>