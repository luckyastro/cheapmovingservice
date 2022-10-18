<?php

$page = 'ajax';
$page_google = 'ajax';

include 'includes/config.php';
include 'includes/includes.php';

function verticals()
{
    global $db;

    if ( $_REQUEST['vertical1'] != '' )
    {
        $sql = "
		SELECT id, vertical
		FROM verticals
		WHERE parent_id = '" . $db->makeSafe( $_REQUEST['vertical1'] ) . "'
		ORDER BY vertical ASC
		";
        $q = $db->query( $sql );
        if ( $db->numrows( $q ) > 0 )
        {
            echo '<option value="">What specialty describes your request?</option>';
            while( $f = $db->fetcharray( $q ) )
            {
                echo '<option value="' . $f['id'] . '">' . $f['vertical'] . '</option>';
            }
        }
        else
        {
            echo 'empty';
        }
    }
}

switch( $_REQUEST['action'] )
{
    case 'verticals':
        verticals();
    break;
}