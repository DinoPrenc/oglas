<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if($_SESSION['admin'] != 1){
    header('Location:denied.html');
}else{
    $r = $c->query("SELECT * FROM logs");
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<h2>Pregled logova</h2>';
    echo '<table border=1>';
    echo '<tr>';
    echo '<td>Broj log</td>';
    echo '<td>ID korisnika</td>';
    echo '<td>Vrijeme pristupa</td>';
    echo '<td>Koristeni preglednik</td>';
    echo '<td>IP adresa pristupa</td>';
    echo '<td>Uspijesna prijava</td>';
    echo '<td>Informacije</td>';
    echo '</tr>';
    while ($row = $r->fetch_assoc()){
        echo '<tr>';
        echo '<td>'.$row['log_no'].'</td>';
        echo '<td>'.$row['id_user'].'</td>';
        echo '<td>'.$row['time'].'</td>';
        echo '<td>'.$row['user_agent'].'</td>';
        echo '<td>'.$row['ip'].'</td>';
        echo '<td>'.$row['success_login'].'</td>';
        echo '<td>'.$row['stat'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<p><a href="dash.php">Natrag</a></p>';
}