<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "SELECT * FROM sk_subjects WHERE id='".$_REQUEST['id']."' LIMIT 1";
$result = $dba->query($query);
$row = $dba->fetch_array($result);
?>
<html>
<head>
<title>Show</title>
<link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
<?php include('../header.php');?>

</head>
<body>
<?php include('../sidebar.php');?>
<div id="main-container"><div id="main">
<h1><?php echo $heading;?></h1>

<table class="show">
<tr>
	<td>Id</td>
	<td><?= $row["id"] ?></td>
</tr>
<tr>
	<td>Title</td>
	<td><?= $row["title"] ?></td>
</tr>
<tr>
	<td>Description</td>
	<td><?= $row["description"] ?></td>
</tr>
<tr>
	<td>Background</td>
	<td><?= $row["background"] ?></td>
</tr>
<tr>
	<td>Colors</td>
	<td><?= $row["colors"] ?></td>
</tr>
</table>

<br />
<a href="edit.php?id=<?php echo($row["id"]); ?>">Edit</a> | <a href="delete.php?id=<?php echo($row["id"]); ?>">Delete</a> | <a href="list.php">Back</a> | <a href="new.php">Create new Entry</a>
</div></div>
<?php include('../footer.php');?>

</body>
</html> 
