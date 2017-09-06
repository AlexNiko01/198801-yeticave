<?php
require_once 'functions.php';
require_once 'models/products.php';
require_once 'models/cats.php';
$products = getAllProducts();
$cats = getAllCategories();


// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');
// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";
// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');
$now = strtotime('now');
$interval = $tomorrow - $now;
$lot_time_remaining = gmdate('H:i', $interval);

$content = getTemplate('templates/index.php', ['cats' => $cats, 'products' => $products, 'lot_time_remaining' => $lot_time_remaining]);

renderLayout($content);