<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if ($_SESSION['admin'] != 1) {
    header('Location:denied.html');
} else {
    if (!$_POST) {
        echo '<h1><a href="index.php">Oglasnik</a></h1>';
        echo '<h2>Dodavanje nove kategorije</h2>';
        echo '<form method="post" action="">';
        echo '<p>Naziv kategorije: <input type="text" name="kat" value=""></p>';
        echo '<p><input type="submit" name="submit" value="Dodaj kategoriju"></p>';
        echo '</form>';
        echo '<p><a href="dash.php">Natrag</a></p>';
        if ($_GET) {
            if ($_GET['a'] == 'yes') {
                echo '<p><strong>Dodana je nova kategorija</strong></p>';
            }
            if($_GET['a'] == 'no'){
                 echo '<p><strong>Naziv nemoze biti prazan</strong></p>';
            }
        }
    } else {
        if(($_POST['kat']=='')){
           header('Location:dodaj_kat.php?a=no');
        }else{
        $kat = $_POST['kat'];
        $sql = "INSERT INTO kategorija (naziv) VALUES ('$kat')";
        $c->query($sql);
        header('Location:dodaj_kat.php?a=yes');
    }
    }
}