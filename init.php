<?php
require_once 'functions.php';

$mysqliConnect = mysqli_connect('db', 'root', 'root', 'yeticave');
$error = '';
if (!$mysqliConnect) {
    $error = "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    $content = getTemplate('templates/error.php', ['error' => $error]);
    renderLayout($content, 'Error');
    exit;
}
