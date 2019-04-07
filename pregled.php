<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if(!isset($_SESSION['id'])){
    header('Location:denied.html');
}

$userID = $_SESSION['id'];
$sql = "SELECT * FROM oglas WHERE id_user = '$userID'";
$r = $c->query($sql);

echo '<h1><a href="index.php">Oglasnik</a></h1>';
echo '<h2>Pregled vaših oglasa</h2>';
echo '<table border=1>';
echo '<tr>';
echo '<td>Naslov</td>';
echo '<td>Cijena</td>';
echo '<td>Broj pregleda</td>';
echo '<td>Kategorija</td>';
echo '<td>Aktivan</td>';
echo '</tr>';
while ($row = $r->fetch_assoc()){
    echo '<tr>';
    echo '<td>'.$row['naslov'].'</td>';
    echo '<td>'.$row['cijena'].'</td>';
    echo '<td>'.$row['br_pogleda'].'</td>';
    $id_k = $row['id_kategorija'];  //id kategorije
    $rK = $c->query("SELECT naziv FROM kategorija WHERE id_kategorija = $id_k");
    $rowK = $rK->fetch_assoc();     //za dohvatit podatke iz kategorije(naziv)
    $naziv_kat = $rowK['naziv'];   //naziv kategorije
    echo '<td>'.$naziv_kat.'</td>';
    if($row['aktivan']){
        echo '<td>DA</td>';
    }else{
        echo '<td>NE</td>';
    }
    $idOglas = $row['id_oglas'];
    echo '<td><a href="izmjena.php?id='.$idOglas.'">Izmjeni</td>';
    echo '<td><a href="brisi.php?id='.$idOglas.'">Izbrisi</td>';
    echo '</tr>';
}
echo '</table>';
echo '<p><a href="dash.php">Natrag</a></p>';