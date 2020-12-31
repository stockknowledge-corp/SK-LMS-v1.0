<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$pw = $_REQUEST['password'];
$editerror='';
if($_REQUEST['password-temp']!=''){
	$pw = md5($_REQUEST['password-temp']);
	if($_REQUEST['password-temp']!=$_REQUEST['password-temp2'])	$editerror.='<li>Passwords did not match</li>';
	if($_REQUEST['pw-strength']!='Strong' && $_REQUEST['pw-strength']!='Very Strong' ) $editerror.='<li>You must use a strong password</li>';
}

if($_POST['username']=='') $editerror.='<li>Username required</li>';
if($_POST['username']!=''){
	$query = "SELECT * FROM sk_users WHERE username='".$_POST['username']."' AND password='".md5($_POST['password'])."' LIMIT 1";
	$result = $dba->query($query);
	$row = $dba->fetch_array($result);
	if($row) $editerror.='<li>Username already exists</li>';
}

if($_POST['email']=='') $editerror.='<li>Email Address required</li>';
if($_POST['mobile']=='') $editerror.='<li>Mobile Number required</li>';
if($_POST['firstname']=='') $editerror.='<li>First Name required</li>';
if($_POST['lastname']=='') $editerror.='<li>Last Name required</li>';


// if($_POST['usertype']==2){
// 	if($_POST['teacher-schoolname']=='') $editerror.='<li>School Name required</li>';
// }
// if($_POST['usertype']==3){
// 	if($_POST['student-gradelevel']=='') $editerror.='<li>Grade Level required</li>';
// 	if($_POST['student-schoolname']=='') $editerror.='<li>School Name required</li>';
// }

if($editerror==''){
$query = "UPDATE sk_users SET username='".$_REQUEST['username']."',password='".$pw."',email='".$_REQUEST['email']."',mobile='".$_REQUEST['mobile']."',firstname='".$_REQUEST['firstname']."',lastname='".$_REQUEST['lastname']."',usertype='".$_REQUEST['usertype']."' WHERE id='".mysqli_real_escape_string($dba->link_id,$_REQUEST['id'])."'";
$dba->query($query);

// $query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Users')."','".mysqli_real_escape_string($dba->link_id,'User Edited: '.$_REQUEST['username'])."',NOW(),'".mysqli_real_escape_string($dba->link_id,$_COOKIE['loggedin'])."')";
$query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Users')."','".mysqli_real_escape_string($dba->link_id,'User Edited: '.$_REQUEST['username'])."',NOW(),'".mysqli_real_escape_string($dba->link_id,$_SESSION['loggedin'])."')";

$dba->query($query2);


$_SESSION['flash'] = "Entry Nr. ".$_POST['id']." updated.";
} else {
$_SESSION['error'] = '<ul>'.$editerror.'</ul>';
}
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/edit.php?id=".$_REQUEST['id']);

?> 
