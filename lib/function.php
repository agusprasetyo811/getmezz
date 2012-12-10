<?php

function write_file($file,$data,$type){
	if(!file_exists($file)){
		$open = fopen($file, $type);
		fputs($open,' ');
		fclose($open);
	}else{
		$open = fopen($file, $type);
		fwrite($open,$data);
		fclose($open);
	}
}

function read_file($file_txt){
	$data_txt = $file_txt;
	$fh = fopen($data_txt, "r");
	$file = file_get_contents($data_txt);
	return $file;
}

function link_to($location) {
	header("Location:".$location);
}

function smsdrc_data($port, $connection, $phone_id, $db_host, $db_name, $db_user, $db_pass) {
	$smsdrc_data = "#Gammu Configuration\n".
				   "[gammu]\nport = ".$port.":\nconnection = ".$connection."\n\n".
				   "#Smsd Configuration\n".
				   "[smsd]\nservice = mysql\nlogfile = smsdlog\ndebuglevel = 0\nphoneid = ".$phone_id."\ncommtimeout = 30\nsendtimeout = 30\nPIN = 1234\n\n".
				   "#Connection Database Configuration\n".
				   "pc = ".$db_host."\nuser = ".$db_user."\npassword = ".$db_pass."\ndatabase = ".$db_name."\n";
	return $smsdrc_data; 
}