<?php
// Get Device ID
$device_id = $_GET['device_id'];
echo "LOG : <br>";
for($i=0; $i < count($device_id); $i++){
	$x = $i+1;
	echo "<pre>";
	passthru("gammu -s ".$i." -c gammurc identify");
	passthru("gammu-smsd -n omap".$x." -u");
	passthru("gammu-smsd -c smsdrc".$x." -n omap".$x." -i");
	echo "</pre>";
}
?>
<a href="new_messege.php">New Messehe Test</a>