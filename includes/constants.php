<?php

define( 'DEBUG', false );

// Error reporting
if ( DEBUG == true )
{
	error_reporting( E_ALL ^ E_NOTICE );
	ini_set( 'display_errors', true );
}
else
{
	error_reporting(0);
	ini_set( 'display_errors', false );
}

if ( DEBUG == true )
{
	echo '<div style="font-size:18px;color:red;font-weight:bold;text-align:center;">DEBUG MODE IS ENABLED!</div>';
}

define( 'PATH', '/home/dh_mn7kxh/cheapmovingservices.com' );

define( 'CACHE_DIR', PATH . '/includes/cache' );

// Alert monitoring/notification
define( 'SLOW_ALERTS', false );

// ?
define( 'SLOW_THRESHOLD', 5 );

// Should we log slow reports?
define( 'SLOW_LOG', true );

// Email used for debugging purposes and alerts
define( 'TECH_EMAIL', 'hello@leadgrab.com' );

define( 'TECH_EMAIL_USER', 'hello@leadgrab.com' );
define( 'TECH_EMAIL_PASS', '4eiULK6FEmaMah' );

/**
 * Click tracking
 */
define( 'CLICK_COOKIE', 'lgofferclick' );
define( 'CONVERSION_COOKIE', 'lgofferconversion' );

// Affiliate links

// Penske - truck rental
define( 'AFFILIATE_TRUCK_RENTAL', 'https://www.pensketruckrental.com/rental_entry.html?cid=8046' );

// Amazon
define( 'AFFILIATE_AMAZON', 'https://www.amazon.com/gp/search?ie=UTF8&tag=80eba-20&linkCode=ur2&linkId=3e51a5d7aa523dee6aa8761dcab95a12&camp=1789&creative=9325&index=garden&keywords=moving' );

// Google Recaptcha v3
define( 'RECAPTCHA_V3_SCORE_THRESHOLD', '0.5' );
define( 'RECAPTCHA_V3_SITE_KEY', '6LdT_94UAAAAAM4G23b9oLgy0r2jMF06pGzvE-96' );
define( 'RECAPTCHA_V3_SECRET_KEY', '6LdT_94UAAAAAMMRDmO6vMd3EBj7wZW7hkM5tsml' );