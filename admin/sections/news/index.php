<?php
	/* NEWS PAGE */
						$result = $mysqli->query("SELECT * FROM news order by n_id DESC");
						echo '<td colspan="2" style="width:100%;">';
						echo '<div style="height: 350px; overflow: auto;"> <table class=content2>';
						echo '<tr><th>ID</th><th>Title</th><th>Added</th><th>Content</th></tr>';
						/* CASE SENSITIVE----ERRORS IF VARIABLE ISN'T IN DATABASE */
						while($row = mysqli_fetch_array($result)) {
						$n_id = $row['n_id'];
						$title = $row['title'];
						$added = $row['added'];
						$content = nl2br(htmlspecialchars($row['content']));
						echo "<tr>
						<td style='width:40px;'>".$n_id."</td>
						<td style='width: 100px;'>".$title."</td>
						<td style='width: 200px;'>".$added."</td>
						<td style='width: 400px;'>".$content."</td>
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
							
							echo '<form action="sections/news/add.php" name="rowdata" method="post">';
							echo 'Title:<br>';
							echo '<input type="text" name="title">';
							echo '<br>';
							echo 'Content:<br>';
							echo '<textarea type="text" rows="7" cols="80" maxlength="643" name="content"></textarea>';
							echo '<br>';
							echo '<input type="submit" value="Add Record">';
							echo '</form> ';
							echo '<p>';
							echo '</td>';
							echo '</tr>';
							echo '</table>';
							echo '</div>';
							echo '<td style="vertical-align:middle; text-align:center; width:20%;">';
			
								$rs = $mysqli->query("SELECT title, added FROM news ORDER BY added DESC");

							echo '<form action="take_delete.php" name="delete" method="post">';
							echo '<select name="title">';
							while($row = mysqli_fetch_array($rs)){
							echo "<option value='".$row["title"]."'>".$row["title"]."</option>";}
							echo "</select>";
							echo '<input type="submit" name="submit" value="Delete Article" />';
							echo '</form>';

							echo '<form action="no.php" name="clear" method="post">';
							echo '<input type="submit" style="font-face: "Comic Sans MS"; color: white; background-color: #aa2222; border: 1pt initial; border-color: red value="Clear Entire Table">';
							echo '</form>';
							echo '</td>';		
							echo '</td>';
							
							?>	
						
							<td style="text-align:center; vertical-align:middle; width:20%;">
							<form action="manager.php" method="get">
							<input type="submit" style="width:100px;" name="id" value="news" disabled >
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
							<input type="submit" style=width:100px;" name="id" value="sectors" >
							</form>
							<p>
							<form action="../index.php" method="post">
							<input type="submit" style="width:100px;" name="page_number" value="Exit"> 
							</form>
							</td>
							</tr>
							</table>
							

							 

