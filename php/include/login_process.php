<?php
include_once 'conn.php';
include_once 'functions_login.php';

sec_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // Das gehashte Passwort.
 
    if (login($email, $password, $mysqli) == true) {
        // Login erfolgreich 
        header('Location: ../../index.php');
    } else {
        // Login fehlgeschlagen 
        header('Location: ../../index.php?error=1');
    }
} else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt. 
    echo 'Invalid Request';
}
?>