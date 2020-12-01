<?php 
function getFacebookLogUrl(){
	$endpoint = 'https://www.facebook.com/' . FB_GRAPH_VERSION . '/dialog/oauth';
	$params = array(
		'client_id' => FB_APP_ID,
		'redirect_uri' => FB_REDIRECT_URI,
		'state' => FB_APP_STATE,
		'scope' => 'email',
		'auth_type' => 'rerequest'
	);
	return $endpoint . '?' . http_build_query($params);
}
?>