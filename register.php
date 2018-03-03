<?php

	require_once('header.php');
	require_once('register_form_validation.php');

?>

<main role="main" class="container">
	<div class="row">
		<div class="col-12 col-md-12">			
			<div class="form-container">
				<h3>Registrieren</h3>
				<form name="login" method="POST" action="register.php" novalidate="">
					<input type="hidden" name="form_sent" value="1" />
					<div class="form-group">
						<label for="company_name">Firmenname*</label>
						<input type="text" name="company_name" class="form-control 
							<?php
								if($sent) {
									if(isset($error['company_name'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="company_name" placeholder="Firmenname" value="<?= $company_name ?>">
						<div class="invalid-feedback">
							Firmenname ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="emailInput">E-Mail Adresse*</label>
						<input type="email" name="email" class="form-control 
							<?php
								if($sent) {
									if(isset($error['email'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="emailInput" aria-describedby="emailHelp" value="<?= $email ?>" placeholder="E-Mail Adresse">
						<div class="invalid-feedback">
							<?= $error['email'] ?>
						</div>
					</div>
					<div class="form-group">
						<label for="password">Passwort*</label>
						<input type="password" name="password" class="form-control
							<?php
								if($sent) {
									if(isset($error['password'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="password">
						<div class="invalid-feedback">
							<?= $error['password'] ?>
						</div>
					</div>
					<div class="form-group">
						<label for="password_confirm">Passwort bestätigen*</label>
						<input type="password" name="password_confirm" class="form-control" id="password_confirm">
					</div>
					<div class="form-group ">
						<label for="password_confirm">Anrede</label><br>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="sex" id="sex" value="female" <?= $sex == 'female' ? 'checked' : '' ?>> Frau
							</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="sex" id="sex" value="male" <?= $sex == 'male' ? 'checked' : '' ?>> Herr
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Name*</label>
						<input type="text" name="name" class="form-control
							<?php
								if($sent) {
									if(isset($error['name'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="name" placeholder="Name" value="<?= $name ?>">
						<div class="invalid-feedback">
							Name ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="name">Vorname*</label>
						<input type="text" name="prename" class="form-control
							<?php
								if($sent) {
									if(isset($error['prename'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="name" placeholder="Vorname" value="<?= $prename ?>">
						<div class="invalid-feedback">
							Vorname ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="name">Telefonnummer*</label>
						<input type="text" name="phone" class="form-control
							<?php
								if($sent) {
									if(isset($error['phone'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="phone" placeholder="Telefonnummer" value="<?= $phone ?>">
						<div class="invalid-feedback">
							Telefonnummer ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="street">Strasse / Hausnummer*</label>
						<input type="text" name="street" class="form-control
							<?php
								if($sent) {
									if(isset($error['street'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" placeholder="Strasse / Hausnummer" value="<?= $street ?>">
						<div class="invalid-feedback">
							Strasse / Hausnummer ungültig
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-3">
								<label for="street">PLZ*</label>
								<input type="text" name="plz" class="form-control
									<?php
										if($sent) {
											if(isset($error['plz'])) {
												echo 'is-invalid';
											} else {
												echo 'is-valid';
											}
										}
									?>
								" placeholder="PLZ" value="<?= $plz ?>">
								<div class="invalid-feedback">
									PLZ ungültig
								</div>
							</div>
							<div class="col-9">
								<label for="city">Ort*</label>
								<input type="text" name="city" class="form-control
									<?php
										if($sent) {
											if(isset($error['city'])) {
												echo 'is-invalid';
											} else {
												echo 'is-valid';
											}
										}
									?>
								" id="name" placeholder="Ort" value="<?= $city ?>">
								<div class="invalid-feedback">
									Ort ungültig
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Absenden</button>
				</form>
			</div>
		</div>
	</div>
</main>






<?php

	require_once('footer.php');

?>