<?php

require_once("../_class.dba.inc.php");
require_once("../_conf.dba.inc.php");
require_once("../_static.session.inc.php");
validate_session();

$query = "SELECT * FROM sk_topics WHERE id='".$_REQUEST['id']."' LIMIT 1";
$result = $dba->query($query);
$row = $dba->fetch_array($result);
?>
<html>
<head>
<title>Stock Knowledge - Edit</title>
<link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
<?php include('../header.php');?>

</head>
<body>
<?php include('../sidebar.php');?>
<div id="main-container"><div id="main">
<h1><?php echo $heading;?></h1>

<form action="update.php" method="POST" enctype="multipart/form-data">
<table class="edit">
<input type="hidden" value="<?= $row['id'] ?>" name="id">
<tr>
	<td>Subject</td>
	<td><select name="subject_id">
<?php
$query = "SELECT * FROM sk_subjects ORDER BY id";
$results = $dba->query($query);
while($rowi = $dba->fetch_array($results)) {
	if($rowi['id'] == $row['subject_id']) {
		$selected = ' selected';
	} else {
		$selected = '';
	}
	echo("<option value='".$rowi['id']."'$selected>".$rowi[1]."</option>");
}
?>
</select>
<a href="../sk_subjects/new.php" target="_new">New</a></td>
</tr>
<tr>
	<td>Chapter</td>
	<td><textarea name="chapter"><?= $row['chapter'] ?></textarea>
</td>
</tr>
<tr>
	<td>Title</td>
	<td><textarea name="title"><?= $row['title'] ?></textarea>
</td>
</tr>
<tr>
	<td>Description</td>
	<td><textarea name="description"><?= $row['description'] ?></textarea>
</td>
</tr>
<tr>
	<td>Background</td>
	<!-- <td>
		<textarea name="background"><?= $row['background'] ?></textarea>
	</td> -->
	<td>
		<input type="file" name="background" id="background" onchange="updateModeContent()"><br>
		<span class="small">(leave blank for no change)</span>
	</td>
</tr>
<tr>
	<td>Content</td>
	<td><textarea name="content"><?= $row['content'] ?></textarea>
</td>
</tr>
<tr>
	<td>Grade Level</td>
	<td><textarea name="grade_level"><?= $row['grade_level'] ?></textarea>
</td>
</tr>
<tr style="display:none;">
	<td>Author</td>
	<td><select name="author_id">
<?php
$query = "SELECT * FROM sk_users ORDER BY id";
$results = $dba->query($query);
while($rowi = $dba->fetch_array($results)) {
	if($rowi['id'] == $row['author_id']) {
		$selected = ' selected';
	} else {
		$selected = '';
	}
	echo("<option value='".$rowi['id']."'$selected>".$rowi[1]."</option>");
}
?>
</select>
<a href="../sk_users/new.php" target="_new">New</a></td>
</tr>
<tr>
	<td>Mode</td>
	<td><select name="mode_id">
<?php
$query = "SELECT * FROM sk_modes ORDER BY id";
$results = $dba->query($query);
while($rowi = $dba->fetch_array($results)) {
	if($rowi['id'] == $row['mode_id']) {
		$selected = ' selected';
	} else {
		$selected = '';
	}
	echo("<option value='".$rowi['id']."'$selected>".$rowi[1]."</option>");
}
?>
</select>
<a href="../sk_modes/new.php" target="_new">New</a></td>
</tr>
<tr>
	<td>Mode Content</td>
	<td><textarea name="mode_content" id="mode_content"><?= $row['mode_content'] ?></textarea>
3D File: <input type="file" name="3dFile" id="3dFile" onchange="updateModeContent()"><br>
<span class="small">(leave blank for no change)</span><br>

3D File Attributes: <textarea id="instructions" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"></textarea><br>
Hotspots: 
<div id="hotspots">
</div>
<a href="javascript:void(0);" onclick="addHotSpot()">Add New Hotspot</a>
<script>
var hotspot=0;

