<?php
require_once("_class.dba.inc.php");
require_once("_conf.dba.inc.php");
require_once("_static.session.inc.php");
validate_session();

header("Access-Control-Allow-Origin: *");


if(isset($_GET['f'])){
  // if($_GET['f']=='getSubjects') getSubjects();
  if($_GET['f']=='getTopics') getTopics();
  if($_GET['f']=='getTopic') getTopic();
  if($_GET['f']=='login') login();
  if($_GET['f']=='register') register();
  if($_GET['f']=='leaderboard') leaderboard();
  if($_GET['f']=='addPoints') addPoints();
  if($_GET['f']=='upload') upload();
  if($_GET['f']=='getStudents') getStudents();
  if($_GET['f']=='editStudent') editStudent();
  if($_GET['f']=='getStudent') getStudent();
}

function getStudent(){
  global $dba;

  $query = 'SELECT sk_students.id, sk_students.user_id, sk_users.username, sk_users.email, sk_users.mobile, sk_users.firstname, sk_users.lastname, sk_users.photo, sk_students.gradelevel, sk_students.schoolname, sk_students.preferences, sk_students.progress FROM sk_students INNER JOIN sk_users ON sk_users.id = sk_students.user_id WHERE sk_students.user_id = '.mysqli_real_escape_string($dba->link_id,$_GET['id']);
  $result = $dba->query($query);
  $row = $dba->fetch_array($result);

  if(!empty($row))
    echo '
    {
      "result":"success",
      "content": {
      "id": "'.$row['id'].'",
      "userid":"'.$row['user_id'].'",
      "username":"'.$row['username'].'",
      "email":"'.$row['email'].'",
      "mobile":"'.$row['mobile'].'",
      "firstname":"'.$row['firstname'].'",
      "lastname":"'.$row['lastname'].'",
      "gradelevel":"'.$row['gradelevel'].'",
      "schoolname":"'.$row['schoolname'].'",
      "preferences":"'.$row['preferences'].'",
      "points":"'.$row['progress'].'"
      }
    }';
  else
    echo '{"result": "fail"}';
}

function editStudent(){
  global $dba;
  
  $updateOk = 0;
  $uploadOk = 0;
  $error = '';

  $target_dir = '../assets/photo/';
  $target_file = (isset($_FILES['file']) ? $target_dir . basename($_FILES["file"]["name"]) : '');

  $fields = [];

  $query = 'SELECT user_id FROM sk_students WHERE id = '.mysqli_real_escape_string($dba->link_id, $_GET['id']).';';
  $result = $dba->query($query);
  $userid = $dba->fetch_array($result)['user_id'];

  if(!empty($_POST['grade_level']) || !empty($_POST['school_name']) || !empty($_POST['preferences']) || !empty($_POST['progress'])){
    foreach(array_keys($_POST) as $keys){
      if($keys == 'grade_level') array_push($fields,'gradelevel = '.mysqli_real_escape_string($dba->link_id, $_POST[$keys]));
      if($keys == 'school_name') array_push($fields,'schoolname  = '.mysqli_real_escape_string($dba->link_id, $_POST[$keys]));
      if($keys == 'preferences') array_push($fields, 'preferences = '.mysqli_real_escape_string($dba->link_id, $_POST[$keys]));
      if($keys == 'progress') array_push($fields, 'progress = '.mysqli_real_escape_string($dba->link_id, $_POST[$keys]));
    }

    $fieldsQuery = implode(', ', $fields);

    $query = 'UPDATE sk_students SET '.$fieldsQuery.' WHERE id = '.mysqli_real_escape_string($dba->link_id, $_GET['id']).';';
    $result = $dba->query($query);

    $updateOk = 1;
  }

  if(isset($_FILES['files']) && $_FILES['file']['size'] > 1000000){
    $error = 'Sorry, your file is too large.';
  }else{
    if(isset($_FILES['files']))
      $uploadOk = 1;
    else
      $uploadOk = 0;
  }

  if(!empty($target_file) && $uploadOk = 1){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      $uploadOk = 1;
      $error.= "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
      $error.= "Sorry, there was an error uploading your file.";
      $uploadOk = 0;
    }
  }

  $fields = [];
  
  if(!empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['email']) || !empty($_POST['mobile']) || !empty($_POST['first_name']) || !empty($_POST['last_name'])){
    foreach(array_keys($_POST) as $key){
      if($key == 'username') array_push($fields,'username = \''.mysqli_real_escape_string($dba->link_id, $_GET['id']).'\'');
      if($key == 'password') array_push($fields,'password  = \''.mysqli_real_escape_string($dba->link_id, $_GET['id']).'\'');
      if($key == 'email') array_push($fields, 'email = \''.mysqli_real_escape_string($dba->link_id, $_GET['id']).'\'');
      if($key == 'mobile') array_push($fields, 'mobile = \''.mysqli_real_escape_string($dba->link_id, $_GET['id']).'\'');
      if($key == 'first_name') array_push($fields, 'firstname = \''.mysqli_real_escape_string($dba->link_id, $_GET['id']).'\'');
      if($key == 'last_name') array_push($fields, 'lastname = \''.mysqli_real_escape_string($dba->link_id, $_GET['id']).'\'');
    }

    if($uploadOk == 1){
      array_push($fields, 'photo = \''.mysqli_real_escape_string($dba->link_id, $_FILES['file']['name']).'\'');
    }

    $fieldsQuery = implode(', ', $fields);

    $query = 'UPDATE sk_users SET '.$fieldsQuery.' WHERE id = '.mysqli_real_escape_string($dba->link_id, $userid).';';
    $result = $dba->query($query);
  }

  if(isset($_FILES['file']) && $uploadOk == 0 || empty($_POST)){
    echo '{"result":"fail"'.($error ? ',"content":'.$error : '').'}';
  }else{
    echo '{"result":"success"}';
  }
}

