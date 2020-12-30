<?php


require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

if($_COOKIE['usertype'] == 3)
	header("Location: http://".$_SERVER['HTTP_HOST']."/admin/sk_pages/401.php");

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
	case 'chapter':
	case 'chapter_asc':
		$order_clause = " ORDER BY chapter ASC";
		$order_link_arg_head = "chapter_dsc";
		$order_link_arg = "chapter_asc";
		break;
	case 'chapter_dsc':
		$order_clause = " ORDER BY chapter DESC";
		$order_link_arg_head = "chapter_asc";
		$order_link_arg = "chapter_dsc";
		break;
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
	case 'background':
	case 'background_asc':
		$order_clause = " ORDER BY background ASC";
		$order_link_arg_head = "background_dsc";
		$order_link_arg = "background_asc";
		break;
	case 'background_dsc':
		$order_clause = " ORDER BY background DESC";
		$order_link_arg_head = "background_asc";
		$order_link_arg = "background_dsc";
		break;
	case 'content':
	case 'content_asc':
		$order_clause = " ORDER BY content ASC";
		$order_link_arg_head = "content_dsc";
		$order_link_arg = "content_asc";
		break;
	case 'content_dsc':
		$order_clause = " ORDER BY content DESC";
		$order_link_arg_head = "content_asc";
		$order_link_arg = "content_dsc";
		break;
	case 'mode_content':
	case 'mode_content_asc':
		$order_clause = " ORDER BY mode_content ASC";
		$order_link_arg_head = "mode_content_dsc";
		$order_link_arg = "mode_content_asc";
		break;
	case 'mode_content_dsc':
		$order_clause = " ORDER BY mode_content DESC";
		$order_link_arg_head = "mode_content_asc";
		$order_link_arg = "mode_content_dsc";
		break;
	case 'grade_level':
	case 'grade_level_asc':
		$order_clause = " ORDER BY grade_level ASC";
		$order_link_arg_head = "grade_level_dsc";
		$order_link_arg = "grade_level_asc";
		break;
	case 'grade_level_dsc':
		$order_clause = " ORDER BY grade_level DESC";
		$order_link_arg_head = "grade_level_asc";
		$order_link_arg = "grade_level_dsc";
		break;
	case 'subject_id':
	case 'subject_id_asc':
		$order_clause = " ORDER BY subject_id ASC";
		$order_link_arg_head = "subject_id_dsc";
		$order_link_arg = "subject_id_asc";
		break;
	case 'subject_id_dsc':
		$order_clause = " ORDER BY subject_id DESC";
		$order_link_arg_head = "subject_id_asc";
		$order_link_arg = "subject_id_dsc";
		break;
	case 'author_id':
	case 'author_id_asc':
		$order_clause = " ORDER BY author_id ASC";
		$order_link_arg_head = "author_id_dsc";
		$order_link_arg = "author_id_asc";
		break;
	case 'author_id_dsc':
		$order_clause = " ORDER BY author_id DESC";
		$order_link_arg_head = "author_id_asc";
		$order_link_arg = "author_id_dsc";
		break;
	case 'mode_id':
	case 'mode_id_asc':
		$order_clause = " ORDER BY mode_id ASC";
		$order_link_arg_head = "mode_id_dsc";
		$order_link_arg = "mode_id_asc";
		break;
	case 'mode_id_dsc':
		$order_clause = " ORDER BY mode_id DESC";
		$order_link_arg_head = "mode_id_asc";
		$order_link_arg = "mode_id_dsc";
		break;
	case 'status':
	case 'status_asc':
			$order_clause = " ORDER BY status ASC";
			$order_link_arg_head = "status_dsc";
			$order_link_arg = "status_asc";
			break;
	case 'status_dsc':
			$order_clause = " ORDER BY status DESC";
			$order_link_arg_head = "status_asc";
			$order_link_arg = "status_dsc";
			break;
	default:
		$order_clause = " ORDER BY id";
}

}

$query = "SELECT * FROM sk_topics".$order_clause." LIMIT ".$offset.",".$list_limit;
$query_c = "SELECT count(*) FROM sk_topics";

$num = $dba->query_first($query_c);
if($num[0] > 0) { 
	$num_result_pages = $num[0] / $list_limit;
} else {
	$num_result_pages = 1;
	$query = "SELECT * FROM sk_topics";
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
if(substr($order_link_arg_head,0,-4) == 'subject_id') {
	$ola=$order_link_arg_head;
} else {
	$ola='subject_id';
}
?>
<th class=sk_subject_id><a href="list.php?order=<?= $ola ?>">Subject </a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'chapter') {
	$ola=$order_link_arg_head;
} else {
	$ola='chapter';
}
?>
<th class=sk_chapter><a href="list.php?order=<?= $ola ?>">Chapter</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'description') {
	$ola=$order_link_arg_head;
} else {
	$ola='description';
}
?>
<th class=sk_description><a href="list.php?order=<?= $ola ?>">Description</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'grade_level') {
	$ola=$order_link_arg_head;
} else {
	$ola='grade_level';
}
?>
<th class=sk_grade_level><a href="list.php?order=<?= $ola ?>">Grade Level</a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'author_id') {
	$ola=$order_link_arg_head;
} else {
	$ola='author_id';
}
?>
<th class=sk_author_id><a href="list.php?order=<?= $ola ?>">Author </a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'mode_id') {
	$ola=$order_link_arg_head;
} else {
	$ola='mode_id';
}
?>
<th class=sk_mode_id><a href="list.php?order=<?= $ola ?>">Mode </a></th>
<?php
if(substr($order_link_arg_head,0,-4) == 'status') {
	$ola=$order_link_arg_head;
} else {
	$ola='status';
}
?>
<th class=sk_status><a href="list.php?order=<?= $ola ?>">Status</a></th>
<th class="crud" width="200">Controls</th></tr>
<?php 
while($row = $dba->fetch_array($results)) {
echo("<tr>\n");
	if($_COOKIE['usertype'] == 1)
		echo("\t<td><a href='edit.php?id=".$row['id']."'>".substr(htmlentities($row['title']),0,80)."</a></td>\n");
	else
		echo("\t<td>".substr(htmlentities($row['title']),0,80)."</td>\n");
	
	$queryi = "SELECT * FROM sk_subjects WHERE id = '".$row['subject_id']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td>".$rowi[1]."</td>\n");
	echo("\t<td>".substr(htmlentities($row['chapter']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['description']),0,80)."</td>\n");
	echo("\t<td>".substr(htmlentities($row['grade_level']),0,80)."</td>\n");
	$queryi = "SELECT * FROM sk_users WHERE id = '".$row['author_id']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td>".$rowi[1]."</td>\n");
	$queryi = "SELECT * FROM sk_modes WHERE id = '".$row['mode_id']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td>".$rowi[1]."</td>\n");
	echo("\t<td>".substr(htmlentities($row['status']),0,80)."</td>\n");
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

<?php 
	if($_COOKIE['usertype'] == 1)
	echo '<a href="new.php" class="btn btn-success">Create new Entry</a>'
?>

</div></div>
<?php include('../footer.php');?>

</body>
</html>
