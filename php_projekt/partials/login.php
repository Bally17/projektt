<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'database/database_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['login'])) {
        $error = "";

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $error = "Meno alebo heslo neboli zadané.";
            exit;
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM uzivatelia WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Výstup dát z každého riadku
          while($row = $result->fetch_assoc()) {
            if(password_verify($password, $row['heslo'])){
                $_SESSION['username'] = $username;
                if($username == "admin") {
                    $_SESSION['admin'] = true;
                }
                $sql = "UPDATE uzivatelia SET last_login=now() WHERE username='$username'";
                if ($conn->query($sql) !== TRUE) {
                    $error = "Chyba pri aktualizácii času posledného prihlásenia: " . $conn->error;
                }
                header("Refresh:0");
            }else{
                $error = "Nesprávne heslo.";
            }
          }
        } else {
            $error = "Užívateľ s týmto menom neexistuje.";
        }
        $conn->close();
    }
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['delete_user'];

        $sql = "DELETE FROM uzivatelia WHERE id=$user_id";
        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            $error = "Chyba pri odstraňovaní používateľa: " . $conn->error;
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['admin']);
        header("Refresh:0");
    }
}
?>
<script>
    <?php if (!empty($error)): ?>
    alert("<?php echo $error; ?>");
    <?php endif; ?>
</script>
<div class="login" id="login">
    <form method="POST">
        <div class="login_box">
            <div class="top">
                <header class="header_login">
                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Login'; ?>
                </header>
            </div>
            <?php if (!isset($_SESSION['username'])): ?>
                <div class="input_field">
                    <input type="text" name="username" class="input_input" placeholder="Meno">
                    <i class='bx bx-user'></i>
                </div>
            <?php endif; ?>
            <?php if (!isset($_SESSION['username'])): ?>
                <div class="input_field">
                    <input type="password" name="password" class="input_input" placeholder="Heslo">
                    <i class='bx bx-lock-alt'></i>
                </div>
            <?php endif; ?>
            <div class="input_field">
                <?php if (isset($_SESSION['username'])): ?>
                    <input type="submit" name="logout" class="input_submit" value="Logout">
                <?php else: ?>
                    <input type="submit" name="login" class="input_submit" value="Login">
                <?php endif; ?>
            </div>
            <?php if (!isset($_SESSION['username'])): ?>
                <div class="input_field">
                    <button type="button" class="input_submit" id="goToRegister">Ešte nemáte účet?</button>
                </div>
            <?php endif; ?>
            <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
                    // Zobraziť tabuľku iba pre prihláseného používateľa "admin"
                    // Získať všetkých používateľov z tabuľky uzivatelia
                    $sql = "SELECT * FROM uzivatelia";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Vypísať používateľov v tabuľke
                        echo '<table style="margin-top: 20px; margin-left:0;">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Meno</th>';
                        echo '<th>Čas vytvorenia</th>';
                        echo '<th>Čas posledného prihlásenia</th>';
                        echo '<th>Admin</th>';
                        echo '<th>Odstránenie</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = $result->fetch_assoc()) {
                            $creation_time = $row['cas'];
                            $last_login_time = $row['last_login'];
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td>' . $creation_time . '</td>';
                            echo '<td>' . $last_login_time . '</td>';
                            echo '<td>' . $row['administrator']  . '</td>';
                            echo '<td><button type="submit" name="delete_user" style="
                            background-color: #0e1720;
                            border: 1px solid white;
                            color: white;
                            border-radius: 50px;
                            padding: 5px 10px;
                            cursor: pointer"
                            value="' . $row['id'] . ' ">Odstrániť ' . $row["username"] . '</button></td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo 'Žiadni používatelia v tabuľke.';
                    }
                }
            ?>
            <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] !== 'admin') {
                    // Zobraziť tabuľku iba pre prihláseného používateľa, ktorý nie je "admin"
                    // Získať používateľa z tabuľky uzivatelia
                    $username = $_SESSION['username'];
                    $sql = "SELECT cas, last_login FROM uzivatelia WHERE username='$username'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Vypísať používateľa v tabuľke
                        echo '<table style="margin-top: 20px;">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Čas vytvorenia</th>';
                        echo '<th>Čas posledného prihlásenia</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = $result->fetch_assoc()) {
                            $creation_time = $row['cas'];
                            $last_login_time = $row['last_login'];
                            echo '<tr>';
                            echo '<td>' . $creation_time . '</td>';
                            echo '<td>' . $last_login_time . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo 'Nie sú dostupné žiadne údaje.';
                    }
                }
            ?>
        </div>
    </form>
</div>


