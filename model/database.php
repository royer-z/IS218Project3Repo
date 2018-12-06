<?php
$dsn = "mysql:host=sql1.njit.edu;dbname=rvz2";
$user = "rvz2";
$pass = "gEQl8u0MT";

try {
    $db = new PDO($dsn, $user, $pass);
}catch(PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p class='errorMessage'><span class='errorType'>Database error: </span><span class='errorDescription'>An error occurred while connecting to the database: $error_message</span></p>";
}