 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en"/>
<head profile="http://www.w3.org/2005/10/profile"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<script src="style/js/jquery-1.11.0.min.js"></script>
<script src="style/js/lightbox.min.js"></script>

<?php
/* Title
 * Ugly but it does the job
 * Needs fixing and better 
 * ideas on how to approach
 * this function
 */
include_once '/var/www/config/config.php';

if(empty($_SERVER['REQUEST_URI'])) {
	$full_host = "no_request_url";
} else {	
	$full_host = $_SERVER['REQUEST_URI'];
}

$host = preg_split('#(&|\|\|)#', "$full_host");
$host = $host[0];

// set the title
if($host == '/index.php') {
	echo "<title>$SITE_NAME :: News</title>";

} elseif($host == '/index.php?id=news') {
	echo "<title>$SITE_NAME :: News</title>";

} elseif($host == '/index.php?id=members') {
	echo "<title>$SITE_NAME :: Members</title>";

} elseif($host == '/index.php?id=guides') {
	echo "<title>$SITE_NAME :: Guides</title>";

} elseif($host == '/index.php?id=sectors') {
	echo "<title>$SITE_NAME :: Sectors</title>";

} elseif ($host == '/index.php?id=about') {
	echo "<title>$SITE_NAME :: About</title>";

}  
 
?>
<!-- Set the favicon -->
<link rel="icon" type="image/png" href="/favicon.png"/>

<!-- Set the style sheet -->
<link rel="stylesheet" type="text/css" href="style/css.css"/>
<link href="style/lightbox.css" rel="stylesheet" />

</head>

<!-- Start the body --> 
<body>  
<!-- Div for the logo, change it in the style sheet -->
<div id="logo"></div>

<!-- Menu bar --> 
<table class="center" id="headers">

	<tr>
		<th><a href="index.php" class="default">News</a></th>
    		<th><a href="index.php?id=members" class="members_menu">Members</a></th>
		<th><a href="index.php?id=guides" class="guides_menu">Guides</a></th>
		<th><a href="index.php?id=sectors" class="sectors_menu">Sectors</a></th>
		<th><a href="index.php?id=about" class="about_menu">About</a></th>
	</tr>
</table>
			

