<?php

session_start();
/*
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}
*/

echo '<link rel="stylesheet" type="text/css" href="../style/css.css">';

// Get rid of annoying error messages
if(isset($_GET['id'])) {
	$id=$_GET['id'];
} else {
	$id="main"; 
}

?>

<table class="clock">
  <tr>
    <th style="text-align:left;">You are currently logged in as <?php echo $_SESSION['username']; ?>.</th>
    <th style="text-align:right;"><?php date_default_timezone_set("UTC"); echo date("h:ia"); echo " UTC";?>
  </tr>
</table>

<table class="main">
  <tr>
     
<?php
				// Include MySQL on all pages
				include 'mysqli.php';

// Switch to switch between pages.
if ($_SESSION['loggedin'] == 1) { 
	switch($id) {
				case "guides":
					include 'sections/guides/index.php';
					break;	
				
				case "news":
					include 'sections/news/index.php';
					break;
				
				case "members":
					include 'sections/members/index.php';
					break;
				
				case "sectors":
					include 'sections/sectors/index.php';
					break;

				case "main":
				default:
					include 'sections/default/index.php'; 	
					break;
	}
} else {
	header("Location: login.php");
	exit;
}
?>

		  </div>
		
    </td>
  </tr>
</table>







