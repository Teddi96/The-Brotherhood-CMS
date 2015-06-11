<?php
include 'config/block_tor.php';
include 'config/mysqli.php';
include 'config/bbcodes.php';

/* Prepare a statement */
if(!($stmt = $mysqli->prepare("SELECT * FROM sectors LIMIT 15"))) {
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
} 
/* Execute the statement */
if(!($stmt->execute())) {
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$result = $stmt->get_result();

while ($row = $result->fetch_array()) {
?>

	<body>

		<table class="news">
			<thead>
    				<tr>
					<td><h2><?php echo htmlspecialchars($row['name']); ?></h2></td>
				</tr>
			</thead>
  			<tbody>
    				<tr>
					<th colspan="2"><? echo showBBcodes(nl2br(htmlspecialchars($row['description']))); ?></th>
				</tr>
			</tbody>
		</table>

	</body> 
<?php 
}
$stmt->close();
		
?>
