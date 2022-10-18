<?php

// Include necessary classes/files
include __DIR__ . '/constants.php';
include PATH . '/includes/classes/database.php';
include PATH . '/includes/classes/template.php';
include PATH . '/includes/classes/site.php';
include PATH . '/includes/classes/offers.php';
include PATH . '/includes/classes/click.php';

// PHPMailer class
include PATH . '/includes/libraries/phpmailer/class.phpmailer.php';

// Start new SQL
$db	= new Database();

// Connect to DB
if ( !$db->connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) )
{
    if ( mysqli_connect_error() != '')
    {
        $database_error	= 'Database name is incorrect.';
    }
    else
    {
        $database_error	= '';
        echo ( 'DB Error: (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() . ' ' . $database_error );
    }
}

// General functions
include PATH . '/includes/functions.php';