<?php
session_start();
require_once 'functions.php';
require_once 'models/cats.php';
require_once 'models/bets.php';
require_once 'models/cats.php';
$cats = getAllCategories();
$catMenu = getTemplate('templates/cat-menu.php', ['cats' => $cats]);


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
        $content = getTemplate('templates/lot.php', ['bets' => $bets, 'product' => $product, 'errors' => $errors, 'catMenu' => $catMenu]);
    } else {
        $content = getTemplate('templates/add-lot.php', ['cats' => $cats, 'errors' => $errors, 'file_error_text' => $file_error_text, 'catMenu' => $catMenu]);
    }
    renderLayout($content, 'Добавление лота');

} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
