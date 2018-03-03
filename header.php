<!doctype html>
<html lang="en">
	<head>
    	
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
   		<link href="https://cdn.jsdelivr.net/npm/gijgo@1.8.1/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    	<link href="css/style.css" rel="stylesheet">

    	<title>Business Streamline</title>

    	<?php

    		session_start();

    		require_once('class/customer.class.php');
    		require_once('class/request.class.php');
			require_once('class/offer.class.php');
			require_once('db_connection.php');

    		if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {

				if(
					basename($_SERVER['SCRIPT_FILENAME']) != 'index.php' &&
					basename($_SERVER['SCRIPT_FILENAME']) != 'login.php' && 
					basename($_SERVER['SCRIPT_FILENAME']) != 'register.php'
				) {
					header('Location: login.php?redirect=1');
				}

			}
    		
    	?>

  	</head>
  	<body>

  		<header>
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<div class="container">
					<a class="navbar-brand" href="/index.php">Business Streamline</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item">
								<a class="nav-link" href="/requests.php">Nachfragen</a>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto">
							<?php
								if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1) {
									echo '<li class="nav-item"><a class="nav-link" href="/myrequests.php">Meine Nachfragen</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="/logout.php">Logout</a></li>';
								} else {
									echo '<li class="nav-item"><a class="nav-link" href="/login.php">Login</a></li>';
								}
							?>
						</ul>
					</div>
				</div>
			</nav>
		</header>