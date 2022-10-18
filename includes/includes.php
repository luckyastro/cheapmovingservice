<?php

date_default_timezone_set( 'America/New_York' );

$time = explode( ' ', microtime() );
$page_start = $time[1] + $time[0];

// Include main functions that wouldn't be used for cron purposes
include __DIR__ . '/include_main.php';

// Global Site Settings
include PATH . '/includes/libraries/mobile-detect-2.6.3/Mobile_Detect.php';
$detect = new Mobile_Detect;
$device_type = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$_SESSION['device'] = $device_type;

// Returns array with all information based on user's IP (if we can grab it)

// Override geo_data if the zip code is known
if ( $_REQUEST['zip'] != '' )
{
	$sql = "
	SELECT CityMixedCase, State FROM ZIPCodes WHERE ZipCode = '" . $db->makeSafe( $_REQUEST['zip'] ) . "'
	";
	$q = $db->query( $sql );
	if ( $db->numrows( $q ) > 0 )
	{
		$f = $db->fetcharray( $q );
		
		$geo_data['city'] = $f['CityMixedCase'];
		$geo_data['state'] = $f['State'];
		$geo_data['zip'] = $_REQUEST['zip'];
	}
	else
	{
		$geo_data = get_geo();
	}
}
else
{
	$geo_data = get_geo();
}

// Load site settings
$site = new Site();
$conf = $site->getSiteConfigData();

$_SESSION['TEMPLATE'] = $site->getSiteDomain();

// Get the current page (e.g., explore.php)
$cur_page = cur_page();