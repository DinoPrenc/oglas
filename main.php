<?php

session_start();

include_once ('connect.php');
include_once ('header.php');
h();

$sql_kat = "SELECT * FROM kategorija ORDER BY naziv ASC";
$rK = $c->query($sql_kat);

echo '</header>';

echo '<h1><a href="index.php">Oglasnik</a></h1>';
echo '<h2>Oglasi</h2>';
echo '<form method="post" action="">';
echo '<p>Trazi: <input type="text" name="search"></p>';
echo '<p>Sortiraj<select name="order">';
echo '<option value="price_asc">Cijena od vece</option>';
echo '<option value="price_desc">Cijena od manje</option>';
echo '</select></p>';
echo '<p>Kategorija<select name="kategorija">';
echo '<option value="default">Sve kategorije</option>';
while ($rowK = $rK->fetch_assoc()) {
    echo '<option value="' . $rowK['id_kategorija'] . '">' . $rowK['naziv'] . '</option>';
}
echo '</select></p>';
echo '<p><input type="submit" name="submit" value="Pretrazi"></p>';
echo '<form>';

if (!$_REQUEST) {
    $sql = "SELECT * FROM oglas WHERE aktivan=1 ORDER BY cijena ASC";
    $r = $c->query($sql);
    echo '<table border=1>';
    echo '<tr align="center">';
    echo '<td>Naslov</td>';
    echo '<td>Cijena</td>';
    echo '</tr>';
    while ($row = $r->fetch_assoc()) {
        echo '<tr align="center">';
        echo '<td width=300px height=75px>' . $row['naslov'] . '</td>';
        echo '<td width=200px>' . $row['cijena'] . 'kn</td>';
        $kategorija = $row['id_kategorija'];
        echo '<td width=120px><a href=oglas.php?id=' . $row['id_oglas'] . '&search=&order=price_asc&kategorija=' . $kategorija . '">Pregledaj</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    $search = $_REQUEST['search'];
    $order = $_REQUEST['order'];
    $kategorija = $_REQUEST['kategorija'];

    $sql_search = "SELECT * FROM oglas WHERE (naslov LIKE '%$search%') OR (opis LIKE '%$search%')";

    if ($order == 'price_desc') {
        if ($kategorija != 'default')
            $sql = "SELECT * FROM oglas WHERE (id_kategorija = $kategorija) AND ((naslov LIKE '%$search%') OR (opis LIKE '%$search%')) ORDER BY cijena ASC";
        else
            $sql = "SELECT * FROM oglas WHERE (naslov LIKE '%$search%') OR (opis LIKE '%$search%') ORDER BY cijena ASC";
    }else {
        if ($kategorija != 'default')
            $sql = "SELECT * FROM oglas WHERE (id_kategorija = $kategorija) AND ((naslov LIKE '%$search%') OR (opis LIKE '%$search%')) ORDER BY cijena DESC";
        else
            $sql = "SELECT * FROM oglas WHERE (naslov LIKE '%$search%') OR (opis LIKE '%$search%') ORDER BY cijena DESC";
    }

    $r = $c->query($sql);
    echo '<table border=1>';
    while ($row = $r->fetch_assoc()) {
        echo '<tr align="center">';
        echo '<td width=300px height=75px>' . $row['naslov'] . '</td>';
        echo '<td width=200px>' . $row['cijena'] . 'kn</td>';
        echo '<td width=120px><a href="oglas.php?id=' . $row['id_oglas'] . '&search=' . $search . '&order=' . $order . '&kategorija=' . $kategorija . '">Pregledaj</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}
    