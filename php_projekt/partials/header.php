<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayerStats</title>
    <link rel="icon" href="img/icon-modified.png">
    <link rel="stylesheet" href="css/display.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/ihrisko.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="nav_bar">
            <nav>
                <ul class="nav_ul_links">
                    <a href="index.php" class="svgimg"><i class="fa-solid fa-house" style="color: #fff;"></i></a>
                    <li><a href="#" id="first">Štatistiky</a></li>
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                        <li><a href="#" id="second">Prihlásenie hráča</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo '<a href="#" id="third">' . $username . ' - Log out</a>';
            } else {
                echo '<a href="#" id="third">Log in</a>';
            }
            ?>
        </div>
    </header>
    <section>