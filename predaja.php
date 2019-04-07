<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if (!isset($_SESSION['id'])) {
    header('Location:denied.html');
}

if (!$_POST) {
    $r = $c->query("SELECT * FROM kategorija");
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<h2>Predaja oglasa</h2>';
    echo '<form method="post" action="">';
    echo '<p>Naslov: <input type="text" name="naslov"></p>';
    echo '<p><textarea name="opis" rows="15" cols="60">Opis oglasa</textarea></p>';
    echo '<p>Cijena: <input type="number" name="cijena" min="1" step="0.01"></p>';
    echo '<p>Kategorija: <select name="kategorija">';
    echo '<option value="null">Odaberi kategoriju</option>';
    while ($row = $r->fetch_assoc()) {
        echo '<option value="' . $row['id_kategorija'] . '">' . $row['naziv'] . '</option></p>';
    }
    echo '</select>';
    echo '<p><input type="submit" name="submit" value="Predaj oglas"></p>';
    echo '</form>';
    echo '<p><a href="dash.php">Natrag</a></p>';
}else{      //zavrsetak !post
    $idUser = $_SESSION['id'];      //id korisnika -> veza korisnik-oglas
    $naslov = $_POST['naslov'];
    $opis = $_POST['opis'];
    $cijena = $_POST['cijena'];
    $kategorija = $_POST['kategorija'];
    
    $sql = "INSERT INTO oglas (id_user, naslov, opis, cijena, id_kategorija, aktivan, br_pogleda)"
            . "VALUES ('$idUser', '$naslov','$opis', $cijena, $kategorija, 1, 0)";
    
    $r = $c->query($sql);
    
    echo '<p><strong>Oglas je dodan</strong></p>';
    echo '<p><a href="dash.php">Natrag</a></p>';
}