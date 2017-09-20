<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();
$now = gmdate('Y-m-d H:i:s', strtotime('now'));
$cats = select_data($mysqliConnect, 'SELECT * FROM categories');

$currentPage = 1;
if (!empty($_GET['page'])) {
    $currentPage = $_GET['page'];
}
$postPerPage = 3;
$postsQuantity = count(select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > '$now'  ORDER BY lots.id ASC"));
$pagesQuantity = ceil($postsQuantity / $postPerPage);
$offset = ($currentPage - 1) * $postPerPage;
$products = select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > '$now'  ORDER BY lots.id ASC LIMIT 3 OFFSET 0");

if (!empty($_GET['page'])) {
    $products = select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > '$now'  ORDER BY lots.id ASC LIMIT 3 OFFSET $offset");
}

$pagination = getTemplate('templates/pagination.php', ['pagesQuantity' => $pagesQuantity, 'currentPage' => $currentPage]);

$content = getTemplate('templates/index.php', ['cats' => $cats, 'products' => $products, 'pagination' => $pagination]);
renderLayout($content, 'Главная', $cats);