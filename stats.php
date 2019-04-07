<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if ($_SESSION['admin'] != 1) {
    header('Location:denied.html');
}
echo '<h1><a href="index.php">Oglasnik</a></h1>';
echo '<h2>Pregled statistike</h2>';

//upiti za stat
$noUsers = "SELECT COUNT(id_user) as count FROM user";
$noOglas = "SELECT COUNT(id_oglas) as count FROM oglas";
$noKat = "SELECT COUNT(id_kategorija) as count FROM kategorija";
$noLogin = "SELECT COUNT(log_no) as count FROM logs WHERE success_login = 1";
$noViews = "SELECT SUM(br_pogleda) as count FROM oglas";

$r1 = $c->query($noUsers);
$r2 = $c->query($noOglas);
$r3 = $c->query($noKat);
$r4 = $c->query($noLogin);
$r5 = $c->query($noViews);


$row1 = $r1->fetch_assoc();
$row2 = $r2->fetch_assoc();
$row3 = $r3->fetch_assoc();
$row4 = $r4->fetch_assoc();
$row5 = $r5->fetch_assoc();

echo '<p>Broj registriranih korisnika: '.$row1['count'].'</p>';
echo '<p>Broj oglasa u bazi: '.$row2['count'].'</p>';
echo '<p>Broj kategorija: '.$row3['count'].'</p>';
echo '<p>Broj prijava u sustav: '.$row4['count'].'</p>';
echo '<p>Broj pregleda svih oglasa: '.$row5['count'].'</p>';
echo '<p>Broj pregleda svih oglasa: '.$row5['count'].'</p>';

echo '<p><a href="dash.php">Natrag</a></p>';