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
	<td>User</td>
	<td><select name="user_id">
<?php
$query = "SELECT * FROM sk_users ORDER BY id";
$results = $dba->query($query);
while($row = $dba->fetch_array($results)) {
echo("<option value='".$row['id']."'>"."".$row[1]."</option>
");
}
?>
</select>
<a href="../sk_users/new.php" target="_new">New</a></td>
</tr>
<tr>
	<td>Schoolname</td>
	<td><textarea name="schoolname"></textarea>
</td>
</tr>
<tr>
	<td>Preferences</td>
	<td><textarea name="preferences"></textarea>
</td>
</tr>

</table>
<br />
<input class="btn btn-primary" type="submit" value="Ok"> <input class="btn btn-warning" type="reset" value="Reset"> <a class="btn btn-success" href="list.php">Back</a>
</div></div>
<?php include('../footer.php');?>

</body>
</html> 
