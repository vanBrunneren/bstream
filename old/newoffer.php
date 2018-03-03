<?php
session_start();
include("templates/header_inc.php");
$pdo = new PDO('mysql:host=localhost;dbname=bstream', 'root','');

$showFormular = true;

if(isset($_GET['newoffer'])){
    $error = false;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $quality = $_POST['quality'];
    $price = $_POST['price'];
    $delivery_date = $_POST['delivery_date'];

    //Nachfrage erstellen
    if($error) {

        $statement = $pdo->prepare("INSERT INTO offer (title, description, amount, quality, price, delivery_date) VALUES (:title, :descritpion, :amount, :quality, :price, :delivery_date)");
        $result = $statement->execute(array('title'=>$title, 'description'=>$description, 'amount'=>$amount, 'quality'=>$quality, 'price'=>$price, 'delivery_date'=>$delivery_date));
        
        if($result) {
            echo 'Sie haben erfolgreich ein Angebot abgegeben. Zurück zum <a href="dashboard.php">Dashboard</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist ein Fehler aufgetreten<br>';
        }
    }
}
if($showFormular){
?>
<form action="?newoffer=1" method="post">
Titel:<br>
<input type="text" size="40" maxlength="250" name="title"><br><br>
Beschreibung:<br>
<input type="text" size="40" maxlength="250" name="description"><br><br>
Menge:<br>
<input type="number" size="40" name="amount"><br><br>
Qualität:<br>
<input type="text" size="40" maxlength="250" name="quality"><br><br>
Preis:<br>
<input type="text" size="40" maxlength="250" name="price"><br><br>
Datum:<br>
<input type="date" size="40" maxlength="250" name="delivery_date"><br><br>
<input type="submit" value="Erstellen">
</form>
<?php
}
include("templates/footer_inc.php");
?>