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
	case 'title':
	case 'title_asc':
		$order_clause = " ORDER BY title ASC";
		$order_link_arg_head = "title_dsc";
		$order_link_arg = "title_asc";
		break;
	case 'title_dsc':
		$order_clause = " ORDER BY title DESC";
		$order_link_arg_head = "title_asc";
		$order_link_arg = "title_dsc";
		break;
	case 'description':
	case 'description_asc':
		$order_clause = " ORDER BY description ASC";
		$order_link_arg_head = "description_dsc";
		$order_link_arg = "description_asc";
		break;
	case 'description_dsc':
		$order_clause = " ORDER BY description DESC";
		$order_link_arg_head = "description_asc";
		$order_link_arg = "description_dsc";
		break;
	default:
		$order_clause = " ORDER BY id";
}

}

$query = "SELECT * FROM sk_user_types".$order_clause." LIMIT ".$offset.",".$list_limit;
$query_c = "SELECT count(*) FROM sk_user_types";

$num = $dba->query_first($query_c);
if($num[0] > 0) { 
	$num_result_pages = $num[0] / $list_limit;
} else {
	$num_result_pages = 1;
	$query = "SELECT * FROM sk_user_types";
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
if(substr($order_link_arg_head,0,-4) == 'title') {
	$ola=$order_link_arg_head;
} else {
	$ola='title';
}
?>
<th class=sk_title><a href="list.php?order=<?= $ola ?>">Title</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'description') {
	$ola=$order_link_arg_head;
} else {
	$ola='description';
}
?>
<th class=sk_description><a href="list.php?order=<?= $ola ?>">Description</a></th>
<th class="crud" width="200">Controls</th></tr>
<?php 
while($row = $dba->fetch_array($results)) {
echo("<tr>\n");
	echo("\t<td><a href='edit.php?id=".$row['id']."'>".substr(htmlentities($row['title']),0,80)."</a></td>\n");
	echo("\t<td>".substr(htmlentities($row['description']),0,80)."</td>\n");
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
