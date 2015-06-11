<?php
include_once '../../../config/get_ip.php';
include_once '../../mysqli.php';

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




                                                                                                                                              
