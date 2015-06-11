<table class="content2">
	<thead>
		<td> Change your Password: </td>
	</thead> 
	
	<tbody>
	
		<td>
			<form action="?update_pass" name="update_pass" autocomplete="off" method="post">
				Password: <input type="password" name="password"><br /> 
		     		Repeated: <input type="password" name="password_repeat"><br />
		     		<input type="submit" name="submit">
			</form>
		</td>
	</tbody>
</table>

<?php
if(isset($_GET['update_pass'])) {
	// GET passwords
	$password = $_POST['password'];
	$repeated = $_POST['password_repeat'];

// check if they match
if($password == $repeated) {
// What we need. 
$username = htmlspecialchars($_SESSION['username']);
$userid = htmlspecialchars($_SESSION['userid']);

// Password hashing options
$options = [
'cost' => 12,
];

// Hash the password	
$password_hashed = password_hash($password, PASSWORD_BCRYPT, $options);	

	
// prepare the statement 
	$stmt = $mysqli->prepare("UPDATE users SET password=? WHERE user_id=? AND username=?");

// Bind shit to it
	$stmt->bind_param("sis", $password_hashed, $userid, $username);

// Execute the statement 
	$stmt->execute();

	echo "<script>alert('Password updated!');</script>";

} else {
	echo "<script>alert('Error: Passwords did not match');</script>"; 
}
}	
