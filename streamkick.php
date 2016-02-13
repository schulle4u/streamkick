<?php
// Universal Stream Kick
// 2010 by Steffen Schultz


// Configuration
$type = "shoutcast"; // shoutcast or icecast
$timeout = 5; // connection timeout
$username = "admin"; // only change for icecast
$pass = ""; // admin or kick password
$ip = "127.0.0.1"; // server ip or host
$port = "8000"; // shoutcast or icecast port
$mountpoint = "/stream"; // icecast mountpoint

// Don't edit below this line


// Open socket
$fp = @fsockopen($ip, $port, &$errno, &$errstr, $timeout); 

if($fp) {
	if($type = "shoutcast") {
		fputs($fp,"GET /admin.cgi?pass=".$pass."&mode=kicksrc  HTTP/1.1\nUser-Agent: XML Getter (Mozilla Compatible)\n\n");
	
	} else if($type = "icecast") {
		fputs($fp,"GET /admin/killsource?mount=".$mountpoint."  HTTP/1.1\nUser-Agent: XML Getter (Mozilla Compatible)\n");
		fputs($sp, "Host: ".$ip."\n");
		fputs($sp, "Authorization: Basic ".base64_encode($username.":".$pass)."\n\n");
	} else {
		echo "Invalid server type: ".$type."! Please check settings!";
	}

// Success
echo "The source ";
if($type = "icecast") { 
	echo "broadcasting on mountpoint ".$mountpoint; 
}
echo " of the ".$type." server ".$ip." has been kicked!"; 
} else {
echo "Error: Unable to kick source connection on ".$ip.". Please check connection and/or php settings.";
}
?>