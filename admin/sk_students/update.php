<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "UPDATE sk_students SET user_id='".mysqli_real_escape_string($dba->link_id,$_REQUEST['user_id'])."',gradelevel='".mysqli_real_escape_string($dba->link_id,$_REQUEST['gradelevel'])."',schoolname='".mysqli_real_escape_string($dba->link_id,$_REQUEST['schoolname'])."',preferences='".mysqli_real_escape_string($dba->link_id,$_REQUEST['preferences'])."',progress='".mysqli_real_escape_string($dba->link_id,$_REQUEST['progress'])."' WHERE id='".mysqli_real_escape_string($dba->link_id,$_REQUEST['id'])."'";
$dba->query($query);

$_SESSION['flash'] = "Entry Nr. ".$_POST['id']." updated.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?> 
