<?php
session_start();
include("templates/header_inc.php");

echo 'Alle Nachfragen<br>';
$statement = $pdo->prepare("SELECT * FROM requests ORDER BY timestamp LIMIT 50");
$result = $statement->execute();
while($row = $statement->fetch()){
        echo $row['title']. ' ' . $row['amount']. ' ' .$row['quality']. ' ' .$row['delivery_date']. '<a class="btn btn-default" href="newoffer.php" role="button">Angebot abgeben</a><br>';
}

include("templates/footer_inc.php");
?>
