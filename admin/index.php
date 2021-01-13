<?php
require_once("_class.dba.inc.php");
require_once("_conf.dba.inc.php");
require_once("_static.session.inc.php");
validate_session();
?>

<!doctype html>
<html lang="en">
<head>
<?php include('header.php'); ?>
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
<?php include('sidebar.php');?>
    	<div id="main-container">
    		<div id="main">
    			<h1>Dashboard</h1>
    		</div>
			<div class="container">
				<div class="row justify-content-center"">
					<div id="main" class="col-xs">
						<h3>No. of Topics</h3>
						<h5 style="text-align: center;">
						<?php
							global $dba;

							$query = "SELECT COUNT(*) AS count FROM sk_topics;";
							$row = $dba->query_first($query);

							echo $row['count'];
						?>
						</h5>
					</div>
					<div id="main" class="col-xs">
						<h3>No. of Students</h3>
						<h5 style="text-align: center;">
						<?php
							global $dba;

							$query = "SELECT COUNT(*) AS count FROM sk_students;";
							$row = $dba->query_first($query);

							echo $row['count'];
						?>
						</h5>
					</div>
					<div id="main" class="col-xs">
						<h3>Total points from all students</h3>
						<h5 style="text-align: center;">
						<?php
							global $dba;

							$query = "SELECT SUM(progress) AS total FROM sk_students;";
							$row = $dba->query_first($query);

							echo $row['total'];
						?>
						</h5>
					</div>
				</div>
				<div class="row justify-content-center"">
					<div id="main" class="col-xs">
						<h3>Top 3 from Leaderboard</h3>
						<h5 style="text-align: center;">
						<?php
							global $dba;

							$query = "SELECT * FROM sk_students JOIN sk_users ON sk_students.user_id = sk_users.id ORDER BY progress ASC LIMIT 3 ";
							$results = $dba->query($query);

							echo '<ol style="text-align: left;">';

							while($row = $dba->fetch_array($results)) {
								echo '<li>'.$row['firstname'].' '.$row['lastname'].'</li>';
							}

							echo '</ol>';
						?>
						</h5>
					</div>
					<div id="main" class="col-xs">
						<h3>Latest Topic Published</h3>
						<h5 style="text-align: center;">
						<?php
							global $dba;

							$query = "SELECT * FROM sk_topics ORDER BY id ASC LIMIT 1;";
							$row = $dba->query_first($query);

							echo $row['title'];
						?>
						</h5>
					</div>
				</div>
			</div>
    	</div>
<?php include('footer.php');?>
</body>
</html>
