<?php
session_start();


//User eingeloggt, Ja Nein
//$user = check_user();

include("templates/header_inc.php");
?>
<div class="container main-container">
        <h1>Herzlich Willkommen</h1>

Hallo <?php /*echo htmlentities($user['name']);*/ ?>,<br>
Herzlich Willkommen auf Ihrem Dashboard!<br><br>

<div class="panel panel-default">
        <table class="table">
        <tr>
                <th>#</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>E-Mail</th>
        </tr>
<?php
$statement = $pdo->prepare("SELECT * FROM customer ORDER BY customer_id");
$result = $statement->execute();
$count = 1;
while($row = $statement->fetch()){
    echo "<tr>";
    echo "<td>".$count++."</td>";
    echo "<td>".$row['prename']."</td>";
    echo "<td>".$row['name']."</td>";
    echo '<td><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>';
    echo "</tr>";
}

echo 'Meine Nachfragen<br>';
$statement = $pdo->prepare("SELECT * FROM requests ORDER BY timestamp LIMIT 25");
$result = $statement->execute();
while($row = $statement->fetch()){
        echo $row['title']. ' ' . $row['amount']. ' ' .$row['quality']. ' ' .$row['delivery_date']. '<br>';
}

echo 'Meine Angebote <br>';
$statement = $pdo->prepare("SELECT * FROM offer ORDER BY timestamp LIMIT 25");
$result = $statement->execute();
while($row = $statement->fetch()){
        echo $row['title']. ' ' . $row['amount']. ' ' .$row['quality']. ' '. $row['price']. ' ' .$row['delivery_date']. '<br>';
}
?>
<?php
//suchfunktion Nachfrage?!?
$search_for = "%{$searchtext}%";
$search = $pdo->prepare("SELECT title, amount, quality, delivery_date FROM request WHERE title LIKE ? OR amount LIKE ? OR quality LIKE ? OR delivery_date LIKE ?");
$search->bind_param('ss', $search_for, $search_for);
$search->execute();
$search->bind_result($title, $amount, $quality, $delivery_date);
while($search->fetch()){
        echo "<li>";
        echo $title. ' ' .$amount. ' ' .$quality. ' ' .$delivery_date;
}
?>
<form action="" method="get">
        Suchen nach:
        <input type="hidden" name="aktion" value="suchen">
        <input type="text" name="suchbegriff" id="suchbegriff">
        <input type="submit" value="suchen">
</form>
</table>
</div>
</div>
<?php
include("templates/footer_inc.php")
?>