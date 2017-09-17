<?php
session_start();
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'models/bets.php';
require_once 'models/products.php';
require_once 'models/cats.php';
$cats = getAllCategories();
$catMenu = getTemplate('templates/cat-menu.php',['cats' => $cats]);

$bets = getAllBets();
$product = null;
$id = null;
$rules = [
    'cost' => [
        'required',
        'numeric'
    ]
];
$errors = formValidation($rules);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getSingleProduct($id);
}
$title = '';
if ($product) {
    $content = getTemplate('templates/lot.php', ['bets' => $bets, 'id' => $id, 'product' => $product, 'errors' => $errors,'catMenu' => $catMenu]);
    $title = $product['title'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {
        $currentData = strtotime('now');
        $lotData['cost'] = $_POST['cost'];
        $lotData['lot-id'] = $_POST['lot-id'];
        $lotData['data'] = $currentData;
        if (isset($_COOKIE['lot_data'])) {
            $lotDataIsset = json_decode($_COOKIE['lot_data'], true);
        }
        $lotDataIsset[] = $lotData;
        setcookie('lot_data', json_encode($lotDataIsset), time() + 3600, "/");
        header("Location: mylots.php");
    }
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
    include(__DIR__ . '/404.php');
    die();
}

renderLayout($content, $title);
