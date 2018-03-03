<?php

	require_once('header.php');

?>

	<main role="main" class="container">
		<div class="row">
			<div class="col-12 top-row">
            	<h1>Business Streamline</h1>
            	<p>
                	Auf diesem B2B Portal möchten wir einen Platz im Internet bieten, auf welchem Sie mit minimalem Aufwand, eine maximale Anzahl an Angeboten für bestimmte
                	Produkte erhalten können. Melden Sie sich einfach an und erstellen Sie eine Nachfrage für ein Produkt. Andere Teilnehmer können danach auf Ihre
                	Nachfrage ein Angebot erfassen und Sie können anonym auf die einzelnen Angebote eingehen.
            	</p>
        	</div>
        </div>
		<div class="row">
			<div class="col-12 col-md-3">
				<div class="frontpage-entry-container">
					<div class="frontpage-entry-text-container">
						<h3>Registrieren</h3>
						Registrieren Sie sich mittels Formular. Nach einer Bestätigung von unserer Seite können Sie sich in unser System einloggen
						<div class="fronpage-entry-icon-container">
							<i class="fa fa-sign-in fa-5x"></i>
						</div>
					</div>
					<div class="frontpage-entry-rightimage-container">
						<i class="fa fa-arrow-circle-right fa-3x"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="frontpage-entry-container">
					<div class="frontpage-entry-text-container">
						<h3>Nachfrage</h3>
						Erstellen Sie eine Nachfrage für ein beliebiges Produkt. Sie können dabei die gewünschte Menge und dei Qualität festlegen.
						<div class="fronpage-entry-icon-container">
							<i class="fa fa-envelope-o fa-5x"></i>
						</div>
					</div>
					<div class="frontpage-entry-rightimage-container">
						<i class="fa fa-arrow-circle-right fa-3x"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="frontpage-entry-container">
					<div class="frontpage-entry-text-container">
						<h3>Angebote</h3>
						Verschiedene Anbieter können danach auf Ihre Nachfragen reagieren und dabei ein entsprechendes Angebot plazieren.
						<div class="fronpage-entry-icon-container">
							<i class="fa fa-inbox fa-5x"></i>
						</div>
					</div>
					<div class="frontpage-entry-rightimage-container">
						<i class="fa fa-arrow-circle-right fa-3x"></i>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="frontpage-entry-container">
					<div class="frontpage-entry-text-container">
						<h3>Ware</h3>
						Aus den Angebote auf Ihre Nachfrage können Sie eines auswählen und mit dem Verkäufer in Kontakt tretten und Ihre Ware Bestellen.
						<div class="fronpage-entry-icon-container">
							<i class="fa fa-handshake-o fa-5x"></i>
						</div>
					</div>
					<div class="frontpage-entry-rightimage-container">
						
					</div>
				</div>
			</div>
		</div>
	<?php 
		if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']):
	?>
			<div class="row">
				<div class="col-12 col-md-12">
					<h4>Haben Sie bereits einen Account?</h4>
					<p>Loggen Sie sich <a href="/login.php">hier</a> ein</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-12">
					<h4>Sind Sie neu hier?</h4>
					<p>Registrieren Sie sich <a href="/register.php">hier</a> einen Account</p>
				</div>
			</div>
	<?php
		endif;
	?>
    </main>

<?php

	require_once('footer.php');

?>