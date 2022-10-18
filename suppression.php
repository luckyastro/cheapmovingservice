<?php

$page = 'suppression';

include 'includes/config.php';
include 'includes/includes.php';

$filename = 'suppression_list-' . date( 'Y-m-d' ) . '-master.csv';

$file = PATH . '/media/suppression' . '/' . $filename;
$fp = fopen( $file, 'w' ) or die( 'Could not open file! Please contact support.' );

$sql = "
SELECT DISTINCT email 
FROM unsubscribe 
WHERE 
    date >= '" . date( 'Y-m-d', strtotime( 'now -2 weeks' ) ) . "'
";
$q = $db->query( $sql );
if ( $db->numrows( $q ) > 0 )
{
    $data = "MD5_EMAILS \r\n";

    while( $f = $db->fetcharray( $q ) )
    {
        $data .= md5( $f['email'] ) . "\r\n";
    }
}
else
{
    echo 'No emails found.';
    die();
}

fwrite( $fp, $data ) or die( 'Could not write file! Please contact support.' );
fclose( $fp );

// The file was written and closed, now send it to the browser
header("Content-type: text/csv");
header("Content-description: File Transfer");
header("Content-disposition: attachment; filename=\"" . $filename . "\"");
header("Pragma: public");
header("Cache-control: max-age=0");
header("Expires: 0");

echo file_get_contents( $file );