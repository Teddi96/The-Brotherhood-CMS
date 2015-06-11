<?php
include 'config/block_tor.php';
include 'config/mysqli.php';
include 'config/bbcodes.php';

$num_rec_per_page = 5;

if (isset($_GET["page"])) {
	$page = $_GET["page"]; 
} else {
	$page = 1; 
}
$start_from = ($page-1) * $num_rec_per_page;

	/* Prepare a statement */
	if(!($stmt = $mysqli->prepare("SELECT title, added, content FROM news ORDER BY added DESC LIMIT ?, ?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	/* Bind data to the statement */
	if(!($stmt->bind_param("ii", $start_from, $num_rec_per_page))) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	/* Execute it */
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	} 
		$result = $stmt->get_result();
			while ($row = $result->fetch_array()) {
				$title = htmlspecialchars($row['title']); 
				$added = $row['added']; 
				$content = showBBcodes(htmlspecialchars($row['content'])); 

?>

<body>

<table class="news">
	<thead>
    		<tr>
			<td><h2><?php echo $title; ?></h2></td>
      			<td width="80px"><i><?php echo $added; ?></td>
</tr>
</thead>
<tbody>
<tr>
<th colspan="2"><?php echo $content; ?></th>
</tr>
</tbody>
</table>

<?php 
			}
			$stmt->close();

	echo "<br /><div id='pages'>";
	/* 
	 * Pages, we don't want million news per page
	 * so users have to scroll down million times.
	 */

	/* First, prepare the statement */
	if(!($stmt = $mysqli->prepare("SELECT * FROM news"))) { 
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	/* Then execute it as we don't have anything to bind into it*/
	if(!($stmt->execute())) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}  
	
	$stmt->store_result(); // Store the results
	$total_records = $stmt->num_rows; //get the rows
	$stmt->close(); // close stmt
	$total_pages = ceil($total_records / $num_rec_per_page); // Calculate how many pages to show
		
	echo "<a href='index.php?page=1'>".'First'."</a> "; // Go to first page 
       	
	/*for ($i = 1; $i <= $total_pages; $i++) {*/
	for ($i=max($page-5, 1); $i<= max(1, min($total_pages,$page+5)); $i++) {
		echo "<a href='index.php?page=".$i."'>".$i."</a> ";
	}

	echo "<a href='index.php?page=$total_pages'>".'Last'."</a> "; // Go to last page
	echo "</div>"; 
?>
