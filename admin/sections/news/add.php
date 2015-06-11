<?php
include_once '../../../config/get_ip.php';
include_once '../../mysqli.php';

// Get the title
if(isset($_POST['title'])) {
	$title = $_POST['title'];
}
// Get the content
if(isset($_POST['content'])) {
	$content = $_POST['content'];
}

// Prepare mysql query
if(!$stmt = $mysqli->prepare("INSERT INTO news (n_id, title, added, content) values (NULL, ?, NULL, ?)")) {
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	exit;
}
// Bind our data to it
if(!$stmt->bind_param("ss",$title,$content)) {
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

?>
