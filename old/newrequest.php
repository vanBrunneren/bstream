<?php
session_start();
include("templates/header_inc.php");
$pdo = new PDO('mysql:host=localhost;dbname=bstream', 'root','');

$showFormular = true;

if(isset($_GET['newrequest'])){
    $error = false;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $quality = $_POST['quality'];
    $delivery_date = $_POST['delivery_date'];

    //Nachfrage erstellen
    if($error) {

        $statement = $pdo->prepare("INSERT INTO request (title, description, amount, quality, delivery_date) VALUES (:title, :descritpion, :amount, :quality, :delivery_date)");
        $result = $statement->execute(array('title'=>$title, 'description'=>$description, 'amount'=>$amount, 'quality'=>$quality, 'delivery_date'=>$delivery_date));
        
        if($result) {
            echo 'Sie haben erfolgreich eine neue Nachfrage erstellt. Zurück zum <a href="dashboard.php">Dashboard</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist ein Fehler aufgetreten<br>';
        }
    }
}
if($showFormular){
?>
<form action="?newrequest=1" method="post">
Titel:<br>
<input type="text" size="40" maxlength="250" name="title"><br><br>
Beschreibung:<br>
<input type="text" size="40" maxlength="250" name="description"><br><br>
Menge:<br>
<input type="number" size="40" name="amount"><br><br>
Qualität:<br>
<input type="text" size="40" maxlength="250" name="quality"><br><br>
Datum:<br>
<input type="date" size="40" maxlength="250" name="delivery_date"><br><br>
<input type="submit" value="Erstellen">
</form>
<?php
}
include("templates/footer_inc.php");
?>