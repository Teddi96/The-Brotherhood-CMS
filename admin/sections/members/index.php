<?php 
// Create a prepared statement
$stmt = $mysqli->prepare("SELECT * FROM members ORDER BY B_id ASC");
$stmt->execute();
$result = $stmt->get_result();

?> 

<td colspan="2" style="width:100%;">
<div class="AdminContent">
	<table class="content2">
		<thead>
			<th>ID</th>
			<th>Avatar</th>
			<th>Username</th>
			<th>Profile Link</th>
			<th>Sector</th> 
		</thead> 
<?php 
while($row = $result->fetch_array()) {
	// Lets make this a bit easier to use along with XSS security. 
	$B_id 		= htmlspecialchars($row['B_id']);
	$username 	= htmlspecialchars($row['username'],  ENT_QUOTES, 'ISO-8859-1');
	$profile_link 	= htmlspecialchars($row['profile_link']);
	$sector 	= htmlspecialchars($row['sector']);
	$defaultImage 	= "/style/images/default_avatar.png";
	$avatar 	= (empty($row['avatar'])) ? $defaultImage : htmlspecialchars($row['avatar']);

	// Lets do tbody in here 
?>
	<tbody>
			<tr>
				<td style='width:40px;'><?php echo $B_id; ?></td>						
				<td style='width: 40px;'><img src='<?php echo $avatar; ?>' width='45px'></td>
				<td style='width: 200px;'><?php echo $username; ?></td>
				<td style='width: 200ox;'><a href='<?php echo $profile_link; ?>'><?php echo $profile_link; ?></a></td>
				<td style='width: 400px;'><?php echo $sector; ?></td>
				<td style='width: 70px;'><a href='?id=members&user=<?php echo $B_id; ?>'>Edit</a></td>
			</tr>
	</tbody> 
<?php 	}	 
	$stmt->close();
?>

</td>
</tr>
</table>
</div>

<!-- Start with adding new members --> 
<table class="content2">
<tr>
<td style="vertical-align:middle;">
	<div style="display:table-cell; height:270px; background-color:#222222; left-margin:auto; right-margin:auto; vertical-align:middle; text-align:center;">
		<table class="content2" style="background-color:222;">
			<tr>
				<td style="width:60%;">
					<?php if(empty($_GET['user'])) { ?>
					<form action="sections/members/add.php" name="rowdata" method="post">
						Username:<br />
							<input type="text" name="username"><br />
						Avatar:<br />
							<input type="text" name="avatar"><br/>
						Profile Link:<br />
							<input type="text" name="profile_link"><br/>
						Sector:<br />
							<select name="sector">
				<?php // Get all the sectors names
					$stmt = $mysqli->prepare("SELECT name FROM sectors");
					$stmt->execute();
					$result = $stmt->get_result();
					while($row = $result->fetch_array()) {
						$name = htmlspecialchars($row["name"]);
					?> 
							<option value="<?php echo $name; ?>"><?php echo $name; ?></option>
					<?php }  
						$stmt->close(); ?>
						</select>
						<br />
						<input type="submit" value="Add Record">
						</form>
					<!-- Start with the edit member functionality --> 
					<?php } else { 
						$B_id = $_GET['user'];
						$stmt = $mysqli->prepare("SELECT * FROM members WHERE B_id = ?");
						$stmt->bind_param("i",$B_id);
						$stmt->execute(); 
						$result = $stmt->get_result();
						while($row = $result->fetch_array()) {
							$B_id = htmlspecialchars($row['B_id']);
							$username = htmlspecialchars($row['username'], ENT_QUOTES, 'ISO-8859-1');
							$profile_link = htmlspecialchars($row['profile_link']);
							$sector = htmlspecialchars($row['sector']);
							$avatar = htmlspecialchars($row['avatar']);
							?>
						<form action="update.php" name="rowdata" method="post">
							<input type=hidden name="B_id" value="<?php echo $B_id; ?>">
						Username:<br />
							<input type="text" name="username" value="<?php echo $username; ?>"><br />
						Avatar:<br />
							<input type="text" name="avatar" value="<?php echo $avatar; ?>"><br/>
						Profile Link:<br />
							<input type="text" name="profile_link" value="<?php echo $profile_link; ?>"><br/>
						
<?php	
						}
						$stmt->close();
?>
						Sector:<br />
						<select name="sector">
						<option value="no change">No Change</option>
						<?php
						$stmt = $mysqli->prepare("SELECT name FROM sectors");
						$stmt->execute();
						$result = $stmt->get_result();
						while($row = $result->fetch_array()) {
							$sector = htmlspecialchars($row['name']);
?>						
						<option value="<?php echo $sector; ?>"><?php echo $sector; ?></option>
<?php
					}
?>						</select><br /><br />
							<input type="submit">
						</form>
<?php } ?>
					</td>
				</td>
			</tr>
		</table>
	</div>	

<!-- DELETE A MEMBER -->
<td style="vertical-align:middle; text-align:center; width:20%;">
	<form action="take_delete.php" name="delete" method="post"> 
	<?php // Prepare statement for MySQL
		$stmt = $mysqli->prepare("SELECT B_id, username FROM members ORDER BY B_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
?>
		<select name="B_id">

<?		
		while($row = $result->fetch_array()) {
			$B_id 		= htmlspecialchars($row['B_id']);
			$username 	= htmlspecialchars($row['username']);
?> 
	
			<option value='<?php echo $B_id; ?>'><?php echo $username; ?></option> 
<?php	} ?>
		</select>
		<input type="submit" name="submit" value="Remove member" />
	</form>

		<!-- The menu for the admin pages -->
						<td style="text-align:center; vertical-align:middle; width:20%;">
						<form action="manager.php" method="get">
						<input type="submit" style="width:100px;" name="id" value="news" >
						</form>
							
						<form action="manager.php" method="get">
						<input type="submit" style="width:100px;" name="id" value="guides" >
						</form>
							
						<form action="manager.php" method="get">
						<input type="submit" style=width:100px;" name="id" value="members" disabled >
						</form>
							
						<form action="manager.php" method="get">
						<input type="submit" style=width:100px;" name="id" value="sectors" >
						</form>
							
						<form action="../index.php" method="get">
						<input type="submit" style="width:100px;" name="id" value="Exit"> 
						</form>
						</td>
						</tr>
					</table>
<?php
// Error messages
        //Blacklist
        if(isset($_GET['error'])) {
                $error=$_GET['error'];
        } else {
		$error='nope';
	}
        if($error == 'blacklist') {
                echo "<script>alert('Sorry, this member is complete retard and is blacklisted');</script>";
        }
?>
