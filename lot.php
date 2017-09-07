<?php
require_once 'functions.php';
require_once 'models/bets.php';
require_once 'models/products.php';
$bets = getAllBets();


$product = null;
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getSingleProduct($id);
}
$title = '';
if ($product) {
    $content = getTemplate('templates/lot.php', ['bets' => $bets, 'id' => $id, 'product' => $product]);
    $title = $product['title'];
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
    include(__DIR__ . '/404.php');
    die();
}

renderLayout($content,$title);
