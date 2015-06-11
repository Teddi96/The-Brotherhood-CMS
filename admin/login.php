<?php
include_once 'mysqli.php';
session_start();

if(isset($_GET['hash'])) {

/**
 * In this case, we want to increase the default cost for BCRYPT to 12.
 * Note that we also switched to BCRYPT, which will always be 60 characters.
 */
$options = [
    'cost' => 12,
];
echo password_hash($_GET['hash'], PASSWORD_BCRYPT, $options)."\n";

}


if (isset($_GET['login'])) {
     // Only load the code below if the GET
     // variable 'login' is set. You will
     // set this when you submit the form

	/* Prepare a statement */
	if(!($stmt = $mysqli->prepare('SELECT username, password, user_id FROM users WHERE username = ?'))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	/* Get password and username */
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$password = $_POST['password'];
		$username = $_POST['username'];
	}  

	/* Bind data to the statement */
	if(!($stmt->bind_param('s',$username))) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	/* Execute it */
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$result = $stmt->get_result(); 

	while($row = $result->fetch_array()) {
		$current = $row['password'];
		$user_id = $row['user_id'];
	}
	// Fuck MySQL
	$stmt->close(); 

	// Test if there is actually any $current variable
	if(!isset($current)) {
		echo "Invalid password or username";
	} else {
		// Compare the input and the current password
		if (password_verify($password, $current)) {
			// Hey, We have a smart cookie
			// Set in php.ini how long a session
			// lasts.
			$_SESSION['loggedin'] = 1;
			$_SESSION['username'] = htmlspecialchars($username);
			$_SESSION['userid'] = htmlspecialchars($user_id);
			header("Location: manager.php");
			exit;
		} else {
			// Fuck you retard.
			echo 'Invalid password or username.';
		}
	
	}
} 
 
?>
<link rel="stylesheet" href="style.css">

 <div class="container">
  <div id="login-form">
    <h3>Login</h3>
    <fieldset>
	<form action="?login" method="post">
	<input type="username" name="username" required value="username" onBlur="if(this.value=='')this.value='username'" onFocus="if(this.value=='username')this.value='' "> <!-- JS because of IE support; better: placeholder="Email" -->
        <input type="password" name="password" required value="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "> <!-- JS because of IE support; better: placeholder="Password" -->
	<input type="submit" value"submit">
    </fieldset>
  </div> <!-- end login-form -->
</div>



