<?php 
include 'includes/config.php';
include 'includes/includes.php';

if (isset($_POST['zip'])) {
	$zipcode = $_POST['zip'];
	$sql = "
				SELECT
					*
				FROM
					ZIPCodes 
				WHERE
					ZipCode = '" . $db->makeSafe($zipcode) . "' 
	";
	$q = $db->query($sql);
  
	if ($db->numrows($q) > 0) {
		echo true;
    return;
	}
	echo false;
  return;
}
?>