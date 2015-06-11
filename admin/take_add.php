<?php

// Includes. MySQL + get_ip.php
include_once '../config/get_ip.php';
include_once 'mysqli.php';

// Get if news, member, guides... 
$url = $_SERVER['HTTP_REFERER'];
$url = explode("/",$url);
$url = $url[4];


// News
if($url == "manager.php?id=news") {
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
} 


// members
elseif($url == "manager.php?id=members") {
	// Get username	
	if(isset($_POST['username'])) {
		$username = $_POST['username'];
	}
	// Get the avatar 
	if(isset($_POST['avatar'])) {
		$avatar = $_POST['avatar'];
	}
	// Get the profile_link
	if(isset($_POST['profile_link'])) {
		$profile_link = $_POST['profile_link'];
	}
	// Get the sector 
	if(isset($_POST['sector'])) {
		$sector = $_POST['sector'];
	}

	// Test if member has been blacklisted 
	// statement
	if(!($stmt = $mysqli->prepare("SELECT * FROM blacklist WHERE profile_link LIKE ?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		exit;
	} 
	
	if(!($stmt->bind_param("s",$profile_link))) {
		echo "Binding parameters failed: (" . $stmt->errno .") " . $stmt->error;
		exit;
	}
	
	// Execute it
        if(!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                exit;
        }
	
	$stmt->store_result(); 

	if($stmt->num_rows > 0) {
		header('location: /admin/manager.php?id=members&error=blacklist');
		exit; 
	}
	$stmt->close();	
	// testing ends
	
	// Prepare mysql query
	if(!$stmt = $mysqli->prepare("INSERT INTO members (username, profile_link, sector, avatar, B_id) values (?, ?, ?, ?, NULL)")) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	        exit;	
	}

	// Bind our data to it
	if(!$stmt->bind_param("ssss",$username,$profile_link,$sector,$avatar)) {
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


// guides
elseif($url == "manager.php?id=guides" ) {

	//Get the POST data required
	if(isset($_POST['name'])) {
		$name = $_POST['name'];
	}
	if(isset($_POST['info'])) {
		$info = $_POST['info'];
	}
	if(isset($_POST['link_description'])) {
		$link_desc = $_POST['link_description'];
	}
	if(isset($_POST['link_address']) {
		$link_addr = $_POST['link_address'];
	}
	if(isset($_POST['sector'])) {
		$sector = $_POST['sector'];
	}

	// Prepare mysql query
	if(!$stmt = $mysqli->prepare("INSERT INTO guides (P_id, name, info, link_description, link_address, sector) values (NULL, ?, ?, ?, ?, ?)")) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error; 
		exit;
	}
	
	// Bind our data to it
	if(!$stmt->bind_param("sssss",$name,$info,$link_desc,$link_addr,$sector)) {
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


//sectors
elseif($url == "manager.php?id=sectors") {
	// Get all the POST data we require
	if(isset($_POST['sector_name'])) {
		$name = $_POST['sector_name'];
	}
	if(isset($_POST['desc'])) {
		$desc = $_POST['desc'];
	}

	// Prepare the mysql query
	if(!$stmt = $mysqli->prepare("INSERT INTO sectors (s_id, name, description) values (NULL, ?, ?)")) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		exit;
	}
	
	// Bind our data to it
	if(!$stmt->bind_param("ss",$name,$desc)) {
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


// Use the manager forms to add records.
} else {
	echo "Please use one of the manager forms to add records.";
}

?>
