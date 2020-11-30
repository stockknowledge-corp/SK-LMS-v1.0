<?php

require_once("..//_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "INSERT INTO sk_modes (name,description,content_fields) VALUES ('".mysqli_real_escape_string($dba->link_id,$_REQUEST['name'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['description'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['content_fields'])."')";
$dba->query($query);

$_SESSION['flash'] = "New Entry Nr. ".$dba->insert_id()." created.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?>
