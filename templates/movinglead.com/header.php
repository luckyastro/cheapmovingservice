<!DOCTYPE html>

<html>
<head>
	<title><?php echo $conf['s_name']; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/css/styles.css">

    <!-- FormValidation CSS file -->
	<link rel="stylesheet" href="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/css/formvalidation/formValidation.min.css">

	<script type="text/javascript">
		function getUrlVars()
		{
		    var vars = {};
		    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		        vars[key] = value;
		    });
		    return vars;
		}
		
		function openOffer( url )
		{
			newwindow = window.open( url );
			if (window.focus)
			{
				newwindow.focus()
			}
			return false;
		}
	</script>
	
	<?php

	$index_link = ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) ? '/index.php' : '';
	
	?>
	
	<!-- Global site tag (gtag.js) - Google Ads: 869690515 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-869690515"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', 'AW-869690515');
	</script>

    <?php if ( $page == 'contact' || $page == 'register' ) { ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_V3_SITE_KEY; ?>"></script>
        <script>
            $(document).ready(function() {
                $('#contact-form').submit(function(event) {
                    event.preventDefault();

                    grecaptcha.ready(function () {
                        grecaptcha.execute('<?php echo RECAPTCHA_V3_SITE_KEY; ?>', {action: '<?php echo $page; ?>'}).then(function (token) {
                            $('#contact-form').prepend('<input type="hidden" name="token" value="' + token + '">');
                            $('#contact-form').prepend('<input type="hidden" name="action" value="<?php echo $page; ?>">');
                            $('#contact-form').unbind('submit').submit();
                        });
                    });
                });
            });
        </script>
    <?php } ?>

</head>

<body>

	<nav class="navbar navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
		    
		  <?php if ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) { ?>
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>
	      <?php } ?>
	      
	      <a class="navbar-brand" href="<?php echo $index_link; ?>"><img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/site-logo-white.svg"></a>
	    </div>
	    
	    <?php if ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) { ?>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li class="active"><a href="/">Home</a></li>
	        <li><a href="/buy-moving-leads.php">Buy Moving Leads</a></li>
	        <li><a href="/contact.php">Sell Moving Leads</a></li> 
	        <li><a href="/contact.php">Affiliate Program</a></li> 
	        <?php /*
	        <li><a href="#">Auto Shipping Leads</a></li> 
	        <li><a href="#">Home Leads</a></li>
	        */ ?>
	      </ul>
	    </div>
	    <?php } ?>
	    
	  </div>
	</nav>