document.querySelector('select[name=mode_id]').addEventListener('change',function(e){
	showMode(this.value);
})
// showMode(document.querySelector('select[name=mode_id]').value);
function showMode(mode){
	document.querySelector('#hotspots').innerHTML='';
	hotspot=0;
	if(mode==1) addHotSpot1();
	if(mode==2) addHotSpot2();
}
function addHotSpot(){
	var mode =document.querySelector('select[name=mode_id]').value;
	if(mode==1) addHotSpot1();
	if(mode==2) addHotSpot2();
}
function addHotSpot1(){
	hotspot++;
var html=`
&nbsp;&nbsp;Hotspot #`+hotspot+`:<br>
&nbsp;&nbsp;&nbsp;&nbsp;title: <input type="text" id="title`+hotspot+`s" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate X: <input type="text" id="coordinateX`+hotspot+`" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate Y: <input type="text" id="coordinateY`+hotspot+`" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate Z: <input type="text" id="coordinateZ`+hotspot+`" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Description: <textarea id="description`+hotspot+`" class="description" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"></textarea>
`;
var htmlEl = document.createElement('div');
htmlEl.innerHTML = html;
htmlEl.setAttribute('id','hotspot-'+hotspot);
htmlEl.setAttribute('class','hotspot');
document.querySelector('#hotspots').append(htmlEl);
window.scrollTo(0,100000000000);
// document.querySelector('#coordinateX'+hotspot).focus();
}


function addHotSpot2(){
	hotspot++;
var html=`
&nbsp;&nbsp;Hotspot #`+hotspot+`:<br>
&nbsp;&nbsp;&nbsp;&nbsp;title: <input type="text" id="title`+hotspot+`s" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate X Start: <input type="text" id="coordinateX`+hotspot+`s" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate Y Start: <input type="text" id="coordinateY`+hotspot+`s" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate Z Start: <input type="text" id="coordinateZ`+hotspot+`s" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate X End: <input type="text" id="coordinateX`+hotspot+`e" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate Y End: <input type="text" id="coordinateY`+hotspot+`e" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Coordinate Z End: <input type="text" id="coordinateZ`+hotspot+`e" class="coordinate" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"><br>
&nbsp;&nbsp;&nbsp;&nbsp;Description: <textarea id="description`+hotspot+`" class="description" onkeydown="updateModeContent()" onchange="updateModeContent()" onblur="updateModeContent()"></textarea>
`;
var htmlEl = document.createElement('div');
htmlEl.innerHTML = html;
htmlEl.setAttribute('id','hotspot-'+hotspot);
htmlEl.setAttribute('class','hotspot');
document.querySelector('#hotspots').append(htmlEl);
window.scrollTo(0,100000000000);
// document.querySelector('#coordinateX'+hotspot).focus();
}

