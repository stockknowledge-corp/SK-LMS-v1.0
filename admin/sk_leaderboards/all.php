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

$queryCondition = '';

switch($_COOKIE['usertype']){
	case 2:
		$query = "SELECT gradelevel, schoolname FROM sk_teachers WHERE user_id = ".$_COOKIE['loggedin'];
		$row = $dba->query_first($query);

		$queryCondition = 'WHERE gradelevel = \''.$row['gradelevel'].'\' AND schoolname = \''.$row['schoolname'].'\'';
		break;
	case 3:
		$query = "SELECT gradelevel, schoolname FROM sk_students WHERE user_id = ".$_COOKIE['loggedin'];
		$row = $dba->query_first($query);

		$queryCondition = 'WHERE gradelevel = \''.$row['gradelevel'].'\' AND schoolname = \''.$row['schoolname'].'\'';
		break;
	default:
}

$query = "SELECT * FROM sk_students ".$queryCondition.$order_clause." LIMIT ".$offset.",".$list_limit;
$query_c = "SELECT count(*) FROM sk_students ".$queryCondition;

$num = $dba->query_first($query_c);

if($num[0] > 0) { 
	$num_result_pages = $num[0] / $list_limit;
} 
// else {
// 	$num_result_pages = 1;
// 	$query = "SELECT * FROM sk_students";
// }
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
<tr>
<th class=rank>Rank</th>
<th class=sk_user_id>Student</th>
<th class=sk_gradelevel>Grade Level</th>
<th class=sk_schoolname>Schoo Name</th>
<th class=sk_progress>Points</th>
</tr>
<?php 
$rank=0;
while($row = $dba->fetch_array($results)) {
$rank++;
echo("<tr>\n");
	$queryi = "SELECT * FROM sk_users WHERE id = '".$row['user_id']."'";
	$rowi = $dba->query_first($queryi);
	echo("\t<td>".$rank."</td>\n");
	echo("\t<td><a href='../sk_students/edit.php?id=".$row['id']."'>".$rowi[1]."</a></td>\n");
	echo("\t<td><a href=\"grade_level.php?grade=".substr(htmlentities($row['gradelevel']),0,80)."\">".substr(htmlentities($row['gradelevel']),0,80)."</a></td>\n");
	echo("\t<td><a href=\"school.php?school=".substr(htmlentities($row['schoolname']),0,80)."\">".substr(htmlentities($row['schoolname']),0,80)."</td>\n");
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
