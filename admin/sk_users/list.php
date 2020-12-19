<?php


require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

if(IsSet($_GET['offset'])) {
	$offset = $_GET['offset'];
} else {
	$offset = 0;
}

$list_limit = 25;
$list_limit_per_page = 25;
$order_clause = "";
$order_link_arg_head = "";
$order_link_arg = "";

if(isset($_REQUEST['order'])){
$list_limit = 25;
switch($_REQUEST['order']) {
	case 'username':
	case 'username_asc':
		$order_clause = " ORDER BY username ASC";
		$order_link_arg_head = "username_dsc";
		$order_link_arg = "username_asc";
		break;
	case 'username_dsc':
		$order_clause = " ORDER BY username DESC";
		$order_link_arg_head = "username_asc";
		$order_link_arg = "username_dsc";
		break;
	case 'password':
	case 'password_asc':
		$order_clause = " ORDER BY password ASC";
		$order_link_arg_head = "password_dsc";
		$order_link_arg = "password_asc";
		break;
	case 'password_dsc':
		$order_clause = " ORDER BY password DESC";
		$order_link_arg_head = "password_asc";
		$order_link_arg = "password_dsc";
		break;
	case 'email':
	case 'email_asc':
		$order_clause = " ORDER BY email ASC";
		$order_link_arg_head = "email_dsc";
		$order_link_arg = "email_asc";
		break;
	case 'email_dsc':
		$order_clause = " ORDER BY email DESC";
		$order_link_arg_head = "email_asc";
		$order_link_arg = "email_dsc";
		break;
	case 'mobile':
	case 'mobile_asc':
		$order_clause = " ORDER BY mobile ASC";
		$order_link_arg_head = "mobile_dsc";
		$order_link_arg = "mobile_asc";
		break;
	case 'mobile_dsc':
		$order_clause = " ORDER BY mobile DESC";
		$order_link_arg_head = "mobile_asc";
		$order_link_arg = "mobile_dsc";
		break;
	case 'firstname':
	case 'firstname_asc':
		$order_clause = " ORDER BY firstname ASC";
		$order_link_arg_head = "firstname_dsc";
		$order_link_arg = "firstname_asc";
		break;
	case 'firstname_dsc':
		$order_clause = " ORDER BY firstname DESC";
		$order_link_arg_head = "firstname_asc";
		$order_link_arg = "firstname_dsc";
		break;
	case 'lastname':
	case 'lastname_asc':
		$order_clause = " ORDER BY lastname ASC";
		$order_link_arg_head = "lastname_dsc";
		$order_link_arg = "lastname_asc";
		break;
	case 'lastname_dsc':
		$order_clause = " ORDER BY lastname DESC";
		$order_link_arg_head = "lastname_asc";
		$order_link_arg = "lastname_dsc";
		break;
	case 'photo':
	case 'photo_asc':
		$order_clause = " ORDER BY photo ASC";
		$order_link_arg_head = "photo_dsc";
		$order_link_arg = "photo_asc";
		break;
	case 'photo_dsc':
		$order_clause = " ORDER BY photo DESC";
		$order_link_arg_head = "photo_asc";
		$order_link_arg = "photo_dsc";
		break;
	case 'usertype':
	case 'usertype_asc':
		$order_clause = " ORDER BY usertype ASC";
		$order_link_arg_head = "usertype_dsc";
		$order_link_arg = "usertype_asc";
		break;
	case 'usertype_dsc':
		$order_clause = " ORDER BY usertype DESC";
		$order_link_arg_head = "usertype_asc";
		$order_link_arg = "usertype_dsc";
		break;
	default:
		$order_clause = " ORDER BY id";
}

}

$query = "SELECT * FROM sk_users".$order_clause." LIMIT ".$offset.",".$list_limit;
$query_c = "SELECT count(*) FROM sk_users";

$num = $dba->query_first($query_c);
if($num[0] > 0) { 
	$num_result_pages = $num[0] / $list_limit;
} else {
	$num_result_pages = 1;
	$query = "SELECT * FROM sk_users";
}
$results = $dba->query($query);
?>
<html>
<head>
<title>Stock Knowledge</title>
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

<table class="list">
<?php
if(substr($order_link_arg_head,0,-4) == 'username') {
	$ola=$order_link_arg_head;
} else {
	$ola='username';
}
?>
<th class=sk_username><a href="list.php?order=<?= $ola ?>">Username</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'email') {
	$ola=$order_link_arg_head;
} else {
	$ola='email';
}
?>
<!-- <th class=sk_email><a href="list.php?order=<?= $ola ?>">Email</a></th> -->
<?php
if(substr($order_link_arg_head,0,-4) == 'mobile') {
	$ola=$order_link_arg_head;
} else {
	$ola='mobile';
}
?>
<!-- <th class=sk_mobile><a href="list.php?order=<?= $ola ?>">Mobile</a></th> -->
<?php
if(substr($order_link_arg_head,0,-4) == 'firstname') {
	$ola=$order_link_arg_head;
} else {
	$ola='firstname';
}
?>
<th class=sk_firstname><a href="list.php?order=<?= $ola ?>">Firstname</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'lastname') {
	$ola=$order_link_arg_head;
} else {
	$ola='lastname';
}
?>
<th class=sk_lastname><a href="list.php?order=<?= $ola ?>">Lastname</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'usertype') {
	$ola=$order_link_arg_head;
} else {
	$ola='usertype';
}
?>
<th class=sk_usertype><a href="list.php?order=<?= $ola ?>">Usertype</a></th>
<!-- <th class="crud" width="200">Controls</th></tr> -->
<?php 
while($row = $dba->fetch_array($results)) {
echo("<tr>\n");
	echo("\t<td><a href='edit.php?id=".$row['id']."'>".substr(htmlentities($row['username']),0,80)."</a></td>\n");
	// echo("\t<td>".substr(htmlentities($row['email']),0,80)."</td>\n");
	// echo("\t<td>".substr(htmlentities($row['mobile']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['firstname']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['lastname']),0,80)."</td>\n");
	$queryi = "SELECT * FROM sk_user_types WHERE id = '".$row['usertype']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td>".$rowi[1]."</td>\n");
	// echo("\t<td><a href=\"edit.php?id=".$row['id']."\" class=\"btn btn-warning\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a> <a href=\"delete.php?id=".$row['id']."\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>");
	echo("</tr> ");
}
?>
</table>
<br />

</table>
<br />
<!-- Navigation //-->
<?php
if($num > $list_limit_per_page) {
	if($offset > 0) {
		$newoffset = max(0,($offset-$list_limit));
		echo("<a href=\"list.php?offset=".$newoffset."&order=".$order_link_arg."\">&laquo; Previous</a> | ");
	} else {
		echo("&laquo; Previous | ");
	}
	for($i = 0; $i < $num_result_pages; $i++) {
		$newoffset = $i * $list_limit;
		if($offset == $newoffset) {
			echo("<b>".($i+1)."</b> | ");
		} else {
			echo("<a href=\"list.php?offset=".$newoffset."&order=".$order_link_arg."\">".($i+1)."</a> | ");
		}
	}
	$newoffset = $offset + $list_limit;
	if($newoffset < $num[0]) {
		echo("<a href=\"list.php?offset=".$newoffset."&order=".$order_link_arg."\">Next &raquo;</a>");
	} else {
		echo("Next &raquo;");
	}
}
?>
<br />
<br />
<a href="new.php" class="btn btn-success">Create new Entry</a>
</div></div>
<?php include('../footer.php');?>

</body>
</html>
