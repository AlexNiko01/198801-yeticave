<?php
session_start();
unset($_SESSION['user']);
if (isset($_COOKIE['lot_data'])) {
    setcookie('lot_data', '', time() - 3600, "/");

}

header("Location: index.php");