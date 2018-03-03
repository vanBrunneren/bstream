<?php

	require_once('header.php');

	$offer_id = $_GET['offer_id'];
	$request_id = $_GET['request_id'];

	$offer = new Offer($db_host, $db_name, $db_user, $db_pass);
	$offer->setAccpted($offer_id, 'declined');

	header('Location: myrequests.php?show_details='.$request_id);

?>