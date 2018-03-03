<?php
	
	require_once('header.php');

	$error = array();
	
	$title = '';
	$description = '';
	$amount = '';
	$quality = '';
	$delivery_date = '';

	$sent = false;

	if(isset($_POST['form_sent'])) {

		$sent = true;

		if($_POST['title']) {
			$title = $_POST['title'];
		} else {
			$error['title'] = true;
		}

		if($_POST['description']) {
			$description = $_POST['description'];
		} else {
			$error['description'] = true;
		}

		if($_POST['delivery_date']) {
			$delivery_date = $_POST['delivery_date'];
			$delivery_date = date("Y-m-d", strtotime($delivery_date));
		} else {
			$error['delivery_date'] = true;
		}

		if($_POST['amount']) {
			$amount = str_replace(" ", '', $_POST['amount']);
			if(!is_numeric($amount)) {
				$error['amount'] = true;
			}
		} else {
			$error['amount'] = true;
		}

		if($_POST['quality']) {
			$quality = $_POST['quality'];
		} else {
			$error['quality'] = true;
		}

		if(empty($error)) {
			
			$request = new Request($db_host, $db_name, $db_user, $db_pass);
			$request->create($_SESSION['customer_id'], $title, $description, $delivery_date, $amount, $quality);
			header('Location: requests.php');

		}

	}

?>

<main role="main" class="container">
	<div class="row">
		<div class="col-12 col-md-12 request-col">		
			<h1>Nachfrage erfassen</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-12">			
			<div class="form-container">
				<form name="create_request" method="POST" action="create_request.php" novalidate="">
					<input type="hidden" name="form_sent" value="1" />
					<div class="form-group">
						<label for="title">Titel*</label>
						<input type="text" name="title" class="form-control 
							<?php
								if($sent) {
									if(isset($error['title'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" placeholder="Titel" value="<?= $title ?>">
						<div class="invalid-feedback">
							Titel ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="description">Beschreibung*</label>
						<textarea rows="10" name="description" class="form-control 
							<?php
								if($sent) {
									if(isset($error['description'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" ><?= $description ?></textarea>
						<div class="invalid-feedback">
							Beschreibung ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="delivery_date">Lieferdatum*</label>
						<input type="text" id="datepicker" name="delivery_date" class="form-control
							<?php
								if($sent) {
									if(isset($error['delivery_date'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="delivery_date" placeholder="Lieferdatum" value="<?= $delivery_date ?>">
						<div class="invalid-feedback">
							Lieferdatum ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="amount">Menge*</label>
						<input type="text" name="amount" class="form-control
							<?php
								if($sent) {
									if(isset($error['amount'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="amount" placeholder="Menge" value="<?= $amount ?>">
						<div class="invalid-feedback">
							Menge ungültig
						</div>
					</div>
					<div class="form-group">
						<label for="quality">Qualität*</label>
						<input type="text" name="quality" class="form-control
							<?php
								if($sent) {
									if(isset($error['quality'])) {
										echo 'is-invalid';
									} else {
										echo 'is-valid';
									}
								}
							?>
						" id="quality" placeholder="Qualität" value="<?= $quality ?>">
						<div class="invalid-feedback">
							Qualität ungültig
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