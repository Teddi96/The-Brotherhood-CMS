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
	echo "work in progress"; 
	exit;

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
	echo "work in progress";
	exit;
	
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
	echo "Work in progress"; 
	exit; 
	
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
	echo "Work in progress"; 
	exit; 

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
