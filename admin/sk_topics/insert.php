<?php

require_once("..//_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "INSERT INTO sk_topics (chapter,title,description,background,content,mode_content,grade_level,subject_id,author_id,mode_id) VALUES ('".mysqli_real_escape_string($dba->link_id,$_REQUEST['chapter'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['title'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['description'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['background'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['content'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['mode_content'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['grade_level'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['subject_id'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['author_id'])."','".mysqli_real_escape_string($dba->link_id,$_REQUEST['mode_id'])."')";
$dba->query($query);

$query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Topics')."','".mysqli_real_escape_string($dba->link_id,'New topic added: '.$_REQUEST['title'])."',NOW(),'".mysqli_real_escape_string($dba->link_id,$_COOKIE['loggedin'])."')";
$dba->query($query2);

$error = '';
if($_FILES['3dFile']['size'] > 0){

$target_dir = "../../assets/3d/";
$target_file = $target_dir . basename($_FILES["3dFile"]["name"]);
$uploadOk = 1;
// Check file size
// if ($_FILES["3dFile"]["size"] > 500000) {
  // $error.= "Sorry, your file is too large.";
  // $uploadOk = 0;
// }


// Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
  // $error.= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
// } else {
  if (move_uploaded_file($_FILES["3dFile"]["tmp_name"], $target_file)) {
    $error.= "The file ". basename( $_FILES["3dFile"]["name"]). " has been uploaded.";
  } else {
    $error.= "Sorry, there was an error uploading your file.".$_FILES['3dFile']['error'];
  }
// }
 }


$_SESSION['flash'] = "New Entry Nr. ".$dba->insert_id()." created.";
header("Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/list.php");
?>
