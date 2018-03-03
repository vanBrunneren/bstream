<?php
session_start();
include("templates/header_inc.php");
$pdo = new PDO('mysql:host=localhost;dbname=bstream', 'bstream','u08USpXPayE0r1CU');

$showFormular = true;

if(isset($_GET['register'])){
    $error = false;
    $company_name = $_POST['company_name'];
    $sex = $_POST['sex'];
    $name = $_POST['name'];
    $prename = $_POST['prename'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $street = $_POST['street'];
    $plz = $_POST['plz'];
    $city = $_POST['city'];
    $password = $_POST['password1'];
    $password2 = $_POST['password2'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($password) == 0){
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($password != $password2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    //Ist Email bereits registriert?
    if($error) {
        $statement = $pdo->prepare("SELECT * FROM customer WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false){
            echo 'Diese E-Mail-Adresse ist bereits registriert.<br>';
            $error = true;
        }
    }
    //User registrieren
    if($error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO customer (company_name, sex, name, prename, email, phone, street, plz, city, password) VALUES (:company_name, :sex, :name, :prename, :email, :phone, :street, :plz, :city, :password)");
        $result = $statement->execute(array('company_name'=>$company_name, 'sex'=>$sex, 'name'=>$name, 'prename'=>$prename, 'email'=>$email, 'phone'=>$phone, 'street'=>$street, 'plz'=>$plz, 'city'=>$city, 'password'=>$password_hash));
        
        if($result) {
            echo 'Sie wurden erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist ein Fehler aufgetreten<br>';
        }
    }
}
if($showFormular){
?>
<form action="?register=1" method="post">
Unternehmen:<br>
<input type="text" size="40" maxlength="250" name="company_name"><br><br>
Anrede:<br>
<select name="sex">
    <option value="female">Frau</option>
    <option value="male">Herr</option>
</select><br><br>
Nachname:<br>
<input type="text" size="40" maxlength="250" name="name"><br><br>
Vorname:<br>
<input type="text" size="40" maxlength="250" name="prename"><br><br>
E-Mail-Adresse:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
Telefon:<br>
<input type="text" size="40" maxlength="250" name="phone"><br><br>
Strasse:<br>
<input type="text" size="40" maxlength="250" name="street"><br><br>
Postleitzahl:<br>
<input type="text" size="40" maxlength="250" name="plz"><br><br>
Ort:<br>
<input type="text" size="40" maxlength="250" name="city"><br><br>
Passwort:<br>
<input type="password" size="40" maxlength="250" name="password1"><br><br>
Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="password2"><br><br>
<input type="submit" value="Registrieren">
</form>
<?php
}
include("templates/footer_inc.php");
?>