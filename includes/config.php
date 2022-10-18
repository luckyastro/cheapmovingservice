<?php

define( 'IN_MAIN', true );

// Enabled so we can do a header() redirect (e.g., in index.php)
ob_start();

session_start();

// Master DB
define( 'DB_USER', 'leadgrab_user' );
define( 'DB_PASS', 'n12ln134ldsfq' );
define( 'DB_NAME', 'leadgrab' );
define( 'DB_HOST', 'mysql.leadgrab.com' );

?>