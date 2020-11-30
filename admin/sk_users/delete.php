<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$_SESSION['flash'] = "Entry Nr. ".$_REQUEST['id']." not deleted";
?>
<html>
<head>
<title>Stock Knowledge - Delete</title>
<link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
<?php include('../header.php');?>

</head>
<body>
<?php include('../sidebar.php');?>
<div id="main-container"><div id="main">
<h1><?php echo $heading;?></h1>

<?php
$query = "SELECT * FROM sk_users WHERE id='".$_REQUEST['id']."' LIMIT 1";
$row = $dba->query_first($query);
?>
Do you really want to delete Entry Nr. <?= $_REQUEST['id'] ?> (<?= $row[0].", ".$row[1] ?>)?
<a href="remove.php?id=<?= $_REQUEST['id'] ?>">Yes</a>
<a href="list.php">No</a>
</div></div>
<?php include('../footer.php');?>

</body>
</html>
