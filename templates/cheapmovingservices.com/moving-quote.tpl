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
			<div class="col-sm-5 col-sm-push-7">

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
							<select name="move_size" id="move_size">
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
							<input type="text" name="zip1" id="zip1" pattern="[0-9]*" placeholder="Moving from Zip" maxlength="5">
						</div>
						<div class="col-sm-6">
							<span>Moving To</span>
							<input type="text" name="zip2" id="zip2" pattern="[0-9]*" placeholder="Moving to Zip" maxlength="5">
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
							<!-- <input type="hidden" id="hidden_status_2" name="status_2" value="0">
							<input type="checkbox" id="status_2" name="status_2" value="1" style="width: 3%;"><label>Do you want help
								Finding Packing Supplies?</label><br>
							<input type="hidden" id="hidden_status_3" name="status_3" value="0">
							<input type="checkbox" id="status_3" name="status_3" value="1" style="width: 3%;"><label>Do you want a
								local contractor to contact you?</label><br>
							<input type="hidden" id="hidden_status_4" name="status_4" value="0">
							<input type="checkbox" id="status_4" name="status_4" value="1" style="width: 3%;"><label>Would you like
								Solar panels on your new home?</label><br> -->
						</div>
					</div>

					<!--<input name="submit" type="submit" value="Get FREE Quote!" class="submitbtn">-->

					<br> <input class="btn btn-success btn-md btn-block" type="submit" name="post_lead"
						value="Get FREE Quote!"><br><br>
					<p class="notice" style="font-size:8.5px;">"By clicking "Get FREE Quote!", I understand service providers will
						contact me for moving purposes, as well as any other services I have opted to know more about . I agree to
						receive autodialed and/or pre-recorded calls from Cheapmovingservices.com or it's partners or affilaites to the telephone
						number I have provided in this form. I understand this is not a condition of purchase."</p>


				</form>

			</div>
			<div class="col-sm-7 col-sm-pull-5">

				<div class="splash-headline">

					<h2>Moving? We've got you covered.</h2>

					<br /><br />

					<h2 style="color:#fff;">How Do I Save Money While Moving?</h2>

					<br /><br />

					<li style="color:#fff;font-size:22px;">Enter in your <span
							style="font-weight:bold;color:#fd6a01;">correct</span> details (bogus info will be rejected)</li>
					<li style="color:#fff;font-size:22px;">Our pros will contact you to provide their <span
							style="font-weight:bold;color:#fd6a01;">best price</span></li>
					<li style="color:#fff;font-size:22px;">Celebrate and be happy knowing you saved $</li>

					<br /><br />

					<h2 style="color:#fff;">Cheapmovingservices.com - A Brand You Can Trust</h2>
					
					<br />
					
					<p align="center" style="background-color:#fff;"><img
						src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/trust_brands.png"></p>
					
					<br />
					<div class="top-link-buttons">
						<div class="d-flex column-gap-2">
							<a href="http://thumbtack.57ib.net/c/2954377/269257/4348?utm_source=cma-affiliate" class="btn-common large" target="_blank">Connect with Contractors!</a>
							<a href="https://shareasale.com/r.cfm?b=1094034&u=2921664&m=75506" class="btn-common large" target="_blank">Get Junk Removed!</a>
						</div>
						<div class="d-flex column-gap-2">
							<a href="https://neighbor.pxf.io/c/2954377/1234108/14066" class="btn-common large" target="_blank">Store your Stuff!</a>
							<a href="https://www.tkqlhce.com/click-100467847-13771918" class="btn-common large" target="_blank">Decorate your New Home!</a>
						</div>
						<div class="d-flex column-gap-2">
							<a href="https://shareasale.com/r.cfm?b=883129&u=2921664&m=66601" class="btn-common large" target="_blank">Get Packing Supplies!</a>
							<a href="https://renogy.sjv.io/c/2954377/1200167/14864" class="btn-common large" target="_blank">Interested in Solar Panels?</a>
						</div>
					</div>
			</div>

		</div>
	</div>
	</div>
</section>

<section class="section-services">
	<div class="container">
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
<section class="section-testimonial">
	<div class="container">
		<h2 class="section-title">Happy (& Local!) Customers Saving $$</h2>
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