<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "UPDATE sk_modes SET name='".mysqli_real_escape_string($dba->link_id, $_REQUEST['name'])."',description='".mysqli_real_escape_string($dba->link_id, $_REQUEST['description'])."',content_fields='".mysqli_real_escape_string($dba->link_id, $_REQUEST['content_fields'])."' WHERE id='".mysqli_real_escape_string($dba->link_id,$_REQUEST['id'])."'";
$dba->query($query);

$_SESSION['flash'] = "Entry Nr. ".$_POST['id']." updated.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?> 
