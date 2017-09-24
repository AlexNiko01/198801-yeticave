<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();
determineWinners();

$cats = select_data($mysqliConnect, 'SELECT * FROM categories');

$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
$postPerPage = 3;
$postsQuantity = count(select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > NOW()  ORDER BY lots.id ASC"));
$pagesQuantity = ceil($postsQuantity / $postPerPage);
$offset = ($currentPage - 1) * $postPerPage;
$products = select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > NOW()  ORDER BY lots.id ASC LIMIT 3 OFFSET 0");


if (isset($_GET['page'])) {
    $products = select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > NOW()  ORDER BY lots.id ASC LIMIT 3 OFFSET $offset");
}
$baseUrl = '/index.php?';
$pagination = getTemplate('templates/pagination.php', ['pagesQuantity' => $pagesQuantity, 'currentPage' => $currentPage, 'baseUrl' => $baseUrl]);
$data = compact('cats','products','pagination');
$content = getTemplate('templates/index.php', $data);
renderLayout($content, 'Главная', $cats);