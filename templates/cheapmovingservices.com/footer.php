<footer class="section-footer">
	<div class="container">
		
		<?php if ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) { ?>
		<div class="row">
			<div class="col-sm-3">
				<h3 class="footer-title">ABOUT US</h3>
				<p>For over 15 years, we've been helping customers save on the cost of their move. Let us do the same for you today.</p>
				<div class="footer-social">
					<a href="#" class="facebook"></a>
					<a href="#" class="twitter"></a>
					<a href="#" class="rss"></a>
					<a href="#" class="gplus"></a>
					<a href="#" class="linkedin"></a>
				</div>
			</div>
			<div class="col-sm-3">
				<h3 class="footer-title">OUR SERVICES</h3>
				<a href="/free-moving-quote.php" class="common-link">Free Moving Quote</a>
				<a href="/articles.php" class="common-link">Local Movers</a>
				<a href="/articles.php" class="common-link">Long Distance Movers</a>
				<a href="/articles.php" class="common-link">Auto Transport</a>
				<a href="/articles.php" class="common-link">Moving Storage</a>
				<a href="/articles.php" class="common-link">Moving Guides</a>
			</div>
			<div class="col-sm-3">
				<h3 class="footer-title">QUICK LINKS</h3>
				<a href="/index.php" class="common-link">Home</a>
				<a href="/about.php" class="common-link">About</a>
				<a href="/unsubscribe.php" class="common-link">Unsubscribe</a>
				<a href="/privacy.php" class="common-link">Privacy</a>
				<a href="/terms.php" class="common-link">Terms</a>
				<a href="/contact.php" class="common-link">Contact</a>
			</div>
			<div class="col-sm-3">
				<h3 class="footer-title">CORPORATE</h3>
				<p>Say hello during business hours.</p>
				<?php /*<a href="#" class="common-link"><b>Tel:</b> 1234-5678-9012</a>*/ ?>
				<?php /*<a href="#" class="common-link"><b>Email:</b> hello@<?php echo $conf['s_domain']; ?></a>*/ ?>
				<span class="common-link"><b>Hours:</b> M-F, 8 AM - 6 PM EST</span>
			</div>
		</div>
		<?php } ?>

		<div class="copyright">
			&copy; <?php echo date( 'Y' ); ?> <?php echo $conf['s_name']; ?> | <a href="/privacy.php" class="copyright-link">Privacy</a> | <a href="/terms.php" class="copyright-link">Terms</a> | <a href="/unsubscribe.php" class="copyright-link">Unsubscribe</a>
            <br />
            <spah style="font-size:11px;">We are not affiliated with UHaul, Penske, or any other truck rental or moving company.</spah>
		</div>
	</div>
</footer>

