<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "hraci"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Pripojenie zlyhalo: " . $conn->connect_error());
}
//ALTER TABLE hraci AUTO_INCREMENT = 1; zahaji nove cislovanie ID

?>


