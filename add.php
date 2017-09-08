<?php
session_start();
require_once 'functions.php';
require_once 'models/cats.php';
require_once 'models/bets.php';
$cats = getAllCategories();

$rules = [
    'lot-name' => [
        'required',
    ],
    'category' => [
        'required',
    ],
    'message' => [
        'required',
    ],
    'lot-rate' => [
        'required',
        'numeric'
    ],
    'lot-step' => [
        'required',
        'numeric'
    ],
    'lot-date' => [
        'required',
    ],
];
$errors = formValidation($rules);
$file_error_text = fileValidation();

if (isUserAuthenticated()) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors) && !$file_error_text) {
        $product = renderLotData();
        $bets = getAllBets();
        $content = getTemplate('templates/lot.php', ['bets' => $bets, 'product' => $product,'errors' => $errors]);
    } else {
        $content = getTemplate('templates/add-lot.php', ['cats' => $cats, 'errors' => $errors, 'file_error_text' => $file_error_text]);
    }
    renderLayout($content, 'Добавление лота');

} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
