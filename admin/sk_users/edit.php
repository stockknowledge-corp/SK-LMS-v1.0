<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

if($_COOKIE['usertype'] != 1)
	header("Location: http://".$_SERVER['HTTP_HOST']."/admin/sk_pages/401.php");

if($_COOKIE['verified'] != 1)
	header("Location: ".$home_url."/sk_pages/account-verification.php");

$editerror='';
if(isset($_SESSION['error'])) {
	$editerror=$_SESSION['error'];
	unset($_SESSION['error']);
}

$query = "SELECT * FROM sk_users WHERE id='".$_REQUEST['id']."' LIMIT 1";
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
<?php
if(IsSet($_SESSION['flash'])) {
	echo("<div id=\"flash\">\n");
	echo($_SESSION['flash']);
	unset($_SESSION['flash']);
	echo("<i class=\"fa fa-times-circle-o\" aria-hidden=\"true\" style=\"cursor:pointer; margin-left:20px;\" onclick=\"document.getElementById('flash').style.display='none'\"></i></div>\n");
}
?>
<?php include('../sidebar.php');?>
<div id="main-container"><div id="main">
<h1><?php echo $heading;?></h1>

<form action="update.php" method="POST">
<table class="edit">
<input type="hidden" value="<?= $row['id'] ?>" name="id">
<tr>
	<td>Username</td>
	<td><textarea name="username"><?= $row['username'] ?></textarea>
</td>
</tr>
<tr>
	<td>Email</td>
	<td><textarea name="email"><?= $row['email'] ?></textarea>
</td>
</tr>
<tr>
	<td>Mobile</td>
	<td><textarea name="mobile"><?= $row['mobile'] ?></textarea>
</td>
</tr>
<tr>
	<td>Firstname</td>
	<td><textarea name="firstname"><?= $row['firstname'] ?></textarea>
</td>
</tr>
<tr>
	<td>Lastname</td>
	<td><textarea name="lastname"><?= $row['lastname'] ?></textarea>
</td>
</tr>
<!-- <tr>
	<td>Photo</td>
	<td><textarea name="photo"><?= $row['photo'] ?></textarea>
</td>
</tr> -->
<tr>
	<td>Usertype</td>
	<td><select name="usertype">
<?php
$query = "SELECT * FROM sk_user_types ORDER BY id";
$results = $dba->query($query);
while($rowi = $dba->fetch_array($results)) {
	if($rowi['id'] == $row['usertype']) {
		$selected = ' selected';
	} else {
		$selected = '';
	}
	echo("<option value='".$rowi['id']."'$selected>".$rowi[1]."</option>");
}
?>
</select>
</tr>
<tr>
	<td>Password<br>(Leave blank for no change)</td>
	<td><input type="hidden" name="password" value="<?= $row['password'] ?>">
		<input type="password" name="password-temp" id="pw" onkeyup="assess()">
	<div id="pw-score"></div>
	<input type="hidden" name="pw-strength" id="pw-strength" value="">
</td>
</tr>
<tr>
	<td>Confirm Password</td>
	<td><input type="password" name="password-temp2" id="pw2">
</td>
</tr>
</table>
<br>
<div id="edit-error"><?php echo $editerror?></div>
<br>
<input class="btn btn-primary" type="submit" value="Ok"> <input class="btn btn-warning" type="reset" value="Reset"> <a class="btn btn-success" href="list.php">Back</a>
</form>
</div></div>
<?php include('../footer.php');?>

</body>
</html>
