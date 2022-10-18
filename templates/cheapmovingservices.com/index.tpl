<section class="home-banner">
	<div class="container">
		<div class="headline">
			<h2>Did someone say movers?</h2>
			<h1>That's our specialty.</h1>
			<a href="/free-moving-quote.php" class="btn-common large">Free Moving Quote!</a>
		</div>
	</div>
</section>

<section class="section-requestquote">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">

				<br />

				<h1 class="section-title">Full-Service Moving</h1>
				<p class="section-subtitle">We help connect people for packing, loading, moving, and other relocation services.</p>
				<p class="section-subtitle">Whether you're moving down the street or across the country, we'll help get you in touch with the best.</p>
				<!-- <a href="/free-moving-quote.php" class="btn-common large">Discover More</a><br /> -->
				
				<a href="http://thumbtack.57ib.net/c/2954377/269257/4348?utm_source=cma-affiliate" class="btn-common large" target="_blank">Connect with Contractors!</a><br />
				<a href="https://shareasale.com/r.cfm?b=1094034&u=2921664&m=75506" class="btn-common large" target="_blank">Get Junk Removed!</a><br />
				<a href="https://neighbor.pxf.io/c/2954377/1234108/14066" class="btn-common large" target="_blank">Store your Stuff!</a><br />
				<a href="https://www.tkqlhce.com/click-100467847-13771918" class="btn-common large" target="_blank">Decorate your New Home!</a><br />
				<a href="https://shareasale.com/r.cfm?b=883129&u=2921664&m=66601" class="btn-common large" target="_blank">Get Packing Supplies!</a><br />
				<a href="https://renogy.sjv.io/c/2954377/1200167/14864" class="btn-common large" target="_blank">Interested in Solar Panels?</a><br />
			</div>
			<div class="col-sm-6">

				<br />

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

					<br><input class="btn btn-success btn-md btn-block" type="submit" name="post_lead"
						value="Get FREE Quote!"><br><br>
					<p class="notice" style="font-size:8.5px;">"By clicking "Get FREE Quote!", I understand service providers will
						contact me for moving purposes, as well as any other services I have opted to know more about . I agree to
						receive autodialed and/or pre-recorded calls from Cheapmovingservices.com or it's partners or affilaites to the telephone
						number I have provided in this form. I understand this is not a condition of purchase."</p>


				</form>


				<?php /*
				<form class="form-common">
					<h2>Request a Quote</h2>
					<div class="row">
						<div class="col-md-6">
							<span>Fullname</span>
				            <input type="text" name="fullname" placeholder="Your Fullname">
				        </div>
						<div class="col-md-6">
							<span>Email Address</span>
				            <input type="text" name="email" placeholder="Your Email">
				        </div>
						<div class="col-md-6">
							<span>Moving From</span>
				            <input type="text" name="movingfrom" placeholder="City, State">
				        </div>
						<div class="col-md-6">
							<span>Moving To</span>
				            <input type="text" name="moveto" placeholder="2-3 Bedroom">
				        </div>
						<div class="col-md-6">
							<span>Move size</span>
							<select>
		                      <option value="2to3">2-3 Bedroom</option>
		                      <option value="4to5">4-5 Bedroom</option>
		                    </select>
						</div>
						<div class="col-md-6">
							<span>Moving Date</span>
				            <input type="date" name="movedate" placeholder="7/25/2017">
						</div>
					</div>
		            <input type="submit" value="Submit Request" class="submitbtn">
				</form>
				*/ ?>

			</div>
		</div>
	</div>
</section>

<section class="section-services">
	<div class="container">
		<h1 class="section-title">Your One-Stop Moving Network</h1>
		<p class="section-subtitle">
			We are part of a Professional Network of Movers.<br>
			All of these companies strive to ensure professionalism, reliability, and quality.
		</p>
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

<section class="section-segue">
	<div class="container">
		<h1>Getting a <span class="orange">Moving Quote</span> is simple. It's fast & easy!</h1>
		<div class="btn-container"><a href="/free-moving-quote.php" class="btn-common">Start Free Quote Now</a></div>
	</div>
</section>

<section class="section-why">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="why-container">
					<div class="why-item">
						<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/icon-wallet.svg">
						<div class="why-item-content">
							<h2>MOVING OPTIONS</h2>
							<p>Because you will receive a number of quotes, you are free to compare and choose the best that works for
								your budget</P>
						</div>
					</div>
					<div class="why-item">
						<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/icon-24hrs.svg">
						<div class="why-item-content">
							<h2>FREE, FAST ESTIMATE</h2>
							<p>Within hours, receive estimates from reputable, professional moving companies
							</P>
						</div>
					</div>
					<div class="why-item">
						<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/icon-tag.svg">
						<div class="why-item-content">
							<h2>BUDGET FRIENDLY</h2>
							<p>Using our moving network can result in savings off of your move</P>
						</div>
					</div>
				</div>

			</div>
			
			<div class="col-sm-6">
				<h3 class="section-pretitle">move with confidence</h3>
				<h1 class="section-title">From Planning to Unpacking</h1>
				<p class="section-subtitle">We help connect people for packing, loading, moving, and other relocation services.</p>
				<p class="section-subtitle">Whether you're moving down the street or across the country, we'll help get you in touch with the best.</p>
				<a href="/free-moving-quote.php" class="btn-common large">Start Free Quote Now</a>
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
		<?php /*
		<div class="btn-container"><a href="#" class="btn-common large">View All Testimonials</a></div>
		*/ ?>
	</div>
</section>

