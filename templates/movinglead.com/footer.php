	<footer class="section-footer">
		<div class="container">
			
			<?php if ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) { ?>
			<div class="row">
				<div class="col-sm-3">
					<h3 class="footer-title">ABOUT US</h3>
					<p>For over 15 years, we've been helping moving companies grow their business. Let us do the same for you today.</p>
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
					<a href="/buy-moving-leads.php" class="common-link">Buy Moving Leads</a>
					<a href="/contact.php" class="common-link">Sell Moving Leads</a>
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
			</div>
		</div>
	</footer>

	<?php /*<script src="js/script.js"></script>*/ ?>
		
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/js/bootstrap.min.js"></script>
   
	<!-- FormValidation plugin and the class supports validating Bootstrap form -->
	<script src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/js/formvalidation/formValidation.min.js"></script>
	<script src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/js/formvalidation/framework/bootstrap.min.js"></script>

    <script type="text/javascript">
	    
    $(document).ready(function() {
	    
	    $( '#shipping_car' ).change( function()
	    {
	        if( $( '#shipping_car' ).val() == '1' )
	        {
	            $( '#car_options' ).show();
	        }
	        else
	        {
	            $( '#car_options' ).hide(); 
	        } 
	    }); 
	
	    $('#formID').formValidation({
	        framework: 'bootstrap',
	        err: {
		     	container: 'tooltip'  
	        },
	        verbose: true,
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            firstname: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please enter your first name'
	                    },
	                    stringLength: {
	                        min: 3,
	                        max: 50,
	                        message: 'Your first name is too short or too long'
	                    },
	                    regexp: {
	                        regexp: /^[a-zA-Z0-9_\'\,\s]+$/,
	                        message: 'Your first name has one or more invalid characters'
	                    }
	                }
	            },
	            lastname: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please enter your last name'
	                    },
	                    stringLength: {
	                        min: 3,
	                        max: 50,
	                        message: 'Your last name is too short or too long'
	                    },
	                    regexp: {
	                        regexp: /^[a-zA-Z0-9_\'\,\s]+$/,
	                        message: 'Your last name has one or more invalid characters'
	                    }
	                }
	            },
	            company: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please enter your company name'
	                    },
	                    stringLength: {
	                        min: 3,
	                        max: 50,
	                        message: 'Your company is too short or too long'
	                    },
	                    regexp: {
	                        regexp: /^[a-zA-Z0-9_\'\,\s]+$/,
	                        message: 'Your company name has one or more invalid characters'
	                    }
	                }
	            },
	            email: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please enter in your email'
	                    },
	                    emailAddress: {
		                    message: 'Please enter in a valid email'
	                    }
	                }
	            },
                email2: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter in your email confirmation'
                        },
                        emailAddress: {
                            message: 'Please enter in a valid email confirmation'
                        }
                    }
                },
	            phone1: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please enter in your phone number'
	                    },
	                    phone: {
		                    country: 'US',
		                    message: 'You must enter in a valid US phone number'
	                    }
	                }
	            }
	        }
	    });
	});
		
	</script>

</body>
</html>