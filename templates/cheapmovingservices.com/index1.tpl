<section class="home-banner lander1">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">



				<form method="post" action="/transitions.php" id="formID" class="form-common">
					<input type="hidden" name="stage" value="1">
					<input type="hidden" name="zip" value="">
					<input type="hidden" name="campaign_id" value="">
					<input type="hidden" name="test" value="">
					<input type="hidden" name="affid" value="">
					<input type="hidden" name="lead_intake_type" value="0">
					<input type="hidden" name="source_id" value="21645">
					<input type="hidden" name="redirect" id="redirect" value="" />
					<input type="hidden" name="lead_source" value="<?php echo $conf['s_name']; ?>">
					<input type="hidden" name="lander" value="index.php">
					<input type="hidden" name="email" value="">

					<div class="form-header">
						<h2>FREE Moving Quote!</h2>
						<h3>When movers compete you save big!</h3>
					</div>


					<div class="row">
						<div class="col-sm-6">
							<span>Move Size</span>
							<select name="move_size" id="move_size" required>
								<option value="">- Please Select -</option>
								<?php
	                            
	                            $move_sizes = array(
		                          	0 => '1 Bedroom',
		                          	1 => '2 Bedrooms',
		                          	2 => '3 Bedrooms',
		                          	3 => '4 Bedrooms',
		                          	4 => '5 Bedrooms',
		                          	5 => '5+ Bedrooms'
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
							<span>Move Date</span>
							<input type="date" name="move_date" id="move_date" placeholder="- Please Select -">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<span>Moving From</span>
							<input type="text" name="zip1" id="zip1" pattern="[0-9]*" placeholder="Moving from Zip">
						</div>
						<div class="col-sm-6">
							<span>Moving To</span>
							<input type="text" name="zip2" id="zip2" pattern="[0-9]*" placeholder="Moving to Zip">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<span>First Name</span>
							<input type="text" name="firstname" id="firstname" placeholder="First Name">
						</div>
						<div class="col-sm-6">
							<span>Last Name</span>
							<input type="text" name="lastname" id="lastname" placeholder="Last Name">
						</div>
					</div>

					<div class="row" id="final_div">
						<div class="col-sm-6">

							<span>Email</span>
							<input type="email" name="email" id="email" placeholder="Your Email">

						</div>

						<div class="col-sm-6">

							<span>Phone</span>
							<input type="tel" name="phone1" id="phone1" placeholder="Your Phone Number">

						</div>
					</div>


					<?php /*
					<span>Message</span>
					<textarea rows="3" cols="50" placeholder="Your message"></textarea>
					*/ ?>

					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" id="hidden_status_1" name="status_1" value="0">
							<input type="checkbox" id="status_1" name="status_1" value="1" style="width: 3%;"><label>Do you want Car
								Shipping Info?</label><br>
							<input type="hidden" id="hidden_status_2" name="status_2" value="0">
							<input type="checkbox" id="status_2" name="status_2" value="1" style="width: 3%;"><label>Do you want help
								Finding Packing Supplies?</label><br>
							<input type="hidden" id="hidden_status_3" name="status_3" value="0">
							<input type="checkbox" id="status_3" name="status_3" value="1" style="width: 3%;"><label>Do you want a
								local contractor to contact you?</label><br>
							<input type="hidden" id="hidden_status_4" name="status_4" value="0">
							<input type="checkbox" id="status_4" name="status_4" value="1" style="width: 3%;"><label>Would you like
								Solar panels on your new home?</label><br>
						</div>
					</div>

					<!--<input name="submit" type="submit" value="Get FREE Quote!" class="submitbtn">-->

					<br><br> <input class="btn btn-success btn-md btn-block" type="submit" name="post_lead"
						value="Get FREE Quote!"><br><br>
					<p class="notice" style="font-size:8.5px;">"By clicking "Get FREE Quote!", I understand service providers will
						contact me for moving purposes, as well as any other services I have opted to know more about . I agree to
						receive autodialed and/or pre-recorded calls from Cheapmovingservices.com or it's partners or affilaites to the telephone
						number I have provided in this form. I understand this is not a condition of purchase."</p>


				</form>




			</div>
			<div class="col-sm-6">

				<div class="splash-headline">

					<h1>Save Up to 70%!</h1>

					<?php

					if ( $_REQUEST['keyword'] != '' )
					{
						echo '<h3>' . ucwords( $_REQUEST['keyword'] ) . '</h3><br />';
					}

					?>

					<h3>Whether you're moving down the street or across the country,
						<?php echo $conf['s_name']; ?> is here to help!
					</h3>

					<br />

					<h3>Enter in your information using the form provided. You will receive moving quotes to help you with your
						move.</h3>

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
					<p>We really enjoyed working with
						<?php echo $conf['s_name']; ?>. We saved hundreds over what we were originally quoted from other companies.
						Thanks!!
					</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>William C.</h2>
					<h3>
						<?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?>
					</h3>
				</div>
			</div>
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>My wife and I were referred to
						<?php echo $conf['s_name']; ?> last year. You're in great hands with them. We were very happy with the
						experience.
					</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>Juan U.</h2>
					<h3>
						<?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?>
					</h3>
				</div>
			</div>
			<div class="col-md-4">
				<div class="testimonial-item">
					<p>My roommates and I needed to move out of our apartment fast. With
						<?php echo $conf['s_name']; ?>'s help, everything worked out great. Thanks, guys!
					</p>
					<?php /*<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/sample-profile.jpg">*/ ?>
					<h2>Melissa H.</h2>
					<h3>
						<?php echo $geo_data['city'] . ', ' . $geo_data['state']; ?>
					</h3>
				</div>
			</div>
		</div>
		<?php /*<div class="btn-container"><a href="#" class="btn-common large">View All Testimonials</a></div>*/ ?>
	</div>
</section>