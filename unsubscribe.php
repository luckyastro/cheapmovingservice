<?php

$page = 'unsubscribe';

include 'includes/config.php';
include 'includes/includes.php';
include 'templates/' . $_SESSION['TEMPLATE'] . '/header.php';

$template = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/unsubscribe.tpl';
$template->load( $tpl );

if ( $_REQUEST['email'] != '' )
{
	// Poison data check
	if ( check_email( $_REQUEST['email'] ) == true )
	{
		$sql = "
		INSERT INTO unsubscribe 
		( 
			email, 
			date, 
			s_id 
		) 
		VALUES 
		( 
			'" . $db->makeSafe( $_REQUEST['email'] ) . "', 
			'" . date( 'Y-m-d' ) . "', 
			'" . $conf['s_id'] . "'
		)";
		$q = $db->query( $sql );
		
		$message = "<b>Success!</b> Your email address has been removed.<br /><br />";
			
		$params = array(
			'u' => '68af0f126ce812687b80c9aae',
			'id' => 'bc4e844716',
			'EMAIL' => $_REQUEST['email']
		);
		
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL,"https://moving.us8.list-manage.com/unsubscribe/post?");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close ($ch);
	}
	else
	{
		$message = "<b>Oops!</b> Your email seems to be invalid. Please try entering it in again.<br /><br />";
	}
}

$template->set( 'message', $message );
$template->publish();

include 'templates/' . $_SESSION['TEMPLATE'] . '/footer.php';

?>