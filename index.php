<? 
/*****************************
 * Index page switch center  *
 * add more pages if needed  *
 * using the same form       *
 *****************************/
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

/* Include the header once */
include_once 'style/header.php';

if (isset($_GET['id'])) {
	$id = $_GET['id']; 
} else {
	$id = "news";
}
 
switch($id)
	{
		default:
		case "news":
			include 'sections/news.php';
			break;
	
		case "about": 
			include 'sections/about.php';
			break;
	
		case "members":
			include 'sections/members.php';
			break;
	
		case "guides":
			include 'sections/guides.php';
			break;

		case "sectors":
			include 'sections/sectors.php';
			break;
		
		case "info":
			phpinfo();
			break;
	}


/* Include the footer once */
include_once 'style/footer.php';

?>

