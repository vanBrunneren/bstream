<?php

	$error = array();
	
	$company_name = '';
	$email = '';
	$password = '';
	$password_confirm = '';
	$sex = '';
	$name = '';
	$prename = '';
	$phone = '';
	$street = '';
	$city = '';
	$plz = '';

	$sent = false;

	if(isset($_POST['form_sent'])) {

		$customer = new Customer($db_host, $db_name, $db_user, $db_pass);

		$sent = true;

		if($_POST['company_name']) {
			$company_name = $_POST['company_name'];
		} else {
			$error['company_name'] = true;
		}

		if($_POST['email']) {
			$email = $_POST['email'];
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$error['email'] = "E-Mail Adresse ungültig";
			} else {
				if($customer->findByEmail($_POST['email'])) {
					$error['email'] = "Diese E-Mail Adresse wird bereits verwendet";
				} 
			}
		} else {
			$error['email'] = "E-Mail Adresse ungültig";
		}

		if($_POST['password']) {
			
			if($_POST['password_confirm']) {
				if($_POST['password'] == $_POST['password_confirm']) {

				} else {
					$error['password'] = "Die beiden Passwörter stimmen nicht überein";
				}
			} else {
				$error['password'] = "Das Passwort muss bestätigt werden";
			}

		} else {
			$error['password'] = "Passwort ungültig";
		}

		if($_POST['sex']) {
			$sex = $_POST['sex'];
		}

		if($_POST['name']) {
			$name = $_POST['name'];
		} else {
			$error['name'] = true;
		}

		if($_POST['prename']) {
			$prename = $_POST['prename'];
		} else {
			$error['prename'] = true;
		}

		if($_POST['phone']) {
			$phone = str_replace(" ", '', $_POST['phone']);
			if(!is_numeric($phone)) {
				$error['phone'] = true;
			}
		} else {
			$error['phone'] = true;
		}

		if($_POST['street']) {
			$street = $_POST['street'];
		} else {
			$error['street'] = true;
		}

		if($_POST['city']) {
			$city = $_POST['city'];
		} else {
			$error['city'] = true;
		}

		if($_POST['plz']) {
			$plz = str_replace(" ", '', $_POST['plz']);
			if(!is_numeric($plz)) {
				$error['plz'] = true;
			}
		} else {
			$error['plz'] = true;
		}

		if(empty($error)) {
			
			$customer->create($company_name, $sex, $name, $prename, $email, $phone, $street, $plz, $city, password_hash($_POST['password'], PASSWORD_DEFAULT));
			header('Location: index.php');

		}

	}

?>
























