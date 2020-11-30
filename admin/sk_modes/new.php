<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();
?>
<html>
<head>
<title>Stock Knowledge - New</title>
<link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
<?php include('../header.php');?>

</head>
<body> 
<?php include('../sidebar.php');?>
<div id="main-container"><div id="main">
<h1><?php echo $heading;?></h1>

<form action="insert.php" method="POST">
<table class="new">
<input type="hidden" value="" name="id">
<tr>
	<td>Name</td>
	<td><textarea name="name"></textarea>
</td>
</tr>
<tr>
	<td>Description</td>
	<td><textarea name="description"></textarea>
</td>
</tr>
<tr>
	<td>Content Fields</td>
	<td><textarea name="content_fields"></textarea>
</td>
</tr>

</table>
<br />
<input class="btn btn-primary" type="submit" value="Ok"> <input class="btn btn-warning" type="reset" value="Reset"> <a class="btn btn-success" href="list.php">Back</a>
</div></div>
<?php include('../footer.php');?>

</body>
</html> 
