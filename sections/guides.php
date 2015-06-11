
<?php
include 'config/block_tor.php';
include 'config/mysqli.php';

if(isset($_GET['action'])) {
	$action = $_GET['action'];
}

if(isset($_POST['searchstring'])) {
	$searchstring = htmlspecialchars($_POST['searchstring']);
}

?>

<td>
<table class=search>
<tr><td style="text-align:center;">
<?php
echo 'This search engine supports wildcards (*)<br />';
echo '<form action="index.php?id=guides&action=search" method="post" id="searchresults">';
if(empty($searchstring)) {
	echo '<input type="text" name="searchstring" placeholder="Search">';
} else {
	echo "<input type='text' name='searchstring' value='$searchstring'>";
}
echo '<input type="submit">';
echo '</form>';	
	
	/* Prepare the statement */
	if(!($stmt = $mysqli->prepare("SELECT distinct name FROM guides LIMIT 500"))) { 
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	/* Execute the statement */
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$result = $stmt->get_result();

echo '<select name="member" form="searchresults">';
echo '<option value="member">Member</option>';
while($row = $result->fetch_array()) {
	echo "<option value='".$row["name"]."'>".$row["name"]."</option>";
}
echo "</select>";
$stmt->close();
$result->close();

	/* Prepare the statement */
	if(!($stmt = $mysqli->prepare("SELECT distinct sector FROM guides LIMIT 500"))) {
		 echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	/* Execute the statement */
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$result = $stmt->get_result();

echo '<select name="sector" form="searchresults">';
echo '<option value="sector">Sector</option>';
while($row = $result->fetch_array()) {
	echo "<option value='".$row["sector"]."'>".$row["sector"]."</option>";
}
echo "</select>";
$stmt->close();
$result->close();
?>



 </td></tr>

</tr>
</table>
<?php

if(!isset($action)) { 
	/* Prepare the statement */
	if(!($stmt = $mysqli->prepare("SELECT name, link_description, link_address, sector FROM guides LIMIT 500"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	/* Execute it */
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	$result = $stmt->get_result();

echo "<table class=guides>";
echo '<tr><th>Author</th><th>Title</th><th>Sector</th></tr>';
/* CASE SENSITIVE----ERRORS IF VARIABLE ISN'T IN DATABASE */
while ($row = $result->fetch_array()) {
	$name = htmlspecialchars($row['name']);
    	$link_description = htmlspecialchars($row['link_description']);
    	$link_address = htmlspecialchars($row['link_address']);
    	$sector = htmlspecialchars($row['sector']);
		echo "<tr>
		<td>$name</td>
		<td><a href=$link_address>$link_description</a></td>
		<td>$sector</td>
		</tr>";
	}
echo "</table>";
} else {


	// We need to get 
	// bunch of stuff
	if(isset($_POST['member'])) {
		$member=$_POST['member'];
	} if(isset($_POST['sector'])) {
		$sector=$_POST['sector'];
	}
	if(empty($searchstring)) {
		$searchstring = "*"; 
	$bind = preg_replace("/\*/","%",$searchstring);
	} else {
		$bind = preg_replace("/\*/","%",$searchstring);
	}

// Member and sector are not selected
	if ($member == "member" && $sector == "sector") {
	$stmt = $mysqli->prepare('SELECT * FROM guides WHERE link_description LIKE ?');
	$stmt->bind_param('s', $bind);
	$stmt->execute();
}

// Member is not selected
elseif ($member == "member") { 
	$stmt = $mysqli->prepare("SELECT * FROM guides where sector = ? and link_description LIKE ? LIMIT 500");
	$stmt->bind_param("ss", $sector, $bind);
	$stmt->execute();
}

// Sector is not selected
elseif ($sector == "sector") { 
	$stmt = $mysqli->prepare('SELECT * FROM guides WHERE name = ? and link_description LIKE ? LIMIT 500');
	$stmt->bind_param("ss", $member, $bind);
	$stmt->execute();
                      }

// Members and sectors are selected
elseif ($member !== "member" && $sector !== "sector") {
	$stmt = $mysqli->prepare("SELECT * FROM guides WHERE name = ? and sector = ? and link_description LIKE ? LIMIT 500");
	$stmt->bind_param("sss",$member,$sector,$bind);
	$stmt->execute();
}

	echo "<table class=guides>";
	echo "<tr><th>Author</th><th>Title</th><th>Sector</th></tr>";
	$result = $stmt->get_result();
		while ($row = $result->fetch_array()) {
    			$name = htmlspecialchars($row['name']);
    			$link_description = htmlspecialchars($row['link_description']);
    			$link_address = htmlspecialchars($row['link_address']);
    			$sector = htmlspecialchars($row['sector']);
				echo "<tr>";
					echo "<td>$name</td>";
					echo "<td><a href=$link_address>$link_description</a></td>";
					echo "<td>$sector</td>";
				echo "</tr>";
		
		}
	echo "</table>";
}
?>
