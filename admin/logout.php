<?php
ob_start();
session_start();
if ($_SESSION['role'] == 'author') {
    header("Location:/");
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    unset($_SESSION['author_image']);
    session_destroy();
    exit();
}
else {
    if ($_SESSION['role'] == 'admin')
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        unset($_SESSION['author_image']);
        header("location: login.php");
        session_destroy();
        exit();
}
//session_destroy();
?>