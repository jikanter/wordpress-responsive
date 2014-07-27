<?php

//var_dump($_POST);
$endpoint = "http://localhost/~admin/2014/7/5/BoomShaka/xmlrpc.php";
$username = "admin";
$password = "admin";
// not used
$status = array(
	'contact' => "Contact info updated",
	'bio' => "Artist biography updated",
);
$post_id = intval($_POST['post_id']);
$content = array('post_content' => urldecode($_POST['content']));
$request = xmlrpc_encode_request("wp.editPost", array(0, $username, $password, $post_id, $content));
$context = stream_context_create(array('http' => array(
									   'method' => 'POST',
									   'header' => 'Content-Type: text/xml',
									   'content' => $request)));
$data = file_get_contents($endpoint, false, $context);
if (!$data) {
	trigger_error("post not found. 404 returned");
}
else {
	$message = "post updated";
	header("Location: contact.php?flash=".urlencode($message));
}
?>