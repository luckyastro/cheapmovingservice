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
		<h3>Enter your <u>Car</u>(<u>Year/Make/Model</u>)!</h3>
		<br />
		<h4>This verifies your identity and ensures an accurate quote.</h4>

		<br />

	
		<?php

		if ($_SESSION['zip1'] == $_SESSION['zip2']){

		?>

		<form method="post" action="/LO-thankyou.php">
			<div class="row">
				<div class="col-sm-4">
					<span>Car Year</span>
					<!-- <input type="text" name="auto_year" id="auto_year" placeholder="Car Year" required/> -->
					<select name="car-years" id="car-years"></select>
				</div>
				<div class="col-sm-4">
					<span>Car Make</span>
					<!-- <input type="text" name="auto_make" id="auto_make" placeholder="Car Make" required/> -->
					<select name="car-makes" id="car-makes"></select> 
				</div>
				<div class="col-sm-4">
					<span>Car Model</span>
					<!-- <input type="text" name="auto_model" id="auto_model" placeholder="Car Model" required/> -->
					<select name="car-models" id="car-models"></select>
				</div>
			</div>
			<input type="submit" name="submit" value="I'D LIKE MY QUOTE!">
		</form>
		
		
		<?php }else{ ?>
		
		
		<form method="post" action="/LD-thankyou.php">
			<div class="row">
				<div class="col-sm-4">
					<span>Car Year</span>
					<!-- <input type="text" name="auto_year" id="auto_year" placeholder="Car Year" required/> -->
					<select name="car-years" id="car-years"></select>
				</div>
				<div class="col-sm-4">
					<span>Car Make</span>
					<!-- <input type="text" name="auto_make" id="auto_make" placeholder="Car Make" required/> -->
					<select name="car-makes" id="car-makes"></select> 
				</div>
				<div class="col-sm-4">
					<span>Car Model</span>
					<!-- <input type="text" name="auto_model" id="auto_model" placeholder="Car Model" required/> -->
					<select name="car-models" id="car-models"></select>
				</div>
			</div>
			<input type="submit" name="submit" value="I'D LIKE MY QUOTE!">
		</form>
		
		
	<?php } ?>
		
	</div>
</section>

<section class="section-services">
	<div class="container">
		<h3>Need faster service call now: (224)252-1267</h3>
		<div class="row d-flex justify-content-center">
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-residential.svg">
					<div class="service-content">
						<h2>Connect with contractors</h2>
						<p>Need work done or looking to start a project? Get help from local professionals for any job.</P>
					</div>
					<a href="http://thumbtack.57ib.net/c/2954377/269257/4348?utm_source=cma-affiliate" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-storage.svg">
					<div class="service-content">
						<h2>Get junk removed</h2>
						<p>Have some stuff to get rid of? Fast and easy junk removal.</P>
					</div>
					<a href="https://shareasale.com/r.cfm?b=1094034&u=2921664&m=75506" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-packaging.svg">
					<div class="service-content">
						<h2>Storage</h2>
						<p>Got stuff that won't fit in the next place? You don't have to part with any of your belongings. Store all your extra items safely.</P>
					</div>
					<a href="https://neighbor.pxf.io/c/2954377/1234108/14066" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-commercial.svg">
					<div class="service-content">
						<h2>New home decoration</h2>
						<p>Want to decorate but don't know where to start? Explore tons of exciting options.</P>
					</div>
					<a href="https://www.tkqlhce.com/click-100467847-13771918" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-furniture.svg">
					<div class="service-content">
						<h2>Packing</h2>
						<p>Need help organizing for the big move?  Get high quality packing supplies to assist.</P>
					</div>
					<a href="https://shareasale.com/r.cfm?b=883129&u=2921664&m=66601" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
			<div class="col-sm-4 d-flex">
				<div class="service">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/service-recycling.svg">
					<div class="service-content">
						<h2>Solar panels</h2>
						<p>Interested in renewable energy for your new home? Evaluate Solar options that work for you and your family.</P>
					</div>
					<a href="https://renogy.sjv.io/c/2954377/1200167/14864" class="btn-arrow" target="_blank"></a>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="//www.carqueryapi.com/js/carquery.0.3.4.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var carquery = new CarQuery();
		carquery.init();
		carquery.setFilters({
			sold_in_us:true
		});
		carquery.initYearMakeModel('car-years', 'car-makes', 'car-models');
	});
</script>
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