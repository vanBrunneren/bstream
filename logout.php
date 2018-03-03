<?php

	require_once('header.php');

	session_destroy();

	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>