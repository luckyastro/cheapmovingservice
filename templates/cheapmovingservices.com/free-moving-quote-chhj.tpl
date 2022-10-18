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
				
		        <form method="post" action="/transitions.php" id="formID" class="form-common"<?php echo $pop_code; ?>>
		        <input type="hidden" name="stage" value="1">
		        <input type="hidden" name="lead_intake_type" value="0">
		        <input type="hidden" name="source_id" value="31216">
		        <input type="hidden" name="redirect" value="https://cheapmovingservices.com/page-thankyou2.php">
		        <input type="hidden" name="lead_source" value="chhj.com">
		        <input type="hidden" name="lander" value="free-moving-quote-chhj.php">
				<input type="hidden" name="gclid" value="<?php echo $_REQUEST['gclid']; ?>">
					
					<div class="form-header">
						<h2>FREE Moving Quote!</h2>
						<h3>Save up to 70% - Instant Quote</h3>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<span>Moving from Zip</span>
				            <input type="text" name="zip1" id="zip1" pattern="[0-9]*" placeholder="Moving from Zip" required>
						</div>
						<div class="col-sm-6">
							<span>Moving to Zip</span>
				            <input type="text" name="zip2" id="zip2" pattern="[0-9]*" placeholder="Moving to Zip" required>
						</div>
					</div>

					<div class="row" id="move_size_div">
						<div class="col-sm-6">
							<span>Move Size</span>
							<select name="move_size" id="move_size" required>
                                <option value="">- Please Select -</option>
                                <?php

	                            $move_sizes = array(
		                          	0 => 'Studio',
		                          	1 => '1 Bedroom',
		                          	2 => '2 Bedrooms',
		                          	3 => '3 Bedrooms',
		                          	4 => '4 Bedrooms',
		                          	5 => '5 Bedrooms',
		                          	6 => '5+ Bedrooms'
	                            );
	                            
	                            if ( is_array( $move_sizes ) )
	                            {
		                            foreach( $move_sizes AS $key => $value )
		                            {
			                        	echo '<option value="' . $key . '">' . $value . '</option>';   
		                            }
	                            }

	                            ?>
		                    </select>
						</div>
						<div class="col-sm-6">
							<span>Move Timeframe</span>
							
							<?php /*
				            <input type="date" name="move_date" id="move_date" placeholder="- Please Select -">
				            */ ?>

							<select name="move_date" id="move_date" required>
                                <option value="">- Please Select -</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +2 days' ) ); ?>">Immediate</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +2 days' ) ); ?>">2 Days</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +3 days' ) ); ?>">3 Days</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +1 week' ) ); ?>">1 Week</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +2 weeks' ) ); ?>">2 Weeks</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +3 weeks' ) ); ?>">3 Weeks</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +1 month' ) ); ?>">1 Months</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +2 months' ) ); ?>">2 Months</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +3 months' ) ); ?>">3 Months</option>
                                <option value="<?php echo date( 'Y-m-d', strtotime( 'now +3 months' ) ); ?>">Over 3 Months</option>
                            </select>
                            
						</div>
					</div>

					<div class="row" id="name_div">
						<div class="col-sm-6">
							<span>First Name</span>
				            <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
						</div>
						<div class="col-sm-6">
							<span>Last Name</span>
				            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
						</div>
					</div>
					
					<div class="row" id="final_div">
						<div class="col-sm-6">
							<span>Email</span>
				            <input type="text" name="email" id="email" placeholder="your@email.com" required>
						</div>
						<div class="col-sm-6">
							<span>Phone</span>
				            <input type="text" name="phone1" id="phone1" placeholder="Your Phone #" required>
						</div>
					</div>

					<div class="row" id="auto_questions">
						<div class="col-sm-12">
							<span>Shipping a Car?</span>
							<input type="text" placeholder="E.g., 2004 Toyota Camry (year, make, model)" name="auto" id="auto">
						</div>
					</div>
					
					<p class="notice" id="notice" style="font-size:8.5px;">By clicking "Get FREE Quote!", I understand service providers will contact me for moving purposes. I agree to receive autodialed calls, pre-recorded messages, and/or sms messages from <?php echo $conf['s_name']; ?>, moving companies, and 3rd party service providers to the telephone number I have provided in this form. I understand this is not a condition of purchase.</p>

		            <input class="btn btn-success btn-md btn-block" id="post_lead" type="submit" name="post_lead" value="Get FREE Quote!">

				</form>

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