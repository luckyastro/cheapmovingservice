<?php

$pop_url = '';
$redirect_url = '';

if ( $pop_url != '' )
{
	$pop_code = ' onsubmit="openOffer( \'' . $pop_url . '\' );" ';
}
else
{
	$pop_code = '';
}
	
?>

<section class="home-banner lander1">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				
		       
			</div>
            <div class="col-sm-6">

				<div class="splash-headline">
					
					<h1>Save Up to 70%!</h1>

					<h3>Whether you're moving down the street or across the country, <?php echo $conf['s_name']; ?> is here to help!</h3>
					
					<br />
					
					<h3>Enter in your information using the form provided. You will receive moving quotes to help you with your move.</h3>
					
					<br />
					
					<h3><b>Only VALID information will receive a quote!</h3>

					<br />
					
					<center>
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/trust_brands.png">
					</center>
					
					<br />
				</div>

			</div>
		</div>
	</div>
</section>

<section class="section-testimonial">
	<div class="container">
		<h1 class="section-title">Customers Are Talking</h1>
		<div class="row">
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>We really enjoyed working with <?php echo $conf['s_name']; ?>. We saved hundreds over what we were originally quoted from other companies. Thanks!!</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>William C.</h2>
					<h3><?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?></h3>
				</div>
			</div>
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>My wife and I were referred to <?php echo $conf['s_name']; ?> last year. You're in great hands with them. We were very happy with the experience.</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>Juan U.</h2>
					<h3><?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?></h3>
				</div>
			</div>
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>My roommates and I needed to move out of our apartment fast. With <?php echo $conf['s_name']; ?>'s help, everything worked out great. Thanks, guys!</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>Melissa H.</h2>
					<h3><?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?></h3>
				</div>
			</div>
		</div>
		<?php /*<div class="btn-container"><a href="#" class="btn-common large">View All Testimonials</a></div>*/ ?>
	</div>
</section>