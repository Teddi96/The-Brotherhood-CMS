<?php 

// Include calls
include_once '../config/get_ip.php';
include_once 'mysqli.php';

// Get if news, member, guides... 
$url = $_SERVER['HTTP_REFERER'];
$url = explode("/",$url);
$url = $url[4];
$url = explode("&",$url);
$url = $url[0];



// Members changes
if($url == "manager.php?id=members") {
	
// Get all POST data
if(isset($_POST['B_id'])) {
	$B_id=$_POST['B_id'];
}
if(isset($_POST['username'])) {
	$username=$_POST['username'];
}
if(isset($_POST['profile_link'])) {
	$profile_link=$_POST['profile_link'];
}
if(isset($_POST['avatar'])) {
	$avatar=$_POST['avatar'];
}
if(isset($_POST['sector'])) {
	$sector=$_POST['sector'];
}

if($sector == "no change") {
	
// Prepare the statement 
if(!$stmt = $mysqli->prepare("UPDATE members SET username = ?, profile_link = ?, avatar = ? WHERE B_id = ?")) {
	echo "Prepare failed: (" .  $mysqli->errno . ") " . $mysqli->error;
	exit;
}

// Bind our data to it
if(!$stmt->bind_param("sssi",$username,$profile_link,$avatar,$B_id)) {
	echo "Binding parameters failed: (" . $stmt->errno .") " . $stmt->error;
	exit;
}

// Execute it 
if(!$stmt->execute()) {
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	exit;
}

// Close the connection
$stmt->close();

	// Redirect back to the previous page
	header('location:' . $_SERVER['HTTP_REFERER']);
	exit;	
} else { 

// Prepare the statement 
if(!$stmt = $mysqli->prepare("UPDATE members SET username = ?, profile_link = ?, avatar = ?, sector = ? WHERE B_id = ?")) {
	echo "Prepare failed: (" .  $mysqli->errno . ") " . $mysqli->error;
	exit;
}

// Bind our data to it
if(!$stmt->bind_param("ssssi",$username,$profile_link,$avatar,$sector,$B_id)) {
	echo "Binding parameters failed: (" . $stmt->errno .") " . $stmt->error;
	exit;
}

// Execute it 
if(!$stmt->execute()) {
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	exit;
}

// Close the connection
$stmt->close();

	// Redirect back to the previous page
	header('location:' . $_SERVER['HTTP_REFERER']);
	exit;	
}
}



?>

