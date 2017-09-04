<?php
require_once 'functions.php';
require_once 'models/bets.php';
require_once 'models/products.php';
$bets = getAllBets();

$is_auth = (bool)rand(0, 1);
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$user_data = compact('user_name', 'user_avatar', 'is_auth');

$user_menu = getTemplate('templates/user-menu.php', $user_data);
$product = null;
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getSingleProduct($id);
}

if ($product) {
    $content = getTemplate('templates/lot.php', ['bets' => $bets, 'id' => $id, 'product' => $product]);
    $title = $product['title'];
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
    include(__DIR__ . '/404.php');
    die();
}

$layout = getTemplate('templates/layout.php', ['content' => $content, 'page_title' => $title, 'user_menu' => $user_menu]);

print $layout;
