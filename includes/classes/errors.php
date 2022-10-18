<?php

if (!defined('IN_MAIN')) die ();

class Errors 
{

	function warning( $string = '' ) 
	{
		echo '<h3 class="warning">Warning</h3>' . $string  . "\n";
	}
	
	function fatalerror( $string = '' ) 
	{
		echo '<h3 class="error">Fatal Error</h3>' . $string;
		die();
	}

}

?>