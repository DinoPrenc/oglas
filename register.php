<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if (!$_POST) {
    if (isset($_SESSION['id'])) {
        echo '<p>Za registeaciju novog korisnika morate biti odjavljeni</p>';
        echo '<p><a href="logout.php">Odjava</a></p>';
        echo '<p><a href="index.php">Povratak na pocetnu</a></p>';
    } else {
        $r = $c->query("SELECT id_zupanija, naziv FROM zupanija ");
        ?>
        <html>
            <head>
                <title>Oglasnik</title>
            </head>
            <!--    Stavit headers -->
            <body>
                <h1><a href="index.php">Oglasnik</a></h1>
                <h2>Registracija novog korisnika</h2>
                <form method="post" action="">
                    <p>Ime: <input type="text" name="ime" placeholder="Ime"></p>
                    <p>Prezime: <input type="text" name="prezime" placeholder="Prezime"></p>
                    <p>Email: <input type="email" name="email" placeholder="Upisi svoj email"></p>
                    <!--<p>Zupanija: <input type="text" name="district" placeholder="Zupanija"></p>-->     <!--OVDJE PADAJUCA LISTA IZ BAZE -->
                    <select name="zupanija">
                        <option value="null">Odaberi zupaniju</option>
                        <?php
                        while ($row = $r->fetch_assoc()) {
                            echo '<option value="' . $row['id_zupanija'] . '">' . $row['naziv'] . '</option>';
                        }
                        ?>
                    </select>
                    <p>Broj telefona: <input type="tel" name="tel" placeholder="Broj telefona"></p>
                    <p>Lozinka: <input type="password" name="pass"></p>
                    <p>Ponovi lozinku: <input type="password" name="pass_check"></p>
                    <p><input type="submit" name="submit" value="Registriraj se"></p>
                </form>
                <p><a href="login.php">Prijava</a></p>
            </body>
        </html>

        <?php
    }   //zavrsetak ako ne postoji session[id]
} else {      //zavrsetak !POST
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $zupanija = $_POST['zupanija'];
    $br_tel = $_POST['tel'];
    $pass = md5($_POST['pass']);
    $pass_check = md5($_POST['pass_check']);

    $sql = "INSERT INTO user (ime, prezime, email, id_zupanija, br_tel, password, admin)"
            . "VALUES ('$ime','$prezime', '$email', '$zupanija', '$br_tel', '$pass', '0')";
    $r = $c->query($sql);

    $rC = $c->query("SELECT * FROM user");
    while ($rowC = $rC->fetch_assoc()) {
        if ($rowC['email'] == $email) {
            $exist = 1;
        } else {
            $exist = 0;
        }
    }

    if ($exist) {
        echo '<p>Korisnik s navedenim emailom vec postoji</p>';
        echo '<p><a href="login.php">Prijavi se</a></p>';
        echo '<p><a href="register.php">Registracija novog korisnika</a></p>';
    } else if (!isset($ime) || !isset($prezime) || !isset($email) || !isset($br_tel) || !isset($pass) || $zupanija == 'null') {
        echo '<meta http-equiv="refresh" content="3"; url="register.php"';
        echo '<p>Nisu uneseni svi podaci!</p>';
        echo '<p>Pričekajte</p>';
    } else if ($pass != $pass_check) {
        echo '<meta http-equiv="refresh" content="3"; url="register.php"';
        echo '<p>Ponovljena lozinka se ne podudara!</p>';
        echo '<p>Pričekajte</p>';
    } else {
        echo '<p>Uspijesna registracija</p>';
        echo '<p><a href="login.php">Prijava</a></p>';
    }
}
