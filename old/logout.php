<?php
include("templates/header_inc.php");
session_start();
session_destroy();

echo "Logout erfolgreich";
?>