<?php
include 'database_conn.php';

// Spracovanie dát z formulára
if (isset($_POST['submit'])) {
    $meno = $_POST['meno'];
    $priezvisko = $_POST['priezvisko'];
    $odohrane_zapasy = $_POST['odohrane_zapasy'];
    $pocet_golov = $_POST['pocet_golov'];
    $pocet_asistencii = $_POST['pocet_asistencii'];
    $rocnik = $_POST['rocnik'];
    $pozicia = $_POST['pozicia'];

    // Vloženie dát do tabuľky "hraci"
    $stmt = $conn->prepare("INSERT INTO hraci (meno, priezvisko, odohrane_zapasy, pocet_golov, pocet_asistencii, rocnik, pozicia) 
                            VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param('ssiiiii', $meno, $priezvisko, $odohrane_zapasy, $pocet_golov, $pocet_asistencii, $rocnik, $pozicia);

    try {
        $stmt->execute();
        echo ", Dáta boli úspešne vložené do databázy";
    }
    catch(PDOException $e) {
        echo "Vloženie dát do databázy zlyhalo: " . $e->getMessage();
    }
}

header('Location: ../index.php');
?>
