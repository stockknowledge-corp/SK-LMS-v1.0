<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$id = mysqli_real_escape_string($dba->link_id,$_REQUEST['id']);

$query = "DELETE FROM sk_topics WHERE id='".$id."' LIMIT 1";
$dba->query($query);

$_SESSION['flash'] = "Entry number ".$id." deleted.";

header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?> 