function updateModeContent(){
var backgroundPath = document.getElementById('background').value;
console.log(backgroundPath);
var backgroundName = '';

if (backgroundPath) {
    var startIndex = (backgroundPath.indexOf('\\') >= 0 ? backgroundPath.lastIndexOf('\\') : backgroundPath.lastIndexOf('/'));
    backgroundName = backgroundPath.substring(startIndex);
    if (backgroundName.indexOf('\\') === 0 || backgroundName.indexOf('/') === 0) {
        backgroundName = backgroundName.substring(1);
    }
    // alert(backgroundName);
}
//if(backgroundName=='') backgroundName=objTemp['background'];

var fullPath = document.getElementById('3dFile').value;
var filename = '';
if (fullPath) {
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    // alert(filename);
}
if(filename=='') filename=objTemp['3dfile'];
var instructions = document.getElementById('instructions').value;
var objModeContent = {"3dfile":filename, "instructions":instructions};

var hotspotArr=[];
var mode =document.querySelector('select[name=mode_id]').value;

for(var i=1; i<=hotspot; i++){
	if(mode==1){
		var title = document.getElementById('title'+i+'s').value;
		var coordinateX = document.getElementById('coordinateX'+i).value;
		var coordinateY = document.getElementById('coordinateY'+i).value;
		var coordinateZ = document.getElementById('coordinateZ'+i).value;
		var description = document.getElementById('description'+i).value;
		if(coordinateX==''&&coordinateY==''&&coordinateZ==''&&description==''){
			// document.querySelector('#hotspots').removeChild(document.querySelector('#hotspot-'+i));
		} else {
		hotspotArr[i-1]={"id": i, "title":title,"coordinates":coordinateX+","+coordinateY+","+coordinateZ, "description":description};
		}
	}
	if(mode==2){
		var title = document.getElementById('title'+i+'s').value;
		var coordinateXs = document.getElementById('coordinateX'+i+'s').value;
		var coordinateYs = document.getElementById('coordinateY'+i+'s').value;
		var coordinateZs = document.getElementById('coordinateZ'+i+'s').value;
		var coordinateXe = document.getElementById('coordinateX'+i+'e').value;
		var coordinateYe = document.getElementById('coordinateY'+i+'e').value;
		var coordinateZe = document.getElementById('coordinateZ'+i+'e').value;
		var description = document.getElementById('description'+i).value;
		if(coordinateXs==''&&coordinateYs==''&&coordinateZs==''&&coordinateXe==''&&coordinateYe==''&&coordinateZe==''&&description==''){
			// document.querySelector('#hotspots').removeChild(document.querySelector('#hotspot-'+i));
		} else {
		hotspotArr[i-1]={"id": i, "title":title,"coordinatesS":coordinateXs+","+coordinateYs+","+coordinateZs, "coordinatesE":coordinateXe+","+coordinateYe+","+coordinateZe, "description":description};
		}


	}
}
objModeContent.hotspots=hotspotArr;
modecontent = JSON.stringify(objModeContent);
modecontent = modecontent.replace(/(\r\n|\n|\r)/gm,"");
document.getElementById('mode_content').value=modecontent;

console.log(objModeContent);
}
var objTemp = JSON.parse(document.getElementById('mode_content').value);
console.log(objTemp);
document.getElementById('instructions').value=objTemp.instructions;
var mode =document.querySelector('select[name=mode_id]').value;
for(var i=1; i<=objTemp.hotspots.length; i++){
	if(mode==1){
		addHotSpot1();
		var coords = objTemp.hotspots[i-1].coordinates.split(',');
		document.getElementById('title'+i+'s').value=objTemp.hotspots[i-1].title;
		document.getElementById('coordinateX'+i).value=coords[0];
		document.getElementById('coordinateY'+i).value=coords[1];
		document.getElementById('coordinateZ'+i).value=coords[2];
		document.getElementById('description'+i).value=objTemp.hotspots[i-1].description;
	}
	if(mode==2){
		addHotSpot2()
		var coordsS = objTemp.hotspots[i-1].coordinatesS.split(',');
		var coordsE = objTemp.hotspots[i-1].coordinatesE.split(',');
		document.getElementById('title'+i+'s').value=objTemp.hotspots[i-1].title;
		document.getElementById('coordinateX'+i+'s').value=coordsS[0];
		document.getElementById('coordinateY'+i+'s').value=coordsS[1];
		document.getElementById('coordinateZ'+i+'s').value=coordsS[2];
		document.getElementById('coordinateX'+i+'e').value=coordsE[0];
		document.getElementById('coordinateY'+i+'e').value=coordsE[1];
		document.getElementById('coordinateZ'+i+'e').value=coordsE[2];
		document.getElementById('description'+i).value=objTemp.hotspots[i-1].description;
	}
}
</script>

</td>
</tr>

</table>
<br />
<input class="btn btn-primary" type="submit" value="Ok"> <input class="btn btn-warning" type="reset" value="Reset"> <a class="btn btn-success" href="list.php">Back</a>
</form>
</div></div>
<?php include('../footer.php');?>

</body>
</html>
