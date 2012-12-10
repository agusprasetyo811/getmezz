<?php
/**************************************************************************************
 * Omess-GAGA (Omap Messeger Gammu Gateway) by Agus Prasetyo (agusprasetyo811@gmail.com)
 * This is developed from Rosihan Ari's gammu (http://blog.rosihanari.net).
 * Thanks to mr. Ari about your referension, I hope this is usefull to all.
 *
 * This liblary used to build gateway messeger and structured
 * by OMAP ( http://www.github.com/agusprasetyo811 )
 * ************************************************************************************
 */

/*
 * @author omap (Agus Prasetyo)
 */

require 'lib/function.php';

// set var count;
$count = 1;

// If set plus and min field
if (isset($_GET['plus'])) {
	$count = $count + $_GET['count'];
	write_file("lib/count.txt", $count, 'w');
} else if (isset($_GET['mins'])) {
	if ($_GET['count'] > 1) {
		$count = $_GET['count'] - 1;
		write_file("lib/count.txt", $count, 'w');
	}
}

// If set next button
if (isset($_GET['save'])) {
	// get parameter
	$db_host = @$_GET['db_host'];
	$db_name = @$_GET['db_name'];
	$db_user = @$_GET['db_user'];
	$db_pass = @$_GET['db_pass'];
	
	$device_id = @$_GET['device_id'];
	$port = @$_GET['port'];
	$conncetion = @$_GET['connection'];

	if ($db_host == "" || $db_name == "" || $db_user == "") {
		link_to('?n=err_field');
	} else {
		// Connecting to database
		mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
		// Drop If Database Exist
		mysql_query("DROP DATABASE IF EXISTS ".$db_name) or die(mysql_error());
		// Create Database
		mysql_query("CREATE DATABASE ".$db_name) or die(mysql_error());
		// Read file SQL
		$sql_file = read_file('mysql-table.sql');
		$split = explode(';', $sql_file);
		// Select db and add into
		mysql_select_db($db_name);
		for($i=0; $i<=count($split)-1; $i++){
			mysql_query($split[$i]);
		}
	}

	// Setting Gammurc
	write_file('gammurc', '', 'w');
	for ($i=0; $i<count($_GET['port']);$i++) {
		if (count($_GET['port']) > 1 ) {
			$x = $i+1;
			$gammu_init = 'gammu'.$x;
			$gammu_conf = "[".$gammu_init."]\nport = ".$port[$i].":\nconnection = ".$conncetion[$i]."\n";
			// write to gammurc
			write_file('gammurc', $gammu_conf, 'a');
			// write to smsdrc
			$smsdrc_file_name = 'smsdrc'.$x;
			$sms_data = smsdrc_data($port[$i], $conncetion[$i], $device_id[$i], $db_host, $db_name, $db_user, $db_pass);
			write_file($smsdrc_file_name, $sms_data, 'w');
			link_to('gammu_service.php?n=ss&device_id='.$device_id);
		} else {
			$gammu_conf = "[gammu]\nport = ".$port[$i].":\nconnection = ".$conncetion[$i]."\n";
			write_file('gammurc', $gammu_conf, 'w');
			$sms_data = smsdrc_data($port[$i], $conncetion[$i], $device_id[$i], $db_host, $db_name, $db_user, $db_pass);
			write_file('smsdrc1', $sms_data, 'w');
			link_to('gammu_service.php?n=ss&device_id='.$device_id);
		}
	}
}

// If set reset or if back_to_conf_conn
if (isset($_GET['reset']) || isset($_GET['back_to_conf_conn'])) {
	write_file('gammurc', '', 'w');
}
?>
<title>GAMMURC SETTING</title>
<form>
	<span> OMESS GAGA INSTALATION
		<div width="100%" align="right"></div>
		<hr> </span>
	<!-- Database Field -->
	<table>
		<tr>
			<td colspan="2" width="103">SETTING DATABASE
				<hr></td>
		</tr>
		<tr>
			<td width="103">Host</td>
			<td><input type="text" name="db_host" /></td>
		</tr>
		<tr>
			<td>Database</td>
			<td><input type="text" name="db_name" /></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" name="db_user" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="db_pass" /></td>
		</tr>
		<?php for ($i=0; $i < read_file('lib/count.txt'); $i++) {?>
		<tr>
			<td colspan="3">
				<hr> 
				<br>DEVICE
				<?php if (read_file('lib/count.txt') != 1) { 
					echo $i+1; ?> 
				<?php } else { echo ""; }?>
				<hr>
			</td>
		</tr>
		<tr>
			<td>Device ID</td>
			<td><input type="text" name="device_id[]" /></td>
		</tr>
		<tr>
			<td>Port</td>
			<td><input type="text" name="port[]" /></td>
		</tr>
		<tr>
			<td>Connection</td>
			<td><input type="text" name="connection[]" /></td>
		</tr>
		<?php }?>
		<tr>
			<td align="right" colspan="3">
				<hr> 
				<input type="submit" name="plus" value="+ Device" /> 
				<input type="submit" name="mins" value="- Device" /> 
				<input type="hidden" name="count" value="<?=@read_file('lib/count.txt')?>" /> 
			</td>
			<td></td>
		</tr>
		<tr>
			<td align="right" colspan="3">
				<hr> <input type="submit" name="save" value="Save" />
			</td>
			<td></td>
		</tr>
	</table>
</form>