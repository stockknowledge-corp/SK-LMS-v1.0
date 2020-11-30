<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
exit();
?>
