<?php 
/* Guides index page */

// Print everything in the DB.

// Prepare a statement
if(!$stmt = $mysqli->prepare("SELECT * FROM guides")) {
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

// Execute it
if(!$stmt->execute()) {
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

// simplify
$result = $stmt->get_result();


// before we print the mysql
// we are going to have headers
?>
<td colspan="2" style="width:100%;">
	<div class="AdminContent">
        	<table class="content2">
                	<thead>
                        	<th>ID</th>
                        	<th>name</th>
                        	<th>Info</th>
                        	<th>Description</th>
                        	<th>URL</th>
				<th>Sector</th>
                	</thead>

<?

// while loop for our data
while($row = $result->fetch_array()) {
	// So we don't have to use $row['X']; every time 
	// we want to call that specific data
	$ID = $row['P_id'];
	$name = $row['name'];
	$info = $row['info'];
	$desc = $row['link_description'];
	$url = $row['link_address'];
	$sector = $row['sector'];
 
	// Site parts 
?>
 
<tbody> 
	<tr> 
		<td><?php echo $ID; ?></td> 
		<td><?php echo $name; ?></td>
		<td><?php echo $info; ?></td>
		<td><?php echo $desc; ?></td>
		<td><?php echo $url; ?></td>
		<td><?php echo $sector; ?></td>
	</tr>
</tbody>

<? }
// Close mysql
$stmt->close();
?> 

<!-- Close everything --> 
</table>
</div>
</td>	 

<!-- Adding new guide --> 
<table class="content2">
	<tr>
		<td style="vertical-align:middle;">
			<div style="display:table-cell; height:270px; background-color:#222222; left-margin:auto; right-margin:auto; vertical-align:middle; text-align:center;">
                		<table class="content2" style="background-color:222;">
						<td style="width:60%;">
							<form action="sections/guides/add.php" method="POST" name="rowdata">
								Name:<br />
									<input type="text" name="name"><br />
								Info:<br />
									<input type="text" name="info"><br />
								Link Description:<br />
									<input type="text" name="link_description"><br />
								Link Address:<br />	
									<input type="text" name="link_address">	<br />
								Sector: <br />
									<select name="sector">
									<!-- Get all the available sectors --> 
<?php									$stmt = $mysqli->prepare("SELECT name FROM sectors");
									$stmt->execute(); 
									$result = $stmt->get_result();
									while($row = $result->fetch_array()) {
										echo "<option value='".$row["name"]."'>".$row["name"]."</option>";
									} 
									$stmt->close();?>
									</select><br />
									<input type="submit" value="Add Record">
							</form>
						</td>
				</table>
			</div>
		</td>

<!-- Delete a guide -->

<?php 
$stmt = $mysqli->prepare("SELECT P_id, name FROM guides");
$stmt->execute();
$result = $stmt->get_result(); 
?>
<td style="vertical-align:middle; width:20%; text-align:center;">
	<form action="sections/guides/delete.php">
		<select name="ID">

<?php		while($row = $result->fetch_array()) {
			echo "<option value='".$row["P_id"]."'>".$row['P_id']." : ".$row["name"]."</option>";
	} ?>

		</select>
		<br /><input type="submit" name="submit" value="Delete Record">
	</form>
</td>
</td>
                                                        <td style="text-align:center; vertical-align:middle; width:20%;">
                                                        <form action="manager.php" method="get">
                                                        <input type="submit" style="width:100px;" name="id" value="news" >
                                                        </form>
                                                        <p>
                                                        <form action="manager.php" method="get">
                                                        <input type="submit" style="width:100px;" name="id" value="guides" disabled >
                                                        </form>
                                                        <p>
                                                        <form action="manager.php" method="get">
                                                        <input type="submit" style=width:100px;" name="id" value="members" >
                                                        </form>
                                                        <p>
                                                        <form action="manager.php" method="get">
                                                        <input type="submit" style=width:100px;" name="id" value="sectors" >
                                                        </form>
                                                        <p>
                                                        <form action="../index.php" method="post">
                                                        <input type="submit" style="width:100px;" name="page_number" value="Exit">
                                                        </form>
                                                        </td>
                                                        </tr>
                                                        </table>

