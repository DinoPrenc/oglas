<?php

session_start();

if(!isset($_SESSION['id'])){
    header('Location:denied.html');
}

$c = new mysqli("localhost", "root", "", "oglasnik");       //rjesit preko includea

if(!$_POST){
    echo '<h1><a href="index.php">Oglasnik</a></h1>';
    echo '<h2>Promjena lozinke</h2>';
    echo '<form method="post" action=""';
    echo '<p>Stara lozinka: <input type="password" name="pass_old"></p>';
    echo '<p>Unesi novu lozinku: <input type="password" name="pass"></p>';
    echo '<p>Ponovo unesi novu lozinku: <input type="password" name="pass_check"></p>';
    echo '<p><input type="submit" name="submit" value="Promjena"></p>';
    echo '<p><a href="dash.php">Natrag</a></p>';
}else{      //zavrsetak !post
    $c = new mysqli("localhost", "root", "", "oglasnik");
    
    $userID = $_SESSION['id'];
    $old = md5($_POST['pass_old']);
    $new = md5($_POST['pass']);
    $new_check = md5($_POST['pass_check']);
    
    $sql_change = "UPDATE  user SET password = '$new'";
    $sql_verify = "SELECT password FROM user WHERE id_user = '$userID'";
    
    $r = $c->query($sql_verify);
    $row = $r->fetch_assoc();
    
    if($row['password'] == $old){
        if($new == $new_check){
            $r = $c->query($sql_change);
            //preusmjerit nekamo...
            echo 'lozinka promjenjena';     //privremeno rjesenje za testiranje
        }else{
            echo '<h2>Lozinka se ne podudara</h2>';
            echo '<p><a href="change_pass.php">Pokusaj ponovo</a></p>';
        }
    }else{
        echo '<h2>Netocna stara lozinka</h2>';
        echo '<p><a href="change_pass.php">Pokusaj ponovo</a></p>';
    }
    
    
}
