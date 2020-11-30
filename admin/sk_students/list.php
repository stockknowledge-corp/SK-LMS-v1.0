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
	case 'gradelevel':
	case 'gradelevel_asc':
		$order_clause = " ORDER BY gradelevel ASC";
		$order_link_arg_head = "gradelevel_dsc";
		$order_link_arg = "gradelevel_asc";
		break;
	case 'gradelevel_dsc':
		$order_clause = " ORDER BY gradelevel DESC";
		$order_link_arg_head = "gradelevel_asc";
		$order_link_arg = "gradelevel_dsc";
		break;
	case 'schoolname':
	case 'schoolname_asc':
		$order_clause = " ORDER BY schoolname ASC";
		$order_link_arg_head = "schoolname_dsc";
		$order_link_arg = "schoolname_asc";
		break;
	case 'schoolname_dsc':
		$order_clause = " ORDER BY schoolname DESC";
		$order_link_arg_head = "schoolname_asc";
		$order_link_arg = "schoolname_dsc";
		break;
	case 'preferences':
	case 'preferences_asc':
		$order_clause = " ORDER BY preferences ASC";
		$order_link_arg_head = "preferences_dsc";
		$order_link_arg = "preferences_asc";
		break;
	case 'preferences_dsc':
		$order_clause = " ORDER BY preferences DESC";
		$order_link_arg_head = "preferences_asc";
		$order_link_arg = "preferences_dsc";
		break;
	case 'progress':
	case 'progress_asc':
		$order_clause = " ORDER BY progress ASC";
		$order_link_arg_head = "progress_dsc";
		$order_link_arg = "progress_asc";
		break;
	case 'progress_dsc':
		$order_clause = " ORDER BY progress DESC";
		$order_link_arg_head = "progress_asc";
		$order_link_arg = "progress_dsc";
		break;
	default:
		$order_clause = " ORDER BY id";
}

}

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
<th class=sk_user_id><a href="list.php?order=<?= $ola ?>">User </a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'gradelevel') {
	$ola=$order_link_arg_head;
} else {
	$ola='gradelevel';
}
?>
<th class=sk_gradelevel><a href="list.php?order=<?= $ola ?>">Gradelevel</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'schoolname') {
	$ola=$order_link_arg_head;
} else {
	$ola='schoolname';
}
?>
<th class=sk_schoolname><a href="list.php?order=<?= $ola ?>">Schoolname</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'progress') {
	$ola=$order_link_arg_head;
} else {
	$ola='progress';
}
?>
<th class=sk_progress><a href="list.php?order=<?= $ola ?>">Progress</a></th>
<th class="crud" width="200">Controls</th></tr>
<?php 
while($row = $dba->fetch_array($results)) {
echo("<tr>\n");
	$queryi = "SELECT * FROM sk_users WHERE id = '".$row['user_id']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td><a href='edit.php?id=".$row['id']."'>".$rowi[1]."</a></td>\n");
	echo("\t<td>".substr(htmlentities($row['gradelevel']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['schoolname']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['progress']),0,80)."</td>\n");
	echo("\t<td><a href=\"edit.php?id=".$row['id']."\" class=\"btn btn-warning\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a> <a href=\"delete.php?id=".$row['id']."\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
</a></td>");
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
