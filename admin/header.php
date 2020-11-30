<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$heading = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$heading = str_replace($home_url.'/', '', $heading);
$headingArr = explode('/',$heading);
$heading = str_replace('sk_','',$headingArr[0]);
$heading = str_replace('_',' ',$heading);
$heading = str_replace('.php',' ',$heading);
if(isset($headingArr[1])){
if($headingArr[1]!='list.php') $heading.=' >> '.ucwords(str_replace('.php','',$headingArr[1]));
}
$heading = explode('?',$heading);
$heading = ucwords($heading[0]);
$loggedin=false;
if(isset($_COOKIE['loggedin'])) $loggedin=$_COOKIE['loggedin'];
if(isset($_COOKIE['usertype'])) $usertype=$_COOKIE['usertype'];

if($heading != 'Login ' && !$loggedin){
	$URL=$home_url.'/login.php';
	// echo $heading;
	// echo $URL;
	echo '<script type="text/javascript">document.location.href="'.$URL.'";</script>';
	echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';
}

?>
<!-- Required meta tags -->
<meta charset="utf-8">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $home_url;?>/style.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<meta name = "viewport" content = "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">

<link rel="icon" 

      type="image/png" 

      href="<?php echo $home_url;?>/images/favicon-32x32.png">

<meta name="apple-mobile-web-app-capable" content="yes" />

<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<link rel="apple-touch-icon" href="<?php echo $home_url;?>/images/favicon-32x32.png" />

<meta name="format-detection" content="telephone=no" />

<script type="text/javascript">

window.scrollTo(0,1);

</script>
<script src="<?php echo $home_url;?>/zxcvbn.js"></script>
<script src="<?php echo $home_url;?>/main.js"></script>


