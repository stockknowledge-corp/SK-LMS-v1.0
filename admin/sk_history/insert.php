<?php
require_once("..//_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "INSERT INTO sk_history (activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,$_REQUEST['activity'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['datetime'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['user_id'])."')";
$dba->query($query);

$_SESSION['flash'] = "New Entry Nr. ".$dba->insert_id()." created.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?>
