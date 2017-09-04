<?php
require_once 'functions.php';
require_once 'models/products.php';
require_once 'models/cats.php';
$products = getAllProducts();
$cats = getAllCategories();
$is_auth = (bool)rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');
$interval = $tomorrow - $now;
// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
// ...

$lot_time_remaining = gmdate('H:i', $interval);

$user_data = compact('user_name', 'user_avatar', 'is_auth');

$user_menu = getTemplate('templates/user-menu.php', $user_data);

$content = getTemplate('templates/index.php', ['cats' => $cats, 'products' => $products, 'lot_time_remaining' => $lot_time_remaining]);

$layout = getTemplate('templates/layout.php', ['content' => $content, 'page_title' => 'Главная', 'user_menu' => $user_menu]);
print $layout;