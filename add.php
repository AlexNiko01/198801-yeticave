<?php
require_once 'functions.php';
require_once 'models/cats.php';
$cats = getAllCategories();
$is_auth = (bool)rand(0, 1);
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$user_data = compact('user_name', 'user_avatar', 'is_auth');

$user_menu = getTemplate('templates/user-menu.php', $user_data);
$content = getTemplate('templates/add-lot.php',['cats' => $cats]);


$layout = getTemplate('templates/layout.php', ['content' => $content, 'page_title' => 'Добавление лота', 'user_menu' => $user_menu]);

print $layout;
