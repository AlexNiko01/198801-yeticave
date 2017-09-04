<?php
require_once 'functions.php';
require_once 'models/cats.php';
require_once 'models/bets.php';
$cats = getAllCategories();

$is_auth = (bool)rand(0, 1);
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$user_data = compact('user_name', 'user_avatar', 'is_auth');

$user_menu = getTemplate('templates/user-menu.php', $user_data);
$errors = formValidation();
$file_error_text = fileValidation();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors['errors_required']) && empty($errors['errors_rules']) && !$file_error_text) {
    $product = renderLotData();
    $bets = getAllBets();
    $content = getTemplate('templates/lot.php', ['bets' => $bets, 'product' => $product]);
} else {
    $content = getTemplate('templates/add-lot.php', ['cats' => $cats, 'errors' => $errors, 'file_error_text' => $file_error_text]);
}


$layout = getTemplate('templates/layout.php', ['content' => $content, 'page_title' => 'Добавление лота', 'user_menu' => $user_menu]);

print $layout;
