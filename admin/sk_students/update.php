<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "UPDATE sk_students SET user_id='".$_REQUEST['user_id']."',gradelevel='".$_REQUEST['gradelevel']."',schoolname='".$_REQUEST['schoolname']."',preferences='".$_REQUEST['preferences']."',progress='".$_REQUEST['progress']."' WHERE id='".mysqli_real_escape_string($dba->link_id,$_REQUEST['id'])."'";
$dba->query($query);

$_SESSION['flash'] = "Entry Nr. ".$_POST['id']." updated.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?> 
