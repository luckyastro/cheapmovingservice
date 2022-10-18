<section class="page-banner">
	<div class="container">
		<h1>CONTACT US</h1>
	</div>
</section>

<section class="page-content">
	<div class="container">
		<h2 class="innerpage">GET IN TOUCH</h1>
		<p class="section-subtitle  innerpage">We're happy to help. Let us know what you have on your mind and we'll get back to you with the best way forward.</p>
		<div class="row">
			
			<?php /*
			<div class="col-sm-6">
				<div class="about-item">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/about-location.svg">
					<p>Cecilia Chapman<br>
						711-2880 Nulla St.<br>
						Mankato Mississippi 96522</P>
				</div>
				<div class="about-item">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/about-phone.svg">
					<p>+123 456 7890<br>
						+123 456 7890</P>
				</div>
				<div class="about-item">
					<img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/about-email.svg">
					<p>info@movingorbit.com</P>
				</div>
			</div>
			<?php */ ?>
			
			<div class="col-sm-12">
				{output}
				<form id="contact-form" class="form-common" action="/contact.php" method="post">
					<span>Full Name</span>
		            <input type="text" name="name" placeholder="Your Name">

					<span>Email</span>
		            <input type="text" name="email" placeholder="your@email.com">

					<span>Phone</span>
		            <input type="text" name="phone" placeholder="Your Phone #">

					<span>Solve This: ({challenge_num1} + {challenge_num2})</span>
					<input type="text" name="challenge" placeholder="Your Answer">

					<?php /*
					<span>Selection</span>
					<select>
                      <option value="2to3">Selection 1</option>
                      <option value="4to5">Selection 2</option>
                    </select>
                    */ ?>

					<span>Message</span>
					<textarea rows="4" cols="50" placeholder="Here's what's on my mind..." name="message"></textarea>

					<?php /*
					<span>Checkbox</span>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Option 1</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Option 2</label>
					</div>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Option 3</label>
					</div>
					<br>

					<span>Checkbox Inline</span>
					<label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
					<label class="checkbox-inline"><input type="checkbox" value="">Option 2</label>
					<label class="checkbox-inline"><input type="checkbox" value="">Option 3</label>
					<br><br>

					<span>Radio Button</span>
					<div class="radio">
					  <label><input type="radio" name="optradio">Option 1</label>
					</div>
					<div class="radio">
					  <label><input type="radio" name="optradio">Option 2</label>
					</div>
					<div class="radio disabled">
					  <label><input type="radio" name="optradio" disabled>Option 3</label>
					</div>
					<br>

					<span>Radio Button Inline</span>
					<label class="radio-inline"><input type="radio" name="optradio">Option 1</label>
					<label class="radio-inline"><input type="radio" name="optradio">Option 2</label>
					<label class="radio-inline"><input type="radio" name="optradio">Option 3</label>
					<br><br>
					*/ ?>

		            <input name="submit" type="submit" value="SAY HELLO" class="submitbtn">
				</form>
			</div>
		</div>
	</div>
</section>