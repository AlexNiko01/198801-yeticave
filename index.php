<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();
$now = gmdate('Y-m-d H:i:s', strtotime('now'));
$products = select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo,lots.expire_date, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > '$now'  ORDER BY lots.id ASC LIMIT 6");
$cats = select_data($mysqliConnect, 'SELECT * FROM categories');

$content = getTemplate('templates/index.php', ['cats' => $cats, 'products' => $products]);
renderLayout($content, 'Главная', $cats);