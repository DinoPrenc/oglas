<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

$id = $_GET['id'];

if(!isset($_SESSION['id'])){
    header('Location:denied.html');
}

$r = $c->query("SELECT id_user FROM oglas WHERE id_oglas=$id");
$row = $r->fetch_assoc();
$idUser = $row['id_user'];

if($_SESSION['id'] != $idUser){
    header('Location:denied.html');
}

if(!$_POST){
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<h2>Brisanje oglasa</h2>';
    echo '<p>Jesi li siguran da zelis trajno obristai oglas?</p>';
    echo '<form method="post" action="">';
    echo '<input type="radio" name="brisanje" value="DA" checked>DA';
    echo '<input type="radio" name="brisanje" value="NE">NE<br>';
    echo '<input type="submit" name="submit" value="submit">';
}else{
    $brisanje = $_POST['brisanje'];
    
    if($brisanje == 'DA'){
        $sql = "DELETE FROM oglas WHERE id_oglas = $id LIMIT 1";
        if($c->query($sql)){
            header('Location:pregled.php');
        }else{
            echo 'Greska: '. $c->error;
            echo '<br><a href="pregled.php">Natrag</a>';
        }
    }else{
        header('Location:pregled.php');
    }
}

