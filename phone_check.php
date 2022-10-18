<?php 
include 'includes/config.php';
include 'includes/includes.php';

if (isset($_POST['phone_check'])) {
	$phone1 = $_POST['phone_check'];
	$sql = "
				SELECT
					phone1 
				FROM
					leads 
				WHERE
					phone1 = '" . $db->makeSafe($phone1) . "' 
					AND DATE( created ) >= '" . date(' Y - m - d ', strtotime(' now - 1 WEEK ')) . "'
	";
	$q = $db->query($sql);
  
	if ($db->numrows($q) > 0) {
		echo false;
    return;
	}
	echo true;
  return;
}
?>