<script type="text/javascript">
	$.validator.addMethod("name_regex", function(value, element) {
		if (value.toLowerCase() == 'test') {
			return false;
		} 
		return true;
	}, "A valid first name or full name is required.");

	$.validator.addMethod("email_regex", function(value, element) {
		if (value == 'test@test.com') {
			return false;
		}
		return true;
	}, "The email address is not properly formatted.");

	$.validator.addMethod("zip_regex", function(value, element) {
		var regZipCode = new RegExp("^\\d{5}(-\\d{4})?$");

		if (!regZipCode.test(value)) {
			return false;
		}

		if (
			value.length != 5 || 
			value == '00000' || 
			value == '11111' ||
			value == '22222' ||
			value == '33333' ||
			value == '44444' ||
			value == '55555' ||
			value == '66666' || 
			value == '77777' ||
			value == '88888' ||
			value == '99999') 
		{
			return false;
		} 

		var result = false;

		$.ajax({
			type:"POST",
			async: false,
			url: 'zip_check.php',
			data: {
				zip: value
			},
			success: function(data) {
				result = (data == true) ? true : false;
			},
			error: function(error) {
				console.log("error");
				result = false;
			}
		});
		
		return result;
	}, "A valid Zip code is required.");

	$.validator.addMethod("phone_regex", function(value, element) {
		var length = value.length;
		var phone1 = value;
		if (length > 10) {
			start = length - 10;
			phone1 = value.substr(start, length)
		}
		var phone_check = phone1.match(/.{1,3}/g);
		phone_check[2] += phone_check[3];
		phone_check.splice(3, 1);
		
		if (phone_check[0] == '555' || 
			phone_check[1] == '555' || 
			phone_check[0] == '123' || 
			phone_check[1] == '456' || 
			phone_check[2] == '0000' || 
			phone1.length != 10) 
		{
			return false;
		}
		return true;
	}, "A valid phone number is required.");

	$.validator.addMethod("phone_unique", function(value, element) {
		var result = false;
		var length = value.length;
		var phone1 = value;
		if (length > 10) {
			start = length - 10;
			phone1 = value.substr(start, length)
		}
		$.ajax({
			type:"POST",
			async: false,
			url: 'phone_check.php',
			data: {
				phone_check: phone1
			},
			success: function(data) {

				result = (data == true) ? true : false;
			}
		});
		// return true if username is exist in database
		return result; 
	}, "This phone number already exists in the system.");

	$("#formID").validate({
		rules: {
			'move_size': {
				required: true,
			},
			'move_date': {
				required: true
			},
			'zip1': {
				required: true,
				zip_regex: true,
			},
			'zip2': {
				required: true,
				zip_regex: true,
			},
			'firstname': {
				required: true,
				name_regex: true
			},
			'lastname': {
				name_regex: true
			},
			'email': {
				required: true,
				email: true,
				email_regex: true
			},
			'phone1': {
				required: true,
				phone_regex: true,
				phone_unique: true
			}
		},
		messages: {
			'move_size': {
				required: "This field is required!",
			},
			'move_date': {
				required: "This field is required!",
			},
			'zip1': {
				required: "This field is required!",
			},
			'zip2': {
				required: "This field is required!",
			},
			'firstname': {
				required: "This field is required!",
			},
			'email': {
				required: "This field is required!",
				email: "Please enter a valid email address!"
			},
			'phone1': {
				required: "This field is required!",
			}
		},
		submitHandler: function(form) {
			var zip1 = document.getElementById("zip1").value;
			var zip2 = document.getElementById("zip2").value;
			var status_1 = document.getElementById("status_1");

					if (status_1.checked)
					{
						document.getElementById('redirect').value = 'https://cheapmovingservices.com/car-making.php';
					} else if (zip1 != zip2) {
						document.getElementById('redirect').value = 'https://cheapmovingservices.com/address.php';
					}
					form.submit();
				}
			});

			function send() {

				var zip1 = document.getElementById("zip1").value;
				var zip2 = document.getElementById("zip2").value;
				var status_1 = document.getElementById("status_1");

				if (status_1.checked)
				{
					console.log('https://cheapmovingservices.com/address.php');
					document.getElementById('redirect').value = 'https://cheapmovingservices.com/car-making.php';
				}
				else if ( zip1 != "" || zip2 != "" || zip1 != zip2 )
				{		
					console.log('https://cheapmovingservices.com/address.php');
					document.getElementById('redirect').value = 'https://cheapmovingservices.com/address.php';
				}else{
					alert('no input');
				}
			}
		</script>

    <script type="text/javascript">
        (function() {
                var field = 'xxTrustedFormCertUrl';
                var provideReferrer = false;
                var invertFieldSensitivity = false;
                var tf = document.createElement('script');
                tf.type = 'text/javascript'; tf.async = true;
                tf.src = 'http' + ('https:' == document.location.protocol ? 's' : '') +
                    '://api.trustedform.com/trustedform.js?provide_referrer=' + escape(provideReferrer) + '&field=' + escape(field) + '&l='+new Date().getTime()+Math.random() + '&invert_field_sensitivity=' + invertFieldSensitivity;
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(tf, s); }
        )();
    </script>
    <noscript>
        <img src="http://api.trustedform.com/ns.gif" />
    </noscript>

<!-- <?php echo $_SERVER['SERVER_ADDR']; ?> -->

</body>
</html>