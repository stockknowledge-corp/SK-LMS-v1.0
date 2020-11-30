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

$list_limit = 50;
$list_limit_per_page = 50;
$order_clause = "";
$order_link_arg_head = "";
$order_link_arg = "";

		$order_clause = " ORDER BY progress DESC";
		$order_link_arg_head = "progress_asc";
		$order_link_arg = "progress_dsc";

$query = "SELECT * FROM sk_students".$order_clause." LIMIT ".$offset.",".$list_limit;
$query_c = "SELECT count(*) FROM sk_students";

$num = $dba->query_first($query_c);
if($num[0] > 0) { 
	$num_result_pages = $num[0] / $list_limit;
} else {
	$num_result_pages = 1;
	$query = "SELECT * FROM sk_students";
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
if(substr($order_link_arg_head,0,-4) == 'user_id') {
	$ola=$order_link_arg_head;
} else {
	$ola='user_id';
}
?>
<th class=sk_user_id><a href="index.php?order=<?= $ola ?>">User </a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'gradelevel') {
	$ola=$order_link_arg_head;
} else {
	$ola='gradelevel';
}
?>
<th class=sk_gradelevel><a href="index.php?order=<?= $ola ?>">Gradelevel</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'schoolname') {
	$ola=$order_link_arg_head;
} else {
	$ola='schoolname';
}
?>
<th class=sk_schoolname><a href="index.php?order=<?= $ola ?>">Schoolname</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'progress') {
	$ola=$order_link_arg_head;
} else {
	$ola='progress';
}
?>
<th class=sk_progress><a href="index.php?order=<?= $ola ?>">Points</a></th>
</tr>
<?php 
while($row = $dba->fetch_array($results)) {
echo("<tr>\n");
	$queryi = "SELECT * FROM sk_users WHERE id = '".$row['user_id']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td><a href='edit.php?id=".$row['id']."'>".$rowi[1]."</a></td>\n");
	echo("\t<td>".substr(htmlentities($row['gradelevel']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['schoolname']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['progress']),0,80)."</td>\n");
	echo("</tr> ");
}
?>
</table>
<br />

</table>
<br />


</div></div>
<?php include('../footer.php');?>

</body>
</html>
