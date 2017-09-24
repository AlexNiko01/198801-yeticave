<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();

$cats = select_data($mysqliConnect, 'SELECT * FROM categories');

$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
if (isset($_GET['cat_id'])) {
    $heading = '';
    $catId = $_GET['cat_id'];
    $catData = [];
    foreach ($cats as $cat) {
        if ($cat['id'] == $catId) {
            $catData = $cat;
            $heading = $cat['name'];
        }
    }

    if (empty($catData)) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
        include(__DIR__ . '/404.php');
        die();
    }
    $postPerPage = 9;
    $postsQuantity = count(select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > NOW() AND category_id = $catId"));
    $pagesQuantity = ceil($postsQuantity / $postPerPage);
    $offset = ($currentPage - 1) * $postPerPage;
    $products = select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > NOW() AND category_id = $catId ORDER BY creation_date DESC LIMIT $postPerPage OFFSET $offset");

    $baseUrl = '/category.php?cat_id=' . $catId . '&';
    $data = compact('pagesQuantity', 'currentPage', 'baseUrl');
    $pagination = getTemplate('templates/pagination.php', $data);
    $dataContent = compact('cats', 'products', 'pagination', 'heading');
    $content = getTemplate('templates/category.php', $dataContent);

    renderLayout($content, $heading);
} else {
    header("Location: index.php");
}


