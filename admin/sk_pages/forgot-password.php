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

//verfiy or resend code
if(isset($_GET['email'])){
	date_default_timezone_set("Asia/Taipei");

    $sql = sprintf("SELECT * FROM sk_users WHERE email = '%s' ORDER BY id DESC LIMIT 1" , $_GET['email']);
    $result = $dba->query($sql);
    $resultCount = $dba->num_rows($result);
	// $row = $dba->query_first($sql);
    
    if($resultCount > 0){
        $userid = '';
        $email = '';
        $username = '';

        while($row = $dba->fetch_array($result)){
            $userid = $row['id'];
            $email = $row['email'];
            $username = $row['username'];
        }

	    $code = new code;
	    $randCode = $code->getToken(5);

	    $now = date("Y-m-d H:i:s");
        $exprTime = strtotime($now . ' + 1 day');

	    $sqlx = sprintf("SELECT * FROM sk_forgot_password WHERE userid = '%s' ORDER BY expiration DESC LIMIT 1" , $userid);
        $rowx = $dba->query_first($sqlx);

        $prevExpr = $rowx['expiration'];

        if($now > $prevExpr){
        	$sqly = sprintf("INSERT INTO sk_forgot_password(userid, code, expiration) VALUES('%s', '%s', '%s')", $userid, $randCode, date("Y-m-d H:i:s", $exprTime));
        	$dba->query($sqly);
        
        	$recipient = $email;
    		$username = $username;

    		$subject = 'Recover Account - Stock Knowledge';
    		$body = "Hello ".$username.",".
    		PHP_EOL.
    		"Recover your account!".
    		PHP_EOL.
    		"To complete recovering your account , go to the following link, or enter a verification code".
    		PHP_EOL
    		.$randCode.
    		PHP_EOL.
    		"Kind regards,".
    		PHP_EOL.
    		"Stock Knowledge Team";

    		$bodyHtml = '
    		<p>Hello '.$username.'</p>	

    		<p>Recover your account!</p>

    		<p>To complete recovering your account , go to the following <a href="stockknowledge.org/admin/sk_pages/forgot-password.php?id='.$userid.'&code='.$randCode.'">link</a>, or enter a verification code</p>

    		<p> 
    			<b> VERIFICATION CODE: '.$randCode.'</b>
    		</p>

    		<p>
    		Kind regards, <br/>
    		Stock Knowledge Team
    		</p>';

    		$mailer->Send($recipient, $subject, $bodyHtml, $body);
        }
    }
}

if(isset($_GET['code']) && isset($_GET['id'])){
	$userid = $_GET['id'];
	$sql = sprintf("SELECT * FROM sk_forgot_password WHERE userid = '%s' ORDER BY id DESC LIMIT 1" , $userid);
	$row = $dba->query_first($sql);

	$prevCode = $row['code'];

	if($prevCode == $_GET['code']){
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

		header("Location: ".$home_url.'/sk_pages/reset-password.php?id='.$_GET['id']);
    }
    
}

// if($_COOKIE['verified'] == 1)
// 	header("Location: ".$home_url);
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
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="GET">
				<input class="form-control text-center" type="text" name="email" placeholder="Enter your email" />
					<button class="mt-2 btn-primary" style="width: 100%;" type="submit">Submit</button>
			</form>
			<a href="<? echo $home_url ?>" class="btn-danger text-center text-decoration-none">Login</a>
		</div>
	</div>
</div>


</div></div>
<?php include('../footer.php');?>

</body>
</html>
