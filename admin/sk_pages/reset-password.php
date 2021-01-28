<?php
setcookie('loggedin', '', time() - (86400 * 30)); 
setcookie('usertype', '', time() - (86400 * 30)); 

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
require_once("../_class.code.inc.php");
require_once("../_class.mailer.inc.php");
require_once("../_conf.mailer.inc.php");

require_once("../_static.session.inc.php");

validate_session();

// if(isset($_GET['code']) && isset($_GET['id'])){
// 	$userid = $_GET['id'];
// 	$sql = sprintf("SELECT * FROM sk_forgot_password WHERE userid = '%s' ORDER BY id DESC LIMIT 1" , $userid);
// 	$row = $dba->query_first($sql);

// 	$prevCode = $row['code'];

// 	if($prevCode == $_GET['code']){
        // echo 'login';
        // $query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Users')."','".mysqli_real_escape_string($dba->link_id,'User login')."',NOW(),'".mysqli_real_escape_string($dba->link_id,$row['id'])."')";
		// $dba->query($query2);

		// setcookie('loggedin', $row['userid'], time() + (86400 * 30));
		// $_SESSION['flash'] = "Login successful";
		// header("Location: ".$home_url."/sk_users/edit.php?id=".$row['id']);
	// 	// $sql = sprintf('UPDATE sk_users SET verified = 1 WHERE id = \'%s\'',$userid);
	// 	// $dba->query($sql);

	// 	// $verified = 1;
	// 	// $_COOKIE['verified'] = 1;

	// 	// header("Location: ".$home_url);
    // }
    
// }

// if($_COOKIE['verified'] == 1)
// 	header("Location: ".$home_url);

if(isset($_POST['password'])){
    $sql = sprintf('UPDATE sk_users SET password = md5(\'%s\') WHERE id = \'%s\'', $_POST['password'], $_POST['id']);
    $dba->query($sql);
    header("Location: ".$home_url."/sk_pages/reset-password.php?success=true");
}
?>

<html>
<head>
<title>Stock Knowledge - Forgot Password</title>
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
	<h1>Forgot Password</h1>
	<div class="row justify-content-center">
    	<div class="col-md-6 col-sm-12">
		<br />
		<?php
			if(isset($_GET['resend']))
				echo '<p class="text-center">We sent a verification code to your email!</p>';
		?>
    	<div class="card p-3 mb-3">
            <?php 
                if(isset($_GET['id'])){
                    echo '<form action="'.$_SERVER["PHP_SELF"].'" method="POST">
                    <input class="form-control text-center" type="password" name="password" placeholder="Enter your new password" />
                    ';
                    echo '<input type="hidden" value="'.$_GET['id'].'" name="id" />
                    <button class="mt-2 btn-primary" style="width: 100%;" type="submit">Submit</button>';
                }
                if(isset($_GET['success'])){
                    echo '<p class="text-center">Successfully resetted the password</p>';
                    echo '<a href="'.$home_url.'" class="btn-danger text-center text-decoration-none">Login</a>';
                }
            ?>
			</form>
		</div>
	</div>
</div>


</div></div>
<?php include('../footer.php');?>

</body>
</html>
