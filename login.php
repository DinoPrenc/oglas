<?php
session_start();

include_once ('connect.php');
include_once ('header.php');
h();

if (!$_POST) {
    if (isset($_SESSION['id'])) {       //u slucaju da je korisnik prijavljen
        echo '<p>Odjavite se za ponovnu prijavu</p>';
        echo '<p><a href="logout.php">Odjava</a></p>';
        echo '<p><a href="index.php?a=log">Vrati se na pocetnu</a></p>';
    } else {
        ?>

        <html>
            <head>
                <title>Oglasnik</title>
            </head>
            <body>
                <h1><a href="index.php">Oglasnik</a></h1>
                <h2>Prijava</h2>
                <form method="post" action="">
                    <p>Email: <input type="text" name="email" placeholder="Upisi svoj email"></p>
                    <p>Lozinka: <input type="password" name="pass"></p>
                    <p><input type="submit" name="submit" value="Prijava"></p>
                </form>
                <p><a href="register.php">Registracija novog korisnika</a></p>
            </body>
        </html>

        <?php
    }
} else {      //Zavrsetak !POST -> pocetak POSTA
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);

    //za spremanje logova
    $timestamp = $_SERVER['REQUEST_TIME'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $sql = "SELECT * FROM user WHERE email = '$email' and password = '$pass'";
    $r = $c->query($sql);
    
    $stat = $c->stat();     //za logove
    
    $provjera = mysqli_num_rows($r);        //nadeno u bazi?

    if ($provjera == 1) {
        session_start();

        $row = $r->fetch_assoc();
        $id = $row['id_user'];
        $ime = $row['ime'];
        $prezime = $row['prezime'];
        $admin = $row['admin'];     //admin da/ne
        
        $succes = 1;        //prijava uspijesna

        $_SESSION['id'] = $id;
        $_SESSION['ime'] = $ime;
        //$_SESSION['prezime'] = $prezime;
        $_SESSION['admin'] = $admin;
        
        $log = "INSERT INTO logs (id_user, time, user_agent, ip, success_login, stat) VALUES"
            . "($id, '$timestamp', '$userAgent', '$ip', $succes, '$stat')";
        $c->query($log);        //spremanje logova

        header("Location:index.php");
    } else {
        $succes = 0;
        $log = "INSERT INTO logs (time, user_agent, ip, success_login, stat) VALUES"
            . "('$timestamp', '$userAgent', '$ip', $succes, '$stat')";
        $c->query($log);
        echo '<meta http-equiv="refresh" content="2"; url="login.php"';
        echo '<p>Neuspijesna prijava. Pokusaj ponovo</p>';
    }
}