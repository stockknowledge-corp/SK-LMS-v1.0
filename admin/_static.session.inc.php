<?php
function validate_session() {
	// check for a valid session.
	session_start();
	global $dba;
	global $_SESSION;
	global $_SERVER;
	// enter your session validation code here!
}

function remove_session() {
	global $dba;
	// initialize the session
	session_start();
	
	// remove all session information
	$_SESSION = array();

	// remove the whole session information.
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}

	// remove the session itself.
	session_destroy();
	return true;
}

function d($string) {
	echo("<h3>".$string."</h3>\n");
}
?>
