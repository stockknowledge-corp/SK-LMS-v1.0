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
	<td>Username</td>
	<td><textarea name="username"></textarea>
</td>
</tr>
<tr>
	<td>Password</td>
	<td><textarea name="password"></textarea>
</td>
</tr>
<tr>
	<td>Email</td>
	<td><textarea name="email"></textarea>
</td>
</tr>
<tr>
	<td>Mobile</td>
	<td><textarea name="mobile"></textarea>
</td>
</tr>
<tr>
	<td>Firstname</td>
	<td><textarea name="firstname"></textarea>
</td>
</tr>
<tr>
	<td>Lastname</td>
	<td><textarea name="lastname"></textarea>
</td>
</tr>
<tr>
	<td>Photo</td>
	<td><textarea name="photo"></textarea>
</td>
</tr>
<tr>
	<td>Usertype</td>
	<td><select name="usertype">
<?php
$query = "SELECT * FROM sk_user_types ORDER BY id";
$results = $dba->query($query);
while($row = $dba->fetch_array($results)) {
echo("<option value='".$row['id']."'>"."".$row[1]."</option>
");
}
?>
</select>
<a href="../sk_user_types/new.php" target="_new">New</a></td>
</tr>

</table>
<br />
<input class="btn btn-primary" type="submit" value="Ok"> <input class="btn btn-warning" type="reset" value="Reset"> <a class="btn btn-success" href="list.php">Back</a>
</div></div>
<?php include('../footer.php');?>

</body>
</html> 
