<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

$id = $_REQUEST['id'];
$search = $_REQUEST['search'];
$order = $_REQUEST['order'];
$kategorija = $_REQUEST['kategorija'];

$sql = "SELECT * FROM oglas WHERE id_oglas=$id";
$r = $c->query($sql);
$row = $r->fetch_assoc();

$idUser = $row['id_user'];
$sqlUser = "SELECT * FROM user WHERE id_user = $idUser";
$rU = $c->query($sqlUser);
$rowU = $rU->fetch_assoc();

$br_pogleda = $row['br_pogleda'];

echo '<h1><a href="index.php">Oglasnik</a></h1>';
echo '<h2>Pregled oglasa</h2>';
echo '<h3>' . $row['naslov'] . '</h3>';
echo '<p>Opis oglasa:<br>' . $row['opis'] . '</p>';
echo '<p>cijena: ' . $row['cijena'] . 'kn</p>';
echo '<p><a href="mailto:' . $rowU['email'] . '?Subject=Upit%20za%20oglas%20' . $row['naslov'] . '">Kontaktiraj</a></p>';
echo '<p>Broj pogleda: ' . $br_pogleda . '</p>';
echo '<a href="main.php?search=' . $search . '&order=' . $order . '&kategorija=' . $kategorija . '">Natrag</a>';

$br_pogleda+=1;
$c->query("UPDATE oglas SET br_pogleda = $br_pogleda WHERE id_oglas=$id");
