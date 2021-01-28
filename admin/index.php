<?php
require_once("_class.dba.inc.php");
require_once("_conf.dba.inc.php");
require_once("_static.session.inc.php");
validate_session();

if($_COOKIE['verified'] != 1)
	header("Location: ".$home_url."/sk_pages/account-verification.php");
?>

<!doctype html>
<html lang="en">
<head>
<?php include('header.php');?>
</head>
<body>
<?php
if(IsSet($_SESSION['flash'])) {
	echo("<div id=\"flash\">\n");
	echo($_SESSION['flash']);
	unset($_SESSION['flash']);
	echo("<i class=\"fa fa-times-circle-o\" aria-hidden=\"true\" style=\"cursor:pointer; margin-left:20px;\" onclick=\"document.getElementById('flash').style.display='none'\"></i></div>\n");
}
?>
<?php include('sidebar.php');?>
    	<div id="main-container">
    		<div id="main">
    			<h1>Dashboard</h1>
    		</div>
    	</div>
<?php include('footer.php');?>
</body>
</html>
