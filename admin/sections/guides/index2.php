<?php	
					/* GUIDES PAGE */ 
						$result = $mysqli->query("SELECT P_Id, name, info, link_description, link_address, sector FROM guides");
						echo '<td colspan="2" style="width:100%;">';
						echo '<div style="height: 350px; overflow: auto;"> <table class=content2>';
						echo '<tr><th>ID</th><th>Name</th><th>Info</th><th>Link Description</th><th>Link Address</th><th>Sector</th></tr>';
						/* CASE SENSITIVE----ERRORS IF VARIABLE ISN'T IN DATABASE */
						while($row = mysqli_fetch_array($result)) {
						$ID = $row['P_Id'];
						$name = $row['name'];
						$info = $row['info'];
						$link_description = $row['link_description'];
						$link_address = $row['link_address'];
						$sector = $row['sector'];
			
						echo "<tr>
						<td>$ID</td>
						<td>$name</td>
						<td>$info</td>
						<td><a href=$link_address>$link_description</a></td>
						<td>$link_address</td>
						<td>$sector</td>
						</tr>";	                       }	
						echo '</td>';
						echo '</tr>';
						echo '</table>';
						echo '</div>';
						echo '<p>';
							echo '<table class=content2>';
							echo '<tr>';
							echo '<td style="vertical-align:middle; width:60%;">';
							echo '<div style="display:table-cell; height:270px; background-color:#222222; left-margin:auto; right-margin:auto; vertical-align:middle; text-align:center;">';
							echo '<table class=content2 style="background-color:222222">';
							echo '<tr>';
							echo '<td style="text-align:center;">';

							echo '<form action="take_add.php" name="rowdata" method="post">';
							echo 'Name:<br>';
							echo '<input type="text" name="name">';
							echo '<br>';
							echo 'Info:<br>';
							echo '<input type="text" name="info">';
							echo '<br>';
							echo 'Link Description:<br>';
							echo '<input type="text" name="link_description">';
							echo '<br>';
							echo 'Link Address:<br>';
							echo '<input type="text" name="link_address">';
							echo '<br>';

							$sectors = $mysqli->query("SELECT name FROM sectors");
							echo 'Sector';
							echo '<br>';
							echo '<select name="sector">';
							while($row = mysqli_fetch_array($sectors)) {
								echo "<option value='".$row["name"]."'>".$row["name"]."</option>";
							} 
								echo "</select>";	

							echo '<br>';
							echo '<input type="submit" value="Add Record">';
							echo '</form> ';
							echo '</td>';
							echo '</tr>';
							echo '</table>';
							echo '</div>';
							echo '</td>';
							echo '<td style="vertical-align:middle; width:20%; text-align:center;">';

							$result = $mysqli->query("SELECT P_Id FROM guides LIMIT 500");
			
							echo '<form action="take_delete.php" name="delete" method="post">';
							echo '<select name="ID">';
							while($row = mysqli_fetch_array($result)){
							echo "<option value='".$row["P_Id"]."'>".$row["P_Id"]."</option>";} 
							echo "</select>";
							echo '<input type="submit" name="submit" value="Delete Record" />';
							echo '</form>';
			
							echo '<form action="clear.php" name="clear" method="post">';
							echo '<input type="submit" style="color: white; background-color: #aa2222; border: 1pt initial; border-color: red" value="Clear Entire Table">';
							echo '</form>';
							echo '</td>';
							echo '</td>';
					?>
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
