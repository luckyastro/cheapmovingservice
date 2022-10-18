<section class="page-banner">
	<div class="container">
		<h1>UNSUBSCRIBE</h1>
	</div>
</section>

<section class="page-content">
	<div class="container">
		<h2 class="innerpage">No longer need moving help?</h1>
		<p class="section-subtitle innerpage">No problem. Please fill out the form below and you'll be unsubscribed. Please allow up to 72 hours for the request to complete.</p>
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
			*/ ?>
			
			<div class="col-sm-12">
				<form class="form-common" action="/unsubscribe.php" method="post">
					<span>Full Name</span>
		            <input type="text" name="fullname" placeholder="Your Name">

					<span>Email</span>
		            <input type="text" name="email" placeholder="your@email.com">

					<?php /*
					<span>Selection</span>
					<select>
                      <option value="2to3">Selection 1</option>
                      <option value="4to5">Selection 2</option>
                    </select>

					<span>TextArea</span>
					<textarea rows="4" cols="50" placeholder="Sample Text Area"></textarea>

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

		            <input name="submit" type="submit" value="UNSUBSCRIBE" class="submitbtn">
				</form>
			</div>
		</div>
	</div>
</section>