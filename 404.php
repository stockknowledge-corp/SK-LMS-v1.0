<?php
// var_dump($_SERVER);
if(strpos($_SERVER["REQUEST_URI"],'/app/')===false){
	header('Location: https://'.$_SERVER["HTTP_HOST"].'/admin/sk_pages/404.php');
} else {
	header('Location: https://'.$_SERVER["HTTP_HOST"].'/app/?p='.$_SERVER["REQUEST_URI"]);
}
?>