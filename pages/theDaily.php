<?php
date_default_timezone_set("EST");
session_start();
require "regulate.php";
?>

<!DOCTYPE html>
<html>
<head>
<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="stylesheet" type="text/css" href="mainTheme.css">
</head>


<body>
<nav class="navbar navbar-default" role="navigation">
<ul class="nav nav-justified">
<li><a href="theDaily.php">see the daily!</a></li>
<li><a href="insertNew.php">insert content</a></li>
</ul>
</nav>
<br>
<div class="carouselWrapper">  
<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
<div class="carousel-inner">
<?php
$days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
connectToSQL();
foreach ($days as $day){
	if (Date("l") == $day){
		echo "<div class='active item'>";
	}
	else{
		echo "<div class='item'>";
	}
	echo "<p class='day'>".$day."</p>";
	getDaily($day);
	for ($i=0;$i<sizeof($_SESSION['dailies']);$i++){
		echo "<br><p class='category'>".$_SESSION['dailies'][$_SESSION['ctr']][0]."</p>";
		echo "<br><p class='question'> ". $_SESSION['dailies'][$_SESSION['ctr']][1]."</p>";
		echo '<br><p><button type="button" class="btn btn-success" data-toggle="displayAnswer" data-content="'.$_SESSION['dailies'][$_SESSION['ctr']][2].'">answer</button></p>';
		echo "<br><br><br>";
		$_SESSION['ctr']++;

	}
	$_SESSION['ctr']=0;
	echo "<br>";
	echo "</div>";

}
closeSQLConnection();

?>

</div>
</div>
</div>
<!-- left and right controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">next</span>
</a>
<script>
$(document).ready(function(){
		$('[data-toggle="displayAnswer"]').popover();   
		});
</script>

</body>
</html>
