<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();
$cats = select_data($mysqliConnect, 'SELECT * FROM categories');
$catMenu = getTemplate('templates/cat-menu.php', ['cats' => $cats]);

if (isUserAuthenticated()) {
    $id = $_SESSION['id'];
    $ratedProducts = select_data($mysqliConnect, "SELECT lots.id AS lot_id,lots.photo, lots.title, lots.expire_date, rates.price, DATE_FORMAT(date, '%d.%m.%y %H:%i') as date, categories.name AS cat_name
FROM lots 
JOIN categories ON categories.id = lots.category_id
JOIN rates ON lots.id = rates.lot_id 
WHERE rates.user_id = '$id'");

    $content = getTemplate('templates/mylots.php', ['ratedProducts' => $ratedProducts, 'catMenu' => $catMenu]);
    renderLayout($content, 'Мои ставки');
} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
