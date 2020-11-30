<?php

require_once("..//_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "INSERT INTO sk_users (username,password,email,mobile,firstname,lastname,photo,usertype) VALUES ('".mysqli_real_escape_string($dba->link_id,$_REQUEST['username'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['password'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['email'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['mobile'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['firstname'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['lastname'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['photo'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['usertype'])."')";
$dba->query($query);

$_SESSION['flash'] = "New Entry Nr. ".$dba->insert_id()." created.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?>
