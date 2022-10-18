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

                <?php if ( $_REQUEST['error'] != '' ) { ?>
					<div class="alert alert-danger" role="alert">
						<b>Error.</b> The emails provided to not match. Please correct and try again.
					</div>
				<?php } ?>
				
		        <form method="post" action="/transitions.php" id="formID" class="form-common"<?php echo $pop_code; ?>>
		        <input type="hidden" name="lead_intake_type" value="0">
		        <input type="hidden" name="source_id" value="21645">
		        <input type="hidden" name="redirect" value="<?php echo $redirect_url; ?>">
		        <input type="hidden" name="lead_source" value="<?php echo $conf['s_domain']; ?>">
		        <input type="hidden" name="lander" value="buy-moving-leads.php">
		        <input type="hidden" name="u_type" value="3">
		        <input type="hidden" name="lead_type" value="sp">
		        <input type="hidden" name="p_type" value="1">

					<div class="form-header">
						<h2>
							<?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?>
							<br />Moving Leads Available!
						</h2>
						<h3>Join Now. Receive Leads Today.</h3>
					</div>
					
					<div class="row" id="name_div">
						<div class="col-sm-6">
							<span>First Name</span>
				            <input type="text" name="firstname" id="firstname" placeholder="First Name" value="<?php echo $_REQUEST['firstname']; ?>">
						</div>
						<div class="col-sm-6">
							<span>Last Name</span>
				            <input type="text" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo $_REQUEST['lastname']; ?>">
						</div>
					</div>
					
					<div class="row" id="final_div">
						<div class="col-sm-6">
							<span>Company Name</span>
							<input type="text" name="company" id="company" placeholder="Company" value="<?php echo $_REQUEST['company']; ?>">
						</div>
						<div class="col-sm-6">
							<span>Phone</span>
				            <input type="text" name="phone1" id="phone1" placeholder="Your Phone #" value="<?php echo $_REQUEST['phone1']; ?>">
						</div>
					</div>

					<div class="row" id="name_div">
						<div class="col-sm-6">
							<span>Email</span>
							<input type="text" name="email" id="email" placeholder="your@email.com" value="<?php echo $_REQUEST['email']; ?>">
						</div>
						<div class="col-sm-6">
							<span>Email (Confirm)</span>
							<input type="text" name="email2" id="email2" placeholder="your@email.com" value="<?php echo $_REQUEST['email2']; ?>">
						</div>
					</div>
					
					<?php /*
					<p class="notice" id="notice" style="font-size:8.5px;">By clicking "Sign Up", I understand service providers will contact me for moving purposes. I agree to receive autodialed and/or pre-recorded calls from <?php echo $conf['s_name']; ?> to the telephone number I have provided in this form. I understand this is not a condition of purchase.</p>
					*/ ?>
					
		            <input value="Join Now!" class="btn btn-success btn-md btn-block" id="post_lead" type="submit" name="post_lead">

				</form>

			</div>
            <div class="col-sm-6">

				<div class="splash-headline">
					
					<h1 style="color: #fff;">Receive Moving Leads Today</h1>

					<h3 style="color: #fff;">Why Work with Us?</h3>
					
					<ul class="lander">
						<li> Average of <b>1</b> competitors per lead
						<li> No contracts. Cancel anytime
						<li> Get leads by zip code/state/area code
						<li> Filter by minimum distance, move size, and more
						<li> Receive email leads or Granot posts
						<li> A brand you can trust. 15+ years in lead generation
						<li> 100% self-service platform (control your own account 24/7)
						<li> Phone and Email Support
					</ul>
					
					<h3 style="color: #fff;">Start receiving moving leads. It takes minutes to setup your account.</h3>

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
		<h1 class="section-title">Here's What Our Movers are Saying!</h1>
		<div class="row">
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>We enjoy working with <?php echo $conf['s_name']; ?>. We have been buying leads for years and they have been great, thanks. No BS.</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>Mark C.</h2>
					<h3>Moving Company in <?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?></h3>
				</div>
			</div>
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>My wife and I were referred to <?php echo $conf['s_name']; ?> last year. You're in great hands with them. Good experience.</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>Alex S.</h2>
					<h3>Moving Company in Boston, MA</h3>
				</div>
			</div>
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>We've been burned by moving lead companies. <?php echo $conf['s_name']; ?> is actually one of the few qualified companies.</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>Jennifer R.</h2>
					<h3>Moving Company in Orlando, FL</h3>
				</div>
			</div>
		</div>
		<?php /*<div class="btn-container"><a href="#" class="btn-common large">View All Testimonials</a></div>*/ ?>
	</div>
</section>