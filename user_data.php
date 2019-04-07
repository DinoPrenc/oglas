<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if (!isset($_SESSION['id'])) {
    header('Location:denied.html');
}

$id = $_SESSION['id'];

if (!$_POST) {
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<h2>Korisnički podaci</h2>';
    $r = $c->query("SELECT * FROM user WHERE id_user = $id");
    $row = $r->fetch_assoc();
    $rZ = $c->query("SELECT * FROM zupanija");
    echo '<form method="post" action="">';
    echo '<p>Ime: <input type="text" name="ime" value="' . $row['ime'] . '"></p>';
    echo '<p>Prezime: <input type="text" name="prezime" value="' . $row['prezime'] . '"></p>';
    echo '<p>Zupanija: <select name="zupanija">';
    while ($rowZ = $rZ->fetch_assoc()) {
        echo '<option value="null">Odaberi zupaniju</option>';
        echo '<option value="' . $rowZ['id_zupanija'] . '"';
        if ($row['id_zupanija'] == $rowZ['id_zupanija']) {
            echo 'selected="selected"';
        }
        echo '>' . $rowZ['naziv'] . '</option></p>';
    }
    echo '</select>';
    echo '<p>Broj telefona: <input type="tel" name="tel" value="' . $row['br_tel'] . '"></p>';
    echo '<p>Email: <input type="email" name="email" value="' . $row['email'] . '"></p>';
    echo '<p><input type="submit" name="submit" value="Spremi promjene"></p>';
    echo '</form>';

    echo '<a href="dash.php">Natrag</a>';
} else {      //kraj !post
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $zupanija = $_POST['zupanija'];
    $br_tel = $_POST['tel'];

    if (!isset($ime) || !isset($prezime) || !isset($email) || !isset($br_tel) || $zupanija == 'null') {
        echo '<meta http-equiv="refresh" content="3"; url="user_data.php"';
        echo '<p>Nisu uneseni svi podaci!</p>';
        echo '<p>Pričekajte</p>';
    } else {      //ako je sve uneseno
        $sql = "UPDATE user SET ime='$ime', prezime='$prezime', id_zupanija='$zupanija', email='$email', br_tel='$br_tel' WHERE id_user=$id";
        $r = $c->query($sql);
        echo $c->error;
        echo '<h1><a href="index.php">Oglasnik</a></h1>';
        echo '<a href="user_data.php">Povratak na korisničke podatke</a>';
    }
}