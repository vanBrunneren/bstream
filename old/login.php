<?php

include("templates/header_inc.php");

$pdo = new PDO('mysql:host=localhost;dbname=bstream', 'bstream','u08USpXPayE0r1CU');

print_r($_POST);
$error = array();

if($_POST){

	if(!$_POST['email']) {
		$error['email'] = "Bitte E-Mail Adresse angeben";
	}

	if(!$_POST['password']) {
		$error['password'] = "Bitte Passwort angeben";
	}

	if(empty($error)) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		$statement = $pdo->prepare("SELECT * FROM customer WHERE email = :email");
		$result = $statement->execute(array('email'=>$email));
		$user = $statement->fetch();

		print_r($user);

		if($user !== false && password_verify($password, $user['password'])) {
		    $_SESSION['userid'] = $user['customer_id'];
		    die('Login erfolgreich. Weiter zum <a href="dashbord.php">Dashboard</a>');
		} else {
		    $errorMessage = "E-Mail oder Passwort war ungültig<br>";
		}

	}

}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
        	<?php 
        		print_r($error);
        	?>
            <form action="" method="post">
                E-Mail:<br>
                <input type="email" size="40" maxlength="250" name="email"><br><br>
                Passwort:<br>
                <input type="password" size="40" maxlength="250" name="password"><br><br>
                <input type="submit" value="Abschicken">
            </form>
        </div>
    </div>
</div>

<?php

include("templates/footer_inc.php");

?>