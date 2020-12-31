<?php

// setcookie('loggedin', '', time() - (86400 * 30)); 
$_SESSION['loggedin'] = '';
$loggedin = false;

require_once("_class.dba.inc.php");
require_once("_conf.dba.inc.php");
require_once("_static.session.inc.php");
validate_session();

$_SESSION['flash'] = "Logout Successful";
header("Location: ".$home_url."/login.php");
?>