<?php

setcookie('loggedin', '', time() - (86400 * 30)); 
setcookie('usertype', '', time() - (86400 * 30)); 
$loggedin = false;

require_once("_class.dba.inc.php");
require_once("_conf.dba.inc.php");
require_once("_static.session.inc.php");
validate_session();

$loginerror='';
if(isset($_GET['login'])){
	$query = "SELECT * FROM sk_users WHERE username='".$_POST['username']."' AND password='".md5($_POST['password'])."' LIMIT 1";
	$result = $dba->query($query);
	$row = $dba->fetch_array($result);
	if($row){
		// $loginerror=$row['username'];

		$query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Users')."','".mysqli_real_escape_string($dba->link_id,'User login')."',NOW(),'".mysqli_real_escape_string($dba->link_id,$row['id'])."')";
		$dba->query($query2);

		setcookie('loggedin', $row['id'], time() + (86400 * 30)); 
		$_SESSION['flash'] = "Login successful";
		header("Location: ".$home_url."/sk_users/edit.php?id=".$row['id']);

	} else {
		$loginerror='Invalid Login';
		$loggedin = false;
	}

}

$registrationerror='';
if(isset($_GET['register'])){

if($_POST['username']=='') $registrationerror.='<li>Username required</li>';
if($_POST['username']!=''){
	$query = "SELECT * FROM sk_users WHERE username='".$_POST['username']."' AND password='".md5($_POST['password'])."' LIMIT 1";
	$result = $dba->query($query);
	$row = $dba->fetch_array($result);
	if($row) $registrationerror.='<li>Username already exists</li>';
}
if($_POST['password']=='') $registrationerror.='<li>Password required</li>';
if($_POST['password']!=''){
if($_POST['password']!=$_POST['password2']) $registrationerror.='<li>Passwords did not match</li>';
if($_POST['pw-strength']!='Strong' && $_POST['pw-strength']!='Very Strong' ) $registrationerror.='<li>You must use a strong password</li>';
}

if($_POST['email']=='') $registrationerror.='<li>Email Address required</li>';
if($_POST['mobile']=='') $registrationerror.='<li>Mobile Number required</li>';
if($_POST['firstname']=='') $registrationerror.='<li>First Name required</li>';
if($_POST['lastname']=='') $registrationerror.='<li>Last Name required</li>';


if($_POST['usertype']==2){
	if($_POST['teacher-schoolname']=='') $registrationerror.='<li>School Name required</li>';
}
if($_POST['usertype']==3){
	if($_POST['student-gradelevel']=='') $registrationerror.='<li>Grade Level required</li>';
	if($_POST['student-schoolname']=='') $registrationerror.='<li>School Name required</li>';
}

if($registrationerror==''){
$query = "INSERT INTO sk_users (username,password,email,mobile,firstname,lastname,usertype) VALUES ('".mysqli_real_escape_string($dba->link_id,$_POST['username'])."','".mysqli_real_escape_string($dba->link_id,md5($_POST['password']))."','".mysqli_real_escape_string($dba->link_id,$_POST['email'])."','".mysqli_real_escape_string($dba->link_id,$_POST['mobile'])."','".mysqli_real_escape_string($dba->link_id,$_POST['firstname'])."','".mysqli_real_escape_string($dba->link_id,$_POST['lastname'])."','".mysqli_real_escape_string($dba->link_id,$_POST['usertype'])."')";
$dba->query($query);
$last_id = $dba->insert_id();

$query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Users')."','".mysqli_real_escape_string($dba->link_id,'New user registration: '.mysqli_real_escape_string($dba->link_id,$_POST['username']))."',NOW(),'".mysqli_real_escape_string($dba->link_id,$last_id)."')";
$dba->query($query2);

if($_POST['usertype']==2){
$query3 = "INSERT INTO sk_teachers (user_id,schoolname) VALUES ('".mysqli_real_escape_string($dba->link_id,$last_id)."','".mysqli_real_escape_string($dba->link_id,$_POST['teacher-schoolname'])."')";
}
if($_POST['usertype']==3){
$query3 = "INSERT INTO sk_students (user_id,gradelevel,schoolname) VALUES ('".mysqli_real_escape_string($dba->link_id,$last_id)."','".mysqli_real_escape_string($dba->link_id,$_POST['student-gradelevel'])."','".mysqli_real_escape_string($dba->link_id,$_POST['student-schoolname'])."')";
}
$dba->query($query3);



setcookie('loggedin', $dba->insert_id(), time() + (86400 * 30)); 
$_SESSION['flash'] = "Registration Successful";
header("Location: ".$home_url."/sk_users/edit.php?id=".$last_id);
} else {
	$registrationerror='<ul>'.$registrationerror.'</ul>';
}
}

