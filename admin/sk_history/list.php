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
$order_clause = " ORDER BY datetime DESC";
$order_link_arg_head = "datetime_asc";
$order_link_arg = "datetime_dsc";


if(isset($_REQUEST['order'])){
$list_limit = 25;
switch($_REQUEST['order']) {
	case 'module':
	case 'module_asc':
		$order_clause = " ORDER BY module ASC";
		$order_link_arg_head = "module_dsc";
		$order_link_arg = "module_asc";
		break;
	case 'module_dsc':
		$order_clause = " ORDER BY module DESC";
		$order_link_arg_head = "module_asc";
		$order_link_arg = "module_dsc";
		break;
	case 'activity':
	case 'activity_asc':
		$order_clause = " ORDER BY activity ASC";
		$order_link_arg_head = "activity_dsc";
		$order_link_arg = "activity_asc";
		break;
	case 'activity_dsc':
		$order_clause = " ORDER BY activity DESC";
		$order_link_arg_head = "activity_asc";
		$order_link_arg = "activity_dsc";
		break;
	case 'datetime':
	case 'datetime_asc':
		$order_clause = " ORDER BY datetime ASC";
		$order_link_arg_head = "datetime_dsc";
		$order_link_arg = "datetime_asc";
		break;
	case 'datetime_dsc':
		$order_clause = " ORDER BY datetime DESC";
		$order_link_arg_head = "datetime_asc";
		$order_link_arg = "datetime_dsc";
		break;
	case 'user_id':
	case 'user_id_asc':
		$order_clause = " ORDER BY user_id ASC";
		$order_link_arg_head = "user_id_dsc";
		$order_link_arg = "user_id_asc";
		break;
	case 'user_id_dsc':
		$order_clause = " ORDER BY user_id DESC";
		$order_link_arg_head = "user_id_asc";
		$order_link_arg = "user_id_dsc";
		break;
	default:
		$order_clause = " ORDER BY id";
}

}

$query = "SELECT * FROM sk_history".$order_clause." LIMIT ".$offset.",".$list_limit;
$query_c = "SELECT count(*) FROM sk_history";

$num = $dba->query_first($query_c);
if($num[0] > 0) { 
	$num_result_pages = $num[0] / $list_limit;
} else {
	$num_result_pages = 1;
	$query = "SELECT * FROM sk_history";
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
if(substr($order_link_arg_head,0,-4) == 'module') {
	$ola=$order_link_arg_head;
} else {
	$ola='module';
}
?>
<th class=sk_module><a href="list.php?order=<?= $ola ?>">Module</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'activity') {
	$ola=$order_link_arg_head;
} else {
	$ola='activity';
}
?>
<th class=sk_activity><a href="list.php?order=<?= $ola ?>">Activity</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'datetime') {
	$ola=$order_link_arg_head;
} else {
	$ola='datetime';
}
?>
<th class=sk_datetime><a href="list.php?order=<?= $ola ?>">Datetime</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'user_id') {
	$ola=$order_link_arg_head;
} else {
	$ola='user_id';
}
?>
<th class=sk_user_id><a href="list.php?order=<?= $ola ?>">User </a></th>
</tr>
<?php 
while($row = $dba->fetch_array($results)) {
echo("<tr>\n");
	echo("\t<td><a href=\"".$home_url."/sk_".strtolower($row['module'])."\">".substr(htmlentities($row['module']),0,80)."</a></td>\n");
	echo("\t<td>".substr(htmlentities($row['activity']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['datetime']),0,80)."</td>\n");
	$queryi = "SELECT * FROM sk_users WHERE id = '".$row['user_id']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td>".$rowi[1]."</td>\n");
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
</div></div>
<?php include('../footer.php');?>

</body>
</html>
