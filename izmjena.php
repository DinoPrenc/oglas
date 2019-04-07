<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

$id = $_GET['id'];

if(!isset($_SESSION['id'])){
    header('Location:denied.html');
}

$r = $c->query("SELECT * FROM oglas WHERE id_oglas=$id");
$row = $r->fetch_assoc();
$idUser = $row['id_user'];


if($_SESSION['id'] != $idUser){
    header('Location:denied.html');
}

if(!$_POST){
    $rK = $c->query("SELECT * FROM kategorija");
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<h2>Izmjena oglasa</h2>';
    echo '<form method="post" action="">';
    echo '<p>Naslov: <input type="text" name="naslov" value="'.$row['naslov'].'"></p>';
    echo '<p><textarea name="opis" rows="15" cols="60">'.$row['opis'].'</textarea></p>';
    echo '<p>Cijena: <input type="number" name="cijena" min="1" step="0.01" value="'.$row['cijena'].'"></p>';
    echo '<p>Kategorija: <select name="kategorija">';
    while($rowK = $rK->fetch_assoc()){
        echo '<option value="null">Odaberi kategoriju</option>';
        echo '<option value="'.$rowK['id_kategorija'].'"';
        if($rowK['id_kategorija'] == $row['id_kategorija']){
            echo 'selected="selected"';
        }
        echo '>'.$rowK['naziv'].'</option></p>';
    }
    echo '</select>';
    echo '<p>Zelite li da oglas bude aktivan?</p>';
    echo '<input type="radio" name="aktivan" value="DA" checked>DA';
    echo '<input type="radio" name="aktivan" value="NE">NE<br>';
    echo '<p><input type="submit" name="submit" value="Predaj oglas"></p>';
    echo '</form>';
    echo '<p><a href="pregled.php">Natrag</a></p>';
}else{
    $naslov = $_POST['naslov'];
    $opis = $_POST['opis'];
    $cijena = $_POST['cijena'];
    $kategorija = $_POST['kategorija'];
    if($_POST['aktivan'] == 'DA'){
        $aktivan = 1;
    }else{
        $aktivan = 0;
    }
    
    $sql = "UPDATE oglas SET naslov='$naslov', opis='$opis', cijena=$cijena, id_kategorija=$kategorija, aktivan=$aktivan WHERE id_oglas= $id";
    $r = $c->query($sql);
    echo $c->error;
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<a href="pregled.php">Povratak na oglase</a>';
}
