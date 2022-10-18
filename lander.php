<?php

$page = 'lander';
$page_google = 'lander';
include 'includes/config.php';
include 'includes/includes.php';

$hide_nav = true;

$citystate = ( $geo_data['city'] != '' && $geo_data['state'] != '' ) ? $geo_data['city'] . ', ' . $state_list[$geo_data['state']] : ' in your area';

if ( $_REQUEST['bypass'] == false )
{
	include 'templates/' . $_SESSION['TEMPLATE'] . '/header.php';
}

$template = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/' . $_REQUEST['page'] . '.php';
$template->load( $tpl );

$heading = ucfirst( 'About ' . $_SERVER['SERVER_NAME'] );

// Zip default
if ( $_REQUEST['zip'] != '' && $_REQUEST['zip'] != 'undefined' )
{
	$zip = $_REQUEST['zip'];
}
elseif ( $geo_data['zip'] != '' )
{
	$zip = $geo_data['zip'];
}
else
{
	$zip = '';
}

$state_adv = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_short = ( $geo_data['state'] != '' ) ? $geo_data['state'] : 'US';
$state_full = ( $geo_data['state'] != '' ) ? $state_list[$geo_data['state']] : 'US';

$template->set( 'heading', $heading );
$template->set( 'site', $_SERVER['SERVER_NAME'] );
$template->set( 'link_key', $_SESSION['INCOMING_LINK_KEY'] );
$template->set( 'date', date( 'F d, Y' ) );
$template->set( 'template', $_SESSION['TEMPLATE']);
$template->set( 'zip', $zip );

$template->set( 'location', $citystate );
$template->set( 'state_adv', $state_adv );
$template->set( 'state_short', $state_short );
$template->set( 'state_full', $state_full );

$template->set( 'firstname', $_REQUEST['firstname'] );
$template->set( 'lastname', $_REQUEST['lastname'] );
$template->set( 'email', $_REQUEST['email'] );
$template->set( 'phone1', $_REQUEST['phone1'] );

$template->publish();

include 'templates/' . $_SESSION['TEMPLATE'] . '/footer.php'; 

?>