function getStudents(){
  global $dba;

  $teacher = NULL;
  $condition = NULL;
  
  if(isset($_POST['id'])){
    $query = 'SELECT * FROM sk_teachers WHERE id = '.mysqli_real_escape_string($dba->link_id, $_POST['id']).' LIMIT 1;';
    $result = $dba->query($query);
    $teacher = $dba->fetch_array($result);
    $condition = 'WHERE gradelevel = '.mysqli_real_escape_string($dba->link_id, $teacher['gradelevel']).' AND schoolname = '.mysqli_real_escape_string($dba->link_id, $teacher['schoolname']);
  }
  
  $query = 'SELECT sk_students.id, sk_students.user_id, sk_users.username, sk_users.firstname, sk_users.lastname, sk_students.gradelevel, sk_students.schoolname, sk_students.preferences, sk_students.progress FROM sk_students INNER JOIN sk_users ON sk_users.id = sk_students.user_id '.(isset($_POST['id']) ? $condition : '');
  $results = $dba->query($query);

  $resultLenght = $dba->num_rows($results);

  if(empty($resultLenght))
    echo '{"result": "fail"}';
  else
    echo '
    {
      "result": "success",
      "content":[';

  $count = 0;

  while($row = $dba->fetch_array($results)){
    $count++;
    echo '
      {
        "id": "'.$row['id'].'",
        "user_id":"'.$row['user_id'].'",
        "username":"'.$row['username'].'",
        "firstname":"'.$row['firstname'].'",
        "lastname":"'.$row['lastname'].'",
        "gradelevel":"'.$row['gradelevel'].'",
        "schoolname":"'.$row['schoolname'].'",
        "preferences":"'.$row['preferences'].'",
        "points":"'.$row['progress'].'"
      }';

    if($count%$resultLenght != 0) echo ',';
    else echo '
    ]
  }';
  }
}