<?php /*
<section class="section-segue2">
	<div class="container">
		<h1>Don’t miss out on news, features and special offers.</h1>
		<h1>Subscribe to our newsletter!</h1>
		<form>
			<div class="row">
				<div class="col-sm-4">
				    <input type="text" name="name" placeholder="Your Name">
				</div>
				<div class="col-sm-4">
				    <input type="text" name="email" placeholder="Your Email">
				</div>
				<div class="col-sm-4">
		            <input type="submit" value="Submit Request" class="submitbtn">
				</div>
			</div>
		</form>
	</div>
</section>
*/ ?>

<?php /*
<section class="section-news">
	<div class="container">
		<h1 class="section-title">News & Articles</h1>
		<div class="row">
			<div class="col-sm-6">
				<div class="news-item">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/bg1.jpg">
<div class="news-details">
	<h2>Lorem Ipsum Dolor</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
		aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
	</p>
	<a href="#" class="btn-readmore">Read More</a>
</div>
</div>
</div>
<div class="col-sm-6">
	<div class="news-item">
		<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/bg1.jpg">
		<div class="news-details">
			<h2>Lorem Ipsum Dolor</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
				magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
			<a href="#" class="btn-readmore">Read More</a>
		</div>
	</div>
</div>
</div>
</div>
</section>
*/ ?>

<?php /*
<section id="about">
	<div class="experience">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-8">
				<div class="twenty-year">
				<h1>15+</h1>
				<div class="trolly-img"><img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/resources/trolly.png"
alt="img"></div>

</div>
<div class="experience-cnt">
	<h2>years of</h2> <span>experience</span>
	<p>
		At Cheapmovingservices.com, we like to keep it simple. Enter in your moving information and receive fast, free moving quotes from
		professional moving companies we've vetted. It couldn't be any easier.
	</p>
</div>
</div>
</div>
</div>
</div>
<div class="three-points">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-3 col-xs-12">
				<div class="circle-cnt">
					<div class="circle-red">
						<i class="fa fa-location-arrow" aria-hidden="true"></i>
					</div>
					<h2>Step 1 - Enter Your Details</h2>
					<p>
						We start off with some basic questions concerning the size, distance, and date of your move.
					</p>
				</div>

			</div>
			<div class="col-lg-3 col-sm-3 col-xs-12">
				<div class="circle-cnt">
					<div class="circle-red">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
					</div>
					<h2>Step 2 - Receive Free Quotes</h2>
					<p>
						High-quality, professional moving companies will contact you with a no-obligation quote.
					</p>
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-xs-12">
				<div class="circle-cnt">
					<div class="circle-red">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
					</div>
					<h2>Step 3 - Decide & Move!</h2>
					<p>
						Decide on the moving service partner you feel is right for the job and save money in the process.
					</p>
				</div>
			</div>

		</div>
	</div>
</div>
</section>

<section id="com-featured">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<img class="mover-man-img"
					src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/resources/mover-man-3.png" alt="img">

				<div class="achivement-area">

					<div class="achivement-single yellow-col">
						<div class="achivement-icon">
							<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/icons/branches.png" alt="img">
						</div>
						<h1><span class="timer" data-from="400" data-to="500" data-speed="5000"
								data-refresh-interval="50">1,200</span>+</h1>
						<p>movers</p>
					</div>

					<div class="achivement-single blue-col">
						<div class="achivement-icon">
							<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/icons/vehicle.png" alt="img">
						</div>
						<h1><span class="timer" data-from="900" data-to="1000" data-speed="5000"
								data-refresh-interval="50">600k</span>+</h1>
						<p>quotes</p>
					</div>

					<div class="achivement-single black-col">
						<div class="achivement-icon">
							<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/icons/client.png" alt="img">
						</div>
						<h1><span class="timer" data-from="900" data-to="1000" data-speed="5000"
								data-refresh-interval="50">495k</span>+</h1>
						<p>Happy Clients</p>
					</div>
				</div </div>

				<!-- start testimonial -->
				<section id="testimonials">
					<div class="container">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="text-box clearfix">
									<div class="quote-icon">
										<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/icons/quote.png" alt="img">
									</div>
									<p>
										Moving Orbit helped me save nearly $300 for my recent job relocation. I'll definitely use Moving
										Orbit again in the future when my job takes me to another place, but so far I'm enjoying the area.
										Thanks for making this move easier for me.
									</p>
									<p class="name">
										<span>Benjamin L.</span> <br>Customer
									</p>
								</div>
							</div><!-- col -->

							<div class="col-md-4 col-sm-12">
								<div class="text-box clearfix">
									<div class="quote-icon">
										<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/icons/quote.png" alt="img">
									</div>
									<p>
										Over the years, my team and I have assisted thousands of customers with their moves throughout the
										US. Moving Orbit puts me in touch with these customers who otherwise may not have found out about me
										or my company. Thank you!
									</p>
									<p class="name">
										<span>Peter P.</span> <br>Service Provider
									</p>
								</div>
							</div><!-- col -->

							<div class="col-md-4 col-sm-12">
								<div class="text-box clearfix">
									<div class="quote-icon">
										<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/icons/quote.png" alt="img">
									</div>
									<p>
										My husband and I travel frequently for work with our two kids. In the past, we've had to call
										several companies for quotes. Thanks to Moving Orbit for saving us time by doing the comparison for
										us and helping us save on the move itself!
									</p>
									<p class="name">
										<span>Kelly C.</span> <br>Customer
									</p>
								</div>
							</div><!-- col -->

						</div>
					</div>
				</section>
				<!-- end testimonial -->
				*/ ?>