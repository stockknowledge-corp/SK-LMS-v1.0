<?php
require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
require_once("../_class.code.inc.php");
require_once("../_class.mailer.inc.php");
require_once("../_conf.mailer.inc.php");

validate_session();

//verfiy or resend code
if(isset($_GET['resend'])){
	date_default_timezone_set("Asia/Taipei");

	$userid = $_COOKIE['loggedin'];

	$code = new code;
	$randCode = $code->getToken(5);

	$now = date("Y-m-d H:i:s");
	$exprTime = strtotime($now . ' + 1 day');

	$sql = sprintf("SELECT * FROM sk_account_verification WHERE userid = '%s' ORDER BY expiration DESC LIMIT 1" , $userid);
	$row = $dba->query_first($sql);

	$prevExpr = $row['expiration'];

	// echo $now;
	// echo $prevExpr;

	// 	$mailer->Send($recipient, $subject, $bodyHtml, $body);

	if($now > $prevExpr){
		$sql = sprintf("INSERT INTO sk_account_verification(userid, code, expiration) VALUES('%s', '%s', '%s')", $userid, $randCode, date("Y-m-d H:i:s", $exprTime));
		$dba->query($sql);

		$recipient = $_COOKIE['email'];
		$username = $_COOKIE['username'];

		$subject = 'Account Verification - Stock Knowledge';
		$body = "Hello ".$username.",".
		PHP_EOL.
		"Thank you for signing up!".
		PHP_EOL.
		"To start enjoying our immersive gamified learning platform, complete the activation of your account, go to the following link, or enter a verification code".
		PHP_EOL
		.$randCode.
		PHP_EOL.
		"Kind regards,".
		PHP_EOL.
		"Stock Knowledge Team";

		$bodyHtml = '
		<p>Hello '.$username.'</p>	

		<p>Thank you for signing up!</p>

		<p>To start enjoying our immersive gamified learning platform, complete the activation of your account, go to the following <a href="stockknowledge.org/admin/sk_pages/account-verification">link</a>, or enter a verification code</p>

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

if(isset($_GET['code'])){
	$userid = $_COOKIE['loggedin'];
	$sql = sprintf("SELECT * FROM sk_account_verification WHERE userid = '%s' ORDER BY id DESC LIMIT 1" , $userid);
	$row = $dba->query_first($sql);

	$prevCode = $row['code'];

	if($prevCode == $_GET['code']){
		$sql = sprintf('UPDATE sk_users SET verified = 1 WHERE id = \'%s\'',$userid);
		$dba->query($sql);

		$verified = 1;
		$_COOKIE['verified'] = 1;

		header("Location: ".$home_url);
	}
}

if($_COOKIE['verified'] == 1)
	header("Location: ".$home_url);
?>

<html>
<head>
<title>Stock Knowledge - Verification</title>
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
	<h1>Account Verification</h1>
	<div class="row justify-content-center">
    				<div class="col-md-6 col-sm-12">
					<br />
					<?php
						if(isset($_GET['resend']))
							echo '<p class="text-center">We sent a verification code to your email!</p>';
					?>
    					<div class="card p-3 mb-3">
						<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="GET">
							<input class="form-control text-center" type="text" name="code" placeholder="Verification Code" />
							<button class="mt-2 btn-primary" style="width: 100%;" type="submit">Submit</button>
							<button class="mt-2 btn-warning" style="width: 100%;" type="submit" name="resend" value="true">Resend</button>
						</form>
						<a href="../logout.php" class="btn-danger text-center text-decoration-none">Logout</a>
			    		</div>
		    		</div>
	</div>


</div></div>
<?php include('../footer.php');?>

</body>
</html>
