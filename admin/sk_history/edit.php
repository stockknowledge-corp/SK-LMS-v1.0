<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "SELECT * FROM sk_history WHERE id='".mysqli_real_escape_string($dba->link_id,$_REQUEST['id'])."' LIMIT 1";
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
	<td>Activity</td>
	<td><textarea name="activity"><?= $row['activity'] ?></textarea>
</td>
</tr>
<tr>
	<td>Datetime</td>
	<td><textarea name="datetime"><?= $row['datetime'] ?></textarea>
</td>
</tr>
<tr>
	<td>User</td>
	<td><select name="user_id">
<?php
$query = "SELECT * FROM sk_users ORDER BY id";
$results = $dba->query($query);
while($rowi = $dba->fetch_array($results)) {
	if($rowi['id'] == $row['user_id']) {
		$selected = ' selected';
	} else {
		$selected = '';
	}
	echo("<option value='".$rowi['id']."'$selected>".$rowi[0]." ".$rowi[1]."</option>");
}
?>
</select>
<a href="../sk_users/new.php" target="_new">New</a></td>
</tr>

</table>
<br />
<input class="btn btn-primary" type="submit" value="Ok"> <input class="btn btn-warning" type="reset" value="Reset"> <a class="btn btn-success" href="list.php">Back</a>
</form>
</div></div>
<?php include('../footer.php');?>

</body>
</html>
