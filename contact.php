<?php

$page = 'contact';

include 'includes/config.php';
include 'includes/includes.php';
include 'templates/' . $_SESSION['TEMPLATE'] . '/header.php';

$template = new Template;
$tpl = PATH . '/templates/' . $_SESSION['TEMPLATE'] . '/contact.tpl';
$template->load( $tpl );

if ( $_POST['submit'] == true )
{
	if ( $_POST['email'] != '' && $_POST['name'] != '' && $_POST['phone'] != '' && $_POST['message'] != '' && check_email( $_POST['email'] ) == true )
	{	
		// Only allow email to be sent if time is more than 5 minutes ago
		$hour_ago = time() - 1;

		// Challenge
        if ( $_POST['challenge'] != $_SESSION['answer'] )
        {
            $output .= "<b>Hmm..</b> The challenge failed. Please try again shortly.<br /><br />";
        }
        // Recaptcha check
        elseif ( googleRecaptchaV3Check() == false )
        {
            $output .= '<b>Hmm..</b> Spam detected. Please try again or contact us for more help. Or, just, you know, don\'t spam.<br /><br />';
        }
        elseif ( $_SESSION['mail_sent'] == '' || $_SESSION['mail_sent'] <= $hour_ago )
		{
			// Append debugging data to the message
			$message = $_POST['message'] . "\n\nSubject: " . $_POST['subject'] . "\nName: " . $_POST['name'] . "\nPhone: " . $_POST['phone'] . "\nEmail: " . $_POST['email'] . "\n\nIP: " . $_SERVER['REMOTE_ADDR'] . "\nUser Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\nReferrer: " .
			$_SERVER['HTTP_REFERER'];
			$message = stripslashes( nl2br( $message ) );
			
			$subject = 'New Contact from ' . $_SERVER['SERVER_NAME'] . ' (ID #' . rand( 11111, 99999 ) . ')';
		
			// Send the mailing
			send_mailing( TECH_EMAIL, $subject, $message, $_POST['email'], $_POST['name'] );
			
			// Timestamp to prevent flooding
			$_SESSION['mail_sent'] = time();
			
			$output = "<b>Done.</b> We've been contacted and will respond back to you soon.<br /><br />";
		}
		else
		{
			$output = '<b>Hmm..</b> It looks like you are trying to send messages too quickly. Please try again shortly.<br /><br />';
		}
	}
	else
	{
		$output = "<b>Hmm..</b> You must enter in your name, email, and message.<br /><br />";
	}
}

$num1 = rand( 1, 9 );
$num2 = rand( 1, 9 );
$_SESSION['answer'] = $num1 + $num2;

$template->set( 'challenge_num1', $num1 );
$template->set( 'challenge_num2', $num2 );
$template->set( 'message', $_POST['message'] );
$template->set( 'email', $_POST['email'] );
$template->set( 'name', $_POST['name'] );
$template->set( 'output', $output );

$template->publish();

include 'templates/' . $_SESSION['TEMPLATE'] . '/footer.php';

?>