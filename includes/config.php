<?php

define( 'IN_MAIN', true );

// Enabled so we can do a header() redirect (e.g., in index.php)
ob_start();

session_start();

// Master DB
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );
define( 'DB_NAME', 'leadgrab' );
define( 'DB_HOST', 'localhost' );

?>