?>

<!doctype html>
<html lang="en">
<head>
<?php include('header.php');?>
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
<?php include('sidebar.php');?>
    	<div id="main-container">
    		<div id="main">
    			<h2>You need to login or register to continue</h2>
    			<div class="row">
    				<div class="col-md-6 col-sm-12">
    					<div class="card p-3 mb-3">
			    			<h2>Login</h2>
			    			<form action="login.php?login" method="post">
			    			Username:
			    			<input type="text" name="username" class="form-control">
			    			Password:
			    			<input type="password" name="password" class="form-control">
			    			<br>
			    			<div id="login-error"><?php echo $loginerror?></div>
			    			<br>
			    			<input type="submit" class="btn btn-primary pl-5 pr-5 m-0" value="Login"><br>
			    			<a href="#" class="text-center">Forgot password</a>
			    			</form>
			    		</div>
		    		</div>
		    		<div class="col-md-6 col-sm-12">
    					<div class="card p-3 mb-3">
			    			<h2>Register</h2>
			    			<form action="login.php?register" method="post">
			    			Username:
			    			<input type="text" name="username" class="form-control">
			    			Password:
			    			<input type="password" name="password" class="form-control" onkeyup="assess()" id="pw">
							<div id="pw-score"></div>
							<input type="hidden" name="pw-strength" id="pw-strength" value="">
			    			Confirm Password:
			    			<input type="password" name="password2" class="form-control">
			    			Email:
			    			<input type="text" name="email" class="form-control">
			    			Mobile Number:
			    			<input type="text" name="mobile" class="form-control">
			    			First Name:
			    			<input type="text" name="firstname" class="form-control">
			    			Last Name:
			    			<input type="text" name="lastname" class="form-control">
			    			Type:
			    			<select name="usertype" class="form-control" id="usertype" onchange="showFields()">
			    				<option value="2">Teacher</option>
			    				<option value="3" selected>Student</option>
			    			</select>
			    			<div id="teacher-fields" class="optional-fields">
			    				School Name:
			    				<input type="text" name="teacher-schoolname" class="form-control">
			    			</div>
			    			<div id="student-fields" class="optional-fields">
			    				Grade Level:
			    				<input type="text" name="student-gradelevel" class="form-control">
			    				School Name:
			    				<input type="text" name="student-schoolname" class="form-control">
			    			</div>
			    			<br>
			    			<div id="registration-error"><?php echo $registrationerror?></div>
			    			<br>
			    			<input type="submit" class="btn btn-primary pl-5 pr-5 m-0" value="Register"><br>
			    		</div>
		    		</div>
		    	</div>

    		</div>
    	</div>
<style>
#teacher-fields{
	display: none;
}
#student-fields{
	display: block;
}
</style>
<script>
	function showFields(){
		document.getElementById('student-fields').style.display='none';
		document.getElementById('teacher-fields').style.display='none';
		usertype = document.getElementById('usertype').value;
		if(usertype==2) document.getElementById('teacher-fields').style.display='block';
		if(usertype==3) document.getElementById('teacher-fields').style.display='block';
	}
</script>
<?php include('footer.php');?>
</body>
</html>
