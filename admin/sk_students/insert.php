<?php

require_once("..//_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "INSERT INTO sk_students (user_id,gradelevel,schoolname,preferences,progress) VALUES ('".mysqli_real_escape_string($dba->link_id,$_REQUEST['user_id'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['gradelevel'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['schoolname'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['preferences'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['progress'])."')";
$dba->query($query);

$_SESSION['flash'] = "New Entry Nr. ".$dba->insert_id()." created.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?>
