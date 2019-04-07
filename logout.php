<?php

session_start();

unset($_SESSION['id']);

session_destroy();

$a = $_GET['a'];
if ($a == 'log') {
    header("Location:login.php");
} else {
    header("Location:index.php");
}