<?php
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
$cats = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$products = [
    [
        'title' => '2014 Rossignol District Snowboard',
        'cat' => 'Доски и лыжи',
        'price' => '10999',
        'img_url' => 'img/lot-1.jpg'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'cat' => 'Доски и лыжи',
        'price' => '159999',
        'img_url' => 'img/lot-2.jpg'
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'cat' => 'Крепления',
        'price' => '8000',
        'img_url' => 'img/lot-3.jpg'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'cat' => 'Ботинки',
        'price' => '10999',
        'img_url' => 'img/lot-4.jpg'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'cat' => 'Одежда',
        'price' => '7500',
        'img_url' => 'img/lot-5.jpg'
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'cat' => 'Разное',
        'price' => '5400',
        'img_url' => 'img/lot-6.jpg'
    ],
];

require_once 'functions.php';
$user_menu = getTemplate('templates/user-menu.php',['user_name' => $user_name, 'user_avatar' => $user_avatar, 'is_auth' => $is_auth]);
$content = getTemplate('templates/index.php', ['cats' => $cats, 'products' => $products, 'lot_time_remaining' => $lot_time_remaining]);

$layout = getTemplate('templates/layout.php', ['content' => $content, 'page_title' => 'Главная', 'user_menu' =>$user_menu]);
print $layout;