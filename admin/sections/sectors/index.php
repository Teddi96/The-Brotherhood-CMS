<?php
						$result = $mysqli->query("SELECT * FROM sectors order by s_id DESC");
						echo '<td colspan="2" style="width:100%;">';
						echo '<div style="height: 350px; overflow: auto;"> <table class=content2>';
						echo '<tr><th>ID</th><th>Sector</th><th>Description</th></tr>';
						/* CASE SENSITIVE----ERRORS IF VARIABLE ISN'T IN DATABASE */
						while($row = mysqli_fetch_array($result)) {
						$s_id = htmlspecialchars($row['s_id']);
						$name = htmlspecialchars($row['name']);
						$desc = nl2br(htmlspecialchars($row['description']));

						echo "<tr>
						<td style='width:40px;'>".$s_id."</td>
						<td style='width: 70px;'>".$name."</td>
						<td style='width: 400px;'>".$desc."</td> 
						</tr>";										
} 
						echo '</td>';
						echo '</tr>';
						echo '</table>';
						echo '</div>';
						echo '<p>';
							echo '<table class=content2>';
							echo '<tr>';								
							echo '<td style="vertical-align:middle;">';
							echo '<div style="display:table-cell; height:270px; background-color:#222222; left-margin:auto; right-margin:auto; vertical-align:middle; text-align:center;">';
							echo '<table class=content2 style="background-color:222222">';
							echo '<tr>';
							echo '<td style="width:60%;">';							
							echo '<form action="take_add.php" name="rowdata" method="post">';
							echo 'Name of sector:<br>';
							echo '<input type="text" name="sector_name"><br />';
							echo 'Description:<br />';
							echo '<textarea type="text" rows="7" cols="70" maxlength="643" name="desc"></textarea>';
							echo '<br>';
						        echo '<input type="submit" value="Add Record">';
							echo '</form>';
							echo '<p>';
							echo '</td>';
							echo '</tr>';
							echo '</table>';
							echo '</div>';
							echo '<td style="vertical-align:middle; text-align:center; width:20%;">';
				
								$rs = $mysqli->query("SELECT s_id, name FROM sectors ORDER BY s_id DESC");

							echo '<form action="take_delete.php" name="delete" method="post">';
							echo '<select name="s_id">';
							while($row = mysqli_fetch_array($rs)){
								$s_id = htmlspecialchars($row["s_id"]);
								$name = htmlspecialchars($row["name"]);
								echo "<option value='".$s_id."'>".$name."</option>";
							}
							echo "</select>";
							echo '<input type="submit" name="submit" value="Remove Sector" />';
							echo '</form>';
							echo '<form action="no.php" name="clear" method="post">';
							echo '<input type="submit" style="font-face: "Comic Sans MS"; color: white; background-color: #aa2222; border: 1pt initial; border-color: red value="Clear Entire Table">';
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
							<input type="submit" style="width:100px;" name="id" value="guides" >
							</form>
							<p>
							<form action="manager.php" method="get">
							<input type="submit" style=width:100px;" name="id" value="members" >
							</form>
							<p>
							<form action="manager.php" method="get">
							<input type="submit" style=width:100px;" name="id" value="sectors" disabled >
							</form>
							<p>		
							<form action="../index.php" method="post">
							<input type="submit" style="width:100px;" name="page_number" value="Exit"> 
							</form>
							</td>
							</tr>
							</table>
