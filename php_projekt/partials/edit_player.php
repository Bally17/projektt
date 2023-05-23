<?php
include 'database/database_conn.php';

// Kontrola, či bol formulár odoslaný
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['edit'];

    // Získať pôvodné údaje z databázy
    $sql = "SELECT hraci.id, hraci.meno, hraci.priezvisko, hraci.rocnik, hraci.pozicia AS pozicia_id, pozicia.nazov AS pozicia_nazov, hraci.odohrane_zapasy, hraci.pocet_golov, hraci.pocet_asistencii FROM `hraci` INNER JOIN pozicia ON hraci.pozicia = pozicia.id WHERE hraci.id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sqlPozicia = "SELECT * FROM pozicia";
    $resultPozicia = mysqli_query($conn, $sqlPozicia);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $meno = $_POST['meno'];
    $priezvisko = $_POST['priezvisko'];
    $rocnik = $_POST['rocnik'];
    $pozicia = $_POST['pozicia'];
    $odohrane_zapasy = $_POST['odohrane_zapasy'];
    $pocet_golov = $_POST['pocet_golov'];
    $pocet_asistencii = $_POST['pocet_asistencii'];

    // Aktualizovať údaje v databáze
    $sql = "UPDATE `hraci` SET `meno`='$meno', `priezvisko`='$priezvisko', `rocnik`='$rocnik', `pozicia`='$pozicia', `odohrane_zapasy`='$odohrane_zapasy', `pocet_golov`='$pocet_golov', `pocet_asistencii`='$pocet_asistencii' WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Premiestniť na index.php
        header('Location: index.php');
        exit();
    } else {
        echo "Chyba pri aktualizácii databázy: " . mysqli_error($conn);
    }
}
?>

<div>
    <div class="sign_up_box">
        <form method="post" action="" name="playerForm">
            <input type="hidden" name="id" value="<?php if(isset($row)){ echo $row['id']; } ?>">
            <div class="jeden">
                <div class="sign_up_box_input">
                    <input type="text" name="meno" required="required" value = "<?php if(isset($row)){ echo $row['meno']; } ?>">
                    <span>Meno</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="odohrane_zapasy" required="required" value = "<?php if(isset($row)){ echo $row['odohrane_zapasy']; } ?>">
                    <span>Počet odohraných zápasov</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="pocet_golov" required="required" value = "<?php if(isset($row)){ echo $row['pocet_golov']; } ?>">
                    <span>Počet gólov</span>
                    <i></i>
                </div>
                <input type="submit" name="submit" value="Accept">
            </div>
            <div class="dva">
                <div class="sign_up_box_input">
                    <input type="text" name="priezvisko" required="required" value = "<?php if(isset($row)){ echo $row['priezvisko']; } ?>">
                    <span>Priezvisko</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="rocnik" required="required" value = "<?php if(isset($row)){ echo $row['rocnik']; } ?>">
                    <span>Ročník</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="pocet_asistencii" required="required" value = "<?php if(isset($row)){ echo $row['pocet_asistencii']; } ?>">
                    <span>Počet asistencií</span>
                    <i></i>
                </div>
                <select name="pozicia">
                    <?php
                        while($rowPozicia = mysqli_fetch_assoc($resultPozicia)) {
                            $selected = ($rowPozicia['id'] == $row['pozicia_id']) ? 'selected' : '';
                            echo '<option value="' . $rowPozicia['id'] . '" ' . $selected . '>' . $rowPozicia['nazov'] . '</option>';
                        }
                    ?>
                </select>
            </div>
        </form>
    </div>           
</div>
<script>
document.querySelector('form[name="playerForm"]').addEventListener('submit', function(event) {
    var meno = document.querySelector('input[name="meno"]').value;
    var priezvisko = document.querySelector('input[name="priezvisko"]').value;
    var rocnik = parseInt(document.querySelector('input[name="rocnik"]').value);

    var errors = [];

    if (meno.length < 2) {
        errors.push("Meno musí mať minimálne 2 znaky.");
    }

    if (priezvisko.length < 2) {
        errors.push("Priezvisko musí mať minimálne 2 znaky.");
    }

    if (rocnik < 1950 || rocnik > 2023) {
        errors.push("Ročník musí byť medzi 1950 a 2023.");
    }

    if (errors.length > 0) {
        event.preventDefault(); // Zabránenie odosielaniu formulára pri chybách

        var errorMessages = errors.join('\n');
        alert(errorMessages);
    }
});
</script>


