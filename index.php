<?php

$page = 'index';
$page_google = 'index';

include 'includes/config.php';
include 'includes/includes.php';
include 'templates/' . $_SESSION['TEMPLATE'] . '/header.php';

// Destroy the session if requested
if ( $_GET['reset'] == true )
{
	if ( ini_get( 'session.use_cookies' ) )
	{
		$params = session_get_cookie_params();
		setcookie( session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly'] );
	}

	session_destroy();

	echo "The session has been reset.<br /><br />";
}

$template = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/index.tpl';
$template->load( $tpl );

$citystate = ( $geo_data['city'] != '' && $geo_data['state'] != '' ) ? $geo_data['city'] . ', ' . $state_list[$geo_data['state']] : ' in your area';

$state_adv = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_short = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_full = ( $geo_data['state'] != '' ) ? $state_list[$geo_data['state']] : 'US';

// General variables
$template->set( 'keywords', $_REQUEST['keywords'] );
$template->set( 'location', $citystate );
$template->set( 'state_adv', $state_adv );
$template->set( 'state_short', $state_short );
$template->set( 'state_full', $state_full );
$template->set( 'heading', $heading );
$template->set( 'site', $_SERVER['SERVER_NAME'] );
$template->set( 'link_key', $_SESSION['INCOMING_LINK_KEY'] );
$template->set( 'date', date( 'F d, Y' ) );
$template->set( 'template', $_SESSION['TEMPLATE']);

$template->publish();

include 'templates/' . $_SESSION['TEMPLATE'] . '/footer.php';