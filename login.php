<?php

	require_once('header.php');

	$error = false;

	if(isset($_POST['login'])) {

		if(isset($_POST['email']) && isset($_POST['password'])) {

			if($_POST['email']) {
				$customer = new Customer($db_host, $db_name, $db_user, $db_pass);
				$cust = $customer->findByEmail($_POST['email']);
				if($cust) {
					if(password_verify($_POST['password'], $cust['password'])) {
						
						$_SESSION['loggedIn'] = 1;
						$_SESSION['customer_id'] = $cust['customer_id'];
						$_SESSION['company_name'] = $cust['company_name'];

						header('Location: index.php');

					} else {
						$error = true;
					}
				} else {
					$error = true;
				}
			} else {
				$error = true;
			}
		}

	}

?>

<main role="main" class="container">
	<?php
		if(isset($_GET['redirect']) && $_GET['redirect'] == 1) {
			?>

				<div class="row">
					<div class="col-12 col-md-12">
						<div class="alert alert-danger" role="alert">
							Für diese Seite müssen Sie eingeloggt sein
						</div>
					</div>
				</div>

			<?php
		}
	?>
	<div class="row">
		<div class="col-12 col-md-12">
			<div class="form-container">
				<h3>Anmelden</h3>
				<form name="login" method="POST" action="login.php" novalidate="">
					<input type="hidden" name="login" value="1" />
					<div class="form-group">
						<label for="emailInput">E-Mail Adresse</label>
						<input type="email" name="email" class="form-control
						<?php
							if($error) {
								echo 'is-invalid';
							} 
						?>
						" id="emailInput" aria-describedby="emailHelp" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="E-Mail Adresse">
						<div class="invalid-feedback">
							E-Mail Adresse oder Passwort falsch
						</div>
					</div>
					<div class="form-group">
						<label for="passwordInput">Passwort</label>
						<input type="password" name="password" class="form-control" id="passwordInput" placeholder="Passwort">
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