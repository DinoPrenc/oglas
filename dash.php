<?php
session_start();

include_once ('header.php');
h();

if (!isset($_SESSION['id'])) {
    echo '<p>Potrebno se je prijaviti</p>';
    echo '<p><a href="login.php">Prijava</a></p>';
} else {
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<h2>Kontrolna ploča</h2>';
    echo '<p>Bok, <strong>' . $_SESSION['ime'] . '</strong>. </p>';
    if($_SESSION['admin'] == 1){
        echo '<p><a href="logs.php">Pregled logova</a></p>';
        echo '<p><a href="stats.php">Statistika</a></p>';            //izvuc statistiku iz baze
        echo '<p><a href="dodaj_kat.php">Dodaj kategoriju</a></p>';
        echo '<hr>';
    }
    echo '<p><a href="predaja.php">Predaja oglasa</a></p>';
    echo '<p><a href="pregled.php">Pregled oglasa</a></p>';
    echo '<hr>';
    echo '<p><a href="user_data.php">Pregled i promjena korisnickih podataka</a></p>';
    echo '<p><a href="change_pass.php">Promjena lozinke</a></p><br>';
    echo '<p><a href="index.php">Povratak na pocetnu</a></p>';
    echo '<p><a href="logout.php">ODJAVA</a></p>';
}