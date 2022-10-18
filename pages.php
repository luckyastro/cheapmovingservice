<?php

$page = 'pages';
$page_google = 'pages';
$show_ads = true;

include 'includes/config.php';
include 'includes/includes.php';

// Nav control
$pages_hide_nav = array(
	'moving-quote', 'free-moving-quote', 'free-moving-quote1', 'quote', 'free-quote', 
	'moving-quote-calculator', 'free-moving-quote-calculator', 'free-moving-quote2',
	'buy-moving-leads', 'sell-moving-leads', 'free-moving-quote-now', 'free-moving-quote-chhj',
    'thankyou', 'free-estimate', 'join'
);
if ( in_array( $_REQUEST['page'], $pages_hide_nav ) )
{
	$hide_nav = true;
	$lander = true;
}

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

include 'templates/' . $_SESSION['TEMPLATE'] . '/header.php';

if ( $conf['s_id'] == '167' && $_REQUEST['page'] == 'free-moving-quote' )
{
    $_REQUEST['page'] = 'moving-quote';
}

$template = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/' . $_REQUEST['page'] . '.tpl';
$template->load( $tpl );

$heading = ucfirst( 'About ' . $_SERVER['SERVER_NAME'] );

$template->set( 'heading', $heading );
$template->set( 'site', $_SERVER['SERVER_NAME'] );
$template->set( 'link_key', $_SESSION['INCOMING_LINK_KEY'] );
$template->set( 'date', date( 'F d, Y' ) );
$template->set( 'template', $_SESSION['TEMPLATE']);
$template->set( 'zip', $zip );
$template->set( 'firstname', $_REQUEST['firstname'] );
$template->set( 'lastname', $_REQUEST['lastname'] );
$template->set( 'email', $_REQUEST['email'] );
$template->set( 'phone1', $_REQUEST['phone1'] );

$template->publish();

include 'templates/' . $_SESSION['TEMPLATE'] . '/footer.php';