function upload(){
  global $dba;

  $uploadOk = 0;
  $error = '';

  $target_dir = '';
  $target_file = '';

  $tableName = '';
  $userid = '';

  $data = '';

  //determine upload type
  if($_POST['type'] == '3d')
    $target_dir = '../assets/3d/';
  if($_POST['type'] == 'photo')
    $target_dir = '../assets/photo/';

  //Validate if user parameter is present and determine what type of user
  if(isset($_POST['user'])){
    if($_POST['user'] == 'student')
      $tableName = 'sk_students';
    if($_POST['user'] == 'teacher')
      $tableName = 'sk_teachers';
  }

  //Validate if type is photo and id parameter is present then get and store the user_id
  if(isset($_POST['id']) && $_POST['type'] == 'photo'){
    $query = 'SELECT user_id FROM '.$tableName.' WHERE id = '.$_POST['id'].';';
    $result = $dba->query($query);
    $userid = $dba->fetch_array($result)['user_id'];
  }

  //Validate if data parameter is present
  if(isset($_POST['data']))
    $data = $_POST['data'];

  //Not empty when type parameter is valid
  if(!empty($target_dir))
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

  //Check if photo file size is not greater than 1mb or 3d file size is not greater than 500kb
  if(($_POST['type'] == 'photo' && $_FILES['file']['size'] > 1000000) || ($_POST['type'] == '3d' && $_FILES['file']['size'] > 500000)){
    $error = 'Sorry, your file is too large.';
    $uploadOk = 0;
  }
  //Elseif missing parameter is not valid
  elseif($_POST['type'] == '3d' && empty($data) || $_POST['type'] == 'photo' && empty($userid)){ 
    $uploadOk = 0;
  }
  //Valid upload
  else{
    $uploadOk = 1;
  }

  if ($uploadOk == 0) {
    $uploadOk = 0;
    $error = "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      $uploadOk = 1;
      $error.= "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
      $error.= "Sorry, there was an error uploading your file.";
      $uploadOk = 0;
    }
  }

  //Update photo reference in sk_users table
  if($uploadOk == 1 && $_POST['type'] == 'photo'){
    $query = 'UPDATE sk_users SET photo = \''.$_FILES['file']['name'].'\' WHERE id = '.$userid.';';
    $dba->query($query);
  }

  //Update mode_content  in sk_topics table
  if($uploadOk == 1 && $_POST['type'] == '3d'){
    $query = 'UPDATE sk_topics SET mode_content = \''.$data.'\' WHERE id = '.$_POST['id'].';';
    $dba->query($query);
    echo $query;
  }

  if($uploadOk == 1){
    echo '{
      "result":"success",
      "content":"'.$error.'"
    }';
  }else{
    echo '{
      "result":"fail",
      "content":"'.$error.'"
    }';
  }
}

function addPoints(){
  global $dba;
  $return ='{"result": "fail"}';
  if(isset($_POST['userid']) && $_POST['progress']){
    $currentPoints = 0;

    // //Get student Point
    // $getStudentQuery = "SELECT progress FROM sk_students WHERE user_id = ".$_POST['userid'].";";
    // $result = $dba->query($getStudentQuery);
    // $student = $dba->fetch_array($result);

    // $currentPoints = $student['progress'];
    $points = $_POST['progress'];
    $totalPoints = $points;
    
    // Update student Point
    $updateStudentQuery = "UPDATE sk_students SET progress =  ".mysqli_real_escape_string($dba->link_id,$totalPoints)." WHERE user_id = ".mysqli_real_escape_string($dba->link_id,$_POST['userid']).";";
    $result = $dba->query($updateStudentQuery);
    $return ='{"result": "success","content":{"points":"'.$totalPoints.'"}}';


    $query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Students')."','".mysqli_real_escape_string($dba->link_id,'Gained points from playing')."',NOW(),'".mysqli_real_escape_string($dba->link_id,$_POST['userid'])."')";
    $dba->query($query2);

  }
  echo $return;
}

