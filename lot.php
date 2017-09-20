<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();
$cats = select_data($mysqliConnect, 'SELECT * FROM `categories`');
$catMenu = getTemplate('templates/cat-menu.php', ['cats' => $cats]);

$product = null;
$id = null;
$rules = [
    'cost' => [
        'required',
        'numeric',
        'min_rate'
    ]
];
$errors = formValidation($rules);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = select_data($mysqliConnect, "SELECT lots.id, lots.title,lots.expire_date, lots.start_price,lots.rate_step, lots.photo, lots.favourite_count, lots.description, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE lots.id = '$id'");
}
$title = '';
if ($product) {
    $product = array_shift($product);
    $rates = select_data($mysqliConnect, "SELECT rates.date, rates.price, users.name AS name FROM rates LEFT JOIN users ON rates.user_id = users.id WHERE lot_id = '$id'");
    $usersId = [];
    if(isUserAuthenticated()){
        $currentUserId = $_SESSION['id'];
        $usersId = select_data($mysqliConnect, "SELECT user_id FROM rates WHERE lot_id = '$id' AND user_id = '$currentUserId'");
    }
    $content = getTemplate('templates/lot.php', ['rates' => $rates, 'id' => $id, 'product' => $product, 'errors' => $errors, 'catMenu' => $catMenu, 'usersId' => $usersId]);
    $title = $product['title'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {
        $currentData = gmdate('d-m-y G:i:s', strtotime('now'));
        $id = $_SESSION['id'];
        $lastInsertedId = insert_data($mysqliConnect, 'rates', ['date' => $currentData, 'price' => $_POST['cost'], 'user_id' => $id, 'lot_id' => $_POST['lot-id']]);
        header("Location: mylots.php");
    }
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
    include(__DIR__ . '/404.php');
    die();
}

renderLayout($content, $title, $cats);
