<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Business Streamline</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<?php

session_start();

?>

<nav class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Menu</span>
				<span class="icon-bar">xyz</span>
				<span class="icon-bar">abc</span>
				<span class="icon-bar">123</span>
			</button>
			<a href="index.php" class="navbar-brand">Business Streamline</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<form class="navbar-form navbar-right" action="login.php" method="post">
				<table class="login" role="presentation">
					<tbody>
						<tr>
							<td>
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</div>
									<input class="form-control" placeholder="E-Mail" name="email" type="email" required>
								</div>
							</td>
							<td>
								<input class="form-control" placeholder="Passwort" name="passwort" type="password" value="" required>
							</td>
							<td>
								<button type="submit" class="btn btn-success">Login</button>
							</td>
						</tr>
						<tr>
							<td>
								<small><a href="passwordvergessen.php">Passwort vergessen?</a></small>
								|
								<small><a href="passwordvergessen.php">Neu hier?</a></small>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="settings.php">Einstellungen</a></li>
				<li><a href="Logout.php">Logout</a></li>
			</ul>
		</div>  
	</div>
</nav>