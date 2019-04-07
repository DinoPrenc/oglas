<?php

function h() {
    if (!isset($_SESSION['id'])) {
        $login = false;
    } else {
        $login = true;
    }
    echo '<header>';
    if ($login) {
        echo 'Bok, ' . $_SESSION['ime'] . '!&nbsp;&nbsp;';
        echo '<a href="dash.php">Kontrolna ploča</a>&nbsp;|&nbsp;<a href="logout.php">Odjava</a>';
    } else {
        echo '<a href="login.php">Prijava</a>&nbsp;|&nbsp;<a href="register.php">Registracija</a>';
    }
    echo '</header>';
}
