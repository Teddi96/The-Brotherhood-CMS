<?php
	include 'config/block_tor.php';
	include 'config/mysqli.php';

	//  $_POST
	if(isset($_POST['action'])) {
		$action = $_POST['action'];
	}
	if(isset($_POST['searchstring'])) {
		$searchstring = htmlspecialchars($_POST['searchstring']);
	}
?>

<table class="search" cellspacing="0px" align="center">
<tr><td style="text-align:center;" colspan="2" ><p>This search engine supports wildcards (*)</p></td></tr><tr>

<form action="index.php?id=members&action=search" method="post" id="searchresults">
<?php if(empty($searchstring)) {
	echo "<div id='search_input'><td colspan='2'><input type='text' name='searchstring' placeholder='Search'></td></div>";
} else {
	echo "<div id='search_input'><input type='text' name='searchstring' value='" . $searchstring ."'></div>";
}
echo '<tr><td><input type="submit"></td>';
echo '</form>';	
	/* Prepare a statement */
	if(!($stmt = $mysqli->prepare("SELECT distinct sector FROM members"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	/* Execute the statement */
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	$result = $stmt->get_result();

echo '<td><select name="sector" form="searchresults">';
echo '<option value="sector">Sector</option>';
while($row = $result->fetch_array()) {
	echo "<option value='".$row["sector"]."'>".$row["sector"]."</option>";
}
echo "</select></td></tr>";
$stmt->close();
$result->close();

?>



 </td></tr>

</tr>
</table>

<?php

if(!isset($action)) {
	/* Prepare a statment */
	if(!($stmt = $mysqli->prepare("SELECT * FROM members"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	/* Execute the statement */
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

$i=1;	
echo "<table class=guides>";
echo '<tr><th>ID</th><th>Avatar</th><th>Username</th><th>Sector</th></tr>';

// While loop starts -> Get mysql results and print.
	$result = $stmt->get_result();
		while ($row = $result->fetch_array()) {
			$username = htmlspecialchars($row['username'], ENT_NOQUOTES, 'UTF-8');
			$defaultImage = "style/images/default_avatar.png";
			$avatar = (empty($row['avatar'])) ? $defaultImage : htmlspecialchars($row['avatar']);
	  		$profile_link = htmlspecialchars($row['profile_link']);
    			$sector = htmlspecialchars($row['sector']);
	echo "	<tr>
			<td width='10px' height='40px'>". $i++ ."</td>
			<td width='40px' height='40px'><img src='".$avatar."' width='40' height:'40'></td>
    			<td><a href=".$profile_link.">".$username."</a></td>
    			<td>".$sector."</td>
    		</tr>";
    	} 
    	echo "</table>";
		$stmt->close();
		$result->close();
		
	} else {
		if(isset($_POST['sector'])) {
			$sector=$_POST['sector'];
		}
		if(!isset($searchstring)) {
			$searchstring = "*"; 
			$bind = preg_replace("/\*/","%",$searchstring);
		} else {
			$bind = preg_replace("/\*/","%",$searchstring);
		}
		
		// If sector is not selected 
		if($sector == "sector") {
			$stmt = $mysqli->prepare("SELECT * FROM members WHERE username LIKE ?");
			$stmt->bind_param('s',$bind);
			$stmt->execute();
		}

		// If sector is selected
		elseif($sector != "sector") {
			$stmt = $mysqli->prepare("SELECT * FROM members WHERE sector = ? AND username LIKE ?");
			$stmt->bind_param('ss',$sector,$bind);
			$stmt->execute();
		}
		
		echo "<table class=guides>";
		echo '<tr><th>ID</th><th>Avatar</th><th>Username</th><th>Sector</th></tr>';

		$result = $stmt->get_result();
			while ($row = $result->fetch_array()) {
				// Get all the rows and make them easier to use + secure them
				$username = htmlspecialchars($row['username'], ENT_QUOTES, 'ISO-8859-1');
				$B_id = htmlspecialchars($row['B_id'], ENT_QUOTES, 'ISO-8859-1');	
				$defaultImage = "style/images/default_avatar.png";
				$avatar = (empty($row['avatar'])) ? $defaultImage : htmlspecialchars($row['avatar']);
	  			$profile_link = htmlspecialchars($row['profile_link']);
				$sector = htmlspecialchars($row['sector']);
				
		// Here we print the results on the page 
	echo "	<tr>
			<td width='10'>".$B_id."</td>
			<td width='40'><img src='".$avatar."' width='40'></td>
    			<td><a href=".$profile_link.">".$username."</a></td>
    			<td>".$sector."</td>
    		</tr>";
		} 

		$stmt->close();
		echo "</table>";
	}


?>


