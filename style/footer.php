<div id="footer">
	
		<br /><p>This site is licenced under the <a href="LICENSE.txt">BSD 3-clause License.</a></p>
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo '<p>Page generated in '.$total_time.' seconds.</p><br /><br />';
?>
</div>
</body>
</html>
