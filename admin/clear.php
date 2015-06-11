<?php

include_once '../style/header_no_pic.php'; 
echo '<link rel="stylesheet" type="text/css" href="../style/css.css">';
include 'mysqli.php';

$sql = "delete from guides";
if ($mysqli->query($sql) === TRUE) {

?>	
<table class=main>
  <tr>
    <th style="font-size:12px">Content Manager</th>
    <th style="text-align:right;"><?php date_default_timezone_set("UTC"); echo date("h:ia"); echo " UTC";?>
  </tr>
 <tr>
	<td colspan="2" style="width:100%;">
		<table class=main>
			<tr>
				<td style="text-align:center; font-size:24px;">
				<p>Table "Guides" Cleared<p>
				<form action="manager.php" method="post">
				<button style="width:100px;" name="page_number" type="submit" value="guides">OK</button>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>


<?php

} else {
	echo "Error deleting Table: " . $mysqli->error;
}

$mysqli->close();



?>