function leaderboard(){
  global $dba;

  $queryConditions = [];

  foreach(array_keys($_GET) as $keys){
    if($keys == 'school_id') array_push($queryConditions,'schoolname = '.mysqli_real_escape_string($dba->link_id, $_GET[$keys]));
    if($keys == 'grade_level') array_push($queryConditions,'gradelevel  = '.mysqli_real_escape_string($dba->link_id, $_GET[$keys]));
  }

  $condition = implode(' AND ', $queryConditions);

  $query = 'SELECT sk_students.id, sk_students.user_id, sk_users.firstname, sk_users.lastname, sk_students.gradelevel, sk_students.schoolname, sk_students.preferences, sk_students.progress FROM sk_students INNER JOIN sk_users ON sk_users.id = sk_students.user_id  ORDER BY progress DESC LIMIT 50;';

  $results = $dba->query($query);
  $resultLenght = $dba->num_rows($results);

  if(empty($resultLenght))
    echo '{"result": "fail"}';
  else
    echo '
    {
      "result": "success",
      "content":[';

  $count = 0;

  while($row = $dba->fetch_array($results)){
    $count++;
    echo '
      {
        "id": "'.$row['id'].'",
        "user_id":"'.$row['user_id'].'",
        "firstname":"'.$row['firstname'].'",
        "lastname":"'.$row['lastname'].'",
        "gradelevel":"'.$row['gradelevel'].'",
        "schoolname":"'.$row['schoolname'].'",
        "preferences":"'.$row['preferences'].'",
        "points":"'.$row['progress'].'"
      }';

    if($count%$resultLenght != 0) echo ',';
    else echo '
    ]
  }';
  }
}

function getTopics(){
  global $dba;
  // $query = "SELECT * FROM sk_subjects";
  // $results = $dba->query($query);
  // echo '[';
  // while($row = $dba->fetch_array($results)) {
  //   echo '{"title":"'.$row['title'].'","topics":[';
  //     $query2 = "SELECT * FROM sk_topics WHERE subject_id=".$row['id'];
  //     $results2 = $dba->query($query2);
  //     echo '[';
  //     while($row2 = $dba->fetch_array($results2)) {
  //       echo '{
  //         "topic":"'.$row2['title'].'",
  //         "id":'.$row2['id'].'
  //         "description":'.$row2['id'].'
  //         "grade_level":'.$row2['id'].'
  //         "background":'.$row2['id'].'
  //       },';
  //     }
  //   echo '],';
  // }
  //  echo ']';
  $query = 'SELECT * FROM sk_topics WHERE status = \'Published\'  ORDER BY id DESC LIMIT 50';
  $results = $dba->query($query);
  $r = '{"result":"success","content":[';
  while($row = $dba->fetch_array($results)) {
    $queryi = 'SELECT * FROM sk_subjects WHERE id = \''.mysqli_real_escape_string($dba->link_id,$row['subject_id']).'\'';
    $rowi = $dba->query_first($queryi);

    $r .= '{
      "topic":"'.$row['title'].'",
      "id":"'.$row['id'].'",
      "description":"'.$row['description'].'",
      "grade_level":"'.$row['grade_level'].'",
      "subject":"'.$rowi[1].'",
      "background":"'.$row['background'].'"
    },';
  }
  $r .= ']';
  $r = str_replace('},]', '}]}', $r);
  echo $r;

}

function getTopic(){
  global $dba;
  if(isset($_GET['id'])){
    $query = 'SELECT * FROM sk_topics WHERE status != \'Not published\' AND id=\''.mysqli_real_escape_string($dba->link_id,$_GET['id']).'\' LIMIT 1';
    $result = $dba->query($query);
    $row = $dba->fetch_array($result);


    if(empty($row))
      echo '{"result": "fail"}';
    else{
      $mc=$row['mode_content'];
      if($mc=='') $mc='""';

      echo '
      {
        "subject": "'.$row['subject_id'].'",
        "chapter": "'.$row['chapter'].'",
        "title": "'.$row['title'].'",
        "description": "'.$row['description'].'",
        "background": "'.$row['background'].'",
        "mode": '.$row['mode_id'].',
        "gradelevel": "'.$row['grade_level'].'",
        "content": "'.$row['content'].'",
        "modecontent": '.$mc.'
      }
    ';}
  }
}

function login(){
  global $dba;
  global $home_url;

  $loginerror='{"result":"Invalid login"}';


  $query = "SELECT * FROM sk_users WHERE username='".mysqli_real_escape_string($dba->link_id,$_POST['username'])."' AND password='".mysqli_real_escape_string($dba->link_id,md5($_POST['password']))."' LIMIT 1";
  $result = $dba->query($query);
  $row = $dba->fetch_array($result);
  
  if($row){
  $loginerror='{"result":"Success",
"content":{
  "username":"'.$row['username'].'",
  "id":"'.$row['id'].'"
}
}';

    $query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Users')."','".mysqli_real_escape_string($dba->link_id,'User login')."',NOW(),'".mysqli_real_escape_string($dba->link_id,$row['id'])."')";
    $dba->query($query2);
  } else {
  }

  echo $loginerror;
}

