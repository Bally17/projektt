<?php
if (isset($_POST['register'])) {
    include 'database/database_conn.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $error = "";

    if (strlen($username) < 2 || strlen($password) < 2) {
        $error = "Užívateľské meno a heslo musia mať minimálne 2 znaky.";
    } elseif ($password !== $confirmPassword) {
        $error = "Heslá sa nezhodujú.";
    } elseif (!preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $error = "Heslo musí obsahovať minimálne 1 veľké písmeno, 1 malé písmeno a 1 číslo.";
    } else {
        // Overenie, či užívateľské meno už existuje
        $stmt = $conn->prepare("SELECT username FROM uzivatelia WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Užívateľské meno už existuje. Zvoľte prosím iné.";
        } else {
            // Všetky podmienky sú splnené, vykonaj registráciu
            $stmt = $conn->prepare("INSERT INTO uzivatelia (username, heslo, administrator, cas) VALUES (?, ?, 'Nie', NOW())");
            $stmt->bind_param("ss", $username, $hashed_password);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashovanie hesla

            $stmt->execute();

            $stmt->close();
            $conn->close();

            header("Location: index.php");
            exit;
        }
    }
}
?>

<script>
    <?php if (!empty($error)): ?>
    alert("<?php echo $error; ?>");
    <?php endif; ?>
</script>

<div class="register" id="register">
    <form action="" method="POST">
        <div class="register_box">
            <div class="top">
                <header class="header_register">Register</header>
            </div>
            <div class="input_field">
                <input type="text" name="username" class="input_input" placeholder="Meno">
                <i class='bx bx-user'></i>
            </div>
            <div class="input_field">
                <input type="password" name="password" class="input_input" placeholder="Heslo">
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="input_field">
                <input type="password" name="confirm_password" class="input_input" placeholder="Potvrďte heslo">
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="input_field">
                <input type="submit" name="register" class="input_submit" value="Register">
            </div>
            <div class="input_field">
                <button type="button" class="input_submit" id="goToLogin">Už máte účet?</button>
            </div>
        </div>
    </form>
</div>
