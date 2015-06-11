	<div id="admin">
		<table class=content2>
			<tr>
				<td style="text-align:center;"><p>No Table Selected</p></td>
				<td style="text-align:center; width:20%;">
												
					<form action="manager.php" method="get">
						<input type="submit" style="width:100px; margin-bottom:-14px;" name="id" value="news" > 
					</form>
						
					<form action="manager.php" method="get">
						<input type="submit" style="width:100px; margin-bottom:-14px;"name="id" value="guides" >
					</form>
						
					<form action="manager.php" method="get">
						<input type="submit" style="width:100px; margin-bottom:-14px;" name="id" value="members" > 
					</form>
						
					<form action="manager.php" method="get">
						<input type="submit" style="width:100px; margin-bottom:-14px;" name="id" value="sectors" > 
					</form>
					
					<form action="logout.php" method="post">
						<input type="submit" style="width:100px; margin-bottom:-14px;"value="Exit">
					</form>
				</td>
			</tr>
		</table>
	</div>

<?php include 'user.php'; ?>