function register(){
  global $dba;
  global $home_url;

  $registrationerror='';

  if($_POST['username']=='') $registrationerror.='<li>Username required</li>';

  if($_POST['username']!=''){
    $query = "SELECT * FROM sk_users WHERE username='".mysqli_real_escape_string($dba->link_id,$_POST['username'])."' AND password='".mysqli_real_escape_string($dba->link_id,md5($_POST['password']))."' LIMIT 1";
    $result = $dba->query($query);
    $row = $dba->fetch_array($result);

    if($row) $registrationerror.='<li>Username already exists</li>';
  }

  if($_POST['password']=='') $registrationerror.='<li>Password required</li>';
  
  if($_POST['password']!=''){
    if($_POST['password']!=$_POST['password2']) $registrationerror.='<li>Passwords did not match</li>';
    if($_POST['pw-strength']!='Strong' && $_POST['pw-strength']!='Very Strong' ) $registrationerror.='<li>You must use a strong password</li>';
  }

  if($_POST['email']=='') $registrationerror.='<li>Email Address required</li>';
  if($_POST['mobile']=='') $registrationerror.='<li>Mobile Number required</li>';
  if($_POST['firstname']=='') $registrationerror.='<li>First Name required</li>';
  if($_POST['lastname']=='') $registrationerror.='<li>Last Name required</li>';


  if($_POST['usertype']==2){
    if($_POST['teacher-schoolname']=='') $registrationerror.='<li>School Name required</li>';
  }

  if($_POST['usertype']==3){
    if($_POST['student-gradelevel']=='') $registrationerror.='<li>Grade Level required</li>';
    if($_POST['student-schoolname']=='') $registrationerror.='<li>School Name required</li>';
  }

  if($registrationerror==''){
    $query = "INSERT INTO sk_users (username,password,email,mobile,firstname,lastname,usertype) VALUES ('".mysqli_real_escape_string($dba->link_id,$_POST['username'])."','".mysqli_real_escape_string($dba->link_id,md5($_POST['password']))."','".mysqli_real_escape_string($dba->link_id,$_POST['email'])."','".mysqli_real_escape_string($dba->link_id,$_POST['mobile'])."','".mysqli_real_escape_string($dba->link_id,$_POST['firstname'])."','".mysqli_real_escape_string($dba->link_id,$_POST['lastname'])."','".mysqli_real_escape_string($dba->link_id,$_POST['usertype'])."')";
    $dba->query($query);
    $last_id = $dba->insert_id();

    $query2 = "INSERT INTO sk_history (module,activity,datetime,user_id) VALUES ('".mysqli_real_escape_string($dba->link_id,'Users')."','".mysqli_real_escape_string($dba->link_id,'New user registration: '.mysqli_real_escape_string($dba->link_id,$_POST['username']))."',NOW(),'".mysqli_real_escape_string($dba->link_id,$last_id)."')";
    $dba->query($query2);

    if($_POST['usertype']==2){
      $query3 = "INSERT INTO sk_teachers (user_id,schoolname) VALUES ('".mysqli_real_escape_string($dba->link_id,$last_id)."','".mysqli_real_escape_string($dba->link_id,$_POST['teacher-schoolname'])."')";
    }

    if($_POST['usertype']==3){
      $query3 = "INSERT INTO sk_students (user_id,gradelevel,schoolname) VALUES ('".mysqli_real_escape_string($dba->link_id,$last_id)."','".mysqli_real_escape_string($dba->link_id,$_POST['student-gradelevel'])."','".mysqli_real_escape_string($dba->link_id,$_POST['student-schoolname'])."')";
    }

    $dba->query($query3);

    $registrationerror = '{"result":"Registration successful",
    "content":{"username":"'.$_POST['username'].'","id":"'.$last_id.'"}}';
  } else {
    $registrationerror='{"result":"Registration Failed",
    "content":"<ul>"'.$registrationerror.'"</ul>"}';
  }

  echo $registrationerror;
}