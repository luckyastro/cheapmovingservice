<section class="section-requestquote">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				
				<h3 class="section-pretitle">The <?php echo $conf['s_name']; ?> Network</h3>
				<h1 class="section-title">Up to 65% off!</h1>
				<p class="section-subtitle">Whether you're moving down the street or across the country, <?php echo $conf['s_name']; ?> is here to help!</p>
				<p class="section-subtitle">Enter in your information using the form provided. You will receive moving quotes to help you with your move.</p>
				<p class="section-subtitle"><b>Only VALID information will receive a quote!</b></p>

				<center>
				<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/ssl.png" width="208" height="93">
				</center>
				
				<?php /*<a href="#" class="btn-common large">Receive FREE quotes!</a>*/ ?>
				
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