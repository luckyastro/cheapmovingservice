<!DOCTYPE html>
<html>
<head>
	<title><?php echo $conf['s_name']; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5N32SV6');</script>
	<!-- End Google Tag Manager -->


    <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"137012322"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    
    <!-- FormValidation CSS file -->
	<link rel="stylesheet" href="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/css/formvalidation/formValidation.min.css">

    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/css/styles.css?v=<?php echo rand( 1, 999999 ); ?>">

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
	
	<?php include 'google_analytics.php'; ?>
	
	<?php

	$index_link = ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) ? '/index.php' : '';
	
	?>

    <?php if ( $_REQUEST['page'] == 'thankyou' ) { ?>
        <script type="text/javascript">    var _lg_track_init_ = {aid: 7754}</script><script type="text/javascript" async="true" src="https://leadapi.net/form/track.js"></script>
    <?php } ?>
	
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

    <script type="text/javascript">
        window._mNHandle = window._mNHandle || {};
        window._mNHandle.queue = window._mNHandle.queue || [];
        acu_versionId = "3121199";
        acu_chnm = "5226_traffic";//Used to specify the channel name
        acu_chnm2="<?php echo $_SESSION['source_id']; ?>"; // Used to specify the channel 2 name
        acu_chnm3=""; // Used to specify the channel 3 name
        acu_misc = {};
        acu_misc.query = '';
        acu_misc.zip= '<zip>'; //Used to specify the zip
        acu_misc.score='<credit score>'; //Used to specify the credit score/rating
    </script>
    <script src="//csearchtopics101.akamaized.net/dacu.js?cid=8CU37R3V6" async="async"></script>

</head>

<body>
	<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5N32SV6"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->

<nav class="main-nav">
  <div class="container">
    <div class="navbar-header">
	  
	  <?php if ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) { ?>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <?php } ?>
      
      <a class="navbar-brand" href="<?php echo $index_link; ?>"><img src="/templates/<?php echo $_SESSION['TEMPLATE']; ?>/images/svg/site-logo.svg"></a>
    </div>
    
    <?php if ( $lander == false && $page != 'lander' && $page != 'funnel' && $page != 'offer' ) { ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/articles.php">Local Movers</a></li>
        <li class="active"><a href="/articles.php">Long Distance Movers</a></li> 
        <li><a href="/articles.php">Truck Rental</a></li> 
        <li><a href="/articles.php">Auto Transport</a></li> 
        <li><a href="/articles.php">Moving Tips & Guides</a></li> 
	      <div class="quick-btns">
	      	<?php /*<a href="#" class="call-phone"><div class="icon"></div><span>+123-456-7890</span></a>*/ ?>
	      	<a href="/free-moving-quote.php" class="btn-common get-quote">Free Quote</a>
	      </div>
      </ul>
    </div>
    <?php } ?>
    
  </div>
</nav>

<?php 
	
/*
<a href="#">Tools & Guides</a>
<div class="sub-menu">
<ul>
<li><a href="/articles.php">Articles & Guides</a></li>
<li><a href="/moving-cost-calculator.php">Moving Cost Calculator</a></li>
<li><a href="/packing-calculator.php">Packing Calculator</a></li>
<li><a href="/move-planner.php">Move Planner</a></li>
*/

?>