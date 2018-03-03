<?php

	require_once('class/request.class.php');

	session_start();
	$request = new Request($db_host, $db_name, $db_user, $db_pass);
	$req = $request->getById($_GET['request_id']);

	if($req && $req['customer_id'] == $_SESSION['customer_id']) {
		$request->deleteById($req['request_id']);
	} 

	header('Location: myrequests.php');

?>