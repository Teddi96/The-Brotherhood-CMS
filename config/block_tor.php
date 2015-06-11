<?php

/*******************************************
 * We use this to secure the admin page    *
 * No proxies allowed on the admin page    *
 * to be able to log IP addresses and      *
 * less likely to hide their tracks using  *
 * tor. Need to add more proxies to ban.   *
 * In time this will only be used on Admin *
 * *****************************************/
include '/var/www/config/get_ip.php';

$deny = explode("\n", file_get_contents('/var/www/config/tor.txt'));
if (in_array ($user_ip, $deny)) {
		echo "Tor is banned";
		exit();
	}

?>
