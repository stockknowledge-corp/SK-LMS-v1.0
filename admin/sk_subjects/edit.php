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
<title>Stock Knowledge - Edit</title>
<link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
<?php include('../header.php');?>

</head>
<body>
<?php include('../sidebar.php');?>
<div id="main-container"><div id="main">
<h1><?php echo $heading;?></h1>

<form action="update.php" method="POST">
<table class="edit">
<input type="hidden" value="<?= $row['id'] ?>" name="id">
<tr>
	<td>Title</td>
	<td><textarea name="title"><?= $row['title'] ?></textarea>
</td>
</tr>
<tr>
	<td>Description</td>
	<td><textarea name="description"><?= $row['description'] ?></textarea>
</td>
</tr>
<tr>
	<td>Background</td>
	<td><textarea name="background"><?= $row['background'] ?></textarea>
</td>
</tr>
<tr>
	<td>Colors</td>
	<td><textarea name="colors"><?= $row['colors'] ?></textarea>
</td>
</tr>

</table>
<br />
<input class="btn btn-primary" type="submit" value="Ok"> <input class="btn btn-warning" type="reset" value="Reset"> <a class="btn btn-success" href="list.php">Back</a>
</form>
</div></div>
<?php include('../footer.php');?>

</body>
</html>
