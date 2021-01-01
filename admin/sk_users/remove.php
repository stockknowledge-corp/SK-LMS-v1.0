<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$id = mysqli_real_escape_string($dba->link_id,$_REQUEST['id']);

$query = "SET FOREIGN_KEY_CHECKS=OFF;";
$dba->query($query);

$query = "UPDATE `sk_history` SET `user_id` = '1' WHERE `user_id`='".$id."'";
$dba->query($query);

$query = "DELETE FROM sk_users WHERE id='".$id."' LIMIT 1";
$dba->query($query);

$query = "SET FOREIGN_KEY_CHECKS=ON;";
$dba->query($query);


$_SESSION['flash'] = "Entry number ".$id." deleted.";

header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?> 
